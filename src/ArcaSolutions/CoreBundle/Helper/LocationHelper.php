<?php

namespace ArcaSolutions\CoreBundle\Helper;

use Symfony\Component\DependencyInjection\Container;

class LocationHelper
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Return all location and your children
     *
     * @param array $levels
     * @param string $routing
     * @return array
     * @throws \Exception
     */
    public function getAllLocations(Array $levels, $routing)
    {
        if (!is_array($levels)) {
            throw new \Exception('You must pass a array');
        }

        $level = array_shift($levels);

        $lastLevel = $this->container->get("doctrine")->getRepository("WebBundle:SettingLocation")->findOneBy(
            [
                "enabled" => "y",
                "show"    => "n",
            ],
            [
                "id" => "DESC",
            ]
        );

        $parentLevel = $lastLevel ? $lastLevel->getId() : null;
        $parentId = $lastLevel ? $lastLevel->getDefaultId() : null;

        $locations = $this->getLocation($level, $levels, $parentLevel, $parentId, $routing);

        return $locations;
    }

    /**
     * @param int $level
     * @param array $levels
     * @param bool $parentField
     * @param bool $parent
     * @param string $routing
     * @return array
     */
    public function getLocation($level, array $levels, $parentField = false, $parent = false, $routing = false)
    {
        if ($level) {
            $repository = 'CoreBundle:Location'.$level;
            $levelLocation = $this->container->get('doctrine')
                ->getRepository($repository, 'main');

            if ($parentField and $parent) {
                $levelLocation = $levelLocation->findBy(['location'.$parentField => $parent], ['name' => 'ASC']);
            } else {
                $levelLocation = $levelLocation->findBy([], ['name' => 'ASC']);
            }

            $locations = [];
            $nextLevel = array_shift($levels);
            foreach ($levelLocation as $location) {
                $locations[] = [
                    'item'     => [
                        'id'          => $location->getId(),
                        'name'        => $location->getName(),
                        'friendlyUrl' => $this->container->get('utility')->generateSearchUrl(null, $routing,
                            null, $location->getFriendlyUrl()),
                    ],
                    'children' => !empty($nextLevel) && !empty($this->hasChildrenLocation($nextLevel, $level,
                        $location->getId())) ? true : false,
                    'level'    => $level,
                ];
            }
        } else {
            //only one location level enabled and with default value

            $levelObj = $this->container->get("doctrine")->getRepository("WebBundle:SettingLocation")->findOneBy(
                [
                    "enabled" => "y",
                ],
                [
                    "id" => "DESC",
                ]
            );

            $level = $levelObj ? $levelObj->getId() : null;
            $defaultId = $levelObj ? $levelObj->getDefaultId() : null;

            $repository = 'CoreBundle:Location'.$level;
            $levelLocation = $this->container->get('doctrine')
                ->getRepository($repository, 'main');

            $location = $levelLocation->find($defaultId);

            $locations[] = [
                'item'     => [
                    'id'          => $location->getId(),
                    'name'        => $location->getName(),
                    'friendlyUrl' => $this->container->get('utility')->generateSearchUrl(null, $routing,
                        null, $location->getFriendlyUrl()),
                ],
                'children' => false,
                'level'    => $level,
            ];

        }

        return $locations;
    }

    /**
     * @param int $level
     * @param bool $parentField
     * @param bool $parent
     * @return boolean
     */
    public function hasChildrenLocation($level, $parentField = false, $parent = false)
    {
        $repository = 'CoreBundle:Location'.$level;
        $levelLocation = $this->container->get('doctrine')
            ->getRepository($repository, 'main');

        if ($parentField and $parent) {
            $levelLocation = $levelLocation->findBy(['location'.$parentField => $parent], ['name' => 'ASC']);
        } else {
            $levelLocation = $levelLocation->findBy([], ['name' => 'ASC']);
        }

        return !empty($levelLocation);
    }

    /**
     * Returns the canonical name of this helper.
     *
     * @return string The canonical name
     *
     * @api
     */
    public function getName()
    {
        return 'LocationHelper';
    }
}
