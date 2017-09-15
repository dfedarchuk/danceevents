<?php

namespace ArcaSolutions\ListingBundle\Controller;

use ArcaSolutions\CoreBundle\Exception\ItemNotFoundException;
use ArcaSolutions\CoreBundle\Services\ValidationDetail;
use ArcaSolutions\DealBundle\Entity\Promotion;
use ArcaSolutions\ListingBundle\Entity\Listing;
use ArcaSolutions\ListingBundle\Entity\ListingCategory;
use ArcaSolutions\ListingBundle\Entity\ListingChoice;
use ArcaSolutions\ListingBundle\ListingItemDetail;
use ArcaSolutions\ListingBundle\Sample\ListingSample;
use ArcaSolutions\ReportsBundle\Services\ReportHandler;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\WysiwygBundle\Entity\Page;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Elastica\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_LISTING);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::LISTING_HOME_PAGE);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    /**
     * @param $friendlyUrl
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @throws \Ivory\GoogleMap\Exception\MapException
     * @throws \Ivory\GoogleMap\Exception\OverlayException
     */
    public function detailAction($friendlyUrl)
    {
        /*
         * Validation
         */
        /* @var $item Listing For phpstorm get properties of entity Listing */
        $item = $this->get('search.engine')->itemFriendlyURL($friendlyUrl, "listing", "ListingBundle:Listing");
        /* listing not found by friendlyURL */
        if (is_null($item)) {
            throw new ItemNotFoundException();
        }

        /* normalizes item to validate detail */
        $listingItemDetail = new ListingItemDetail($this->container, $item);
        $level = $listingItemDetail->getLevel();

        /* validating if listing is enabled, if listing's level is active and if level allows detail */
        if (!ValidationDetail::isDetailAllowed($listingItemDetail)) {
            $parameterHandler = new ParameterHandler($this->container, false);
            $parameterHandler->addModule(ParameterHandler::MODULE_LISTING);
            $parameterHandler->addKeyword($friendlyUrl);

            $this->get("request_stack")->getCurrentRequest()->cookies->set("edirectory_results_viewmode", "item");

            return $this->redirect($parameterHandler->buildUrl());
        }

        /*
         * Report
         */
        if (false === ValidationDetail::isSponsorsOrSitemgr($listingItemDetail)) {
            /* Counts the view towards the statistics */
            $this->container->get("reporthandler")->addListingReport($item->getId(), ReportHandler::LISTING_DETAIL);
        }

        /*
         * Workaround to get item's locations
         * We did in this way for reuse the 'Utility.address'(summary) macro in view
         */
        $locations = $this->get('location.service')->getLocations($item);
        $locations_ids = [];
        $locations_rows = [];
        foreach (array_filter($locations) as $levelLocation => $location) {
            $key = substr($levelLocation, 0, 2).':'.$location->getId();
            $locations_ids[] = $key;
            $locations_rows[$key] = $location;
        }

        /* gets item's gallery */
        $gallery = null;
        if ($listingItemDetail->getLevel()->imageCount > 0) {
            $gallery = $this->get('doctrine')->getRepository('ListingBundle:Listing')
                ->getGallery($item, --$listingItemDetail->getLevel()->imageCount);
        }

        $map = null;
        /* checks if item has latitude and longitude to show the map */
        if ($item->getLatitude() && $item->getLongitude() && $this->container->get('settings')->getSettingGoogle('maps_status') == 'on') {
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
            $map->setCenter($item->getLatitude(), $item->getLongitude());

            $marker = $this->get('ivory_google_map.marker');

            /* mark item in map */
            $marker->setPosition($item->getLatitude(), $item->getLongitude(), true);
            $marker->setOptions([
                'clickable' => false,
                'flat'      => true,
            ]);
            $map->addMarker($marker);
        }

        /* gets item reviews */
        $reviews = $this->get('doctrine')->getRepository('WebBundle:Review')->findBy([
            'itemType' => 'listing',
            'approved' => '1',
            'itemId'   => $item->getId(),
        ], [
            'rating' => 'DESC',
            'added'  => 'DESC',
        ], 3);

        /* gets total of reviews */
        $reviews_total = $this->get('doctrine')->getRepository('WebBundle:Review')
            ->getTotalByItemId($item->getId(), 'listing');

        $extra_fields = null;
        if ($item->getTemplate()) {
            $extra_fields = $item->getTemplate()->getFields();
        }

        /* Validates if listing has the review active */
        $reviews_active = $this->getDoctrine()->getRepository('WebBundle:Setting')
            ->getSetting('review_listing_enabled');

        $categoryIds = $categories = [];
        $array_cat = $item->getCategories()->toArray();
        foreach ($array_cat as $listingCategory) {
            $categoryIds[] = Category::create()
                ->setId($listingCategory->getCategory()->getId())
                ->setModule(ParameterHandler::MODULE_LISTING);
            $categories[] = $listingCategory->getCategory();
        }

        /* gets listing's deals */
        $deals = [];
        foreach ($item->getDeals() as $deal) {
            /* @var $deal Promotion */
            if ($this->get('deal.handler')->isValid($deal)) {
                $deals[] = $deal;
            }
        }
        /* limit deals by listing level */
        $deals = array_slice($deals, 0, $listingItemDetail->getLevel()->dealCount);

        $badges = array_map(function ($item) {
            /* @var $item ListingChoice */
            return $item->getEditorChoice();
        }, $item->getChoices()->toArray());

        /* Gets listing classifieds */
        $classifieds = [];
        foreach ($item->getClassifieds() as $classified) {
            if ($this->get('classified.handler')->isValid($classified)) {
                $classifieds[] = $classified;
            }
        }

        /* Limit classified by listing level */
        $classifieds = array_slice($classifieds, 0, $level->classifiedQuantityAssociation);

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_LISTING);

        $twig = $this->container->get("twig");

        $twig->addGlobal('item', $item);
        $twig->addGlobal('deals', $deals);
        $twig->addGlobal('classifieds', $classifieds);
        $twig->addGlobal('level', $level);
        $twig->addGlobal('locationsIDs', $locations_ids);
        $twig->addGlobal('locationsObjs', $locations_rows);
        $twig->addGlobal('badges', $badges);
        $twig->addGlobal('gallery', $gallery);
        $twig->addGlobal('categories', $categories);
        $twig->addGlobal('bannerCategories', $categoryIds);
        $twig->addGlobal('reviews_active', $reviews_active);
        $twig->addGlobal('reviews', $reviews);
        $twig->addGlobal('reviews_total', $reviews_total);
        $twig->addGlobal('extra_fields', $extra_fields);
        $twig->addGlobal('map', $map);
        $twig->addGlobal('country', $locations['country']);
        $twig->addGlobal('region', $locations['region']);
        $twig->addGlobal('state', $locations['state']);
        $twig->addGlobal('city', $locations['city']);
        $twig->addGlobal('neighborhood', $locations['neighborhood']);
        $twig->addGlobal('clicktocall_enabled', $this->get('settings')->getDomainSetting('twilio_enabled_call'));

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::LISTING_DETAIL_PAGE);

        return $this->render('::modules/listing/detail.html.twig', [
            'pageId'          => $page->getId(),
            'customTag' => $page->getCustomTag(),
        ]);
    }

    /**
     * @param int $level
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @throws \Ivory\GoogleMap\Exception\MapException
     * @throws \Ivory\GoogleMap\Exception\OverlayException
     */
    public function sampleDetailAction($level = 0)
    {
        $item = new ListingSample($level, $this->get("translator"), $this->get('doctrine'));
        $listingItemDetail = new ListingItemDetail($this->container, $item);

        $map = null;
        /* checks if item has latitude and longitude to show the map */
        if ($item->getLatitude() && $item->getLongitude() && $this->container->get('settings')->getSettingGoogle('maps_status') == "on") {
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
            $map->setCenter($item->getLatitude(), $item->getLongitude());

            $marker = $this->get('ivory_google_map.marker');

            /* mark item in map */
            $marker->setPosition($item->getLatitude(), $item->getLongitude(), true);
            $marker->setOptions([
                'clickable' => false,
                'flat'      => true,
            ]);
            $map->addMarker($marker);
        }

        /* gets listing's deal */
        $deals = [];
        for ($i = 0; $i < $listingItemDetail->getLevel()->dealCount; $i++) {
            $deals[] = $item->getDeals();
        }

        /* Validates if listing has the review active */
        $reviews_active = $this->getDoctrine()->getRepository('WebBundle:Setting')
            ->getSetting('review_listing_enabled');

        $editorChoice = $this->getDoctrine()->getRepository('ListingBundle:EditorChoice')->findby([
            'available' => 1,
        ]);

        $categories = array_map(function ($item) {
            return $item->getCategory();
        }, $item->getCategories());

        $twig = $this->container->get("twig");

        $twig->addGlobal('item', $item);
        $twig->addGlobal('classifieds', $item->getClassifieds());
        $twig->addGlobal('level', $listingItemDetail->getLevel());
        $twig->addGlobal('map', $map);
        $twig->addGlobal('gallery', $item->getGallery(--$listingItemDetail->getLevel()->imageCount));
        $twig->addGlobal('reviews_active', $reviews_active);
        $twig->addGlobal('reviews', $item->getReviews());
        $twig->addGlobal('reviews_total', $item->getReviewCount());
        $twig->addGlobal('categories', $categories);
        $twig->addGlobal('deals', $deals);
        $twig->addGlobal('locationsIDs', $item->getFakeLocationsIds());
        $twig->addGlobal('locationsObjs', $item->getLocationObjects());
        $twig->addGlobal('badges', $editorChoice);
        $twig->addGlobal('clicktocall_enabled', $this->get('settings')->getDomainSetting('twilio_enabled_call'));
        $twig->addGlobal('isSample', true);

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_LISTING);
        /* @var Page $page*/
        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::LISTING_DETAIL_PAGE);

        return $this->render('::modules/listing/detail.html.twig', [
            'pageId'          => $page->getId(),
            'customTag' => $page->getCustomTag(),
        ]);
    }

    public function allcategoriesAction()
    {
        /* Loading and setting wysiwyg */
        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_LISTING);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::LISTING_CATEGORIES_PAGE);

        $result = $this->get('search.repository.category')
            ->findCategoriesWithItens('listing');

        $twig = $this->get('twig');

        $twig->addGlobal('categories', $result);
        $twig->addGlobal('routing', ParameterHandler::MODULE_LISTING);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    public function viewContactAction()
    {
        $return = [
            "status" => false,
        ];

        $session = $this->container->get("session");
        $request = $this->container->get("request");

        $listingId = $request->request->get("item");
        $type = null;
        $reportType = null;

        switch ($request->request->get("type")) {
            case "phone":
                $type = "Phone";
                $reportType = ReportHandler::LISTING_PHONE;
                break;
            case "fax":
                $type = "Fax";
                $reportType = ReportHandler::LISTING_FAX;
                break;
            case "url":
                $type = "Url";
                $reportType = ReportHandler::LISTING_CLICK;
                break;
        }

        if ($type) {
            $recentlyViewed = $session->get("listing{$type}Viewed", []);

            if (empty($recentlyViewed[$listingId])) {
                /* Counts the view towards the statistics */
                $this->container->get("reporthandler")->addListingReport($listingId, $reportType);

                $listing = $this->get('doctrine')->getRepository('ListingBundle:Listing')->find($listingId);

                $recentlyViewed[$listingId] = call_user_func([$listing, "get{$type}"]);
                $session->set("listing{$type}Viewed", $recentlyViewed);
            }

            $return["status"] = true;
            $return["data"] = $recentlyViewed[$listingId];
        }

        return new JsonResponse($return);
    }

    public function alllocationsAction()
    {
        $locations_enable = $this->get('doctrine')->getRepository('WebBundle:SettingLocation')->getLocationsEnabledID();
        $locations = $this->get('helper.location')->getAllLocations($locations_enable, ParameterHandler::MODULE_LISTING);

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_LISTING);

        $twig = $this->container->get("twig");

        $twig->addGlobal('locations', $locations);
        $twig->addGlobal('routing', ParameterHandler::MODULE_LISTING);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::LISTING_ALL_LOCATIONS);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    /**
     * Returns locations on ajax call
     *
     * @return Response JsonResponse
     */
    public function locationsAction(Request $request)
    {
        return $this->container->get('location.service')->getChildrenLocations($request);
    }

    /**
     * @param String $friendlyUrl
     * @param Integer $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function reviewAction($friendlyUrl, $page)
    {
        $page = $this->get("search.engine")->convertFromPaginationFormat($page);

        /* Validates if listing has the review active */
        $active = $this->getDoctrine()->getRepository('WebBundle:Setting')->getSetting('review_listing_enabled');
        if (is_null($active) or $active == '') {
            throw $this->createNotFoundException('Listing has not reviews activated');
        }

        /* Gets listing and validation if exist */
        /* @var $listing Listing For phpstorm get properties of entity Listing */
        $listing = $this->get('search.engine')->itemFriendlyURL($friendlyUrl, "listing", "ListingBundle:Listing");
        if (is_null($listing)) {
            throw $this->createNotFoundException('This Listing does not exist');
        }

        /* Validates if level has the review active */
        $listingDetail = new ListingItemDetail($this->container, $listing);
        if (!$listingDetail->getLevel()->hasReview) {
            throw $this->createNotFoundException('This listing has not activated reviews');
        }

        /* Gets reviews of listing */
        $reviews = $this->getDoctrine()
            ->getRepository('WebBundle:Review')
            ->findBy([
                'itemType' => 'listing',
                'approved' => 1,
                'itemId'   => $listing->getId(),
            ], ['added' => 'DESC']);

        /*
         * Workaround to get item's locations
         * We did in this way for reuse the 'Utility.address'(summary) macro in view
         */
        $locations = $this->get('location.service')->getLocations($listingDetail->getItem());
        $locations_ids = [];
        $locations_rows = [];
        foreach (array_filter($locations) as $level => $location) {
            $key = substr($level, 0, 2).':'.$location->getId();
            $locations_ids[] = $key;
            $locations_rows[$key] = $location;
        }

        // Creates the pagination to reviews
        $pagination = $this->get('knp_paginator')->paginate($reviews, $page);

        /* Gets total of reviews */
        $reviews_total = $this->get('doctrine')->getRepository('WebBundle:Review')
            ->getTotalByItemId($listing->getId(), 'listing');

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_LISTING);

        $twig = $this->container->get("twig");

        $twig->addGlobal('review', $listing);
        $twig->addGlobal('reviews_total', $reviews_total);
        $twig->addGlobal('pagination', $pagination);
        $twig->addGlobal('country', $locations['country']);
        $twig->addGlobal('region', $locations['region']);
        $twig->addGlobal('state', $locations['state']);
        $twig->addGlobal('city', $locations['city']);
        $twig->addGlobal('neighborhood', $locations['neighborhood']);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::LISTING_REVIEWS);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    /**
     * Save report clicking(visit website)
     *
     * @param Request $request
     * @return Response nothing
     */
    public function reportClickAction(Request $request)
    {
        $friendlyUrl = json_decode($this->get('url_encryption')->decrypt($request->get('info')));
        $friendlyUrl = current($friendlyUrl);

        /*
         * Validation
         */
        /* @var $item Listing For phpstorm get properties of entity Listing */
        $item = $this->get('search.engine')->itemFriendlyURL($friendlyUrl, 'listing', 'ListingBundle:Listing');
        /* listing not found by friendlyURL */
        if (null === $item) {
            throw new ItemNotFoundException();
        }

        /*
        * Report
        */
        /* Counts click */
        $this->container->get('reporthandler')->addListingReport($item->getId(), ReportHandler::LISTING_CLICK);

        /* Return nothing */

        return new Response();
    }
}
