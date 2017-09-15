<?php

namespace ArcaSolutions\ListingBundle\Entity\Internal;

use ArcaSolutions\ListingBundle\Entity\ListingLevel;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ListingLevelFeatures
{
    /**
     * @var boolean
     */
    public $hasDetail = false;
    /**
     * @var boolean
     */
    public $hasReview = false;
    /**
     * @var boolean
     */
    public $hasEmail = false;
    /**
     * @var boolean
     */
    public $hasURL = false;
    /**
     * @var boolean
     */
    public $hasPhone = false;
    /**
     * @var boolean
     */
    public $hasFax = false;
    /**
     * @var boolean
     */
    public $hasVideo = false;
    /**
     * @var boolean
     */
    public $hasAdditionalFiles = false;
    /**
     * @var boolean
     */
    public $hasSummaryDescription = false;
    /**
     * @var boolean
     */
    public $hasLongDescription = false;
    /**
     * @var boolean
     */
    public $hasHoursOfWork = false;
    /**
     * @var boolean
     */
    public $hasLocationReference = false;
    /**
     * @var boolean
     */
    public $hasBadges = false;
    /**
     * @var boolean
     */
    public $hasSocialNetworking = false;
    /**
     * @var boolean
     */
    public $hasFeatureInformation = false;
    /**
     * @var boolean
     */
    public $hasClickToCall = false;
    /**
     * @var boolean
     */
    public $isActive = false;
    /**
     * @var boolean
     */
    public $isFeatured = false;
    /**
     * @var boolean
     */
    public $isPopular = false;
    /**
     * @var boolean
     */
    public $isDefault = false;
    /**
     * @var double
     */
    public $categoryPrice = 0;
    /**
     * @var double
     */
    public $price = 0;
    /**
     * @var int
     */
    public $freeCategoryCount = 0;
    /**
     * @var int
     */
    public $imageCount = 0;
    /**
     * @var int
     */
    public $level = 0;
    /**
     * @var string
     */
    public $name = null;
    /**
     * @var int
     */
    public $dealCount = 0;
    /**
     * @var int
     */
    public $classifiedQuantityAssociation = 0;
    /**
     * @var double
     */
    public $price_yearly = 0;
    /**
     * @var integer
     */
    public $trial = 0;

    /**
     * @param Registry $doctrine
     * @param array $settings
     * @return array
     */
    public static function getAllLevelsAndNormalize($doctrine, array $settings = [])
    {
        $return = [];

        $levels = $doctrine->getRepository('ListingBundle:ListingLevel')->findBy(["active" => 'y']);

        /* @var $level ListingLevel */
        foreach ($levels as $level) {
            $listingLevel = static::normalizeLevel($level, $doctrine, $settings);

            $return[$level->getValue()] = $listingLevel;
        }

        return $return;
    }

    /**
     * @param ListingLevel $level
     * @param $doctrine
     * @param array $settings
     * @return ListingLevelFeatures
     */
    public static function normalizeLevel(ListingLevel $level, $doctrine, array $settings = [])
    {
        $fields = $doctrine->getRepository('ListingBundle:ListingLevelField')->findBy([
            "level" => $level->getValue()
        ]);

        $listingLevel = new ListingLevelFeatures();

        $listingLevel->name = (string)$level->getName();

        $listingLevel->isActive = $level->getActive() == "y";
        $listingLevel->isDefault = $level->getDefaultlevel() == "y";
        $listingLevel->isPopular = $level->getPopular() == "y";

        $listingLevel->level = (int)$level->getValue();
        $listingLevel->imageCount = (int)$level->getImages();
        $listingLevel->dealCount = (int)$level->getDeals();
        $listingLevel->freeCategoryCount = (int)$level->getFreeCategory();

        $listingLevel->categoryPrice = (double)$level->getCategoryPrice();
        $listingLevel->price = (double)$level->getPrice();
        $listingLevel->price_yearly = (double)$level->getPriceYearly();
        $listingLevel->trial = (int)$level->getTrial();

        /* Setting all the has */
        //$listingLevel->hasCheezburger = true;

        $listingLevel->hasDetail = $level->getDetail() == "y";
        $listingLevel->hasClickToCall = $level->getHasCall() == "y";
        $listingLevel->hasReview = $level->getHasReview() == "y";

        /* Setting review if it is enabled */
        if (isset($settings['review']) && $settings['review'] != 'on') {
            unset($listingLevel->hasReview);
        }

        /* Settings clicktocall if it is enabled */
        if (isset($settings['clicktocall']) && $settings['clicktocall'] != 'on') {
            unset($listingLevel->hasClickToCall);
        }

        $listingLevel->isFeatured = $level->getFeatured() == "y";
        $listingLevel->classifiedQuantityAssociation = $level->getClassifiedQuantityAssociation();

        foreach ($fields as $field) {
            switch ($field->getField()) {
                case "email" :
                    $listingLevel->hasEmail = true;
                    break;
                case "url" :
                    $listingLevel->hasURL = true;
                    break;
                case "phone" :
                    $listingLevel->hasPhone = true;
                    break;
                case "fax" :
                    $listingLevel->hasFax = true;
                    break;
                case "main_image" :
                    $listingLevel->imageCount++;
                    break;
                case "video" :
                    $listingLevel->hasVideo = true;
                    break;
                case "attachment_file" :
                    $listingLevel->hasAdditionalFiles = true;
                    break;
                case "summary_description" :
                    $listingLevel->hasSummaryDescription = true;
                    break;
                case "long_description" :
                    $listingLevel->hasLongDescription = true;
                    break;
                case "hours_of_work" :
                    $listingLevel->hasHoursOfWork = true;
                    break;
                case "locations" :
                    $listingLevel->hasLocationReference = true;
                    break;
                case "badges" :
                    $listingLevel->hasBadges = true;
                    break;
                case "social_network" :
                    $listingLevel->hasSocialNetworking = true;
                    break;
                case "features" :
                    $listingLevel->hasFeatureInformation = true;
                    break;
            }
        }

        return $listingLevel;
    }

}
