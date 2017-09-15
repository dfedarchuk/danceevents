<?php

namespace ArcaSolutions\SearchBundle\Events;

use ArcaSolutions\CoreBundle\Search\BaseConfiguration;
use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\ElasticsearchBundle\Entity\DecayFunction;
use ArcaSolutions\SearchBundle\Entity\Filters\BaseFilter;
use ArcaSolutions\SearchBundle\Entity\Sorters\BaseSorter;
use Elastica\Aggregation\AbstractAggregation;
use Elastica\Filter\AbstractFilter;
use Elastica\Query;
use Elastica\Script\Script;
use Elastica\Script\ScriptFields;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\Pagination\PaginationInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\EventDispatcher\Event;

class SearchEvent extends Event
{
    /**
     * @var BaseFilter[]
     */
    private $filters = [];

    /**
     * @var ScriptFields
     */
    private $elasticaScriptFields = null;
    /**
     * @var BaseConfiguration[]
     */
    private $modules = [];
    /**
     * @var string[]
     */
    private $keyword = null;
    /**
     * @var string
     */
    private $where = null;
    /**
     * @var bool
     */
    private $isRandom = false;
    /**
     * @var BaseSorter[]
     */
    private $sorts = [];
    /**
     * @var BaseSorter
     */
    private $defaultSorter = null;
    /**
     * @var DecayFunction[]
     */
    private $decayfunctions = [];
    /**
     * @var array
     */
    private $options = [];

    /**
     * @param null $keyword
     * @param bool|false $isRandom
     * @param array $options
     * @param null $where
     */
    function __construct($keyword = null, $isRandom = false, $options = [], $where = null)
    {
        $this->setKeyword($keyword);
        $this->setWhere($where);
        $this->isRandom = (!$keyword && !$where) ? true : $isRandom;
        $this->options = $options;
    }

    //region Getters / Setters
    /**
     * @return BaseFilter[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Adds a base filter to the search
     * @param BaseFilter $filter
     * @param $key
     */
    public function addFilter(BaseFilter $filter, $key)
    {
        $this->filters[$key] = $filter;
    }

    /**
     * Returns true if the Event has registered Filters
     * @return bool
     */
    public function hasFilters()
    {
        return !empty($this->filters);
    }


    /**
     * Adds a script field to the search
     * @param $fieldName string
     * @param $script Script
     */
    public function addElasticaScriptField($fieldName, $script) {
        if ($this->elasticaScriptFields == null) {
            $this->elasticaScriptFields = new ScriptFields();
        }
        $this->elasticaScriptFields->addScript($fieldName, $script);
    }

    public function hasScriptFields() {
        return $this->elasticaScriptFields != null;
    }


    /**
     * Returns all registered modules
     * @return BaseConfiguration[]
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * @param BaseConfiguration $module
     * @param $key
     */
    public function addModule($module, $key)
    {
        $this->modules[$key] = $module;
    }

    /**
     * Returns true if the event has registered Modules
     * @return bool
     */
    public function hasModules()
    {
        return !empty($this->modules);
    }

    /**
     * @param $translatedName
     * @return \ArcaSolutions\SearchBundle\Entity\Sorters\BaseSorter
     */
    public function getSort($translatedName = null)
    {
        $return = null;

        if ($translatedName && !empty($this->sorts[$translatedName])) {
            $return = $this->sorts[$translatedName];
        }

        return $return;
    }

    /**
     * @return \ArcaSolutions\SearchBundle\Entity\Sorters\BaseSorter
     */
    public function getSorters()
    {
        return $this->sorts;
    }

    /**
     * Adds a base filter to the search
     * @param BaseSorter $sort
     * @param $key
     */
    public function addSort(BaseSorter $sort, $key)
    {
        $this->sorts[$key] = $sort;
    }

    /**
     * Returns true if the Event has registered Filters
     * @return bool
     */
    public function hasSorts()
    {
        return !empty($this->sorts);
    }

    /**
     * Returns the keyword being searched for
     * @return string|null
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Sets the search keyword
     * @param mixed $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = Utility::convertStringToArray($keyword);
    }

    /**
     * Returns true if the query results should be randomized
     * @return bool
     */
    public function isRandom()
    {
        return $this->isRandom;
    }

