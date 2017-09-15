<?php

namespace ArcaSolutions\ListingBundle\Search;

use ArcaSolutions\CoreBundle\Search\BaseConfiguration;
use ArcaSolutions\SearchBundle\Services\SearchEngine;

class BadgeConfiguration extends BaseConfiguration
{
    /**
     * @var string|null
     */
    public static $elasticType = "badge";

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'search.badge.id' => 'register'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getElasticaQuery()
    {
        $returnValue = [];

        if ($termArray = $this->searchEvent->getKeyword()) {
            $queryBuilder = SearchEngine::getElasticaQueryBuilder();
            $returnValue[static::$elasticType] = $queryBuilder->query()->ids(static::$elasticType, $termArray);
        }

        return $returnValue;
    }
}
