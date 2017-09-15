<?php

namespace ArcaSolutions\SearchBundle\Entity\Filters;


use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchEngine;

class BoundingFilter extends BaseFilter
{
    /**
     * {@inheritdoc}
     */
    protected static $name = "BoundingFilter";

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'search.global' => 'registerItem',
        );
    }

    /**
     * Provides the necessary elasticsearch queries and filters for a geo bounding box search
     *
     * @param SearchEvent $searchEvent
     * @param $eventName
     */
    public function registerItem(SearchEvent $searchEvent, $eventName)
    {
        $request = $this->container->get("request");

        if ($topLeft = $request->get('topLeft') AND $bottomRight = $request->get('bottomRight')) {

            $this->register($searchEvent, $eventName);

            $qb = SearchEngine::getElasticaQueryBuilder();

            $this->addElasticaFilter(
                $qb->filter()->geo_bounding_box(
                    'geoLocation',
                    [$topLeft, $bottomRight]
                )
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getFilterView()
    {
        return "";
    }

    /**
     * {@inheritdoc}
     */
    public function processAggregationResults($aggregationResults)
    {
        /* This filter has no aggregations */
    }

    /**
     * {@inheritdoc}
     */
    protected function processAggregationBuckets($filterAggregationBuckets)
    {
        /* This filter has no buckets. */
    }
}