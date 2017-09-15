<?php

namespace ArcaSolutions\CoreBundle\Interfaces;

interface EntityLocationRepositoryInterface
{
    /**
     * Get featured locations
     *
     * It is used to return locations categories from an entity
     * This function must return an array and this function must returns items
     * with just these fields:
     *      title
     *      fullFriendlyUrl as friendly_url
     *
     * @param null $location_level
     *
     * @return array
     * @throws \Exception
     */
    public function getFeaturedLocationsByLevel($location_level);
}
