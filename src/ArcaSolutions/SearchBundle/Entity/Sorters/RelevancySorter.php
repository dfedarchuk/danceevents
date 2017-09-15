<?php

namespace ArcaSolutions\SearchBundle\Entity\Sorters;

use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use Elastica\Query;
use Elastica\Script\ScriptFile;

class RelevancySorter extends BaseSorter
{
    protected static $name = "relevancy";

    public static function getSubscribedEvents()
    {
        return [
            'search.global' => 'register',
        ];
    }

    public function sort(Query $query)
    {
        $parameterHandler = $this->container->get("search.parameters");

        if ($parameterHandler->hasKeywords() || ($parameterHandler->hasWheres() && !$this->container->get("nearby.handler")->isNearbyEnabled())) {
            $query->setParam("track_scores", true);
            $query->setSort([
                '_score' => ['order' => 'desc'],
                'level'  => [
                    'order'         => 'asc',
                    "unmapped_type" => "integer",
                ],
            ]);
        } elseif (($parameterHandler->hasLocations() && $geoDistance = $this->container->get("nearby.handler")->getGeoDistanceInfoByLocation()) ||
            ($parameterHandler->hasWheres() && $geoDistance = $this->container->get("nearby.handler")->getGeoDistanceInfoByWhere())
        ) {
            $geoLocationUnit = $this->container->get("translator")->trans("distance.unit", [], "units");

            $this->script = new ScriptFile("searchDistance", [
                'lat' => $geoDistance['latitude'],
                'lon' => $geoDistance['longitude'],
            ]);

            $query->setParam("track_scores", false);
            $query->setSort([
                '_geo_distance' => [
                    'geoLocation' => [
                        'lat' => $geoDistance['latitude'],
                        'lon' => $geoDistance['longitude'],
                    ],
                    'order'       => 'asc',
                    'unit'        => $geoLocationUnit,
                ],
            ]);
        } elseif ($modules = $parameterHandler->getModules() and count($modules) == 1) {
            $query->setParam("track_scores", false);
            switch (array_pop($modules)) {
                case ParameterHandler::MODULE_ARTICLE:
                    $query->setSort([
                        'level'           => [
                            'order'         => 'asc',
                            "unmapped_type" => "integer",
                        ],
                        'publicationDate' => [
                            'order'   => 'desc',
                            'missing' => 100,
                        ],
                    ]);
                    break;
                case ParameterHandler::MODULE_BLOG:
                    $query->setSort([
                        'publicationDate' => [
                            'order'   => 'desc',
                            'missing' => 100,
                        ],
                    ]);
                    break;
                case ParameterHandler::MODULE_CLASSIFIED:
                    $query->setSort([
                        'level' => [
                            'order'         => 'asc',
                            "unmapped_type" => "integer",
                        ],
                    ]);
                    break;
                case ParameterHandler::MODULE_DEAL:
                    $query->setSort([
                        'date.end' => [
                            'order'   => 'asc',
                            'missing' => 100,
                        ],
                    ]);
                    break;
                case ParameterHandler::MODULE_EVENT:
                    $query->setSort([
                        'level'    => [
                            'order' => 'asc',
                        ],
                        'date.end' => [
                            'order'   => 'asc',
                            'missing' => 100,
                        ],
//                        'recurring.until' => [
//                            'order' => 'asc',
//                            'missing' => 100
//                        ],
                    ]);
                    break;
                case ParameterHandler::MODULE_LISTING:
                    $query->setSort([
                        'level'  => [
                            'order' => 'asc',
                        ],
                        '_score' => [
                            'order' => 'desc',
                        ],
                        '_score' => [
                            'order' => 'desc',
                        ],
                    ]);
                    break;
            }
        } else {
            $query->setParam("track_scores", false);
            $query->setSort([
                'level'  => [
                    'order'         => 'asc',
                    "unmapped_type" => "integer",
                ],
                '_score' => [
                    'order' => 'desc',
                ],
            ]);
        }
    }
}
