<?php

namespace ArcaSolutions\SearchBundle\Entity\Sorters;

use ArcaSolutions\CoreBundle\Services\Utility;
use Elastica\Query;
use Elastica\Script\ScriptFile;

class DistanceSorter extends BaseSorter
{
    /**
     * @var string
     */
    protected static $name = "distance";

    /**
     * @var null
     */
    private $userGeoLocation = null;

    /**
     * @var bool
     */
    private $initialized = false;

    function __construct($container)
    {
        parent::__construct($container);

        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return [
            'search.global'     => 'register',
            //'search.global.map' => 'register',
        ];
    }

    public function needsGeoLocation()
    {
        return true;
    }

    public function sort(Query $query)
    {
        if (!$this->initialized) {
            $lat = $this->container->get("request")->get("lat");
            $lon = $this->container->get("request")->get("lng");

            if (!empty($lat) && !empty($lon)){
                $this->userGeoLocation = [
                    'lat' => $lat,
                    'lon' => $lon,
                ];
            } else {
                $this->userGeoLocation = Utility::extractGeoPoint($this->container->get("request_stack")->getCurrentRequest()
                    ->cookies->get($this->container->get("search.engine")->getGeoLocationCookieName()));
            }

            if ($this->userGeoLocation) {
                $this->script = new ScriptFile("searchDistance", $this->userGeoLocation);
            }

            $this->initialized = true;
        }

        if ($this->userGeoLocation) {
            $geoLocationUnit = $this->container->get("translator")->trans("distance.unit", [], "units");
            $query->setSort([
                '_geo_distance' => [
                    'geoLocation' => $this->userGeoLocation,
                    'order'       => 'asc',
                    'unit'        => $geoLocationUnit
                ]
            ]);
        }
    }
}
