<?php

namespace ArcaSolutions\SearchBundle\Entity\Filters;

use ArcaSolutions\SearchBundle\Entity\FilterMenuTreeNode;
use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\SearchBundle\Services\SearchEngine;

class ModuleFilter extends BaseFilter
{
    /**
     * {@inheritdoc}
     */
    protected static $name = "ModuleFilter";

    private $aggregationInfo;

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'search.global'     => [['registerItem', -100]],
            'search.global.map' => [['registerItem', -100]],
        ];
    }

    public function registerItem(SearchEvent $event, $eventName)
    {
        $this->register($event, $eventName);

        $parameterInfo = $this->container->get("search.parameters");
        $searchEngine = $this->container->get("search.engine");
        $qb = SearchEngine::getElasticaQueryBuilder();

        if ($searchedModules = $parameterInfo->getModules()) {

            $filters = [];

            while ($module = array_pop($searchedModules)) {
                $filters[] = $qb->filter()->type($searchEngine->getElasticTypeByModule($module));
            }

            if (count($filters) > 1) {
                $this->addElasticaPostFilter($qb->filter()->bool_or($filters));
            } else {
                $this->addElasticaPostFilter(array_pop($filters));
            }
        }
    }

    public function getElasticaAggregations()
    {
        $subscribedEvents = self::getSubscribedEvents();

        switch ($subscribedEvents[$this->eventName][0][0]) {
            case 'registerItem' :
                $qb = SearchEngine::getElasticaQueryBuilder();

                $aggregation = $qb->aggregation()->terms(static::$name)
                    ->setField("_type")
                    ->setSize($this->searchConfig['settings']['aggregationSize']);

                $filters = $this->searchEvent->getElasticaPostFilters();
                unset ($filters[static::$name]);

                if ($filters) {
                    $aggregation->addAggregation(
                        $qb->aggregation()->filter(
                            "filtered",
                            $qb->filter()->bool_and($filters)
                        )
                    );
                }

                $this->addElasticaAggregation($aggregation);
                break;
        }

        return $this->elasticaAggregations;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilterView()
    {
        $return = null;

        if ($this->aggregationInfo && count($this->aggregationInfo) > 1) {
            $searchEngine = $this->container->get("search.engine");

            $modules = [];
            /* Gets the friendlyUrl of the categories being searched for */
            $requestModules = $this->container->get("search.parameters")->getModules();

            foreach ($this->aggregationInfo as $module => $documentCount) {
                /* @todo After 'promotion' has been changed to 'deal', change the line below */
                $module == ParameterHandler::MODULE_DEAL and $module = 'promotion';
                $alias = $searchEngine->getModuleAlias($module);

                $modules[$module] = new FilterMenuTreeNode(
                    null,
                    null,
                    $alias,
                    $module,
                    null,
                    null,
                    in_array($module, $requestModules),
                    $this->getSearchPageUrl($module),
                    $documentCount,
                    false
                );
            }

            $return = $this->container->get("twig")->render(
                "::blocks/filters/module.html.twig",
                [
                    "availableModules" => $modules,
                    "selectedModules"  => $requestModules,
                ]
            );
        }

        return $return;
    }

    /**
     * @param $module
     * @return array
     */
    private function getSearchPageUrl($module)
    {
        $searchParameters = clone $this->container->get("search.parameters");
        $searchParameters->toggleModule($module);

        return $searchParameters->buildUrl();
    }

    /**
     * {@inheritdoc}
     */
    protected function processAggregationBuckets($filterAggregationBuckets)
    {
        $this->aggregationInfo = null;

        foreach ($filterAggregationBuckets as $bucket) {
            if ($documentCount = isset($bucket['filtered']) ? $bucket['filtered']['doc_count'] : $bucket['doc_count']) {
                $this->aggregationInfo[$bucket['key']] = $documentCount;
            }
        }
    }
}
