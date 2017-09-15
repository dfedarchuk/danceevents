<?php

namespace ArcaSolutions\ListingBundle;

use ArcaSolutions\CoreBundle\Interfaces\ItemDetailInterface;
use ArcaSolutions\ListingBundle\Entity\Internal\ListingLevelFeatures;
use ArcaSolutions\ListingBundle\Entity\Listing;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ListingItemDetail
 *
 * @package ArcaSolutions\ListingBundle
 */
final class ListingItemDetail implements ItemDetailInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Listing
     */
    private $item = null;

    /**
     * @var ListingLevelFeatures
     */
    private $level = null;

    /**
     * @param ContainerInterface $containerInterface
     * @param Listing            $listing
     */
    public function __construct(ContainerInterface $containerInterface, Listing $listing)
    {
        $this->container = $containerInterface;
        $this->item = $listing;

        /* sets item's level */
        $this->setLevel();
    }

    /**
     * Sets item's level
     */
    private function setLevel()
    {
        /* gets levels */
        $this->level = ListingLevelFeatures::normalizeLevel(
            $this->getItem()->getLevelObj(),
            $this->container->get("doctrine")
        );
    }

    /** {@inheritdoc} */
    public function getModuleName()
    {
        return 'listing';
    }

    /** {@inheritdoc} */
    public function getLevel()
    {
        /* checks if item was seated */
        if (is_null($this->item)) {
            throw new \Exception('You must set the item');
        }

        return $this->level;
    }

    /** {@inheritdoc} */
    public function getItem()
    {
        /* checks if item was seated */
        if (is_null($this->item)) {
            throw new \Exception('You must set the item');
        }

        return $this->item;
    }

    /**
     * Returns container object to give access on services
     *
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }
}
