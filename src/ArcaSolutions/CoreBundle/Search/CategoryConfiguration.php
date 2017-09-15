<?php

namespace ArcaSolutions\CoreBundle\Search;

use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchEngine;

class CategoryConfiguration extends BaseConfiguration
{
    /**
     * @var string|null
     */
    public static $elasticType = "category";

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'search.category.friendlyurl' => 'registerFriendlyUrl',
            'search.category.id'          => 'registerId',
        ];
    }

    public function registerFriendlyUrl(SearchEvent $event)
    {
        $this->register($event);

        if ($termArray = $this->searchEvent->getKeyword()) {
            $qB = SearchEngine::getElasticaQueryBuilder();

            $this->setElasticaQuery($qB->query()->terms("friendlyUrl", $termArray));
        }
    }

    public function registerId(SearchEvent $event)
    {
        $this->register($event);

        if ($termArray = $this->searchEvent->getKeyword()) {
            $qB = SearchEngine::getElasticaQueryBuilder();

            $this->setElasticaQuery($qB->query()->ids(static::$elasticType, $termArray));
        }
    }
}
