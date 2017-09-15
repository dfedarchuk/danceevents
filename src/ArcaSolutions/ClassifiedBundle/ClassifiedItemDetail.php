<?php

namespace ArcaSolutions\ClassifiedBundle;

use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use ArcaSolutions\ClassifiedBundle\Entity\Internal\ClassifiedLevelFeatures;
use ArcaSolutions\CoreBundle\Interfaces\ItemDetailInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ClassifiedItemDetail
 *
 * @package ArcaSolutions\EventBundle
 */
final class ClassifiedItemDetail implements ItemDetailInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Classified
     */
    private $item = null;

    /**
     * @var ClassifiedLevelFeatures
     */
    private $level = null;

    /**
     * @param ContainerInterface $containerInterface
     * @param Classified $classified
     */
    public function __construct(ContainerInterface $containerInterface, Classified $classified)
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
        /* setting level */
        $this->level = ClassifiedLevelFeatures::normalizeLevel($this->item->getLevelObj(), $this->container->get("doctrine"));
    }

    /** {@inheritdoc} */
    public function getModuleName()
    {
        return 'classified';
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
