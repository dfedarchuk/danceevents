<?php

namespace ArcaSolutions\EventBundle\Controller;

use ArcaSolutions\CoreBundle\Exception\ItemNotFoundException;
use ArcaSolutions\CoreBundle\Exception\UnavailableItemException;
use ArcaSolutions\CoreBundle\Services\ValidationDetail;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\EventBundle\Entity\Eventcategory;
use ArcaSolutions\EventBundle\EventItemDetail;
use ArcaSolutions\EventBundle\Sample\EventSample;
use ArcaSolutions\ReportsBundle\Services\ReportHandler;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_EVENT);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::EVENT_HOME_PAGE);

        return $this->render('::base.html.twig', [
            'title' => 'Event Index',
            'dateFilter' => $this->get('filter.date'),
            'pageId'          => $page->getId(),
            'pageTitle' => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords' => $page->getMetaKey(),
            'customTag' => $page->getCustomTag()
        ]);
    }

    /**
     * @param $friendlyUrl
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws UnavailableItemException
     * @throws \Exception
     * @throws \Ivory\GoogleMap\Exception\MapException
     * @throws \Ivory\GoogleMap\Exception\OverlayException
     */
    public function detailAction($friendlyUrl)
    {
        /*
         * Validation
         */
        /* @var $item Event For phpstorm get properties of entity Event */
        $item = $this->get('search.engine')->itemFriendlyURL($friendlyUrl, 'event', 'EventBundle:Event');
        /* event not found by friendlyURL */
        if (is_null($item)) {
            throw new ItemNotFoundException();
        }

        /* normalizes item to validate detail */
        $eventItemDetail = new EventItemDetail($this->container, $item);

        /* validating if event is enabled, if events level is active and if level allows detail */
        if (!ValidationDetail::isDetailAllowed($eventItemDetail)) {
            $parameterHandler = new ParameterHandler($this->container, false);
            $parameterHandler->addModule(ParameterHandler::MODULE_EVENT);
            $parameterHandler->addKeyword($friendlyUrl);

            $this->get("request_stack")->getCurrentRequest()->cookies->set("edirectory_results_viewmode", "item");

            return $this->redirect($parameterHandler->buildUrl());
        }

        /*
         * Report
         */
        if (false === ValidationDetail::isSponsorsOrSitemgr($eventItemDetail)) {
            /* Counts the view towards the statistics */
            $this->container->get("reporthandler")->addEventReport($item->getId(), ReportHandler::EVENT_DETAIL);
        }

        /*
         * Workaround to get item's locations
         * We did in this way for reuse the 'Utility.address'(summary) macro in view
         */
        $locations = $this->get('location.service')->getLocations($item);
        $locations_ids = [];
        $locations_rows = [];
        foreach (array_filter($locations) as $location) {
            $locations_ids[] = $location->getId();
            $locations_rows[$location->getId()] = $location;
        }

        /* gets item's gallery */
        $gallery = null;
        if ($eventItemDetail->getLevel()->imageCount > 0) {
            $gallery = $this->get('doctrine')->getRepository('EventBundle:Event')
                ->getGallery($item, --$eventItemDetail->getLevel()->imageCount);
        }

        $map = null;
        /* checks if item has latitude and longitude to show the map */
        if ($item->getLatitude() && $item->getLongitude() && $this->container->get('settings')->getSettingGoogle('maps_status') == "on") {
            /* sets map */
            $map = $this->get('ivory_google_map.map');
            $map->setApiKey($this->container->get('settings')->getSettingGoogle('maps_key'));
            $map->setMapOption("scrollwheel", false);
            $map->setMapOption('zoom', 15);
            /* sets the item's location the center of the map */
            $map->setCenter($item->getLatitude(), $item->getLongitude());

            $marker = $this->get('ivory_google_map.marker');

            /* mark item in map */
            $marker->setPosition($item->getLatitude(), $item->getLongitude(), true);
            $marker->setOptions([
                'clickable' => false,
                'flat' => true,
            ]);
            $map->addMarker($marker);
        }

        $categoryIds = array_map(function ($item) {
            /* @var $item EventCategory */
            return Category::create()
                ->setId($item->getId())
                ->setModule(ParameterHandler::MODULE_EVENT);
        }, $item->getCategories());

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_EVENT);

        $twig = $this->container->get("twig");

        $twig->addGlobal('bannerCategories', $categoryIds);
        $twig->addGlobal('item', $item);
        $twig->addGlobal('level', $eventItemDetail->getLevel());
        $twig->addGlobal('categories', $item->getCategories());
        $twig->addGlobal('gallery', $gallery);
        $twig->addGlobal('map', $map);
        $twig->addGlobal('locationsIDs', $locations_ids);
        $twig->addGlobal('locationsObjs', $locations_rows);
        $twig->addGlobal('country', $locations['country']);
        $twig->addGlobal('region', $locations['region']);
        $twig->addGlobal('state', $locations['state']);
        $twig->addGlobal('city', $locations['city']);
        $twig->addGlobal('neighborhood', $locations['neighborhood']);
        $twig->addGlobal('dateFilter', $this->get('filter.date'));

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::EVENT_DETAIL_PAGE);

        return $this->render('::modules/event/detail.html.twig', [
            'pageId'          => $page->getId(),
            'customTag' => $page->getCustomTag()
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
        $item = new EventSample($level, $this->get("translator"), $this->get('doctrine'));

        /* normalizes item to validate detail */
        $eventItemDetail = new EventItemDetail($this->container, $item);

        $map = null;
        /* checks if item has latitude and longitude to show the map */
        if ($item->getLatitude() && $item->getLongitude() && $this->container->get('settings')->getSettingGoogle('maps_status') == "on") {
            /* sets map */
            $map = $this->get('ivory_google_map.map');
            $map->setApiKey($this->container->get('settings')->getSettingGoogle('maps_key'));
            $map->setMapOption("scrollwheel", false);
            $map->setMapOption('zoom', 15);
            /* sets the item's location the center of the map */
            $map->setCenter($item->getLatitude(), $item->getLongitude());

            $marker = $this->get('ivory_google_map.marker');

            /* mark item in map */
            $marker->setPosition($item->getLatitude(), $item->getLongitude(), true);
            $marker->setOptions([
                'clickable' => false,
                'flat' => true,
            ]);
            $map->addMarker($marker);
        }

        $twig = $this->container->get("twig");

        $twig->addGlobal('item', $item);
        $twig->addGlobal('level', $eventItemDetail->getLevel());
        $twig->addGlobal('categories', $item->getCategories());
        $twig->addGlobal('gallery', $item->getGallery(--$eventItemDetail->getLevel()->imageCount));
        $twig->addGlobal('map', $map);
        $twig->addGlobal('locationsIDs', $item->getFakeLocationsIds());
        $twig->addGlobal('locationsObjs', $item->getLocationObjects());
        $twig->addGlobal('categories', $item->getCategories());
        $twig->addGlobal('dateFilter', $this->get('filter.date'));
        $twig->addGlobal('isSample', true);

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_EVENT);
        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::EVENT_DETAIL_PAGE);

        return $this->render('::modules/event/detail.html.twig', [
            'pageId'          => $page->getId(),
            'customTag' => $page->getCustomTag()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allcategoriesAction()
    {
        /* Loading and setting wysiwyg */
        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_EVENT);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::EVENT_CATEGORIES_PAGE);

        $categories = $this->get('search.repository.category')
            ->findCategoriesWithItens(ParameterHandler::MODULE_EVENT);

        $twig = $this->get('twig');

        $twig->addGlobal('categories', $categories);
        $twig->addGlobal('routing', ParameterHandler::MODULE_EVENT);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function alllocationsAction()
    {
        $locations_enable = $this->get('doctrine')->getRepository('WebBundle:SettingLocation')->getLocationsEnabledID();
        $locations = $this->get('helper.location')->getAllLocations($locations_enable, ParameterHandler::MODULE_EVENT);

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_EVENT);

        $twig = $this->container->get("twig");

        $twig->addGlobal('locations', $locations);
        $twig->addGlobal('routing', ParameterHandler::MODULE_EVENT);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::EVENT_ALL_LOCATIONS);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle' => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords' => $page->getMetaKey(),
            'customTag' => $page->getCustomTag()
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
}
