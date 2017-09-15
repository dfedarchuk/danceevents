<?php

namespace ArcaSolutions\CoreBundle\Interfaces;

interface EntityCategoryRepositoryInterface
{
    /**
     * Get parents categories
     *
     * It is used to return parents categories from an entity
     * This function must return an array and this function must returns items
     * with just these fields:
     *      title
     *      friendlyUrl as friendly_url
     *
     * @return Array
     * @throws \Exception
     */
    public function getParentCategories();
}
