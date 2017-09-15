<?php

namespace ArcaSolutions\BannersBundle\Entity\Internal;

use ArcaSolutions\BannersBundle\Entity\Bannerlevel;
use Doctrine\Bundle\DoctrineBundle\Registry;

class BannerLevelFeatures
{
    /**
     * @var boolean
     */
    public $isActive = false;
    /**
     * @var boolean
     */
    public $isDefault = false;
    /**
     * @var boolean
     */
    public $isPopular = false;
    /**
     * @var double
     */
    public $price = 0;
    /**
     * @var double
     */
    public $price_yearly = 0;
    /**
     * @var int
     */
    public $block_impressions = 0;
    /**
     * @var double
     */
    public $block_price = 0;
    /**
     * @var int
     */
    public $level = 0;
    /**
     * @var string
     */
    public $name = null;
    /**
     * @var integer
     */
    public $width = 0;
    /**
     * @var integer
     */
    public $height = 0;
    /**
     * @var integer
     */
    public $trial = 0;

    /**
     * @param Registry $doctrine
     * @return array
     */
    public static function getAllLevelsAndNormalize($doctrine)
    {
        $return = [];

        $levels = $doctrine->getRepository('BannersBundle:Bannerlevel')->findBy(["active" => 'y']);

        foreach ($levels as $level) {
            $bannerLevel = static::normalizeLevel($level);

            $return[$level->getValue()] = $bannerLevel;
        }

        return $return;
    }

    /**
     * Normalize levels
     *
     * @param Bannerlevel $level
     * @return BannerLevelFeatures
     */
    public static function normalizeLevel(Bannerlevel $level)
    {
        $bannerLevel = new BannerLevelFeatures();

        $bannerLevel->name = (string)$level->getName();

        $bannerLevel->isActive = $level->getActive() == "y";
        $bannerLevel->isDefault = $level->getDefaultlevel() == 'y';
        $bannerLevel->isPopular = $level->getPopular() == 'y';

        $bannerLevel->width = (int)$level->getWidth();
        $bannerLevel->height = (int)$level->getHeight();

        $bannerLevel->level = (int)$level->getValue();

        $bannerLevel->price = (double)$level->getPrice();
        $bannerLevel->price_yearly = (double)$level->getPriceYearly();
        $bannerLevel->trial = (int)$level->getTrial();

        $bannerLevel->block_impressions = $level->getImpressionBlock();
        $bannerLevel->block_price = (double)$level->getImpressionPrice();

        return $bannerLevel;
    }
}
