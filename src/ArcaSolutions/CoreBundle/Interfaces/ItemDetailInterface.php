<?php

namespace ArcaSolutions\CoreBundle\Interfaces;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Normalizes items of modules to abstract some validations and information
 *
 * Interface ItemDetailInterface
 *
 * @package ArcaSolutions\CoreBundle
 */
interface ItemDetailInterface
{
    /**
     * Returns item's module's name
     *
     * @return string
     */
    public function getModuleName();

    /**
     * Returns the object of level features
     *
     * @return object
     */
    public function getLevel();

    /**
     * Returns the item
     *
     * @return object
     */
    public function getItem();

    /**
     * Returns container object to give access on services
     *
     * @return ContainerInterface
     */
    public function getContainer();
}
