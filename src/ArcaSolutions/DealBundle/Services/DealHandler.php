<?php

namespace ArcaSolutions\DealBundle\Services;


use ArcaSolutions\CoreBundle\Services\Settings;
use ArcaSolutions\DealBundle\Entity\Promotion;
use ArcaSolutions\ListingBundle\Entity\Internal\ListingLevelFeatures;
use ArcaSolutions\ListingBundle\Entity\Listing;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class DealHandler
 *
 * @version 1.0.0
 * @author Diego Mosela <diego.mosela@arcasolutions.com>
 * @package ArcaSolutions\DealBundle\Services
 * @copyright 2003-2016 ArcaSolutions Inc.
 * @since Class available since Release 11.1.0
 */
class DealHandler
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
     * DealHandler constructor.
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
     * Validates if the deal is valid and if listing level has a deal
     *
     * Here is an example
     * <code>
     * $dealHandler = $this->get('deal.handler');
     * if ($dealHandler->isValid($deal) {
     *     // Deal is valid
     * }
     * </code>
     *
     * @access public
     * @author Diego Mosela <diego.mosela@arcasolutions.com>
     * @version 1.0.0
     *
     * @param Promotion $deal the Promotion entity
     *
     * @return bool
     */
    public function isValid(Promotion $deal)
    {
        $valid = 0;
        if ($listing = $deal->getListing()) {
            /** @var Listing $listing */
            $listingLevel = ListingLevelFeatures::normalizeLevel($listing->getLevelObj(), $this->doctrine);
            $moduleAvailable = $this->settings->getDomainSetting('custom_promotion_feature');

            $now = new \DateTime(date('Y-m-d'));
            $deal->getStartDate() <= $now and $valid += 1;
            $deal->getEndDate() >= $now and $valid += 2;
            $listingLevel->dealCount > 0 and $valid += 3;
            $moduleAvailable === 'on' and $valid += 4;
        }

        return $valid == 10;
    }
}
