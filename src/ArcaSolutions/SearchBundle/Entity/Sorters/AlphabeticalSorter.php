<?php

namespace ArcaSolutions\SearchBundle\Entity\Sorters;

use Elastica\Query;

class AlphabeticalSorter extends BaseSorter
{
    protected static $name = "alphabetical";

    public static function getSubscribedEvents()
    {
        return [
            'search.global' => 'register',
        ];
    }

    public function sort(Query $query)
    {
        $query->setSort([
            'title.raw' => ['order' => 'asc']
        ]);
    }
}
