<?php

namespace ArcaSolutions\SearchBundle\Entity\Sorters;

use ArcaSolutions\SearchBundle\Events\SearchEvent;
use Elastica\Query;
use Elastica\Script;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class BaseSorter implements EventSubscriberInterface
{
    protected static $name;
    protected $translatedName;
    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @var Script
     */
    protected $script;

    /**
     * @param ContainerInterface $container
     */
    function __construct($container)
    {
        $this->container = $container;
        /** @Ignore */
        $this->translatedName = $container->get("translator")->trans(static::$name, [], "filters");
    }

    /**
     * @return bool
     */
    public function needsGeoLocation()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isSelected()
    {
        static $translatedSortParameterName = null;

        /* This may look stupid at a first glance, checking a variable you just declared as null,
         * but this is a static variable, gentleman. This will only happen once */
        if (!$translatedSortParameterName) {
            $translatedSortParameterName = $this->container->get("translator")->trans("sort", [], "filters");
        }

        return $this->container->get("request")->get($translatedSortParameterName) == $this->translatedName;
    }

    /**
     * @param SearchEvent $event
     */
    public function register(SearchEvent $event)
    {
        $event->addSort($this, $this->translatedName);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return static::$name;
    }

    /**
     * @return mixed
     */
    public function getTranslatedName()
    {
        return $this->translatedName;
    }

    abstract public function sort(Query $query);

    /**
     * @param bool $isDefault
     * @return array
     */
    public function getSearchPageUrl($isDefault = false)
    {
        $result = null;
        static $translatedSortParameterName = null;

        if (!$translatedSortParameterName) {
            $translatedSortParameterName = $this->container->get("translator")->trans("sort", [], "filters");
        }

        if ($searchParameters = clone $this->container->get("search.parameters")) {
            $searchParameters->clearQueryParameter($translatedSortParameterName);
            $isDefault or $searchParameters->addQueryParameter($translatedSortParameterName, $this->translatedName);
            $result = $searchParameters->buildUrl();
        }

        return $result;
    }

    /**
     * @return Script
     */
    public function getScript()
    {
        return $this->script;
    }
}
