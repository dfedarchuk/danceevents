<?php

namespace ArcaSolutions\SearchBundle\Entity\Sorters;

use Elastica\Query;

/**
 * Class ReviewSorter
 *
 * @package ArcaSolutions\SearchBundle\Entity\Sorters
 */
class ReviewSorter extends BaseSorter
{
    protected static $name = 'review';

    /**
     * Sets events to listening
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'bestof.listing' => 'register',
        ];
    }

    /**
     * Sets sort elastic query for date
     *
     * @param Query $query
     */
    public function sort(Query $query)
    {
        $query->setSort([
            'averageReview' => [
                'order' => 'desc'
            ]
        ]);
    }
}