    /**
     * @return BaseSorter
     */
    public function getDefaultSorter()
    {
        return $this->defaultSorter;
    }

    /**
     * Returns an array of JS twigs where the key is the identifier and the Value is the path to the twig
     * @return array
     */
    public function getResultsJSTwigs()
    {
        $return = [];

        foreach ($this->modules as $module) {
            $return = array_merge($return, $module->getResultsJS());
        }

        return $return;
    }

    /**
     * @param BaseSorter $defaultSorter
     */
    public function setDefaultSorter($defaultSorter)
    {
        $this->defaultSorter = $defaultSorter;
    }
    //endregion


    //region Elastica Getters
    /**
     * Returns all elastica aggregations for this search event
     * @return AbstractAggregation[]
     */
    public function getElasticaAggregations()
    {
        $return = [];

        foreach ($this->filters as $key => $filter) {
            $return = array_merge($return, $filter->getElasticaAggregations());
        }

        foreach ($this->modules as $key => $module) {
            $return = array_merge($return, $module->getElasticaAggregations());
        }

        return $return;
    }

    /**
     * Returns all elastica filters for this search event, including the basic module filters
     * @return AbstractFilter[]
     */
    public function getElasticaFilters()
    {
        $return = [];

        foreach ($this->filters as $key => $filter) {
            $return = array_merge($return, $filter->getElasticaFilters());
        }

        foreach ($this->modules as $key => $module) {
            $return = array_merge($return, $module->getElasticaFilters());
        }

        return $return;
    }

    public function getElasticaScriptFields() {
        return $this->elasticaScriptFields;
    }

    /**
     * Returns all elastica filters for this search event, including the basic module filters
     * @return AbstractFilter[]
     */
    public function getElasticaPostFilters()
    {
        $return = [];

        foreach ($this->filters as $key => $filter) {
            $return = array_merge($return, $filter->getElasticaPostFilters());
        }

//        foreach ($this->modules as $key => $module) {
//            $return = array_merge($return, $module->getElasticaFilters());
//        }

        return $return;
    }

    /**
     * Returns all elastica queries for this search event
     * @return Query\AbstractQuery[]
     */
    public function getElasticaQueries()
    {
        $return = [];

        foreach ($this->filters as $filter) {
            $return = array_merge($return, (array)$filter->getElasticaQuery());
        }

        foreach ($this->modules as $module) {
            $return = array_merge($return, (array)$module->getElasticaQuery());
        }

        return $return;
    }

    /**
     * Returns all elastica types
     * @return string[]
     */
    public function getElasticaTypes()
    {
        $return = [];

        foreach ($this->modules as $key => $module) {
            if ($module->isTypeIncludedOnSearch()){
                $return[$key] = $module->getElasticType();
            }
        }

        return $return;
    }

    /**
     * Returns all elastica types
     * @return string[]
     */
    public function getModuleLevelFeatures()
    {
        $return = [];

        foreach ($this->modules as $key => $module) {
            $module->getLevelFeatures($return);
        }

        return $return;
    }

    /**
     * @param PaginationInterface $pagination
     */
    public function processAggregationResults($pagination)
    {
        /* @var SlidingPagination $pagination */
        $aggregationResults = $pagination->getCustomParameter('aggregations');

        foreach ($this->filters as $filter) {
            $filter->processAggregationResults($aggregationResults);
        }
    }

    public function sort($mainQuery)
    {
        foreach ($this->sorts as $sort) {
            $sort->sort($mainQuery);
        }
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return \ArcaSolutions\ElasticsearchBundle\Entity\DecayFunction[]
     */
    public function getDecayfunctions()
    {
        return $this->decayfunctions;
    }

    /**
     * @param \ArcaSolutions\ElasticsearchBundle\Entity\DecayFunction $decayfunction
     */
    public function addDecayfunction($decayfunction)
    {
        $this->decayfunctions[] = $decayfunction;
    }

    /**
     * @return string
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * @param string $where
     */
    public function setWhere($where)
    {
        $this->where = $where;
    }
    //endregion


}
