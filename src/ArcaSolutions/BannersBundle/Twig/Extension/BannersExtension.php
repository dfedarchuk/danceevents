<?php

namespace ArcaSolutions\BannersBundle\Twig\Extension;

use ArcaSolutions\BannersBundle\Entity\Banner;
use ArcaSolutions\BannersBundle\Entity\Helpers\BannerType;
use ArcaSolutions\BannersBundle\Repository\BannerRepository;
use ArcaSolutions\CoreBundle\Services\Settings;
use ArcaSolutions\DealBundle\Search\DealConfiguration;
use ArcaSolutions\ImageBundle\Entity\Image;
use ArcaSolutions\ListingBundle\Search\ListingConfiguration;
use ArcaSolutions\ReportsBundle\Services\ReportHandler;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class BannersExtension
 *
 * Class with the functions used to call banners in twig file
 *
 * @package ArcaSolutions\BannersBundle\Twig\Extension
 */
class BannersExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * BannersExtension constructor.
     *
     * @param ContainerInterface $container
     * @param Settings $settings
     */
    public function __construct(ContainerInterface $container, Settings $settings)
    {
        $this->container = $container;
        $this->settings = $settings;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'bannerLeaderboard',
                [$this, 'renderLeaderboard'],
                ['is_safe' => ['all'], 'needs_environment' => true]
            ),
            new \Twig_SimpleFunction(
                'bannerLargeMobile',
                [$this, 'renderLargeMobile'],
                ['is_safe' => ['all'], 'needs_environment' => true]
            ),
            new \Twig_SimpleFunction(
                'bannerSquare',
                [$this, 'renderSquare'],
                ['is_safe' => ['all'], 'needs_environment' => true]
            ),
            new \Twig_SimpleFunction(
                'bannerWideSkyscraper',
                [$this, 'renderWideSkyscraper'],
                ['is_safe' => ['all'], 'needs_environment' => true]
            ),
            new \Twig_SimpleFunction(
                'bannerSponsoredLinks',
                [$this, 'renderSponsoredLinks'],
                ['is_safe' => ['all'], 'needs_environment' => true]
            ),
            new \Twig_SimpleFunction(
                'bannerGoogle',
                [$this, 'renderGoogle'],
                ['is_safe' => ['all'], 'needs_environment' => true]
            ),
            new \Twig_SimpleFunction(
                'bannerAnchor',
                [$this, 'anchor'],
                ['is_safe' => ['all']]
            ),
        ];
    }

    /**
     * Retrieves a Leaderboard Banner instance
     *
     * @param \Twig_Environment $env
     * @param array $classes
     * @param string[] $module
     * @param int[] $category
     * @return string
     */
    public function renderLeaderboard(\Twig_Environment $env, $classes = [], $module = [], $category = [])
    {
        return $this->renderImageBanner($env, BannerType::LEADERBOARD, $classes, $module, $category,
            "::blocks/banners/imagebanner-leaderboard.html.twig");
    }

    /**
     * Retrieves a large mobile Banner instance
     *
     * @param array $classes
     * @param string[] $module
     * @param int[] $category
     * @param \Twig_Environment $env
     * @return string
     */
    public function renderLargeMobile(\Twig_Environment $env, $classes = [], $module = [], $category = [])
    {
        return $this->renderImageBanner($env, BannerType::LARGE_MOBILE, $classes, $module, $category,
            "::blocks/banners/imagebanner-large.html.twig");
    }

    /**
     * Retrieves a square Banner instance
     *
     * @param array $classes
     * @param string[] $module
     * @param int[] $category
     * @param \Twig_Environment $env
     * @return string
     */
    public function renderSquare(\Twig_Environment $env, $classes = [], $module = [], $category = [])
    {
        return $this->renderImageBanner($env, BannerType::SQUARE, $classes, $module, $category,
            "::blocks/banners/imagebanner-square.html.twig");
    }

    /**
     * Retrieves a wide skyscraper Banner instance
     *
     * @param array $classes
     * @param string[] $module
     * @param int[] $category
     * @param \Twig_Environment $env
     * @return string
     */
    public function renderWideSkyscraper(\Twig_Environment $env, $classes = [], $module = [], $category = [])
    {
        return $this->renderImageBanner($env, BannerType::WIDE_SKYSCRAPER, $classes, $module, $category,
            "::blocks/banners/imagebanner-wide.html.twig");
    }

    /**
     * Retrieves a sponsored links Banner instance
     *
     * @param array $classes
     * @param string[] $module
     * @param int[] $category
     * @param \Twig_Environment $env
     * @return string
     */
    public function renderSponsoredLinks(\Twig_Environment $env, $classes = [], $module = [], $category = [])
    {
        if (!$this->container->get('modules')->isModuleAvailable('banner')) {
            return '';
        }

        $return = null;

        if ($banner = $this->fetch(BannerType::SPONSORED_LINKS, $module, $category)) {
            $url = $this->anchor($banner);
            $displayUrl = trim($banner->getDisplayUrl()) or $displayUrl = trim($banner->getDestinationUrl());

            $return = $env->render(
                "::blocks/banners/sponsoredlink.html.twig",
                [
                    "banner"     => $banner,
                    "classes"    => $classes,
                    "url"        => $url,
                    "displayUrl" => $displayUrl,
                ]
            );
        }

        return $return;
    }

    /**
     * Renders an image banner, taking into account its type, module and categories, as well as css classes and a custom twig template.
     *
     * @param \Twig_Environment $env
     * @param int $type This is the BannerType constant which matches the desired banner type (Leaderboard, square, etc..)
     * @param array $classes These are the css classes which will be applied to the banner container div
     * @param array $module These are the modules whose banners shall be randomly picked from
     * @param array $category These are the categories whose banners shall be randomly picked from
     * @param string $template This is a path to a twig template which will render this specific banner
     * @return null|string
     */
    public function renderImageBanner(
        \Twig_Environment $env,
        $type,
        $classes = [],
        $module = [],
        $category = [],
        $template = "::blocks/banners/imagebanner.html.twig"
    ) {
        if (!$this->container->get('modules')->isModuleAvailable('banner')) {
            return '';
        }

        $return = null;

        try {
            if ($banner = $this->fetch($type, $module, $category)) {
                $context = [
                    "banner"  => $banner,
                    "classes" => $classes,
                ];

                if ($banner->getShowType() == BannerType::SHOWTYPE_IMAGE) {
                    $context["url"] = $this->anchor($banner);

                    if ($banner->getImageId() and $image = $banner->getImage()) {
                        /* @var Image $image */
                        $context['image_type'] = $image->getType();
                        $context["image"] = $this->container->get("imagehandler")->getPath($image);
                    } else {
                        throw new \Exception("No image found for IMAGE banner of id {$banner->getId()}");
                    }

                    $context["target"] = $banner->getTargetWindow() == BannerType::TARGET_NEW ? 'target="_blank"' : "";
                }

                $return = $env->render(
                    $template,
                    $context
                );
            }
        } catch (\Exception $e) {
            $this->container->get("logger")->critical("Couldn't get banner.", ["Exception" => $e->getMessage()]);
        }

        return $return;
    }

    /**
     * Renders the necessary script and code to print a google ads banner
     *
     * @param \Twig_Environment $env
     * @param array $classes These are the classes which will be applied to the banner-containing div
     * @return string
     */
    public function renderGoogle(\Twig_Environment $env, $classes = [])
    {
        if (!$this->container->get('modules')->isModuleAvailable('banner') or
            strtolower($this->container->get('settings')->getSettingGoogle('ad_status')) == 'off'
        ) {
            return '';
        }

        return $env->render(
            "::blocks/banners/adwords.html.twig",
            [
                'client'  => $this->settings->getSettingGoogle('ad_client'),
                'type'    => $this->settings->getSettingGoogle('ad_type'),
                'channel' => $this->settings->getSettingGoogle('ad_channel'),
                // These constants are in a config.yml file inside the bundle
                'width'   => $this->container->getParameter('google.ad.width'),
                'height'  => $this->container->getParameter('google.ad.height'),
                'classes' => $classes,
            ]
        );
    }

    /**
     * Fetches a banner according to its $type, $modules and $categories.
     *
     * @param string $type A integer defined by constants on the BannerType class
     * @param string[] $modules An array of modules whose banners shall be randomly picked from
     * @param int[] $categories An array of categories whose banners shall be randomly picked from
     * @return Banner|null
     */
    public function fetch($type, $modules = [], $categories = [])
    {
        $return = null;

        is_array($modules) or $modules = (array)$modules;
        is_array($categories) or $categories = (array)$categories;

        if ($type
            and $doctrine = $this->container->get('doctrine')
            and $manager = $doctrine->getManager()
            and $levelRepository = $manager->getRepository('BannersBundle:Bannerlevel')
            and $level = $levelRepository->getLevelActive($type)
        ) {
            $parameterHandler = $this->container->get("search.parameters");

            $categorizedSections = [];

            if ($modules or $modules = $parameterHandler->getModules()) {
                $categorizedSections = array_fill_keys($modules, null);
            }

            if ($categories or $categories = $parameterHandler->getCategories()) {

                /* @var $category Category */
                while ($category = array_pop($categories)) {
                    $module = $category->getModule();
                    $categoryId = preg_replace("/[^\d]/", "", $category->getId());

                    $categorizedSections[$module][] = $categoryId;

                    if ($module == ListingConfiguration::$elasticType) {
                        $categorizedSections[DealConfiguration::$elasticType][] = $categoryId;
                    }
                }
            }

            /* @var $repository BannerRepository */
            $repository = $doctrine->getRepository('BannersBundle:Banner');

            /* @var $banner Banner */
            if ($banner = $repository->getBanner($level, $categorizedSections)) {

                if (!$this->container->get("utility")->isRobotUser()) {
                    if ($banner->getExpirationSetting() == BannerType::EXPIRATION_BY_IMPRESSION) {
                        try {
                            $banner->setImpressions(max([($banner->getImpressions() - 1), 0]));
                            $this->container->get('doctrine.orm.domain_entity_manager')->flush($banner);
                        } catch (OptimisticLockException $e) {
                            $this->container->get('logger')->error("Subtracting impressions to the banner [{$banner->getId()}]");
                        }
                    }
                }

                $this->container->get('reporthandler')->addBannerReport($banner->getId(), ReportHandler::BANNER_VIEW);
                $return = $banner;
            }
        } else {
            $this->container->get("logger")->addError("Invalid banner level value ({$type}).");
        }

        return $return;
    }

    /**
     * Alias for create a banner anchor
     *
     * @param Banner $banner
     * @return string
     */
    public function anchor(Banner $banner)
    {
        if (!$this->container->get('modules')->isModuleAvailable('banner')) {
            return '';
        }

        $anchor = 'javascript:void(0);';

        if ($banner and $banner->getDestinationUrl()) {
            $anchor = $this->container->get('router')
                ->generate(
                    'banners_reports',
                    ['bannerId' => $this->container->get('url_encryption')->encrypt($banner->getId())]
                );
        }

        return $anchor;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'banner';
    }
}
