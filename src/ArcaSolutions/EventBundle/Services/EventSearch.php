<?php

namespace ArcaSolutions\EventBundle\Services;

use ArcaSolutions\MultiDomainBundle\Services\Settings;
use ArcaSolutions\SearchBundle\Events\GlobalSearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchEngine;
use Elastica;

class EventSearch
{
    private $elasticType = "event";
    private $settings;
    private $searchEngine;

    function __construct(Settings $settings, SearchEngine $engine)
    {
        $this->settings = $settings;
        $this->searchEngine = $engine;
    }

    public function onGlobalSearch(GlobalSearchEvent $event)
    {
        $event->addType( $this->elasticType );
    }
}