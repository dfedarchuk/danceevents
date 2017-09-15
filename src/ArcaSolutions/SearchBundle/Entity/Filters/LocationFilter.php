<?php

namespace ArcaSolutions\SearchBundle\Entity\Filters;

use ArcaSolutions\CoreBundle\Entity\Location1;
use ArcaSolutions\CoreBundle\Entity\Location3;
use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Location;
use ArcaSolutions\SearchBundle\Entity\FilterMenuTreeNode;
use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\SearchBundle\Services\SearchEngine;

class LocationFilter extends BaseFilter
{
    /**
     * {@inheritdoc}
     */
    protected static $name = "LocationFilter";

    protected $requestedLocationFriendlyUrls = [];

    private $aggregationInfo;

    /**
     * Contains the last enabled location. Defaults to 4
     * @var int
     */
    private $lastLevel = null;
    /**
     * Contains all enabled location values. Defaults to [1, 3, 4]
     * @var int[]
     */
    private $enabledLocations = null;

    /**
     * Returns the last enabled level
     * @return int
     */
    public function getLastLevel()
    {
        $this->lastLevel or $this->lastLevel = $this->container->get('doctrine')->getRepository('WebBundle:SettingLocation')
            ->getLastLocationEnabledID() ?: 4;

        return $this->lastLevel;
    }

