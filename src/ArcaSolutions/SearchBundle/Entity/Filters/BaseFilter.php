<?php

namespace ArcaSolutions\SearchBundle\Entity\Filters;

use ArcaSolutions\SearchBundle\Events\SearchEvent;
use Elastica\Aggregation\AbstractAggregation;
use Elastica\Filter\AbstractFilter;
use Elastica\Query\AbstractQuery;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class BaseFilter implements EventSubscriberInterface
{
    /**
     * @var string
     */
    protected static $name;
    /**
     * @var AbstractAggregation[]
     */
    protected $elasticaAggregations = [];
    /**
     * @var AbstractFilter[]
     */
    protected $elasticaFilters = [];
    /**
     * @var AbstractFilter[]
     */
    protected $elasticaPostFilters = [];
    /**
     * @var Container
     */
    protected $container;
    /**
     * @var SearchEvent
     */
    protected $searchEvent;
    /**
     * @var string
     */
    protected $eventName;

    /**
     * @var array
     */
    protected $searchConfig;

    /**
     * @param ContainerInterface $container
     */
    function __construct($container)
    {
        $this->container = $container;
        $this->searchConfig = $this->container->getParameter('search.config');
    }

    /**
     * @param SearchEvent $event
     * @param $eventName
     */
    public function register(SearchEvent $event, $eventName)
    {
        $event->addFilter($this, static::$name);
        $this->searchEvent = $event;
        $this->eventName = $eventName;
    }

    //region Getters
    /**
     * @return string
     */
    public static function getName()
    {
        return static::$name;
    }

    /**
     * @return SearchEvent
     */
    public function getSearchEvent()
    {
        return $this->searchEvent;
    }

    /**
     * Retrieves the rendered HTML of each filter
     * @return string
     */
    abstract public function getFilterView();
    //endregion


    //region Elastica
    /**
     * @return AbstractFilter[]
     */
    public function getElasticaFilters()
    {
        return $this->elasticaFilters;
    }

    /**
     * @param AbstractFilter $elasticaFilter
     * @param $key
     */
    public function addElasticaFilter(AbstractFilter $elasticaFilter, $key = null)
    {
        $key or $key = static::$name;
        $this->elasticaFilters[$key] = $elasticaFilter;
    }

    /**
     * @return AbstractFilter[]
     */
    public function getElasticaPostFilters()
    {
        return $this->elasticaPostFilters;
    }

    /**
     * @param AbstractFilter $elasticaFilter
     * @param $key
     */
    public function addElasticaPostFilter(AbstractFilter $elasticaFilter, $key = null)
    {
        $key or $key = static::$name;
        $this->elasticaPostFilters[$key] = $elasticaFilter;
    }

    /**
     * @return AbstractAggregation[]
     */
    public function getElasticaAggregations()
    {
        return $this->elasticaAggregations;
    }

    /**
     * @param AbstractAggregation $elasticaAggregation
     * @param $key
     */
    public function addElasticaAggregation($elasticaAggregation, $key = null)
    {
        $key or $key = static::$name;
        $this->elasticaAggregations[$key] = $elasticaAggregation;
    }

    /**
     * @return AbstractQuery[]
     */
    public function getElasticaQuery()
    {
        return [];
    }

    /**
     * Processes the results of this module's aggregations
     * @param $aggregationResults
     * @return mixed|null
     */
    public function processAggregationResults($aggregationResults)
    {
        $returnValue = null;

        if (isset($aggregationResults[static::$name]) and $filterAggregationBuckets = $aggregationResults[static::$name]["buckets"]) {
            $returnValue = $this->processAggregationBuckets($filterAggregationBuckets);
        }

        return $returnValue;
    }

    /**
     * Processes the individual buckets of this module's aggregations and prepares it for posterior use
     * @param $filterAggregationBuckets
     * @return mixed
     */
    abstract protected function processAggregationBuckets($filterAggregationBuckets);
    //endregion
}
