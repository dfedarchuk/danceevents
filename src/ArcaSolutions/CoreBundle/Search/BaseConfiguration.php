<?php

namespace ArcaSolutions\CoreBundle\Search;

use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchEngine;
use Elastica;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class BaseConfiguration implements EventSubscriberInterface
{
    /**
     * @var string|null
     */
    public static $elasticType = null;
    /**
     * @var string
     */
    protected static $module = null;
    /**
     * @var bool
     */
    protected $typeIncludedOnSearch = true;
    /**
     * @var Elastica\Aggregation\AbstractAggregation[]
     */
    protected $elasticaAggregations = [];
    /**
     * @var Elastica\Filter\AbstractFilter[]
     */
    protected $elasticaFilters = [];
    /**
     * @var Elastica\Query\AbstractQuery
     */
    protected $elasticaQuery = null;

    /**
     * @var Elastica\Script\Script
     */
    protected $elasticaScriptFields = [];
    /**
     * @var SearchEvent
     */
    protected $searchEvent = null;
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var SearchEngine
     */
    protected $searchEngine;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->searchEngine = $container->get('search.engine');
    }

    /**
     * True if the $elasticType of this module should be added to the final search
     * @return boolean
     */
    public function isTypeIncludedOnSearch()
    {
        return $this->typeIncludedOnSearch;
    }

    /**
     * Returns the Elasticsearch Type associated with this module
     * @return string|null
     */
    public function getElasticType()
    {
        return static::$elasticType;
    }

    /**
     * Registers this module to the $event. This means all queries, filters and aggregations
     * associated with this module will be inserted into the final query.
     * @param SearchEvent $event
     */
    public function register(SearchEvent $event)
    {
        $this->searchEvent = $event;
        $event->addModule($this, static::$elasticType);
    }

    /**
     * Returns this module's inserted Elastica filters
     * @return Elastica\Filter\AbstractFilter[]
     */
    public function getElasticaFilters()
    {
        return $this->elasticaFilters;
    }

    /**
     * @return Elastica\Script\Script[]
     */
    public function getElasticaScriptFields()
    {
        return $this->elasticaScriptFields;
    }

    /**
     * @param String $fieldName
     * @param Elastica\Script\Script
     */
    public function addElasticaScriptField($fieldName, $script)
    {
        $this->elasticaScriptFields[$fieldName] = $script;
    }

    /**
     * Adds this module's Elastica filters to be added to the final Search instance
     * @param Elastica\Filter\AbstractFilter $elasticaFilter
     * @param $key
     */
    public function addElasticaFilter($elasticaFilter, $key = null)
    {
        $key or $key = static::$elasticType;

        $this->elasticaFilters[$key] = $elasticaFilter;
    }

    /**
     * Returns this module's inserted Elastica query
     * @return Elastica\Query\AbstractQuery
     */
    public function getElasticaQuery()
    {
        return $this->elasticaQuery;
    }

    /**
     * Sets this module's Elastica Query to be added to the final Search instance
     * @param Elastica\Query\AbstractQuery $elasticaQuery
     * @param $key
     */
    public function setElasticaQuery($elasticaQuery, $key = null)
    {
        $key or $key = static::$elasticType;

        $this->elasticaQuery = [$key => $elasticaQuery];
    }

    /**
     * Returns this module's inserted Elastica aggregations
     * @return Elastica\Aggregation\AbstractAggregation[]
     */
    public function getElasticaAggregations()
    {
        return $this->elasticaAggregations;
    }

    /**
     * Adds an aggregation to be inserted into the final Search instance
     * @param $key
     * @param Elastica\Aggregation\AbstractAggregation $elasticaAggregation
     */
    public function addElasticaAggregation($key, $elasticaAggregation)
    {
        $key or $key = static::$elasticType;
        $this->elasticaAggregations[$key] = $elasticaAggregation;
    }

    /**
     * This functions feeds the module configuration level features into the &features array, if any.
     * Per convention, the key name should be the module's name.
     * @param array &$features
     */
    public function getLevelFeatures(&$features)
    {
    }

    /**
     * Returns all js twigs which should be rendered in the results page
     * @return string[]
     */
    public function getResultsJS()
    {
        return [];
    }

    /**
     * Creates an Elastica Query instance for this module's search action
     * @return Elastica\Query
     */
    public function createDefaultSearchQuery()
    {
        $qB = SearchEngine::getElasticaQueryBuilder();

        $keyword = Utility::convertArrayToString($this->searchEvent->getKeyword());
        $where = $this->searchEvent->getWhere();

        $keywordQuery = null;
        $whereQuery = null;
        $content = 0;
        if ($where) {
            if ($geoDistance = $this->container->get("nearby.handler")->getGeoDistanceInfoByWhere()) {
                $whereQuery = $qB->query()->bool();
                $whereQuery->addShould(
                    $qB->query()->match()->setFieldQuery("searchInfo.location",
                        $where)->setFieldType("searchInfo.location", "phrase")
                        ->setFieldBoost("searchInfo.location", 2)
                );
                $whereQuery->addShould(
                    $qB->query()->geo_distance(
                        'geoLocation',
                        [
                            'lat' => $geoDistance['latitude'],
                            'lon' => $geoDistance['longitude'],
                        ],
                        $geoDistance['radius'])
                );
                $content |= 1;
            } else {
                $whereQuery = $qB->query()->match()->setFieldQuery("searchInfo.location",
                    $where)->setFieldType("searchInfo.location", "phrase");
                $content |= 1;
            }
        }

        if ($keyword) {
            $keywordQuery = $qB->query()->multi_match();

            $keywordQuery->setQuery($keyword)
                ->setTieBreaker(0.3)
                ->setOperator("and")
                ->setFields([
                    'friendlyUrl^500',
                    'title.raw^200',
                    'title.analyzed^10',
                    'description^5',
                    'searchInfo.keyword^1',
                    'searchInfo.location^1',
                ]);

            $content |= 2;
        }

        switch ($content) {
            case 1:
                $query = $whereQuery;
                break;
            case 2:
                $query = $keywordQuery;
                break;
            case 3:
                $query = $qB->query()->bool();
                $query->addMust($keywordQuery);
                $query->addMust($whereQuery);
                break;
            default:
                $query = $qB->query()->match_all();
                break;
        }

        return $query;
    }
}
