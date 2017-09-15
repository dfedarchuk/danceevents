<?php

namespace ArcaSolutions\DealBundle\Controller;

use ArcaSolutions\CoreBundle\Exception\ItemNotFoundException;
use ArcaSolutions\CoreBundle\Exception\UnavailableItemException;
use ArcaSolutions\CoreBundle\Services\ValidationDetail;
use ArcaSolutions\DealBundle\DealItemDetail;
use ArcaSolutions\DealBundle\Entity\Promotion;
use ArcaSolutions\ListingBundle\Entity\ListingCategory;
use ArcaSolutions\ListingBundle\ListingItemDetail;
use ArcaSolutions\ReportsBundle\Services\ReportHandler;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

final class DefaultController extends Controller
{
    /**
     * Homepage
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_DEAL);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::DEAL_HOME_PAGE);

        return $this->render('::base.html.twig', [
            'title' => 'Deal Index',
            'pageId'          => $page->getId(),
            'pageTitle' => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords' => $page->getMetaKey(),
            'customTag' => $page->getCustomTag()
        ]);
    }

    /**
     * Detail page
     *
     * @param $friendlyUrl
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws ItemNotFoundException
     * @throws \Exception
     * @throws \Ivory\GoogleMap\Exception\MapException
     * @throws \Ivory\GoogleMap\Exception\OverlayException
     */
    public function detailAction($friendlyUrl)
    {
        /*
         * Validation
         */
        /* @var $item Promotion For phpstorm get properties of entity Listing */
        $item = $this->get('search.engine')->itemFriendlyURL($friendlyUrl, 'deal', 'DealBundle:Promotion');
        /* event not found by friendlyURL */
        if (is_null($item)) {
            throw new ItemNotFoundException();
        }

        /* normalizes item to validate detail */
        $dealItemDetail = new DealItemDetail($this->container, $item);

        $listingItemDetail = null;
        if ($item->getListingId()) {
            $listingItemDetail = new ListingItemDetail($this->container, $item->getListing());
        }

        /*
         * It validates if the listing is enabled, if sponsor is accessing this page or if the sitemgr is accessing
         * It is used an OR conditional because it has rules for sponsor and sitemgr that have to overwrite all the others
         */
        if (!($listingItemDetail && ValidationDetail::isDetailAllowed($dealItemDetail) && 'A' === $listingItemDetail->getItem()->getStatus())) {
            /* error page */
            throw new UnavailableItemException();
        }

        /*
         * Report
         */
        if (false === ValidationDetail::isSponsorsOrSitemgr($dealItemDetail)) {
            /* Counts the view towards the statistics */
            $this->container->get("reporthandler")->addDealReport($item->getId(), ReportHandler::DEAL_DETAIL);
        }

        /*
         * Workaround to get item's locations
         * We did in this way for reuse the 'Utility.address'(summary) macro in view
         */
        $locations = array_filter($this->get('location.service')->getLocations($item->getListing()));
        $locations_ids = [];
        $locations_rows = [];
        foreach ($locations as $location) {
            $locations_ids[] = $location->getId();
            $locations_rows[$location->getId()] = $location;
        }

        $map = null;
        /* checks if item has latitude and longitude to show the map */
        if ($item->getListing()->getLatitude() && $item->getListing()->getLongitude() && $this->container->get('settings')->getSettingGoogle('maps_status') == "on") {
            /* sets map */
            $map = $this->get('ivory_google_map.map');
            $map->setApiKey($this->container->get('settings')->getSettingGoogle('maps_key'));
            $map->setMapOption("scrollwheel", false);
            $map->setStylesheetOptions([
                'width'  => '100%',
                'height' => '255px',
            ]);

            $map->setMapOption('zoom', 15);
            /* sets the item's location the center of the map */
            $map->setCenter($item->getListing()->getLatitude(), $item->getListing()->getLongitude());

            $marker = $this->get('ivory_google_map.marker');

            /* mark item in map */
            $marker->setPosition($item->getListing()->getLatitude(), $item->getListing()->getLongitude(), true);
            $marker->setOptions([
                'clickable' => false,
                'flat'      => true,
            ]);
            $map->addMarker($marker);
        }

        /* adds view phone script(listing) */
        $this->get('javascripthandler')->addJSBlock('::modules/listing/js/summary.js.twig')
            ->addJSExternalFile('assets/js/lib/countdown/jquery.countdown.min.js')
            ->addJSExternalFile('assets/js/modules/deal/detail.js');

        /* calculating percentage */
        $percentage = 0;
        if ($item->getRealvalue() != 0) {
            $percentage = sprintf('%d', 100 - $item->getDealvalue() * 100 / $item->getRealvalue());
        }

        if ($item->getListingId() and $listing = $item->getListing()) {
            $categoryIds = array_map(function ($item) {
                /* @var $item ListingCategory */
                return Category::create()
                    ->setId($item->getId())
                    ->setModule(ParameterHandler::MODULE_DEAL);
            }, $listing->getCategories()->getValues());
        } else {
            $categoryIds = [];
        }

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_DEAL);

