<?php

namespace ArcaSolutions\WebBundle\Services;


use ArcaSolutions\ArticleBundle\Entity\Articlelevel;
use ArcaSolutions\BannersBundle\Entity\Bannerlevel;
use ArcaSolutions\ClassifiedBundle\Entity\ClassifiedLevel;
use ArcaSolutions\ClassifiedBundle\Entity\Internal\ClassifiedLevelFeatures;
use ArcaSolutions\CoreBundle\Exception\LevelInvalidException;
use ArcaSolutions\CoreBundle\Helper\ModuleHelper;
use ArcaSolutions\CoreBundle\Services\Modules;
use ArcaSolutions\CoreBundle\Services\Settings;
use ArcaSolutions\EventBundle\Entity\EventLevel;
use ArcaSolutions\EventBundle\Entity\Internal\EventLevelFeatures;
use ArcaSolutions\ListingBundle\Entity\Internal\ListingLevelFeatures;
use ArcaSolutions\ListingBundle\Entity\ListingLevel;
use Symfony\Bridge\Doctrine\RegistryInterface;

class AdvertiseHandler
{
    const NAMESPACE_LEVEL = "ArcaSolutions\\%sBundle\\Entity\\Internal\\%s";
    const REPOSITORY_LEVEL = "%sBundle:%sLevel";

    /**
     * @var array
     */
    private $reorder = [
        'Listing',
        'Event',
        'Classified',
    ];

    /**
     * @var array
     */
    private $nonFeatures = [
        'trial',
        'name',
        'level',
        'price',
        'price_yearly',
        'categoryPrice',
        'freeCategoryCount',
        'isActive',
        'isFeatured',
        'isPopular',
        'isDefault',
    ];

    /**
     * @var Modules
     */
    private $modules;

    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * @var ModuleHelper
     */
    private $moduleHelper;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * AdvertiseHandler constructor.
     *
     * @param RegistryInterface $doctrine
     * @param Modules $modules
     * @param ModuleHelper $moduleHelper
     */
    public function __construct(
        RegistryInterface $doctrine,
        Modules $modules,
        ModuleHelper $moduleHelper,
        Settings $settings
    ) {
        $this->doctrine = $doctrine;
        $this->modules = $modules;
        $this->moduleHelper = $moduleHelper;
        $this->settings = $settings;
    }

    public function getLevels($module)
    {
        $module = ucfirst($module);
        $levelFeatures = sprintf(self::NAMESPACE_LEVEL, $module.($module == 'Banner' ? 's' : ''),
            $module.'LevelFeatures');

        if (!class_exists($levelFeatures)) {
            throw new LevelInvalidException();
        }

        if ($module == 'Article' || $module == 'Listing') {
            $settings = [
                'review'      => $this->settings->getDomainSetting(sprintf('review_%s_enabled',
                    mb_strtolower($module))),
                'clicktocall' => $this->settings->getDomainSetting('twilio_enabled_call'),
            ];
            $levelFeatures = call_user_func([$levelFeatures, 'getAllLevelsAndNormalize'], $this->doctrine, $settings);
        } else {
            $levelFeatures = call_user_func([$levelFeatures, 'getAllLevelsAndNormalize'], $this->doctrine);
        }

        /* Reorder Plans */
        if (in_array($module, $this->reorder)) {
            $levelFeatures = $this->reorderPlans($levelFeatures, $module);
        }

        return $levelFeatures;
    }

    public function getNonFeatures()
    {
        return $this->nonFeatures;
    }

    private function reorderPlans($plans, $module)
    {
        krsort($plans);
        $totPlan = count($plans);
        $middle = (int)ceil($totPlan / 2);
        $return = [];

        $repLevel = sprintf(self::REPOSITORY_LEVEL, $module, $module);
        $lastLevel = $this->doctrine->getRepository($repLevel)->findLowerLevel();

        $i = 1;
        /* @var $plan ListingLevelFeatures|EventLevelFeatures|ClassifiedLevelFeatures */
        foreach ($plans as $plan) {
            /* Reserve the average position for the popular plan */
            $i == $middle and $i++;

            /* Checking if the plan is popular */
            if ($plan->isPopular) {
                $return[$middle] = $plan;
            } elseif ($plan->level == $lastLevel['value']) {
                $return[$totPlan] = $plan;
            } else {
                $return[$i] = $plan;
                $i++;
            }
        }

        /* Reorder of the result */
        ksort($return);

        return $return;
    }

    public function getPopularLevel($module)
    {
        /* @var $repository ListingLevel|Articlelevel|ClassifiedLevel|Bannerlevel|EventLevel */
        $repository = $this->moduleHelper->getModuleLevelRepositoryName($module);

        return $this->doctrine->getRepository($repository)->findOneBy(['active' => 'y', 'popular' => 'y']);
    }
}
