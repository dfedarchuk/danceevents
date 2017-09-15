<?php

namespace ArcaSolutions\BlogBundle;

use ArcaSolutions\BlogBundle\Entity\Post;
use ArcaSolutions\CoreBundle\Interfaces\ItemDetailInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DealItemDetail
 *
 * @package ArcaSolutions\EventBundle
 */
final class BlogItemDetail implements ItemDetailInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Post
     */
    private $item = null;

    /**
     * Doesn't have it
     */
    private $level = null;

    /**
     * @param ContainerInterface $containerInterface
     * @param Post               $classified
     */
    public function __construct(ContainerInterface $containerInterface, Post $classified)
    {
        $this->container = $containerInterface;
        $this->item = $classified;

        /* sets item's level */
        $this->setLevel();
    }

    /**
     * Sets item's level
     */
    private function setLevel()
    {
    }

    /** {@inheritdoc} */
    public function getModuleName()
    {
        return 'blog';
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
