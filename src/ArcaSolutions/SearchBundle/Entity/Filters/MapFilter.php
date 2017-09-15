<?php

namespace ArcaSolutions\SearchBundle\Entity\Filters;

use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchEngine;

class MapFilter extends BaseFilter
{
    /**
     * {@inheritdoc}
     */
    protected static $name = "MapFilter";

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'search.global.map' => 'registerItem',
        ];
    }

    public function registerItem(SearchEvent $event, $eventName)
    {
        $this->register($event, $eventName);

        $qb = SearchEngine::getElasticaQueryBuilder();

        $this->addElasticaFilter(
            $qb->filter()->bool_not(
                $qb->filter()->bool_and([
                    $qb->filter()->term()->setTerm("geoLocation.lat", 0),
                    $qb->filter()->term()->setTerm("geoLocation.lon", 0)
                ])
            )
        );
    }

    public function getFilterView()
    {
        return "";
    }

    /**
     * {@inheritdoc}
     */
    public function processAggregationResults($aggregationResults)
    {
        return null;
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
