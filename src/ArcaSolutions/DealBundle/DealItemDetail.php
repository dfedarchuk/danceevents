<?php

namespace ArcaSolutions\DealBundle;

use ArcaSolutions\CoreBundle\Interfaces\ItemDetailInterface;
use ArcaSolutions\DealBundle\Entity\Promotion;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DealItemDetail
 *
 * @package ArcaSolutions\EventBundle
 */
final class DealItemDetail implements ItemDetailInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Promotion
     */
    private $item = null;

    /**
     * Doesn't have it
     */
    private $level = null;

    /**
     * @param ContainerInterface $containerInterface
     * @param Promotion         $deal
     */
    public function __construct(ContainerInterface $containerInterface, Promotion $deal)
    {
        $this->container = $containerInterface;
        $this->item = $deal;

        /* sets item's level */
        $this->setLevel();
    }

    /**
     * Sets item's level
     */
    private function setLevel(){}

    /** {@inheritdoc} */
    public function getModuleName()
    {
        return 'deal';
    }

    /** {@inheritdoc} */
    public function getLevel()
    {
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
