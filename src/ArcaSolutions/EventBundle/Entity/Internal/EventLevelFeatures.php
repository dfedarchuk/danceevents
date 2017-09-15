<?php

namespace ArcaSolutions\EventBundle\Entity\Internal;

use ArcaSolutions\EventBundle\Entity\EventLevel;
use Doctrine\Bundle\DoctrineBundle\Registry;

class EventLevelFeatures
{
    /**
     * @var boolean
     */
    public $hasDetail = false;
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
    public $hasVideo = false;
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
    public $hasContactName = false;
    /**
     * @var boolean
     */
    public $hasEventTime = false;
    /**
     * @var boolean
     */
    public $hasFacebookPage = false;
    /**
     * @var boolean
     */
    public $isActive = false;
    /**
     * @var boolean
     */
    public $isPopular = false;
    /**
     * @var boolean
     */
    public $isDefault = false;
    /**
     * @var boolean
     */
    public $isFeatured = false;
    /**
     * @var double
     */
    public $price = 0;
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
     * @var double
     */
    public $price_yearly = 0;
    /**
     * @var integer
     */
    public $trial = 0;

    /**
     * @param Registry $doctrine
     *
     * @return array
     */
    public static function getAllLevelsAndNormalize($doctrine)
    {
        $return = [];

        $levels = $doctrine->getRepository('EventBundle:EventLevel')->findBy(["active" => 'y']);

        foreach ($levels as $level) {
            $eventLevel = static::normalizeLevel($level, $doctrine);

            $return[$level->getValue()] = $eventLevel;
        }

        return $return;
    }

    public static function normalizeLevel(EventLevel $level, $doctrine)
    {
        $fields = $doctrine->getRepository('EventBundle:EventLevelField')->findBy([
            "level" => $level->getValue()
        ]);

        $eventLevel = new EventLevelFeatures();

        $eventLevel->name = (string)$level->getName();

        $eventLevel->isActive = $level->getActive() == "y";
        $eventLevel->isDefault = $level->getDefaultlevel() == "y";
        $eventLevel->isPopular = $level->getPopular() == "y";

        $eventLevel->level = (int)$level->getValue();
        $eventLevel->imageCount = (int)$level->getImages();

        $eventLevel->price = (double)$level->getPrice();
        $eventLevel->price_yearly = (double)$level->getPriceYearly();
        $eventLevel->trial = (int)$level->getTrial();

        /* Setting all the has */

        $eventLevel->hasDetail = $level->getDetail() == "y";
        $eventLevel->isFeatured = $level->getFeatured() == "y";

        foreach ($fields as $field) {
            switch ($field->getField()) {
                case "email" :
                    $eventLevel->hasEmail = true;
                    break;
                case "url" :
                    $eventLevel->hasURL = true;
                    break;
                case "phone" :
                    $eventLevel->hasPhone = true;
                    break;
                case "main_image" :
                    $eventLevel->imageCount++;
                    break;
                case "video" :
                    $eventLevel->hasVideo = true;
                    break;
                case "summary_description" :
                    $eventLevel->hasSummaryDescription = true;
                    break;
                case "long_description" :
                    $eventLevel->hasLongDescription = true;
                    break;
                case "contact_name" :
                    $eventLevel->hasContactName = true;
                    break;
                case "fbpage" :
                    $eventLevel->hasFacebookPage = true;
                    break;
                case "start_time" :
                    $eventLevel->hasEventTime = true;
                    break;
            }
        }

        return $eventLevel;
    }

}
