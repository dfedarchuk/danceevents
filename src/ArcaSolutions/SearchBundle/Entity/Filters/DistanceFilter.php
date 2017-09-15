<?php

namespace ArcaSolutions\SearchBundle\Entity\Filters;

use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchEngine;

class DistanceFilter extends BaseTranslatableUrlFilter
{
    /**
     * {@inheritdoc}
     */
    protected static $name = "Distance";
    /**
     * {@inheritdoc}
     */
    protected static $filterUrlName = "nearby";

    /* Note: use only URL safe chars for the cookie names or santa won't bring you a present. */
    /**
     * This is the name of the cookie containing the user's preferred distance
     * @var string
     */
    protected static $distanceCookieName = "edirectory_searchOptions_userRadius";
    /**
     * This is the name of the cookie containing the user's GeoLocation coordinates
     * @var string
     */
    protected static $geoLocationCookieName = "edirectory_searchOptions_userGeoLocation";

    /**
     * @return string
     */
    public static function getDistanceCookieName()
    {
        return self::$distanceCookieName;
    }

    /**
     * @return string
     */
    public static function getGeoLocationCookieName()
    {
        return self::$geoLocationCookieName;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
//            'search.global'         => 'registerItem',
//            'search.listing'        => 'registerItem',
//            'search.deal'           => 'registerItem',
//            'search.event'          => 'registerItem',
//            'search.classified'     => 'registerItem',
//            'search.global.map'     => 'registerMapItem',
//            'search.listing.map'    => 'registerMapItem',
//            'search.deal.map'       => 'registerMapItem',
//            'search.event.map'      => 'registerMapItem',
//            'search.classified.map' => 'registerMapItem',
        );
    }

    public function registerItem(SearchEvent $searchEvent, $eventName)
    {
        $this->register($searchEvent, $eventName);

        $qb = SearchEngine::getElasticaQueryBuilder();
        $parameterInfo = $this->container->get("search.parameters");

        $configs = $this->container->getParameter("search.config");
        $geoLocationUnit = $configs['settings']['locationUnit'];

        if ($ratingInfo = $parameterInfo->getQueryParameter($this->translatedName)) {

            $request = $this->container->get("request");
            $distance = $request->cookies->get(self::$distanceCookieName);
            $userGeoLocation = $this->container->get("utility")->getGeoPointFromCookies();

            if ($distance && $userGeoLocation) {
                $this->addElasticaPostFilter(
                    $qb->filter()->geo_distance(
                        'geoLocation',
                        $userGeoLocation,
                        $distance . $geoLocationUnit
                    )
                );
            }
        }
    }

    public function registerMapItem(SearchEvent $searchEvent, $eventName)
    {
        $this->register($searchEvent, $eventName);

        $geoLocationUnit = "km";

        if ($ratingInfo = $this->container->get("search.parameters")->getQueryParameter($this->translatedName)) {

            $request = $this->container->get("request");
            $distance = $request->cookies->get(self::$distanceCookieName);
            $userGeoLocation = $this->container->get("utility")->getGeoPointFromCookies();

            if ($distance && $userGeoLocation) {
                $this->addElasticaFilter(
                    SearchEngine::getElasticaQueryBuilder()->filter()->geo_distance(
                        'geoLocation',
                        $userGeoLocation,
                        $distance . $geoLocationUnit
                    )
                );
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getFilterView()
    {
        $requestFilterDistance = $this->container->get("search.parameters")->getQueryParameter($this->translatedName);
        $javaScriptHandler = $this->container->get("javascripthandler");

        $javaScriptHandler->addJSExternalFile("dist/js/libs/bootstrap-slider.min.js");
        $javaScriptHandler->addJSBlock("::js/filters/distance.js.twig");
        $javaScriptHandler->addTwigParameter("distanceCookieName", static::$distanceCookieName);
        $javaScriptHandler->addTwigParameter("geoLocationCookieName", static::$geoLocationCookieName);

        $configs = $this->container->getParameter("search.config");
        $geoLocationUnit = $configs['settings']['locationUnit'];

        return $this->container->get("twig")->render(
            "::blocks/filters/distance.html.twig",
            [
                "isSelected"    => (bool)$requestFilterDistance,
                "unit"          => $geoLocationUnit,
                "searchPageUrl" => $this->getSearchPageUrl()
            ]
        );
    }

    /**
     * @return array
     */
    private function getSearchPageUrl()
    {
        $result = null;

        if ($searchParameters = clone $this->container->get("search.parameters")) {
            $searchParameters->toggleQueryParameter($this->translatedName, 1);
            $result = $searchParameters->buildUrl();
        }

        return $result;
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
