<?php

namespace ArcaSolutions\ArticleBundle\Entity\Internal;

use ArcaSolutions\ArticleBundle\Entity\Articlelevel;
use ArcaSolutions\CoreBundle\Services\Settings;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ArticleLevelFeatures
{
    /**
     * @var boolean
     */
    public $isFeatured = false;
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
    public $hasDetail = false;
    /**
     * @var boolean
     */
    public $hasReview = false;
    /**
     * @var boolean
     */
    public $hasPublicationDate = true;
    /**
     * @var boolean
     */
    public $hasAuthor = true;
    /**
     * @var boolean
     */
    public $hasAbstract = true;
    /**
     * @var int
     */
    public $imageCount = 0;
    /**
     * @var double
     */
    public $price = 0;
    /**
     * @var int
     */
    public $level = 0;
    /**
     * @var string
     */
    public $name = null;
    /**
     * @var string
     */
    public $content = true;
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

        $levels = $doctrine->getRepository('ArticleBundle:Articlelevel')->findBy(["active" => 'y']);

        foreach ($levels as $level) {
            $articleLevel = static::normalizeLevel($level, $settings);

            $return[$level->getValue()] = $articleLevel;
        }

        return $return;
    }

    /**
     * @param Articlelevel $level
     * @param array $settings
     * @return ArticleLevelFeatures
     */
    public static function normalizeLevel(Articlelevel $level, array $settings = [])
    {
        $articleLevel = new ArticleLevelFeatures();

        $articleLevel->name = (string)$level->getName();

        $articleLevel->isActive = $level->getActive() == "y";

        $articleLevel->level = (int)$level->getValue();
        $articleLevel->imageCount = (int)$level->getImages();

        $articleLevel->price = (double)$level->getPrice();
        $articleLevel->price_yearly = (double)$level->getPriceYearly();
        $articleLevel->trial = (int)$level->getTrial();

        $articleLevel->isDefault = $level->getDefaultlevel() == 'y';
        $articleLevel->isFeatured = $level->getFeatured() == 'y';

        /* Setting all the has */
        //$articleLevel->hasCheezburger = true;

        /* Setting review if it is enabled */
        if (isset($settings['review'])) {
            $articleLevel->hasReview = $settings['review'] == 'on';
        }

        $articleLevel->hasDetail = $level->getDetail() == "y";

        return $articleLevel;
    }
}
