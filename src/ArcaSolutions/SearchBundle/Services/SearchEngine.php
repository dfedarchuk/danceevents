<?php

namespace ArcaSolutions\SearchBundle\Services;

use ArcaSolutions\ArticleBundle\Search\ArticleConfiguration;
use ArcaSolutions\BlogBundle\Search\BlogConfiguration;
use ArcaSolutions\ClassifiedBundle\Search\ClassifiedConfiguration;
use ArcaSolutions\CoreBundle\Search\CategoryConfiguration;
use ArcaSolutions\CoreBundle\Search\LocationConfiguration;
use ArcaSolutions\DealBundle\Search\DealConfiguration;
use ArcaSolutions\EventBundle\Search\EventConfiguration;
use ArcaSolutions\ListingBundle\Search\ListingConfiguration;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Badge;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Location;
use ArcaSolutions\SearchBundle\Entity\Sorters\RelevancySorter;
use ArcaSolutions\SearchBundle\Events\SearchEvent;
use Elastica\Client;
use Elastica\Exception\NotImplementedException;
use Elastica\Filter\Term;
use Elastica\Query;
use Elastica\Query\Filtered;
use Elastica\QueryBuilder;
use Elastica\Result;
use Elastica\ScanAndScroll;
use Elastica\Search;
use Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\MarkerCluster;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SearchEngine
{
    /**
     * @var QueryBuilder
     */
    private static $elasticaQueryBuilder = null;
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var Client
     */
    private $elasticaClient = null;
    /**
     * @var array
     */
    private $elasticsearchServers;
    /**
     * @var string
     */
    private $randomizationInterval;
    /**
     * @var int
     */
    private $defaultSearchResultSize;
    /**
     * @var array
     */
    private $friendlyUrlOrder;
    /**
     * @var string
     */
    private $geoLocationCookieName = "edirectory_geolocation_coordinates";
    /**
     * @var string
     */
    private $paginationFormat = "p:1";
    /**
     * @var string
     */
    private $keywordFormat = "k:";
    /**
     * @var string
     */
    private $whereFormat = "w:";

    /** @var LoggerInterface */
    private $logger;

    function __construct(ContainerInterface $container, LoggerInterface $logger, $searchSettings)
    {
        $this->container = $container;
        $this->logger = $logger;

        $this->elasticsearchServers = $searchSettings["elasticsearch"];
        $this->randomizationInterval = $searchSettings["settings"]["randomizationInterval"];
        $this->defaultSearchResultSize = $searchSettings["settings"]["defaultSearchResultSize"];
        $this->friendlyUrlOrder = $searchSettings["seo"]["friendlyUrlOrder"];

        try {
            $client = new Client($searchSettings["elasticsearch"]);

            $connections = $client->getConnections();

            foreach ($connections as $connection) {
                $connection->setConnectTimeout(10);
            }

            /* This line serves the sole purpose of testing if the connection was successful */
            $client->getStatus();
            $this->elasticaClient = $client;
        } catch (\Exception $e) {
            $logger->error("Elasticsearch : Couldn't connect to server.", ["Exception" => $e]);
        }
    }

    /**
     * @return array
     */
    public function getElasticsearchServers()
    {
        return $this->elasticsearchServers;
    }

    /**
     * @return int
     */
    public function getDefaultSearchResultSize()
    {
        return $this->defaultSearchResultSize;
    }

    /**
     * @return string
     */
    public function getRandomizationInterval()
    {
        return $this->randomizationInterval;
    }

    /**
     * Returns the friendly URL item order as configured on the yml file
     * @return string[]
     */
    public function getFriendlyUrlOrder()
    {
        return $this->friendlyUrlOrder;
    }

    public function itemFriendlyURL($friendlyUrl, $type, $repository)
    {
        $response = null;
        $query = ['friendlyUrl' => $friendlyUrl];

        if ($this->elasticaClient) {
            try {
                $indexName = $this->container->get("search.engine")->getElasticIndexName();

                $elasticaIndex = $this->elasticaClient->getIndex($indexName);
                $listingType = $elasticaIndex->getType($type);

                $friendlyURLFilter = new Term();
                $friendlyURLFilter->setTerm("friendlyUrl", $friendlyUrl);

                $filteredQuery = new Filtered();
                $filteredQuery->setQuery(new Query\MatchAll());
                $filteredQuery->setFilter($friendlyURLFilter);

                $queryBody = new Query($filteredQuery);
                $finalResultSet = $listingType->search($queryBody)->getResults();

                if ($result = array_shift($finalResultSet)) {
                    $query = ['id' => $result->getId()];
                }
            } catch (\Exception $e) {
            }
        }

        $entityRepository = $this->container->get("doctrine")->getRepository($repository);
        $response = $entityRepository->findOneBy($query);

        return $response;
    }

    /**
     * @return string
     */
    public function getElasticIndexName()
    {
        return $this->container->get("multi_domain.information")->getElastic();
    }

    /**
     * Performs a search on all modules
     * @param $keyword
     * @param null $where
     * @return SearchEvent
     */
    public function globalSearch($keyword, $where = null)
    {
        $event = new SearchEvent($keyword, false, [], $where);
        $event->setDefaultSorter(new RelevancySorter($this->container));

        $this->container->get("event_dispatcher")->dispatch('search.global', $event);

        return $event;
    }

    /**
     * @param $ids
     * @return Category[]
     */
    public function categoryIdSearch($ids)
    {
        $return = [];

        $event = new SearchEvent($ids);

        $this->container->get("event_dispatcher")->dispatch('search.category.id', $event);

        $scroll = new ScanAndScroll($this->search($event));

        foreach ($scroll as $page) {
            foreach ($page->getResults() as $result) {
                $return[$result->getId()] = Category::buildFromElasticResult($result);
            }
        }

        return $return;
    }

    public function search(SearchEvent $searchEvent, $size = 10)
    {
        $return = null;

        switch ($this->getEngineType()) {
            case "elasticsearch" :
                $return = $this->elasticSearch($searchEvent, $size);
                break;
            case "mysql" :
                throw new NotImplementedException("Oops, we still have to build this thing. Sorry. ");
                break;
        }

        return $return;
    }

    /**
     * Returns the type of engine which will be used for searching
     * @return string
     */
    public function getEngineType()
    {
        return $this->elasticaClient === null ? "mysql" : "elasticsearch";
    }

    /**
     * Assembles an Elastica Search object with data contained inside the $searchEvent variable
     * @param SearchEvent $searchEvent
     * @param int $size
     * @return Search|null
     */
    private function elasticSearch(SearchEvent $searchEvent, $size = 10)
    {
        $indexName = $this->container->get("search.engine")->getElasticIndexName();

        /* Attempts to retrieve the database name, which is the same for MySQL and Elaticsearch */
        if (!$indexName || !$searchEvent->hasModules()) {
            return null;
        }

        $search = new Search($this->getElasticaClient());
        $search->addIndex($indexName);
        $search->addTypes($searchEvent->getElasticaTypes());

        /* Query Builder */
        $qb = self::getElasticaQueryBuilder();

        $finalQuery = new Query();
        $finalQuery->setSource(true);

        $mainQuery = $qb->query()->match_all();

        /* Adds all queries registered inside the event */
        if ($searchEvent->getKeyword() and $queries = $searchEvent->getElasticaQueries()) {
            if (count($queries) == 1) {
                $mainQuery = array_pop($queries);
            } else {
                $mainQuery = new Query\BoolQuery();

                foreach ($queries as $query) {
                    $mainQuery->addShould($query);
                }
            }
        }

        /* Adds all aggregations registered in the Event */
        if ($aggregations = $searchEvent->getElasticaAggregations()) {
            foreach ($aggregations as $aggregation) {
                $finalQuery->addAggregation($aggregation);
            }
        }

        /* Adds all postfilters registered in the Event */
        if ($postFilters = $searchEvent->getElasticaPostFilters()) {
            $finalQuery->setPostFilter($qb->filter()->bool()->addMust($postFilters));
        }

        /* Adds all filters registered in the Event */
        if ($filters = $searchEvent->getElasticaFilters()) {
            $mainQuery = $qb->query()->filtered(
                $mainQuery,
                $qb->filter()->bool()->addMust($filters)
            );
        }

        if ($searchEvent->hasScriptFields()) {
            $finalQuery->setScriptFields($searchEvent->getElasticaScriptFields());
        }

        /* Randomizes the ResultSet */
        if ($searchEvent->isRandom()) {
            $mainQuery = $qb->query()
                ->function_score()
                ->setRandomScore($this->getRandomizationScore())
                ->setQuery($mainQuery);
        } else {
            if ($decayFunctions = $searchEvent->getDecayFunctions()) {
                $mainQuery = $qb->query()
                    ->function_score()
                    ->setQuery($mainQuery);

                foreach ($decayFunctions as $decayFunction) {
                    $mainQuery->addDecayFunction(
                        $decayFunction->getFunction(),
                        $decayFunction->getField(),
                        $decayFunction->getOrigin(),
                        $decayFunction->getScale(),
                        $decayFunction->getOffset(),
                        $decayFunction->getDecay(),
                        $decayFunction->getWeight(),
                        $decayFunction->getFilter()
                    );
                }

            }
        }

        $finalQuery->setQuery($mainQuery);

        /* Apply sorting */
        $translatedSortParameterName = $this->container->get("translator")->trans("sort", [], "filters");

        if ($sortParameterValue = $this->container->get("request")->get($translatedSortParameterName)) {
            $sorter = $searchEvent->getSort($sortParameterValue);
        } else {
            // API request of nearby sets Distance Sorter as the default
            $lat = $this->container->get("request")->get("lat");
            $lon = $this->container->get("request")->get("lng");

            if (!empty($lat) && !empty($lon) && $this->container->get('request')->get('module') != ParameterHandler::MODULE_BLOG) {
                $translatedDistanceSorterName = $this->container->get("translator")->trans("distance", [],
                    "filters");
                $searchEvent->setDefaultSorter($searchEvent->getSort($translatedDistanceSorterName));
            }

            $sorter = $searchEvent->getDefaultSorter();
        }

        if ($sorter) {
            $sorter->sort($finalQuery);

            if ($script = $sorter->getScript()) {
                $finalQuery->addScriptField("scriptedFieldData",
                    $script); //new Script("searchDistance",["lat" => 0, "lon" => 0]));
            }
        }

        $finalQuery->setSize($size);

        $search->setQuery($finalQuery);

        return $search;
    }

    /**
     * @return \Elastica\Client|null
     */
    public function getElasticaClient()
    {
        return $this->elasticaClient;
    }

    /**
     * Manages a singleton instance of the querybuilder
     * @return QueryBuilder
     */
    public static function getElasticaQueryBuilder()
    {
        if (self::$elasticaQueryBuilder === null) {
            self::$elasticaQueryBuilder = new QueryBuilder();
        }

        return self::$elasticaQueryBuilder;
    }

    /**
     * Generates a random
     * @return float|int
     */
    public function getRandomizationScore()
    {
        $return = 1;

        try {
            $interval = \DateInterval::createFromDateString($this->randomizationInterval);
            $intervalInSeconds = date_create('@0')->add($interval)->getTimestamp();
            $return = floor(time() / $intervalInSeconds);
        } catch (\Exception $e) {
        }

        return $return;
    }

    /**
     * Performs a search on all modules
     * @param string[] $friendlyUrl
     * @return Category[]
     */
    public function categoryFriendlyURLSearch($friendlyUrl)
    {
        $return = [];

        $event = new SearchEvent($friendlyUrl);

        $this->container->get("event_dispatcher")->dispatch('search.category.friendlyurl', $event);

        $scroll = new ScanAndScroll($this->search($event));

        foreach ($scroll as $page) {
            foreach ($page->getResults() as $result) {
                $return[$result->getId()] = Category::buildFromElasticResult($result);
            }
        }

        return $return;
    }

    /**
     * Searches for badges based on their Ids
     * @param string[] $ids
     * @return Badge[]
     */
    public function badgeIdSearch($ids)
    {
        $return = [];

        $event = new SearchEvent($ids);

        $this->container->get("event_dispatcher")->dispatch('search.badge.id', $event);

        foreach ($this->search($event)->search()->getResults() as $result) {
            $return[$result->getId()] = Badge::buildFromElasticResult($result);
        }

        return $return;
    }

    /**
     * @param string[]|string $ids
     * @return Location[]
     */
    public function locationIdSearch($ids)
    {
        $return = [];

        $event = new SearchEvent($ids);

        $this->container->get("event_dispatcher")->dispatch('search.location.id', $event);

        $scroll = new ScanAndScroll($this->search($event));

        foreach ($scroll as $page) {
            foreach ($page->getResults() as $result) {
                $return[$result->getId()] = Location::buildFromElasticResult($result);
            }
        }

        return $return;
    }

    /**
     * @param string[] $friendlyUrl
     * @return Location[]
     */
    public function locationFriendlyURLSearch($friendlyUrl)
    {
        $return = [];

        $event = new SearchEvent($friendlyUrl);

        $this->container->get("event_dispatcher")->dispatch('search.location.friendlyurl', $event);

        $scroll = new ScanAndScroll($this->search($event));

        foreach ($scroll as $page) {
            foreach ($page->getResults() as $result) {
                $return[$result->getId()] = Location::buildFromElasticResult($result);
            }
        }

        return $return;
    }

    /**
     * @return array
     */
    public function getAllCategories()
    {
        $return = [];

        $indexName = $this->getElasticIndexName();

        if ($this->elasticaClient) {
            $search = new Search($this->elasticaClient);
            $search->addIndex($indexName);
            $search->addType("category");

            $scroll = new ScanAndScroll($search);

            foreach ($scroll as $page) {
                foreach ($page->getResults() as $result) {
                    $return[$result->getId()] = Category::buildFromElasticResult($result);
                }
            }
        }

        return $return;
    }

    /**
     * @param int $level
     * @return array
     */
    public function getAllLocations($level = 0)
    {
        $return = [];

        $indexName = $this->container->get("search.engine")->getElasticIndexName();

        if ($this->elasticaClient) {
            $search = new Search($this->elasticaClient);
            $search->addIndex($indexName);
            $search->addType("location");

            if ($level) {
                $qB = self::getElasticaQueryBuilder();
                $search->setQuery(
                    $qB->query()->filtered(
                        $qB->query()->match_all(),
                        $qB->filter()->term()->setTerm("level", $level)
                    )
                );
            }

            $scroll = new ScanAndScroll($search);

            foreach ($scroll as $page) {
                foreach ($page->getResults() as $result) {
                    $return[$result->getId()] = Location::buildFromElasticResult($result);
                }
            }
        }

        return $return;
    }

    /**
     * Get location aggregation by level.
     *
     * @param string $module
     * @param int $level
     * @param int $limit
     * @return array
     */
    public function getLocationByModule($module, $level, $limit = 0)
    {
        $search = new Search($this->elasticaClient);
        $search->addIndex($this->getElasticIndexName())
            ->addType($module);

        $qb = self::getElasticaQueryBuilder();

        $agg = $qb->aggregation()->terms('location')
            ->setField('locationId')
            ->setInclude(sprintf('L%d.*', $level));

        if($limit){
            $agg->setSize($limit);
        }

        $query = new Query();
        $query
            ->setSize(0)
            ->setQuery(
                $qb->query()->term(['status' => true])
            )
            ->addAggregation($agg);

        $search->setQuery($query);

        try {
            $result = $search->search();

            return $result->getAggregation('location');
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage(), ['exception' => $e]);

            return [];
        }
    }

    /**
     * Returns the elastic type of the item whose friendlyUrl is passed via parameter
     * @param $terms
     * @return null|string
     */
    public function getFriendlyUrlType($terms)
    {
        $return = null;

        if ($terms) {
            $indexName = $this->container->get("search.engine")->getElasticIndexName();

            $search = new Search($this->elasticaClient);
            $search->addIndex($indexName);
            $search->addType(CategoryConfiguration::$elasticType);
            $search->addType(LocationConfiguration::$elasticType);

            $qb = self::getElasticaQueryBuilder();

            $query = new Query();
            $query->setSize(1);
            $query->setQuery(
                $qb->query()->filtered(
                    $qb->query()->match_all(),
                    $qb->filter()->terms("friendlyUrl", $terms)
                )
            );

            $search->setQuery($query);

            if ($results = $search->search()->getResults()) {
                /* @var Result $result */
                $result = array_pop($results);
                $return = $result->getType();
            }
        }

        return $return;
    }

    public function articleSearch($keyword)
    {
        $event = new SearchEvent($keyword);

        $this->container->get("event_dispatcher")->dispatch('search.article', $event);

        return $event;
    }

    public function blogSearch($keyword)
    {
        $event = new SearchEvent($keyword);

        $this->container->get("event_dispatcher")->dispatch('search.blog', $event);

        return $event;
    }

    public function classifiedSearch($keyword)
    {
        $event = new SearchEvent($keyword);

        $this->container->get("event_dispatcher")->dispatch('search.classified', $event);

        return $event;
    }

    public function dealSearch($keyword)
    {
        $event = new SearchEvent($keyword);

        $this->container->get("event_dispatcher")->dispatch('search.deal', $event);

        return $event;
    }

    public function eventSearch($keyword)
    {
        $event = new SearchEvent($keyword);

        $this->container->get("event_dispatcher")->dispatch('search.event', $event);

        return $event;
    }

    public function listingSearch($keyword)
    {
        $event = new SearchEvent($keyword);

        $this->container->get("event_dispatcher")->dispatch('search.listing', $event);

        return $event;
    }

    /**
     * @param $keyword
     * @param null $where
     * @return \Ivory\GoogleMap\Map|null|object
     */
    public function buildMap($keyword, $where = null)
    {
        $return = null;

        $event = new SearchEvent($keyword, false, [], $where);
        $this->container->get("event_dispatcher")->dispatch("search.global.map", $event);

        /* In order not to overload the user's machine, we limit map results to one thousand */
        if ($search = $this->search($event, 1000)) {

            $results = $search->search();

            if ($results->getTotalHits() > 0 && $this->container->get('settings')->getSettingGoogle('maps_status') == 'on') {

                /* These are the variable names which will be created by Ivory Google maps bundle
                 * And used by JavaScriptHandler inside map.js.twig */
                $mapJsVariable = "summaryMap";
                $clustererJSVariable = "summaryMarkerClusterer";

                /* Retrieving icon names from configuration files */
                $assets = $this->container->get("templating.helper.assets");
                $searchOptions = $this->container->getParameter("search.config");
                $icons = $searchOptions['map']['icons'];

                /* Creates and configures the map instance */
                $map = $this->container->get("ivory_google_map.map");
                $map->setApiKey($this->container->get('settings')->getSettingGoogle('maps_key'));
                $map->setJavascriptVariable($mapJsVariable);
                $map->setMapOption("scrollwheel", false);

                /* Creates and configures the clusterer */
                $cluster = $this->container->get("ivory_google_map.marker_cluster");
                $cluster->setType(MarkerCluster::MARKER_CLUSTER);
                $cluster->setJavascriptVariable($clustererJSVariable);
                $cluster->setOption("styles", [
                    [
                        "textColor" => $icons['group']['textColor'],
                        "url"       => $assets->getUrl($icons['iconPath'].$icons['group']['url']),
                        "height"    => $icons['group']['height'],
                        "width"     => $icons['group']['width'],
                    ],
                ]);

                /* Adds all necessary JS files for this to work */
                $jsHandler = $this->container->get("javascripthandler");

                $jsHandler->addJSExternalFile("assets/js/utility/cache.js");
                $jsHandler->addJSExternalFile("assets/js/utility/miscellaneous.js");
                $jsHandler->addJSExternalFile("assets/js/search/map.js");
                $jsHandler->addJSBlock("::js/summary/map.js.twig");
                $jsHandler->addTwigParameter("mapJsVariable", $mapJsVariable);
                $jsHandler->addTwigParameter("clustererJSVariable", $clustererJSVariable);

                /* Adds the markers */
                foreach ($results->getResults() as $result) {
                    $data = $result->getData();

                    if (empty($data['geoLocation'])) {
                        continue;
                    }

                    /* Filters out things located at 0,0. */
                    if ($itemGeoLocation = $data['geoLocation'] and !empty($itemGeoLocation['lat']) and !empty($itemGeoLocation['lon'])) {
                        $marker = $this->container->get("ivory_google_map.marker");
                        $marker->setPosition($itemGeoLocation['lat'], $itemGeoLocation['lon'], true);
                        $marker->setPrefixJavascriptVariable('results_marker_');
                        $marker->setOption('clickable', true);
                        $marker->setOption('flat', true);
                        $marker->setOption('itemElement',
                            ["item" => $result->getId(), "itemtype" => $result->getType()]);

                        $icons[$result->getType()] and $marker->setIcon(
                            $assets->getUrl($icons['iconPath'].$icons[$result->getType()])
                        );

                        $cluster->addMarker($marker);
                    }
                }

                /* Return null if not exist markers */
                if ($cluster->hasMarkers()) {
                    $map->setMarkerCluster($cluster);
                    $return = $map;
                }
            }
        }

        return $return;
    }

    /**
     * Deletes all items inside a certain $type.
     * Do I need to tell you to be extremelly careful when using this?
     *
     * @param string $type
     */
    public function clearType($type)
    {
        if ($type) {
            $qB = self::getElasticaQueryBuilder();
            $elasticClient = $this->container->get("search.engine")->getElasticaClient();
            $elasticIndex = $elasticClient->getIndex($this->container->get("search.engine")->getElasticIndexName());
            $elasticType = $elasticIndex->getType($type);
            $elasticType->deleteByQuery($qB->query()->match_all());
        }
    }

    /**
     * Returns an array containing all active modules types as keys and aliases as values
     * @return array
     */
    public function getActiveModules()
    {
        $return = [];

        $modules = array_filter($this->container->get('modules')->getAvailableModules());
        $modules = array_keys($modules);

        while ($module = array_pop($modules)) {
            if ($alias = $this->getModuleAlias($module)) {
                $return[$module] = $alias;
            }
        }

        return $return;
    }

    /**
     * Gets the alias of a certain module
     * @param $module
     * @return string|null
     */
    public function getModuleAlias($module)
    {
        switch ($module) {
            case "article" :
                $return = $this->container->getParameter("alias_article_module");
                break;
            case "blog" :
                $return = $this->container->getParameter("alias_blog_module");
                break;
            case "classified" :
                $return = $this->container->getParameter("alias_classified_module");
                break;
            case "promotion" :
            case "deal" :
                $return = $this->container->getParameter("alias_promotion_module");
                break;
            case "event" :
                $return = $this->container->getParameter("alias_event_module");
                break;
            case "listing" :
                $return = $this->container->getParameter("alias_listing_module");
                break;
            default:
                $return = null;
                break;
        }

        return $return;
    }

    public function getElasticTypeByModule($module)
    {
        switch ($module) {
            case "article":
                $return = ArticleConfiguration::$elasticType;
                break;
            case "blog":
                $return = BlogConfiguration::$elasticType;
                break;
            case "classified":
                $return = ClassifiedConfiguration::$elasticType;
                break;
            case "promotion":
            case "deal":
                $return = DealConfiguration::$elasticType;
                break;
            case "event":
                $return = EventConfiguration::$elasticType;
                break;
            case "listing":
                $return = ListingConfiguration::$elasticType;
                break;
            default:
                $return = null;
                break;
        }

        return $return;
    }

    /**
     * @return string
     */
    public function getGeoLocationCookieName()
    {
        return $this->geoLocationCookieName;
    }

    /**
     * 10 => p:10
     * @param $numericInput
     * @return string
     */
    public function convertToPaginationFormat($numericInput)
    {
        return preg_replace("/\d+/", $numericInput, $this->paginationFormat) ?: 1;
    }

    /**
     * keyword => k:keyword
     * @param $keywordInput
     * @return mixed
     */
    public function convertToKeywordFormat($keywordInput)
    {
        return $this->keywordFormat.$keywordInput;
    }

    /**
     * california => w:california
     * @param $whereInput
     * @return mixed
     */
    public function convertToWhereFormat($whereInput)
    {
        return $this->whereFormat.$whereInput;
    }

    /**
     * p:10 => 10
     * @param $formattedInput
     * @return int
     */
    public function convertFromPaginationFormat($formattedInput)
    {
        return (int)preg_replace("/[^\d]/", "", $formattedInput) ?: 1;
    }

    /**
     * k:example => example
     * @param $formattedInput
     * @return string
     */
    public function convertFromKeywordFormat($formattedInput)
    {
        $return = '';
        if (strpos($formattedInput, $this->keywordFormat) !== false) {
            $return = str_replace($this->keywordFormat, '', $formattedInput);
        }

        return $return;
    }

    /**
     * w:california => california
     * @param $formattedInput
     * @return string
     */
    public function convertFromWhereFormat($formattedInput)
    {
        $return = '';
        if (strpos($formattedInput, $this->whereFormat) !== false) {
            $return = str_replace($this->whereFormat, '', $formattedInput);
        }

        return $return;
    }

    /**
     * Returns the correct analyzer for a certain language
     * @param $lang
     * @return string
     */
    public function getAnalyzerForLanguage($lang)
    {
        switch ($this->container->get("languagehandler")->getISOLang($lang)) {
            case "pt":
                $return = "brazilian";
                break;
            case "fr":
                $return = "french";
                break;
            case "de":
                $return = "german";
                break;
            case "it":
                $return = "italian";
                break;
            case "es":
                $return = "spanish";
                break;
            case "tr":
                $return = "turkish";
                break;
            case "en":
            default:
                $return = "english";
                break;
        }

        return $return;
    }

    /**
     * @return \Elastica\Index
     */
    public function getElasticaIndex()
    {
        return $this->getElasticaClient()->getIndex($this->getElasticIndexName());
    }
}
