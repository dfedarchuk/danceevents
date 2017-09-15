<?php

namespace ArcaSolutions\CoreBundle\Services;

use ArcaSolutions\ArticleBundle\Entity\Article;
use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\ListingBundle\Entity\Listing;
use ArcaSolutions\WebBundle\Entity\SettingLocation;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class LocationService
 *
 * @package ArcaSolutions\CoreBundle\Services
 */
class LocationService
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Returns country, region, state, city and neighborhood objects
     * Workaround to get item's location
     *
     * @param Listing|Article|Classified|Event $item
     *
     * @return array
     */
    public function getLocations($item)
    {
        $array = [
            'neighborhood' => null,
            'city'         => null,
            'state'        => null,
            'region'       => null,
            'country'      => null,
        ];

        $locations = $this->getLocationsEnabled();

        if (isset($locations[1]) && $locations[1]->getEnabled() == 'y' && $item->getLocation1()) {
            $array['country'] = $this->container->get('doctrine')->getRepository('CoreBundle:Location1', 'main')
                ->find($item->getLocation1());
            /* workaround to it works like in elastic search */
            if ($array['country']) {
                $array['country']->level = 1;
            }
        }

        if (isset($locations[2]) && $locations[2]->getEnabled() == 'y' && $item->getLocation2()) {
            $array['region'] = $this->container->get('doctrine')->getRepository('CoreBundle:Location2', 'main')
                ->find($item->getLocation2());
            /* workaround to it works like in elastic search */
            if ($array['region']) {
                $array['region']->level = 2;
            }
        }

        if (isset($locations[3]) && $locations[3]->getEnabled() == 'y' && $item->getLocation3()) {
            $array['state'] = $this->container->get('doctrine')->getRepository('CoreBundle:Location3', 'main')
                ->find($item->getLocation3());
            /* workaround to it works like in elastic search */
            if ($array['state']) {
                $array['state']->level = 3;
            }
        }

        if (isset($locations[4]) && $locations[4]->getEnabled() == 'y' && $item->getLocation4()) {
            $array['city'] = $this->container->get('doctrine')->getRepository('CoreBundle:Location4', 'main')
                ->find($item->getLocation4());
            /* workaround to it works like in elastic search */
            if ($array['city']) {
                $array['city']->level = 4;
            }
        }

        if (isset($locations[5]) && $locations[5]->getEnabled() == 'y' && $item->getLocation5()) {
            $array['neighborhood'] = $this->container->get('doctrine')->getRepository('CoreBundle:Location5', 'main')
                ->find($item->getLocation5());
            /* workaround to it works like in elastic search */
            if ($array['neighborhood']) {
                $array['neighborhood']->level = 5;
            }
        }

        return $array;
    }

    /**
     * Returns enabled locations
     *
     * @param bool $showDefault
     * @return \ArcaSolutions\WebBundle\Entity\SettingLocation[]
     */
    public function getLocationsEnabled($showDefault = false)
    {
        $items = $this->container->get('doctrine')->getRepository('WebBundle:SettingLocation')->findBy(['enabled' => 'y']);

        $array = [];
        foreach ($items as $item) {
            /* Condition to check of locations level when it is activated, with defaul location and marked to show defaul value.

                If location is activated and don't marked the default value, show location
                If location is activated and marked the default value, but don't marked show default value, dont show location
                If location is activated, marked default value and marked the show default value, show location
             */
            if (!$showDefault or ($showDefault and (($item->getDefaultId() and $item->getShow() == 'y') or !$item->getDefaultId()))) {
                $array[$item->getId()] = $item;
            }
        }

        return $array;
    }

    /**
     * Returns children locations
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getChildrenLocations($request)
    {
        $id = $request->request->get('id');
        $level= $request->request->get('level');
        $routing= $request->request->get('routing');

        $locations_enable = $this->container->get('doctrine')->getRepository('WebBundle:SettingLocation')->getLocationsEnabledID(true, $level);

        $nextLevel = array_shift($locations_enable);

        $locations = [];
        if ($nextLevel)
            $locations = $this->container->get('helper.location')->getLocation($nextLevel, $locations_enable, $level, $id, $routing);

        return new JsonResponse($locations);
    }


}