    /**
     * Returns an array containing all enabled locations
     * @return int[]
     */
    public function getEnabledLocations()
    {
        if (!$this->enabledLocations) {
            $repository = $this->container->get('doctrine')->getRepository('WebBundle:SettingLocation');
            $this->enabledLocations = $repository->getLocationsEnabledID() ?: [1, 3, 4];
        };

        return $this->enabledLocations;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'search.global'           => 'registerItem',
            'search.global.map'       => 'registerMapItem',
            'search.suggest.location' => 'registerSuggest',
        ];
    }

    /**
     * Provides the necessary elasticsearch queries and filters for a summary search
     * @param SearchEvent $searchEvent
     * @param $eventName
     */
    public function registerItem(SearchEvent $searchEvent, $eventName)
    {
        $this->register($searchEvent, $eventName);

        $parameterInfo = $this->container->get("search.parameters");

        /* will only add filters if there are location information inside the request */
        if ($searchedLocations = $parameterInfo->getLocations()) {

            $qb = SearchEngine::getElasticaQueryBuilder();
            $reportHandler = $this->container->get("reporthandler");
            $modules = $parameterInfo->hasModules() ? $parameterInfo->getModules() : ['global'];

            $doctrine = $this->container->get("doctrine");

            $activeLocations = $this->container->get("location.service")->getLocationsEnabled();

            $repositoryDictionary = [
                1 => $doctrine->getRepository("CoreBundle:Location1", "main"),
                2 => $doctrine->getRepository("CoreBundle:Location2", "main"),
                3 => $doctrine->getRepository("CoreBundle:Location3", "main"),
                4 => $doctrine->getRepository("CoreBundle:Location4", "main"),
                5 => $doctrine->getRepository("CoreBundle:Location5", "main"),
            ];

            foreach ($searchedLocations as $id => $location) {
                $locationArray = [
                    1 => 0,
                    2 => 0,
                    3 => 0,
                    4 => 0,
                    5 => 0,
                ];

                $locationId = preg_replace("/L\d+:/", "", $location->getId());
                $locationLevel = $location->getLevel();
                $locationArray[$locationLevel] = $locationId;

                /* @var $location Location3 */
                $location = $repositoryDictionary[$locationLevel]->find($locationId);

                for ($i = 1; $i < $locationLevel; $i++) {
                    if (array_key_exists($i, $activeLocations)) {

                        $functionName = "getLocation{$i}";
                        $locationArray[$i] = $location->$functionName();
                    }
                }

                foreach ($modules as $module) {
                    $reportHandler->addLocationSearchReport(
                        $reportHandler->getReportModule($module),
                        $searchEvent->getWhere(),
                        (int)$locationArray[1],
                        (int)$locationArray[2],
                        (int)$locationArray[3],
                        (int)$locationArray[4],
                        (int)$locationArray[5]
                    );
                }
            }

            /* Attempts to get all sublocations as well */
            if ($results = $this->getRecursiveLocations($searchedLocations)) {
                /* the ID is the key of each location within the $results array */
                $locationIds = array_keys($results);
                if ($geoDistance = $this->container->get("nearby.handler")->getGeoDistanceInfoByLocation()) {
                    $elasticFilter = $qb->filter()->bool();
                    $elasticFilter
                        ->addShould($qb->filter()->terms("locationId", $locationIds))
                        ->addShould($qb->filter()->geo_distance(
                                'geoLocation',
                                [
                                    'lat' => $geoDistance['latitude'],
                                    'lon' => $geoDistance['longitude'],
                                ],
                                $geoDistance['radius']

                            )
                        );
                } else {
                    $elasticFilter = $qb->filter()->terms("locationId", $locationIds);
                }
//                if ($parameterInfo->hasKeywords()) {
//                    $this->addElasticaFilter($elasticFilter);
//                } else {
                $this->addElasticaPostFilter($elasticFilter);
//                }
            }
        }
    }

    public function getElasticaAggregations()
    {
        $subscribedEvents = self::getSubscribedEvents();

        switch ($subscribedEvents[$this->eventName]) {
            case 'registerItem' :
                $qb = SearchEngine::getElasticaQueryBuilder();

                $aggregation = $qb->aggregation()->terms(static::$name)
                    ->setField("locationId")
                    ->setSize($this->searchConfig['settings']['aggregationSize']);

                $filters = $this->searchEvent->getElasticaPostFilters();
                unset ($filters[static::$name]);

                if ($filters) {
                    $aggregation->addAggregation(
                        $qb->aggregation()->filter(
                            "filtered",
                            $qb->filter()
                                ->bool()
                                ->addMust($filters)
                        )
                    );
                }

                $this->addElasticaAggregation($aggregation);

                break;
        }

        return $this->elasticaAggregations;
    }

    /**
     * Provides the necessary queries and filters for a map search
     * @param SearchEvent $searchEvent
     * @param $eventName
     */
    public function registerMapItem(SearchEvent $searchEvent, $eventName)
    {
        $this->register($searchEvent, $eventName);

        /* will only add filters if there are location information inside the request */
        if ($searchedLocations = $this->container->get("search.parameters")->getLocations()) {
            /* Attempts to get all sublocations as well */
            if ($results = $this->getRecursiveLocations($searchedLocations)) {
                /* the ID is the key of each location within the $results array */
                $locationIds = array_keys($results);

                $qb = SearchEngine::getElasticaQueryBuilder();

                if ($geoDistance = $this->container->get("nearby.handler")->getGeoDistanceInfoByLocation()) {
                    $elasticFilter = $qb->filter()->bool();
                    $elasticFilter
                        ->addShould($qb->filter()->terms("locationId", $locationIds))
                        ->addShould($qb->filter()->geo_distance(
                            'geoLocation',
                            [
                                'lat' => $geoDistance['latitude'],
                                'lon' => $geoDistance['longitude'],
                            ],
                            $geoDistance['radius']

                        )
                        );
                } else {
                    $elasticFilter = $qb->filter()->terms("locationId", $locationIds);
                }
            }
        }
    }

    /**
     * Starting from a friendly url, queries elasticsearch for information on the provided locations and also all of
     * their children recursively.
     *
     * @param $locations Location[]
     * @return array
     */
    public function getRecursiveLocations($locations)
    {
        $returnValue = $locations;

        /* This guy will keep all children for later processing */
        $recursiveStack = [];
        $searchEngine = $this->container->get("search.engine");

        foreach ($locations as $location) {
            /* We'll add all children to the stack to get their own sublocations */
            if ($children = $location->getSubLocationId()) {
                $recursiveStack = array_merge($recursiveStack, $children);
            }
        }

        /* this will assemble a Id query and return every location within the stack */
        while ($recursiveStack) {
            $results = $searchEngine->locationIdSearch($recursiveStack);
            /* Empties the array, for it's values have already been used above */
            $recursiveStack = [];

            foreach ($results as $location) {
                /* Checks if the location has already been processed */
                if (!isset($returnValue[$location->getId()])) {
                    $returnValue[$location->getId()] = $location;

                    /* We'll add all children here to get their own sublocations */
                    if ($children = $location->getSubLocationId()) {
                        $recursiveStack = array_merge($recursiveStack, $children);
                    }
                }
            }
        }

        return $returnValue;
    }

    /**
     * This function will register the necessary queries for advanced suggestions
     * @param SearchEvent $event
     * @param $eventName
     */
    public function registerSuggest(SearchEvent $event, $eventName)
    {
        $this->register($event, $eventName);

        $qB = SearchEngine::getElasticaQueryBuilder();

        if ($keyword = $event->getKeyword()) {
            $this->addElasticaFilter(
                $qB->filter()->terms("categoryId", $event->getKeyword())
            );
        }

        $this->addElasticaAggregation(
            $qB->aggregation()->terms(static::$name)
                ->setField("locationId")
                ->setSize($this->searchConfig['settings']['aggregationSize'])
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFilterView()
    {
        $return = null;

        if ($this->aggregationInfo) {

            $javaScriptHandler = $this->container->get("javascripthandler");
            $javaScriptHandler->addJSExternalFile("assets/js/search/utility.js");
            $javaScriptHandler->addJSBlock("::js/filters/location.js.twig");

            $locationTree = $this->getLocationTree();

            $return = $this->container->get("twig")->render(
                "::blocks/filters/location.html.twig",
                [
                    "locationTree" => $locationTree,
                    "selected"     => $this->requestedLocationFriendlyUrls,
                ]
            );
        }

        return $return;
    }

    /**
     * Extracts location data from the Resultset
     * @param Location[] $locations
     * @param $dictionary
     */
    public function extractFromResultSet($locations, &$dictionary)
    {
        $parents = [];

        foreach ($locations as $location) {
            if (isset($dictionary[$location->getId()])) {
                continue;
            }

            $locationCount = isset($this->aggregationInfo[$location->getId()]) ? $this->aggregationInfo[$location->getId()]["numberOfItems"] : 0;

            $parentId = $location->getParentId();

            if ($parentId && !isset($dictionary[$parentId]) && !isset($locations[$parentId])) {
                $parents[$parentId] = true;
            }

            $dictionary[$location->getId()] = new FilterMenuTreeNode(
                $parentId,
                $location->getSubLocationId(),
                $location->getTitle(),
                $location->getFriendlyUrl(),
                $location->getLevel(),
                $location->getId(),
                in_array($location->getFriendlyUrl(), $this->requestedLocationFriendlyUrls),
                null,
                $locationCount
            );
        }

        if ($parents) {
            $resultLocations = $this->container->get("search.engine")->locationIdSearch(array_keys($parents));
            $this->extractFromResultSet($resultLocations, $dictionary);
        }
    }

    /**
     * Assembles a tree based on the LocationDictionary connections
     * @param FilterMenuTreeNode[] $locationDictionary
     * @return FilterMenuTreeNode[]
     */
    public function linkElements(&$locationDictionary)
    {
        $selectedItemParents = [];
        $parentlessItems = [];

        foreach ($locationDictionary as &$location) {
            /* Links to the Parent, if any */
            if ($location->parentId && isset($locationDictionary[$location->parentId])) {
                $location->parent = $locationDictionary[$location->parentId];

                if ($location->isSelected) {
                    if ($location->parent && !isset($selectedItemParents[$location->parent->id])) {
                        $selectedItemParents[$location->parent->id] = $location->parent;
                    }
                }
            } elseif (!isset($parentlessItems[$location->id])) {
                $parentlessItems[$location->id] = $location;
            }

            /* Links to the children, if any */
            foreach ($location->childrenId as $childId) {
                if (isset($locationDictionary[$childId])) {
                    $location->children[$childId] = $locationDictionary[$childId];
                }
            }
        }

        $return = $selectedItemParents ? $selectedItemParents : $parentlessItems;

        /* must return all locations possibilities for the API */
        if ($this->container->get("request")->get("location")){
            $return = $parentlessItems;
        }

        /* @var FilterMenuTreeNode $element */
        while ($element = array_pop($selectedItemParents)) {
            if (!$element->isParentOfSelected) {
                $element->isParentOfSelected = true;
                $element->parent and array_push($selectedItemParents, $element->parent);
            }
        }

        return $return;
    }

    /**
     * Removes from a location tree root all locations not marked as used (isUsed == true)
     * @param $location FilterMenuTreeNode
     * @return array
     */
    private function getSearchPageUrl($location)
    {
        $result = null;

        if ($location->friendlyUrl) {
            $locationFriendlyUrls = [];

            /* Ok here's some explanation on the code below:
             * During a search, locations being filtered cancel each other unless we are talking about the last enabled
             * level. In order to achieve this effect, we pass a parameter to "override" parameterhandler's url
             * generation "location" settings.
             */
            if ($location->module == $this->getLastLevel()) {
                if ($parent = $location->parent) {
                    $siblings = array_map(function ($a) {
                        /* @var FilterMenuTreeNode $a */
                        return $a->friendlyUrl;
                    }, $parent->children);

                    /* Only currently selected children will be spared */
                    $locationFriendlyUrls = array_intersect($siblings, $this->requestedLocationFriendlyUrls);
                }

                /* Toggles this $location filter */
                $index = array_search($location->friendlyUrl, $locationFriendlyUrls);

                if ($index === false) {
                    $locationFriendlyUrls[] = $location->friendlyUrl;
                } else {
                    unset($locationFriendlyUrls[$index]);
                }
            } else {
                if (!in_array($location->friendlyUrl, $this->requestedLocationFriendlyUrls)) {
                    $locationFriendlyUrls[] = $location->friendlyUrl;
                }
            }

            $result = $this->container->get("search.parameters")->buildUrl(
                1,
                [ParameterHandler::SLUG_LOCATION => $locationFriendlyUrls]
            );
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    protected function processAggregationBuckets($filterAggregationBuckets)
    {
        $this->aggregationInfo = null;

        foreach ($filterAggregationBuckets as $bucket) {

            if ($documentCount = isset($bucket['filtered']) ? $bucket['filtered']['doc_count'] : $bucket['doc_count']) {
                $this->aggregationInfo[$bucket['key']] = [
                    "numberOfItems" => $documentCount,
                ];
            }
        }
    }

    /**
     * Sets search urls for all itens contained inside the initial $locationTree, while also sorting the children
     * both alphabetically and by level
     *
     * @param FilterMenuTreeNode[] $locationTree
     */
    public function setSearchUrls($locationTree)
    {
        $transversables = $locationTree;

        /* @var FilterMenuTreeNode $locationNode */
        while ($locationNode = array_pop($transversables)) {
            if ($locationNode->children) {
                /* Sorts Children alphabetically but puts selected items and parents first */
                usort($locationNode->children, [$this, "locationSort"]);

                $transversables = array_merge($transversables, $locationNode->children);
            }

            $locationNode->searchPageUrl = $this->getSearchPageUrl($locationNode);
        }
    }

    /**
     * Calculates the amount of items within nodes properly.
     * <b> Recursive Function </b>
     *
     * @param FilterMenuTreeNode $location
     * @return int
     */
    public function bubbleCounts($location)
    {
        if ($location->children) {
            foreach ($location->children as $child) {
                $location->resultCount or $location->resultCount = $this->bubbleCounts($child);
            }
        }

        return $location->resultCount;
    }

    /**
     * @param $a FilterMenuTreeNode
     * @param $b FilterMenuTreeNode
     * @return int
     */
    public function locationSort($a, $b)
    {
        $result = 0;

        $a->isSelected and $result -= 100000;
        $b->isSelected and $result += 100000;

        $a->isParentOfSelected and $result -= 50000;
        $b->isParentOfSelected and $result += 50000;

        $a->resultCount > 0 and $result -= 75000;
        $b->resultCount > 0 and $result += 75000;

        $result += strcmp(Utility::stripAccents($a->title), Utility::stripAccents($b->title));

        return $result;
    }


    /**
     * @return mixed
     */
    public function getAggregationInfo()
    {
        return $this->aggregationInfo;
    }

    /**
     * Return a tree containing all the locations within the resultset
     *
     * @return \ArcaSolutions\SearchBundle\Entity\FilterMenuTreeNode[]|null
     */
    public function getLocationTree()
    {

        $locationTree = null;

        if ($this->aggregationInfo) {

            /* Gets all the locations within the resultset */
            $resultLocations = $this->container->get("search.engine")->locationIdSearch(array_keys($this->aggregationInfo));

            /* Array containing all friendly Urls of locations being searched */
            $this->requestedLocationFriendlyUrls = array_map(function ($location) {
                /* @var $location Location */
                return $location->getFriendlyUrl();
            }, $this->container->get("search.parameters")->getLocations());


            /* Fills the Dictionary with information about the locations contained in the resultset */
            $locationDictionary = [];
            $this->extractFromResultSet($resultLocations, $locationDictionary);

            /* Transforms the dictionary into a tree */
            $locationTree = $this->linkElements($locationDictionary);

//            foreach ($locationTree as $node) {
//                $this->bubbleCounts($node);
//            }

            $this->setSearchUrls($locationTree);

            usort($locationTree, [$this, "locationSort"]);
        }

        return $locationTree;
    }
}
