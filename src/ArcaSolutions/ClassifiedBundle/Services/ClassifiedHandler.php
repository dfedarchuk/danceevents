<?php

namespace ArcaSolutions\ClassifiedBundle\Services;


use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use ArcaSolutions\CoreBundle\Services\Settings;
use ArcaSolutions\ListingBundle\Entity\Internal\ListingLevelFeatures;
use ArcaSolutions\ListingBundle\Entity\Listing;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ClassifiedHandler
 *
 * @version 1.0.0
 * @author Diego Mosela <diego.mosela@arcasolutions.com>
 * @package ArcaSolutions\ClassifiedBundle\Services
 * @copyright 2003-2016 ArcaSolutions Inc.
 * @since Class available since Release 11.1.04
 */
class ClassifiedHandler
{
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * ClassifiedHandler constructor.
     *
     * @access public
     * @author Diego Mosela <diego.mosela@arcasolutions.com>
     * @version 1.0.0
     *
     * @param RegistryInterface $doctrine
     * @param Settings $settings
     */
    public function __construct(RegistryInterface $doctrine, Settings $settings)
    {
        $this->doctrine = $doctrine;
        $this->settings = $settings;
    }

    /**
     * Function isValid
     *
     * Validates if the classified is valid and if listing level has a classified
     *
     * Here is an example
     * <code>
     * $classifiedHandler = $this->get('classified.handler');
     * if ($classifiedHandler->isValid($classified) {
     *     // Classified is valid
     * }
     * </code>
     *
     * @access public
     * @author Diego Mosela <diego.mosela@arcasolutions.com>
     * @version 1.0.0
     *
     * @param Classified $classified The classified entity
     *
     * @return bool
     */
    public function isValid(Classified $classified)
    {
        $return = false;
        $valid = 0;
        if ($listing = $classified->getListing()) {
            /** @var Listing $listing */
            $listingLevel = ListingLevelFeatures::normalizeLevel($listing->getLevelObj(), $this->doctrine);
            $moduleAvailable = $this->settings->getDomainSetting('custom_classified_feature');

            $classified->getStatus() == 'A' and $valid += 1;
            $listing->getStatus() == 'A' and $valid += 2;
            $listingLevel->classifiedQuantityAssociation > 0 and $valid += 3;
            $moduleAvailable === 'on' and $valid += 4;

            if ($valid == 10) {
                $return = true;
            }
        }

        return $return;
    }
}