        $twig = $this->container->get("twig");

        $twig->addGlobal('bannerCategories', $categoryIds);
        $twig->addGlobal('item', $item);
        $twig->addGlobal('map', $map);
        $twig->addGlobal('percentage', $percentage);
        $twig->addGlobal('listing_level', $listingItemDetail->getLevel());
        $twig->addGlobal('locationsIDs', $locations_ids);
        $twig->addGlobal('locationsObjs', $locations_rows);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::DEAL_DETAIL_PAGE);

        return $this->render('::modules/deal/detail.html.twig', [
            'pageId'          => $page->getId(),
            'customTag' => $page->getCustomTag()
        ]);
    }

    /**
     * All categories page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allcategoriesAction()
    {
        /* Loading and setting wysiwyg */
        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_DEAL);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::DEAL_CATEGORIES_PAGE);

        $categories = $this->get('search.repository.category')
            ->findCategoriesWithItens(ParameterHandler::MODULE_DEAL);

        $twig = $this->get('twig');

        $twig->addGlobal('categories', $categories);
        $twig->addGlobal('routing', ParameterHandler::MODULE_DEAL);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    /**
     * Make a redeem of a deal. Send notification and get the code.
     * If it was already redeemed, just get the code and show it again.
     * If it was not, generate a new code, save it and show.
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function redeemAction(Request $request, $id)
    {
        /* gets user Id using profile credentials */
        $userId = $request->getSession()->get('SESS_ACCOUNT_ID');

        if (is_null($userId)) {
            return $this->redirect('/profile/login.php?userperm=1&redeem_remember='.$id);
        }

        $deal = $this->get('doctrine')->getRepository('DealBundle:Promotion')->find($id);

        $userAccount = $this->get('doctrine')->getManager('main')->getRepository('CoreBundle:Contact')->find($userId);

        $redeem = $this->get('redeem.handler')->makeRedeem($deal, $userAccount);

        /* Get deal(listing) location. It used this function because locations's table is in other database */
        $locations = $this->get('location.service')->getLocations($deal->getListing());

        return $this->render('::blocks/modals/modal-redeem.html.twig', [
            'redeem'    => $redeem,
            'deal'      => $deal,
            'locations' => $locations,
            'user'      => $userAccount,
        ]);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function alllocationsAction()
    {
        $locations_enable = $this->get('doctrine')->getRepository('WebBundle:SettingLocation')->getLocationsEnabledID();
        $locations = $this->get('helper.location')->getAllLocations($locations_enable, ParameterHandler::MODULE_DEAL);

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_DEAL);

        $twig = $this->container->get("twig");

        $twig->addGlobal('locations', $locations);
        $twig->addGlobal('routing', ParameterHandler::MODULE_DEAL);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::DEAL_ALL_LOCATIONS);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle' => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords' => $page->getMetaKey(),
            'customTag' => $page->getCustomTag()
        ]);
    }

    /**
     * Returns children locations on ajax call
     *
     * @return Response JsonResponse
     */
    public function locationsAction(Request $request)
    {
        return $this->container->get('location.service')->getChildrenLocations($request);
    }
}
