<?php

namespace ArcaSolutions\SearchBundle\Entity\Filters;

use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchEngine;

class DealFilter extends BaseTranslatableUrlFilter
{
    /**
     * {@inheritdoc}
     */
    protected static $name = "DealFilter";
    /**
     * {@inheritdoc}
     */
    protected static $filterUrlName = "withDeal";

    private $aggregationInfo;

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
//            'search.global'      => 'registerItem',
//            'search.global.map'  => 'registerMapItem',
//            'search.listing'     => 'registerItem',
//            'search.listing.map' => 'registerMapItem',
        ];
    }

    public function registerItem(SearchEvent $event, $eventName)
    {
        $this->register($event, $eventName);

        $qb = SearchEngine::getElasticaQueryBuilder();
        $parameterInfo = $this->container->get("search.parameters");

        if ($ratingInfo = $parameterInfo->getQueryParameter($this->translatedName)) {
            $this->addElasticaPostFilter(
                $qb->filter()->bool_not(
                    $qb->filter()->term(["promotionId" => 0])
                )
            );
        }

        $this->addElasticaAggregation(
            $qb->aggregation()->filter(
                static::$name,
                $qb->filter()->bool_not($qb->filter()->term(["promotionId" => 0]))
            )
        );
    }

    public function registerMapItem(SearchEvent $event, $eventName)
    {
        $this->register($event, $eventName);

        $qb = SearchEngine::getElasticaQueryBuilder();
        if ($ratingInfo = $this->container->get("search.parameters")->getQueryParameter($this->translatedName)) {
            $this->addElasticaFilter(
                $qb->filter()->bool_not(
                    $qb->filter()->term(["promotionId" => 0])
                )
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getFilterView()
    {
        $return = null;

        if ($this->aggregationInfo > 0) {

            $requestFilterRatings = $this->container->get("search.parameters")->getQueryParameter($this->translatedName);

            $return = $this->container->get("twig")->render(
                "::blocks/filters/deal.html.twig",
                [
                    "isSelected"    => (bool)$requestFilterRatings,
                    "searchPageUrl" => $this->getSearchPageUrl(),
                    "resultCount"   => (int)$this->aggregationInfo
                ]
            );
        }

        return $return;
    }

    /**
     * @return array
     */
    private function getSearchPageUrl()
    {
        $result = null;

        if ($searchParameters = clone $this->container->get("search.parameters")) {
            $searchParameters->toggleQueryParameter($this->translatedName, 1);
            $result = $searchParameters->buildUrl();
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function processAggregationResults($aggregationResults)
    {
        $returnValue = null;

        if (isset($aggregationResults[static::$name])) {
            $this->aggregationInfo = $aggregationResults[static::$name]["doc_count"];
        }

        return $returnValue;
    }

    /**
     * {@inheritdoc}
     */
    protected function processAggregationBuckets($filterAggregationBuckets)
    {
        /* This filter has no buckets.
         *
         *      ,.--'`````'--.,
         *     (\'-.,_____,.-'/)
         *      \\-.,_____,.-//
         *      ;\\         //|
         *      | \\  ___  // |
         *      |  '-[___]-'  |
         *      |             |
         *      |             |
         *      |             |
         *      `'-.,_____,.-''
         */
    }
}
