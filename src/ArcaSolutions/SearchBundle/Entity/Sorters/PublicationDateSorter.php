<?php

namespace ArcaSolutions\SearchBundle\Entity\Sorters;

use Elastica\Query;

/**
 * Class PublicationDateSorter
 *
 * @package ArcaSolutions\SearchBundle\Entity\Sorters
 */
class PublicationDateSorter extends BaseSorter
{
    /**
     * Sorter name
     *
     * @var string
     */
    protected static $name = "date";

    /**
     * Sets events to listening
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'recent.article'    => 'register',
            'recent.classified' => 'register',
            'recent.deal'       => 'register',
            'recent.blog'       => 'register'
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
            'publicationDate' => [
                'order' => 'desc'
            ]
        ]);
    }
}
