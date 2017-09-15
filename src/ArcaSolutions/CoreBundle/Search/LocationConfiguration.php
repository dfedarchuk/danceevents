<?php

namespace ArcaSolutions\CoreBundle\Search;

use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchEngine;

class LocationConfiguration extends BaseConfiguration
{
    /**
     * @var string|null
     */
    public static $elasticType = "location";

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'search.location.friendlyurl' => 'registerFriendlyUrl',
            'search.location.id'          => 'registerId'
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
