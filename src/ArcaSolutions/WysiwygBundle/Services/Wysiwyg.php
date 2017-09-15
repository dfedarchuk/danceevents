<?php

namespace ArcaSolutions\WysiwygBundle\Services;


use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\WebBundle\Entity\SettingNavigation;
use ArcaSolutions\WebBundle\Entity\Slider;
use ArcaSolutions\WysiwygBundle\Entity\Page;
use ArcaSolutions\WysiwygBundle\Entity\PageWidget;
use ArcaSolutions\WysiwygBundle\Entity\Theme;
use ArcaSolutions\WysiwygBundle\Entity\Widget;
use ArcaSolutions\WysiwygBundle\Entity\WidgetTheme;
use Doctrine\ORM\EntityManager;
use Exception;
use Navigation;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Wysiwyg
 *
 * This service handles everything but RENDERING that has something to do with Wysiwyg
 * Create, Edit, Delete pages and their widgets
 * Retrieving the data from DB, saving data in DB.
 *
 */
class Wysiwyg
{
    /**
     * These constants are used in PageType Entity
     * And are the possible values for the $pageType
     * ALERT: DO NOT CHANGE THE CONSTANT VALUES
     * They are used for the reset feature at sitemgr
     * If you need to change you will have to change the function that have 'get'.constant.'DefaultWidgets'
     * EX:  const HOME_PAGE
     *      function getHomePageDefaultWidgets()
     */
    const HOME_PAGE = "Home Page";
    const RESULTS_PAGE = "Directory Results";
    const CONTACT_US_PAGE = "Contact Us";
    const FAQ_PAGE = "FAQ";
    const TERMS_OF_SERVICE_PAGE = "Terms of Use";
    const PRIVACY_POLICY_PAGE = "Privacy Policy";
    const SITEMAP_PAGE = "Sitemap";
    const MAINTENANCE_PAGE = "Maintenance Page";
    const ERROR404_PAGE = "Error Page";
    const ITEM_UNAVAILABLE_PAGE = "Item Unavailable Page";
    const ADVERTISE_PAGE = "Advertise with Us";
    const CUSTOM_PAGE = "Custom Page";

    const LISTING_HOME_PAGE = "Listing Home";
    const LISTING_DETAIL_PAGE = "Listing Detail";
    const LISTING_CATEGORIES_PAGE = "Listing View All Categories";
    const LISTING_ALL_LOCATIONS = "Listing View All Locations";
    const LISTING_REVIEWS = "Listing Reviews";

    const EVENT_HOME_PAGE = "Event Home";
    const EVENT_DETAIL_PAGE = "Event Detail";
    const EVENT_CATEGORIES_PAGE = "Event View All Categories";
    const EVENT_ALL_LOCATIONS = "Event View All Locations";

    const CLASSIFIED_HOME_PAGE = "Classified Home";
    const CLASSIFIED_DETAIL_PAGE = "Classified Detail";
    const CLASSIFIED_CATEGORIES_PAGE = "Classified View All Categories";
    const CLASSIFIED_ALL_LOCATIONS = "Classified View All Locations";

    const DEAL_HOME_PAGE = "Deal Home";
    const DEAL_DETAIL_PAGE = "Deal Detail";
    const DEAL_CATEGORIES_PAGE = "Deal View All Categories";
    const DEAL_ALL_LOCATIONS = "Deal View All Locations";

    const ARTICLE_HOME_PAGE = "Article Home";
    const ARTICLE_DETAIL_PAGE = "Article Detail";
    const ARTICLE_CATEGORIES_PAGE = "Article View All Categories";
    const ARTICLE_REVIEWS = "Article Reviews";

    const BLOG_HOME_PAGE = "Blog Home";
    const BLOG_DETAIL_PAGE = "Blog Detail";
    const BLOG_CATEGORIES_PAGE = "Blog View All Categories";
    /**
     * CUSTOM ADDPAGETYPE
     * here are an example of how you add a PageType constant to be used in the load data
     */
    /*const TEST_PAGE = "Test Page";*/

    /**
     * ContainerInterface
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var array
     */
    protected $urlToRoute = [
        self::ARTICLE_CATEGORIES_PAGE    => 'alias_article_allcategories_url_divisor',
        self::ARTICLE_HOME_PAGE          => 'alias_article_module',
        self::BLOG_CATEGORIES_PAGE       => 'alias_blog_allcategories_url_divisor',
        self::BLOG_HOME_PAGE             => 'alias_blog_module',
        self::CLASSIFIED_CATEGORIES_PAGE => 'alias_classified_allcategories_url_divisor',
        self::CLASSIFIED_HOME_PAGE       => 'alias_classified_module',
        self::EVENT_CATEGORIES_PAGE      => 'alias_event_allcategories_url_divisor',
        self::EVENT_HOME_PAGE            => 'alias_event_module',
        self::LISTING_CATEGORIES_PAGE    => 'alias_listing_allcategories_url_divisor',
        self::LISTING_HOME_PAGE          => 'alias_listing_module',
        self::DEAL_CATEGORIES_PAGE       => 'alias_promotion_allcategories_url_divisor',
        self::DEAL_HOME_PAGE             => 'alias_promotion_module',
        self::ADVERTISE_PAGE             => 'alias_advertise_url_divisor',
        self::CONTACT_US_PAGE            => 'alias_contactus_url_divisor',
        self::FAQ_PAGE                   => 'alias_faq_url_divisor',
        self::SITEMAP_PAGE               => 'alias_sitemap_url_divisor',
        self::TERMS_OF_SERVICE_PAGE      => 'alias_terms_url_divisor',
        self::PRIVACY_POLICY_PAGE        => 'alias_privacy_url_divisor',
        self::LISTING_ALL_LOCATIONS      => 'alias_alllocations_url_divisor',
        self::CLASSIFIED_ALL_LOCATIONS   => 'alias_alllocations_url_divisor',
        self::DEAL_ALL_LOCATIONS         => 'alias_alllocations_url_divisor',
        self::EVENT_ALL_LOCATIONS        => 'alias_alllocations_url_divisor',
        self::LISTING_REVIEWS            => 'alias_review_url_divisor',
        self::ARTICLE_REVIEWS            => 'alias_review_url_divisor',
    ];

    /**
     * @var string
     */
    private $module = ParameterHandler::MODULE_LISTING;

    /**
     * @var string
     */
    private $moduleBanner = null;

    /**
     * @var string
     */
    private $requestUrl;

    /**
     * @var string
     */
    private $theme = Theme::DEFAULT_THEME;

    /**
     * @var array
     */
    public $urlNonEditable = [
        self::HOME_PAGE,
        self::RESULTS_PAGE,
        self::ERROR404_PAGE,
        self::ITEM_UNAVAILABLE_PAGE,
        self::MAINTENANCE_PAGE,
        self::LISTING_DETAIL_PAGE,
        self::ARTICLE_DETAIL_PAGE,
        self::BLOG_DETAIL_PAGE,
        self::CLASSIFIED_DETAIL_PAGE,
        self::DEAL_DETAIL_PAGE,
        self::EVENT_DETAIL_PAGE,
    ];

    public $pageViewNotAllowed = [
        self::HOME_PAGE,
        self::RESULTS_PAGE,
        self::ERROR404_PAGE,
        self::ITEM_UNAVAILABLE_PAGE,
        self::MAINTENANCE_PAGE,
        self::LISTING_DETAIL_PAGE,
        self::ARTICLE_DETAIL_PAGE,
        self::BLOG_DETAIL_PAGE,
        self::CLASSIFIED_DETAIL_PAGE,
        self::DEAL_DETAIL_PAGE,
        self::EVENT_DETAIL_PAGE,
        self::ARTICLE_REVIEWS,
        self::LISTING_REVIEWS,
    ];

    public $urlConfirmation = [
        'location' => [
            self::LISTING_ALL_LOCATIONS,
            self::CLASSIFIED_ALL_LOCATIONS,
            self::DEAL_ALL_LOCATIONS,
            self::EVENT_ALL_LOCATIONS,
        ],
        'category' => [
            self::LISTING_CATEGORIES_PAGE,
            self::ARTICLE_CATEGORIES_PAGE,
            self::CLASSIFIED_CATEGORIES_PAGE,
            self::BLOG_CATEGORIES_PAGE,
            self::DEAL_CATEGORIES_PAGE,
            self::EVENT_CATEGORIES_PAGE,
        ],
        'review'   => [
            self::LISTING_REVIEWS,
            self::ARTICLE_REVIEWS,
        ],
    ];

    private $pagesWithoutSEO = [
        self::RESULTS_PAGE,
        self::LISTING_DETAIL_PAGE,
        self::EVENT_DETAIL_PAGE,
        self::CLASSIFIED_DETAIL_PAGE,
        self::DEAL_DETAIL_PAGE,
        self::ARTICLE_DETAIL_PAGE,
        self::BLOG_DETAIL_PAGE,
        self::ERROR404_PAGE,
        self::ITEM_UNAVAILABLE_PAGE,
    ];

    /**
     * This array contains the groups of the widgets that can only be one of them per page,
     * if widget's name changing at the load data is necessary change here as well.
     * You can add the title of the widget to block the whole group, or create another group.
     *
     * @var array
     */
    private $widgetNonDuplicate = [
        'header'            => [
            'Header',
            'Header with Contact Phone',
            'Navigation with Centered Logo',
            'Navigation with left Logo plus Social Media',
            'Sticky Menu',
        ],
        'footer'            => [
            'Footer',
            'Footer with Newsletter',
            'Footer with Social Media',
            'Footer with Logo',
        ],
        'search'            => [
            'Search box with Slider',
            'Search box without Slider',
            'Search Bar',
            'Search box',
            'Search box module detail',
            'Search box Blog detail',
            'Search box for Reviews page',
        ],
        'result'            => [
            'Results content with left filters',
            'Results content with right filters',
            'Results content with left filters and grid view',
            'Results content with right filters and grid view',
        ],
        'result_info'       => [
            'Results Info',
        ],
        'signup'            => [
            'Signup for our newsletter',
        ],
        'upcoming_event'    => [
            'Upcoming Events',
        ],
        'upcoming_corousel' => [
            'Upcoming Events Carousel',
        ],
        'detail'            => [
            'Listing Detail',
            'Event Detail',
            'Classified Detail',
            'Article Detail',
            'Deal Detail',
            'Blog Detail',
        ],
        'all_locations'     => [
            'All Locations',
        ],
        'all_categories'    => [
            'All Categories',
        ],
        'contact'           => [
            'Contact form',
        ],
        'faq_box'           => [
            'Faq box',
        ],
        'faq_header'        => [
            'Faq header',
        ],
        'sitemap_header'    => [
            'Sitemap Header',
        ],
        'sitemap'           => [
            'Sitemap',
        ],
        'sign_up_text'      => [
            'Sign up Text',
        ],
        'pricing_plans'     => [
            'Pricing & Plans',
        ],
        'reviews_block'     => [
            'Reviews block',
        ],
        'events'            => [
            'Events Calendar',
        ],
    ];

    /**
     * @param $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Return the system selected theme as an Entity
     *
     * @return Theme
     */
    public function getSelectedTheme()
    {
        $templateName = $this->container->get("multi_domain.information")->getTemplate();

        return $this->container->get("doctrine")->getRepository('WysiwygBundle:Theme')->findOneBy([
            'title' => ucfirst($templateName),
        ]);
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param string $module
     */
    public function setModule($module)
    {
        $this->module = $module;
        $this->moduleBanner = $module;
    }

    /**
     * @return string
     */
    public function getModuleBanner()
    {
        return $this->moduleBanner;
    }

    /**
     * @param string $module
     */
    public function setModuleBanner($module)
    {
        $this->moduleBanner = $module;
    }

    /**
     * @return string
     */
    public function getRequestUrl()
    {
        return $this->requestUrl;
    }

    /**
     * @param string $requestUrl
     */
    public function setRequestUrl($requestUrl)
    {
        $this->requestUrl = $requestUrl;
    }

    /**
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * @return array
     */
    public function getPagesWithoutSEO()
    {
        return $this->pagesWithoutSEO;
    }

    /**
     * @return array
     */
    public function getAllPages()
    {
        return $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->findAll();
    }

    /**
     * @param integer $id
     */
    public function deletePage($id)
    {
        try {
            $doctrine = $this->container->get('doctrine');
            $em = $doctrine->getManager();
            $page = $doctrine->getRepository('WysiwygBundle:Page')->find($id);

            $em->remove($page);
            $em->flush($page);
        } catch (Exception $e) {
            $this->container->get('logger')->addError($e->getMessage());
        }
    }

    /**
     * @param integer $id
     * @return array
     */
    public function getWidgetsPerPage($id)
    {
        return $this->container->get('doctrine')->getRepository('WysiwygBundle:PageWidget')
            ->findBy(['pageId' => $id, "themeId" => $this->getSelectedTheme()->getId()], ['order' => 'ASC']);
    }

    /**
     * @param integer $id
     * @return Page
     */
    public function getPage($id)
    {
        return $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->find($id);
    }

    /**
     * @param integer $pageId
     * @param array $postArray
     * @return array
     * @internal param array $pageWidgets
     */
    public function savePageWidgets($pageId, array $postArray)
    {
        $translator = $this->container->get('translator');
        $em = $this->container->get('doctrine')->getManager();
        /* @var Page $page */
        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->find($pageId);

        setting_get("sitemgr_language", $sitemgr_language);
        $sitemgrLanguage = substr($sitemgr_language, 0, 2);

        /* Success message */
        $return = [
            'success' => true,
            'message' => $translator->trans('Changes successfully saved.', [], 'messages', $sitemgrLanguage),
        ];

        // Decode array containing each widget information
        $pageWidgets = json_decode($postArray['serializedPost'], true);

        //Set Page Information
        if (!empty($postArray['title'])) {
            $page->setTitle($postArray['title']);
        }

        $page->setMetaKey($postArray['keywords']);
        $page->setMetaDescription($postArray['description']);
        $page->setCustomTag($postArray['customTag']);
        $page->setSitemap($postArray['sitemap'] ?: false);

        if (!empty($postArray['url'])) {
            /* Checks if a url is unique */
            $pageTypes = [$page->getPageType()->getTitle()];
            foreach ($this->urlConfirmation as $key => $types) {
                if (in_array($page->getPageType()->getTitle(), $types)) {
                    $pageTypes = $types;
                }
            }

            $pageEntity = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page');
            if ($pageEntity->uniqueUrl($postArray['url'], $pageTypes, $pageId)) {
                $return['success'] = false;
                $return['message'] = $translator->trans('The page URL entered is already being used by another page, please choose another URL. The remaining changes were successfully saved.',
                    [], 'messages', $sitemgrLanguage);
            } else {
                if ($page->getPageType()->getTitle() == self::CUSTOM_PAGE) {
                    $postArray['url'] = str_replace('.html', '', $postArray['url']);
                } else {
                    /* Save URL all Categories from all modules */
                    if (!empty($postArray['replica'])) {
                        foreach ($this->urlConfirmation as $type => $types) {
                            if ($type != $postArray['replica']) {
                                continue;
                            }

                            foreach ($types as $pageType) {
                                $this->saveUrl($postArray['url'], $pageType);
                                /* @var $pSave Page */
                                $pSave = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType($pageType);
                                $pSave->setUrl($postArray['url']);
                            }
                        }
                    } else {
                        $this->saveUrl($postArray['url'], $page->getPageType()->getTitle());
                    }
                }

                $page->setUrl($postArray['url']);
            }
        }

        $em->flush();

        if ($pageWidgets && $postArray['changed']) {
            foreach ($pageWidgets as $order => $item) {
                if ($item['pageWidgetId']) {
                    $pageWidget = $this->container->get('doctrine')
                        ->getRepository('WysiwygBundle:PageWidget')->find($item['pageWidgetId']);
                    $pageWidget->setOrder($order);
                } else {
                    $pageWidget = $this->saveWidget(null, $page->getId(), $item['widgetId']);
                    if ($pageWidget) {
                        $pageWidget->setOrder($order);
                        $em->persist($pageWidget);
                    } else {
                        $return['success'] = false;
                        $return['message'] = $translator->trans('Something went wrong!', [], 'widgets',
                            $sitemgrLanguage);
                    }
                }
            }
            $em->flush();
            $em->clear();
        }

        return $return;
    }


    /**
     * @param integer $id
     * @return array
     */
    public function getWidgetFromPage($id)
    {
        // Get All widget by ID (Page_Widget Table)
        return $this->container->get('doctrine')->getRepository('WysiwygBundle:PageWidget')->findOneBy([
            'id'      => $id,
            "themeId" => $this->getSelectedTheme()->getId(),
        ]);
    }

    /**
     * @param integer $id
     * @return array
     */
    public function getOriginalWidget($id)
    {
        // Get Default Widget information (Widget Table)
        return $this->container->get('doctrine')->getRepository('WysiwygBundle:Widget')->find($id);
    }

    /**
     * @return \ArcaSolutions\WysiwygBundle\Entity\Widget[]|array
     */
    public function getGroupedWidgets($pageTypeId)
    {
        // Get Default Widgets (Widget Table)
        $themeId = $this->getSelectedTheme()->getId();

        return $this->container->get('doctrine')->getRepository('WysiwygBundle:Widget')->findAllGrouped($pageTypeId,
            $themeId);
    }

    /**
     * @return array
     */
    public function getWidgetTypes()
    {
        // Get Default Widgets (Widget Table)
        return $this->container->get('doctrine')->getRepository('WysiwygBundle:Widget')->findTypes();
    }

    /**
     * Create a New widget for a page at the bottom
     * @param $content
     * @param null $pageId
     * @param null $widgetId
     *
     * @return PageWidget|bool
     */
    public function saveWidget($content, $pageId = null, $widgetId = null)
    {
        try {
            $em = $this->container->get('doctrine')->getManager();
            // Page Entity
            $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->find($pageId);
            /* @var Widget $widget */
            $widget = $this->container->get('doctrine')->getRepository('WysiwygBundle:Widget')->find($widgetId);
            // Theme Entity
            $theme = $this->container->get('doctrine')->getRepository('WysiwygBundle:Theme')->find($this->getSelectedTheme());
            // Get new widget Order
            $order = $this->container->get('doctrine')->getRepository('WysiwygBundle:PageWidget')->findLastOrder($pageId,
                $this->getSelectedTheme());

            /* themes that has this $widget */
            $widgetThemes = array_map(function ($widgetTheme) {
                /* @var $widgetTheme WidgetTheme */
                return $widgetTheme->getTheme();
            }, $widget->getThemes()->toArray());

            /* validates if the actual $theme has the $widget */
            if (!in_array($theme, $widgetThemes)) {
                return false;
            }

            $pageWidget = new PageWidget();
            $pageWidget->setContent($content ? $content : $widget->getContent());
            $pageWidget->setPage($page);
            $pageWidget->setWidget($widget);
            $pageWidget->setTheme($theme);
            $pageWidget->setOrder($order);

            $em->persist($pageWidget);

            $this->replicateHeaderOrFooterForAllPages($pageWidget->getWidget(), $pageWidget->getContent(), $em);

            $em->flush();
        } catch (Exception $e) {
            $this->container->get('logger')->error($e->getMessage());
        }

        return $pageWidget;
    }

    /**
     * Save a changed content of a widget
     * @param integer $id
     * @param string $content
     *
     * @return PageWidget|null|object
     */
    public function saveWidgetContent($id, $content)
    {
        // Save Widget customized content (Page_Widget Table)
        try {
            $em = $this->container->get('doctrine')->getManager();
            if ($id) {
                $pageWidget = $this->container->get('doctrine')->getRepository('WysiwygBundle:PageWidget')->find($id);
                $pageWidget->setContent($content);

                $em->persist($pageWidget);

                $this->replicateHeaderOrFooterForAllPages($pageWidget->getWidget(), $pageWidget->getContent(), $em);

                $em->flush();
                $em->clear();

                return $pageWidget;
            }
        } catch (Exception $e) {
            $this->container->get('logger')->error($e->getMessage());
        }
    }

    /**
     * @param Widget $widget
     * @param $content
     * @param $em
     */
    public function replicateHeaderOrFooterForAllPages(Widget $widget, $content = null, $em)
    {
        /* @var $widget Widget */
        if ($widget and in_array($widget->getType(), [Widget::HEADER_TYPE, Widget::FOOTER_TYPE])) {

            $pageWidgetsToUpdate = $this->container->get("doctrine")->getRepository("WysiwygBundle:PageWidget")
                ->getPageWidgetByTypeOfAllPages(
                    $widget->getType(),
                    $widget->getId(),
                    $this->getSelectedTheme()->getId()
                );

            /* @var $pageWidget PageWidget */
            foreach ($pageWidgetsToUpdate as $pageWidget) {
                $pageWidget->setWidget($widget);
                $pageWidget->setContent($content ? $content : $widget->getContent());

                $em->persist($pageWidget);
            }
        }
    }

    public function saveFavIcon($file)
    {
        $container = $this->container;
        $originalName = "favicon_";
        $imageUploader = $container->get('imageuploader');
        $file = new UploadedFile($file['tmp_name'], $originalName);

        return $imageUploader->uploadFavicon($file, $originalName);
    }

    public function saveLogo($file)
    {
        $container = $this->container;
        $originalName = 'img_logo.png';
        $imageUploader = $container->get('imageuploader');
        $file = new UploadedFile($file['tmp_name'], $originalName);

        return $imageUploader->uploadLogo($file, $originalName);
    }

    public function getNavigation($navigation_area = null, $appBuilder = false)
    {
        $arrayOptions = [];
        if (!$navigation_area) {
            $navigation_area = ($appBuilder ? "tabbar" : "header");
        }

        Navigation::getNavbar($arrayOptions, $navigation_area);
        $this->removesDisabledModules($arrayOptions);

        return $arrayOptions;
    }

    /**
     * It removes disabled modules from menu directly
     *
     * @param array $menu
     * @param string $field The field that contains the item url | link
     */
    public function removesDisabledModules(&$menu = [], $field = 'link')
    {
        $modules_available = $this->container->get("modules")->getAvailableModules();

        foreach ($menu as $key => $item) {
            /* @var SettingNavigation $item */
            if (isset($item['custom']) && $item['custom'] != 'n') {
                continue;
            }

            /* it just continues, if it is module's links */
            if (false === strpos($item[$field], 'DEFAULT_URL')) {
                continue;
            }

            /* getting module's name by link */
            $module = explode('_', $item[$field]);
            $module = current($module);
            $module = strtolower($module);
            /* it is enabled or not */
            if ($modules_available[$module] === false) {
                unset($menu[$key]);
            }
        }

        $newMenu = [];
        foreach ($menu as $item) {
            $newMenu[] = $item;
        }

        $menu = $newMenu;
    }

    public function clearNavigation($area)
    {
        $em = $this->container->get('doctrine')->getManager();
        $qb = $em->createQueryBuilder();
        $qb->delete('WebBundle:SettingNavigation', 'sn')
            ->where('sn.area = :area')
            ->setParameter('area', $area)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $navArr
     * @param string $area
     */
    public function saveNavigation($navArr, $area = 'header')
    {
        $em = $this->container->get('doctrine')->getManager();

        $this->clearNavigation($area);

        $order = 0;
        $settingNav = null;
        foreach ($navArr as $itemNavbar) {
            if (strpos($itemNavbar['name'], 'navigation_text_') !== false) {
                $settingNav = new SettingNavigation();
                $settingNav->setArea($area);
                $settingNav->setOrder($order);
                $settingNav->setLabel($itemNavbar['value']);
            }
            if (strpos($itemNavbar['name'], 'custom_') !== false) {
                $settingNav->setCustom($itemNavbar['value']);
            }
            if (strpos($itemNavbar['name'], 'link_') !== false) {
                $settingNav->setLink($itemNavbar['value']);
                $order++;
                $em->persist($settingNav);
            }
        }
        $em->flush();
        $em->clear();
    }

    /**
     * @param string $area
     * @return string
     */
    public function reloadNavbar($area = 'header')
    {
        $translator = $this->container->get('translator');
        $arrayOptions = $this->getNavigation($area);
        $navbarHtml = '';

        for ($i = 0; $i < count($arrayOptions); $i++) {
            include($this->container->getParameter('kernel.root_dir').'/../web/includes/forms/form-navigation-structure.php');
        }

        return $navbarHtml;
    }

    public function reloadSlider()
    {
        $sliders = $this->getSlider();
        $sliderHtml = '';
        $sliderInfoHtml = '';

        /* @var $slider Slider */
        foreach ($sliders as $slider) {
            if ($slider->getImage()) {
                $fileName = $this->container->get('imagehandler')->getPath($slider->getImage());
                $slider->setImagePath(IMAGE_URL.'/'.$fileName);
            }
        }

        /* The translator is being used on the forms */
        $translator = $this->container->get('translator');
        for ($i = 0; $i < TOTAL_SLIDER_ITEMS; $i++) {
            if ($sliders[$i]) {
                include($this->container->getParameter('kernel.root_dir').'/../web/includes/forms/form-slider-structure.php');
                include($this->container->getParameter('kernel.root_dir').'/../web/includes/forms/form-slider-info-structure.php');
            }
        }

        return ['sliderHtml' => $sliderHtml, 'sliderInfoHtml' => $sliderInfoHtml];
    }

    public function saveSocialLinks($socialLinks)
    {
        $settings = $this->container->get('settings');
        foreach ($socialLinks as $socialLink) {
            $settings->setSetting($socialLink['name'], $socialLink['value']);
        }
    }

    public function saveBackgroundImage($file, $originalName, $extension = 'jpg')
    {
        $originalName = $originalName.'.'.$extension;
        $file = new UploadedFile($file['tmp_name'], $originalName);

        return $this->container->get('imageuploader')->uploadBackgroundImage($file, $originalName);
    }

    public function getSlider($area = 'web')
    {
        $container = $this->container;

        $sliders = $container->get('doctrine')->getRepository('WebBundle:Slider')->getSlidersByAreaSitemgr($area);

        return $sliders;
    }

    public function saveSlider($sliderJson)
    {
        $em = $this->container->get('doctrine')->getManager();

        $sliderArr = json_decode($sliderJson, true);

        foreach ($sliderArr as $key => $slider) {
            /* Getting each field */
            $sliderItem = array_column($slider, 'value', 'name');
            /* @var $slideRow Slider */
            $slideRow = $this->container->get('doctrine')->getRepository('WebBundle:Slider')->find($sliderItem['slideId']);
            if ($slideRow) {
                $slideRow->setTitle($sliderItem['title']);
                $slideRow->setSummary($sliderItem['summary']);
                $slideRow->setLink($sliderItem['link']);
                $slideRow->setSlideOrder($key);
                $slideRow->setTarget($sliderItem['openWindow'] == '1' ? 'blank' : 'self');
                if ($sliderItem['imageId'] != $slideRow->getImageId() && $slideRow->getImage()) {
                    $this->container->get('imagehandler')->deleteSliderImage($slideRow->getImage());
                    $image = $this->container->get('doctrine')->getRepository('ImageBundle:Image')->find($sliderItem['imageId']);
                    $slideRow->setImage($image);
                }
                $slideRow->setImageId($sliderItem['imageId']);
            } elseif ($sliderItem['imageId'] != '') {
                $slideRow = new Slider();
                $slideRow->setTitle($sliderItem['title']);
                $slideRow->setSummary($sliderItem['summary']);
                $slideRow->setLink($sliderItem['link']);
                $slideRow->setSlideOrder($key);
                $slideRow->setArea('web');
                $slideRow->setTarget($sliderItem['openWindow'] ? 'blank' : 'self');
                $image = $this->container->get('doctrine')->getRepository('ImageBundle:Image')->find($sliderItem['imageId']);
                $slideRow->setImage($image);

                $em->persist($slideRow);
            }

            $em->flush($slideRow);
        }

        return ['success' => true];
    }

    public function deleteSlider($deleteIds)
    {
        $container = $this->container;
        $em = $container->get('doctrine')->getManager();
        $imageHandler = $container->get('imagehandler');
        $deleteIdsArr = explode(',', $deleteIds);

        foreach ($deleteIdsArr as $slideId) {
            $slideRow = $container->get('doctrine')->getRepository('WebBundle:Slider')->find($slideId);
            if ($slideRow) {
                $slideRow->getImage() and $imageHandler->deleteSliderImage($slideRow->getImage(), false);
                $em->remove($slideRow);
                $em->flush($slideRow);
            }
        }
    }

    public function deleteWidgetFromPage($pageWidgetId)
    {
        $container = $this->container;
        $em = $container->get('doctrine')->getManager();
        $return = false;

        $pageWidget = $container->get('doctrine')->getRepository('WysiwygBundle:PageWidget')->find($pageWidgetId);
        if ($pageWidget) {
            $em->remove($pageWidget);
            $em->flush($pageWidget);
            $return = true;
        }

        return $return;
    }

    /**
     * Reset all widgets of the Page to the default configuration
     *
     * @param $pageId
     * @return array
     */
    public function resetPage($pageId)
    {
        $em = $this->container->get('doctrine')->getManager();
        $translator = $this->container->get("translator");

        setting_get("sitemgr_language", $sitemgr_language);
        $sitemgrLanguage = substr($sitemgr_language, 0, 2);

        /* Success message */
        $return = [
            'success' => true,
            'message' => $translator->trans('Page successfully reset.', [], 'messages', $sitemgrLanguage),
        ];

        try {
            $pageWidgets = $this->container->get('doctrine')->getRepository('WysiwygBundle:PageWidget')->findBy([
                'pageId'  => $pageId,
                'themeId' => $this->getSelectedTheme()->getId(),
            ]);

            if ($pageWidgets) {
                foreach ($pageWidgets as $pageWidget) {
                    $em->remove($pageWidget);
                }

                $em->flush();
            }

            $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->find($pageId);

            $pageType = $page->getPageType()->getTitle();
            $this->setTheme($this->getSelectedTheme()->getTitle());

            /* Get Default Widgets Method */
            $method = 'get'.str_replace(' ', '', $pageType).'DefaultWidgets';
            $pageWidgetsArr = $this->$method();

            /* Get specific contents */
            $contents = $this->container->get('wysiwyg.service')->getDefaultSpecificWidgetContents();

            if ($pageWidgetsArr) {
                foreach ($pageWidgetsArr as $pageWidgetTitle) {
                    /* @var $widget Widget */
                    $widget = $this->container->get('doctrine')->getRepository('WysiwygBundle:Widget')->findOneBy(['title' => $pageWidgetTitle]);

                    $this->saveWidget(
                        isset($contents[$pageType][$pageWidgetTitle]) ? $contents[$pageType][$pageWidgetTitle] : null,
                        $pageId,
                        $widget->getId()
                    );
                }
            }
        } catch (Exception $e) {
            $return = ['success' => false, 'message' => $e->getMessage()];
        }

        return $return;
    }

    /**
     * Returns the common widgets to all themes
     *
     * @return array
     */
    public function getCommonThemeWidgets()
    {
        $trans = $this->container->get('translator');

        return [
            $trans->trans('Search box with Slider', [], 'widgets', 'en'),
            $trans->trans('Search box without Slider', [], 'widgets', 'en'),
            $trans->trans('Leaderboard ad bar (728x90)', [], 'widgets', 'en'),
            $trans->trans('4 Featured listings', [], 'widgets', 'en'),
            $trans->trans('Browse by category block with images', [], 'widgets', 'en'),
            $trans->trans('3 rectangle ad bar', [], 'widgets', 'en'),
            $trans->trans('Upcoming Events', [], 'widgets', 'en'),
            $trans->trans('3 Recent Articles', [], 'widgets', 'en'),
            $trans->trans('Signup for our newsletter', [], 'widgets', 'en'),
            $trans->trans('Popular Deals', [], 'widgets', 'en'),
            $trans->trans('Browse by Location with Right Banner (160x600)', [], 'widgets', 'en'),
            $trans->trans('Featured Classifieds with Right banner (230x230)', [], 'widgets', 'en'),
            $trans->trans('Banner Large Mobile, one banner Sponsored Links and one Google Ads', [], 'widgets', 'en'),
            $trans->trans('Download our apps bar', [], 'widgets', 'en'),
            $trans->trans('Sitemap Header', [], 'widgets', 'en'),
            $trans->trans('Sitemap', [], 'widgets', 'en'),
            $trans->trans('Search Bar', [], 'widgets', 'en'),
            $trans->trans('3 Featured Listings', [], 'widgets', 'en'),
            $trans->trans('Best Of Listings', [], 'widgets', 'en'),
            $trans->trans('Featured Events', [], 'widgets', 'en'),
            $trans->trans('Upcoming Events Carousel', [], 'widgets', 'en'),
            $trans->trans('3 Featured Classifieds', [], 'widgets', 'en'),
            $trans->trans('Popular Classifieds', [], 'widgets', 'en'),
            $trans->trans('3 Must Read Articles', [], 'widgets', 'en'),
            $trans->trans('4 Recent Articles', [], 'widgets', 'en'),
            $trans->trans('3 Special Deals', [], 'widgets', 'en'),
            $trans->trans('4 New Deals', [], 'widgets', 'en'),
            $trans->trans('3 Popular Posts', [], 'widgets', 'en'),
            $trans->trans('Recent Posts', [], 'widgets', 'en'),
            $trans->trans('Search box', [], 'widgets', 'en'),
            $trans->trans('Results Info', [], 'widgets', 'en'),
            $trans->trans('Results content with left filters', [], 'widgets', 'en'),
            $trans->trans('Results content with right filters', [], 'widgets', 'en'),
            $trans->trans('Search box module detail', [], 'widgets', 'en'),
            $trans->trans('Listing Detail', [], 'widgets', 'en'),
            $trans->trans('Event Detail', [], 'widgets', 'en'),
            $trans->trans('Classified Detail', [], 'widgets', 'en'),
            $trans->trans('Article Detail', [], 'widgets', 'en'),
            $trans->trans('Deal Detail', [], 'widgets', 'en'),
            $trans->trans('Blog Detail', [], 'widgets', 'en'),
            $trans->trans('Search box Blog detail', [], 'widgets', 'en'),
            $trans->trans('Contact form', [], 'widgets', 'en'),
            $trans->trans('Faq box', [], 'widgets', 'en'),
            $trans->trans('Faq header', [], 'widgets', 'en'),
            $trans->trans('Custom Content', [], 'widgets', 'en'),
            $trans->trans('Sign Up Text', [], 'widgets', 'en'),
            $trans->trans('Pricing & Plans', [], 'widgets', 'en'),
            $trans->trans('All Categories', [], 'widgets', 'en'),
            $trans->trans('All Locations', [], 'widgets', 'en'),
            $trans->trans('Special Events', [], 'widgets', 'en'),
            $trans->trans('Search box for Reviews page', [], 'widgets', 'en'),
            $trans->trans('Reviews block', [], 'widgets', 'en'),
            $trans->trans('Header', [], 'widgets', 'en'),
            $trans->trans('Header with Contact Phone', [], 'widgets', 'en'),
            $trans->trans('Navigation with left Logo plus Social Media', [], 'widgets', 'en'),
            $trans->trans('Navigation with Centered Logo', [], 'widgets', 'en'),
            $trans->trans('Results content with left filters and grid view', [], 'widgets', 'en'),
            $trans->trans('Results content with right filters and grid view', [], 'widgets', 'en'),
            $trans->trans('Footer', [], 'widgets', 'en'),
            $trans->trans('Footer with Newsletter', [], 'widgets', 'en'),
            $trans->trans('Footer with Logo', [], 'widgets', 'en'),
            $trans->trans('Footer with Social Media', [], 'widgets', 'en'),
            $trans->trans('Sticky Menu', [], 'widgets', 'en'),
            $trans->trans('Events Calendar', [], 'widgets', 'en'),
            /*
             * CUSTOM ADDWIDGET
             * here are an example of how you add the widget 'Widget test' for all themes
             * if you need that 'Widget test' to be available only for a specific theme you have
             * to remove it from here and add at the right function below
             */
            /* $trans->trans('Widget test', [], 'widgets', 'en'), */
        ];
    }

    /**
     * Returns the commons and the Default Theme widgets
     *
     * @return array
     */
    public function getDefaultThemeWidgets()
    {
        $trans = $this->container->get('translator');

        return array_merge($this->getCommonThemeWidgets(), [
            /*
             * CUSTOM ADDWIDGET
             * here are an example of how you add the widget 'Widget test' for Default theme
             * if you need that 'Widget test' to be available for all themes you have
             * to remove it from here and add at the right function above
             *
             * $trans->trans('Widget test', [], 'widgets', 'en'),*/
        ]);
    }

    /**
     * Returns the commons and the Doctor Theme widgets
     *
     * @return array
     */
    public function getDoctorThemeWidgets()
    {
        $trans = $this->container->get('translator');

        return array_merge($this->getCommonThemeWidgets(), [
            $trans->trans('Featured Categories', [], 'widgets', 'en'),
            $trans->trans('2 Column Recent Articles', [], 'widgets', 'en'),
            $trans->trans('Browse by Category and Location with Square banner', [], 'widgets', 'en'),
            $trans->trans('Recent Reviews plus Wide Skyscraper banner', [], 'widgets', 'en'),
        ]);
    }

    /**
     * Returns the commons and the Restaurant Theme widgets
     *
     * @return array
     */
    public function getRestaurantThemeWidgets()
    {
        $trans = $this->container->get('translator');

        return array_merge($this->getCommonThemeWidgets(), [
            $trans->trans('5 Featured Listings', [], 'widgets', 'en'),
            $trans->trans('Browse by Locations plus Square Banners', [], 'widgets', 'en'),
            $trans->trans('Popular Deals plus Wide Skyscraper banner', [], 'widgets', 'en'),
        ]);
    }

    /**
     * Returns the commons and the Wedding Theme widgets
     *
     * @return array
     */
    public function getWeddingThemeWidgets()
    {
        $trans = $this->container->get('translator');

        return array_merge($this->getCommonThemeWidgets(), [
            $trans->trans('5 Recent Articles', [], 'widgets', 'en'),
            $trans->trans('6 Featured Listings plus 2 Square Banners', [], 'widgets', 'en'),
            $trans->trans('4 Featured Events', [], 'widgets', 'en'),
            $trans->trans('3 Recent Posts', [], 'widgets', 'en'),
        ]);
    }

    /**
     *  CUSTOM ADDTHEME
     *  here are an example of you add all the common widgets and the specific widgets to the Test Theme
     */
    /*public function getTestThemeWidgets()
    {
        $trans = $this->container->get('translator');

        return array_merge($this->getCommonThemeWidgets(), [
            $trans->trans('Widget test', [], 'widgets', 'en'),
        ]);
    }*/


    //region Default Widgets of each page by theme
    /**
     * Each function of this region returns the widgets ordered of each page
     * The widgets returned are different for each theme
     * ALERT: DO NOT CHANGE THE FUNCTIONS NAME
     * They have to match its own PageType constant plus 'DefaultWidgets' for the reset feature at sitemgr
     * Ex:  constant HOME_PAGE
     *      function getHomePageDefaultWidgets()
     */


    /**
     * Returns the widgets that compose the Home Page
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getHomePageDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box with Slider',
                'Leaderboard ad bar (728x90)',
                '4 Featured listings',
                'Browse by category block with images',
                '3 rectangle ad bar',
                'Upcoming Events',
                '3 Recent Articles',
                'Signup for our newsletter',
                'Popular Deals',
                'Browse by Location with Right Banner (160x600)',
                'Featured Classifieds with Right banner (230x230)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
                /*
                 * CUSTOM ADDWIDGET
                 * here are an example of how you add the widget 'Widget test'
                 * at the Home Page default widgets for Default theme
                 * if you need that 'Widget test' to be available for all themes you have
                 * add in each array below
                 */
                /* 'Widget test',*/
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box with Slider',
                'Featured Categories',
                'Leaderboard ad bar (728x90)',
                '2 Column Recent Articles',
                'Browse by Category and Location with Square banner',
                'Recent Reviews plus Wide Skyscraper banner',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box with Slider',
                'Leaderboard ad bar (728x90)',
                '5 Featured Listings',
                'Browse by category block with images',
                '3 rectangle ad bar',
                '3 Recent Articles',
                'Browse by Locations plus Square Banners',
                'Popular Deals plus Wide Skyscraper banner',
                'Signup for our newsletter',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box with Slider',
                'Leaderboard ad bar (728x90)',
                'Browse by category block with images',
                '5 Recent Articles',
                '6 Featured Listings plus 2 Square Banners',
                '4 Featured Events',
                '3 Recent Posts',
                'Browse by Location with Right Banner (160x600)',
                'Signup for our newsletter',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Listing Home
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getListingHomeDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Featured Listings',
                'Browse by category block with images',
                'Best Of Listings',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Featured Listings',
                'Browse by category block with images',
                'Best Of Listings',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Featured Listings',
                'Browse by category block with images',
                'Best Of Listings',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Featured Listings',
                'Browse by category block with images',
                'Best Of Listings',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Event Home
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getEventHomeDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                'Featured Events',
                'Browse by category block with images',
                'Special Events',
                'Upcoming Events Carousel',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                'Featured Events',
                'Browse by category block with images',
                'Special Events',
                'Upcoming Events Carousel',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                'Featured Events',
                'Browse by category block with images',
                'Special Events',
                'Upcoming Events Carousel',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                'Featured Events',
                'Browse by category block with images',
                'Special Events',
                'Upcoming Events Carousel',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Classified Home
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getClassifiedHomeDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Featured Classifieds',
                'Browse by category block with images',
                '3 rectangle ad bar',
                'Popular Classifieds',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Featured Classifieds',
                'Browse by category block with images',
                '3 rectangle ad bar',
                'Popular Classifieds',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Featured Classifieds',
                'Browse by category block with images',
                '3 rectangle ad bar',
                'Popular Classifieds',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Featured Classifieds',
                'Browse by category block with images',
                '3 rectangle ad bar',
                'Popular Classifieds',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Article Home
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getArticleHomeDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Must Read Articles',
                '3 rectangle ad bar',
                'Browse by category block with images',
                '4 Recent Articles',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Must Read Articles',
                '3 rectangle ad bar',
                'Browse by category block with images',
                '4 Recent Articles',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Must Read Articles',
                '3 rectangle ad bar',
                'Browse by category block with images',
                '4 Recent Articles',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Must Read Articles',
                '3 rectangle ad bar',
                'Browse by category block with images',
                '4 Recent Articles',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Deal Home
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getDealHomeDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Special Deals',
                'Browse by category block with images',
                '4 New Deals',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Special Deals',
                'Browse by category block with images',
                '4 New Deals',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Special Deals',
                'Browse by category block with images',
                '4 New Deals',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Special Deals',
                'Browse by category block with images',
                '4 New Deals',
                '3 rectangle ad bar',
                'Browse by Location with Right Banner (160x600)',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Blog Home
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getBlogHomeDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Popular Posts',
                '3 rectangle ad bar',
                'Recent Posts',
                'Browse by category block with images',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Popular Posts',
                '3 rectangle ad bar',
                'Recent Posts',
                'Browse by category block with images',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Popular Posts',
                '3 rectangle ad bar',
                'Recent Posts',
                'Browse by category block with images',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search Bar',
                'Leaderboard ad bar (728x90)',
                '3 Popular Posts',
                '3 rectangle ad bar',
                'Recent Posts',
                'Browse by category block with images',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Directory Results
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getDirectoryResultsDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'Results Info',
                'Results content with left filters',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'Results Info',
                'Results content with left filters',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'Results Info',
                'Results content with left filters',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'Results Info',
                'Results content with left filters',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Listing Detail
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getListingDetailDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box module detail',
                'Listing Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box module detail',
                'Listing Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box module detail',
                'Listing Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box module detail',
                'Listing Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Event Detail
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getEventDetailDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box module detail',
                'Event Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box module detail',
                'Event Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box module detail',
                'Event Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box module detail',
                'Event Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Classified Detail
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getClassifiedDetailDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box module detail',
                'Classified Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box module detail',
                'Classified Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box module detail',
                'Classified Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box module detail',
                'Classified Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Article Detail
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getArticleDetailDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box module detail',
                'Article Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box module detail',
                'Article Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box module detail',
                'Article Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box module detail',
                'Article Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Deal Detail
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getDealDetailDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box module detail',
                'Deal Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box module detail',
                'Deal Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box module detail',
                'Deal Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box module detail',
                'Deal Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Blog Detail
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getBlogDetailDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box Blog detail',
                'Blog Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box Blog detail',
                'Blog Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box Blog detail',
                'Blog Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box Blog detail',
                'Blog Detail',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Contact Us
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getContactUsDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'Contact form',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'Contact form',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'Contact form',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'Contact form',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the FAQ
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getFAQDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Faq header',
                'Leaderboard ad bar (728x90)',
                'Faq box',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Faq header',
                'Leaderboard ad bar (728x90)',
                'Faq box',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Faq header',
                'Leaderboard ad bar (728x90)',
                'Faq box',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Faq header',
                'Leaderboard ad bar (728x90)',
                'Faq box',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Terms of Service
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getTermsofServiceDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Leaderboard ad bar (728x90)',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Leaderboard ad bar (728x90)',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Leaderboard ad bar (728x90)',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Leaderboard ad bar (728x90)',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Privacy Policy
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getPrivacyPolicyDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Leaderboard ad bar (728x90)',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Leaderboard ad bar (728x90)',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Leaderboard ad bar (728x90)',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Leaderboard ad bar (728x90)',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Sitemap
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getSitemapDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Sitemap Header',
                'Leaderboard ad bar (728x90)',
                'Sitemap',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Sitemap Header',
                'Leaderboard ad bar (728x90)',
                'Sitemap',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Sitemap Header',
                'Leaderboard ad bar (728x90)',
                'Sitemap',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Sitemap Header',
                'Leaderboard ad bar (728x90)',
                'Sitemap',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Maintenance Page
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getMaintenancePageDefaultWidgets()
    {
        return ['Custom Content'];
    }

    /**
     * Returns the widgets that compose the Error Page
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getErrorPageDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Item Unavailable Page
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getItemUnavailablePageDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box',
                'Custom Content',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Advertise with Us
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getAdvertisewithUsDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Sign Up Text',
                'Pricing & Plans',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Sign Up Text',
                'Pricing & Plans',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Sign Up Text',
                'Pricing & Plans',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Sign Up Text',
                'Pricing & Plans',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Listing View All Categories
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getListingViewAllCategoriesDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'All Categories',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'All Categories',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'All Categories',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'All Categories',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Event View All Categories
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getEventViewAllCategoriesDefaultWidgets()
    {
        return $this->getListingViewAllCategoriesDefaultWidgets();
    }

    /**
     * Returns the widgets that compose the Classified View All Categories
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getClassifiedViewAllCategoriesDefaultWidgets()
    {
        return $this->getListingViewAllCategoriesDefaultWidgets();
    }

    /**
     * Returns the widgets that compose the Article View All Categories
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getArticleViewAllCategoriesDefaultWidgets()
    {
        return $this->getListingViewAllCategoriesDefaultWidgets();
    }

    /**
     * Returns the widgets that compose the Deal View All Categories
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getDealViewAllCategoriesDefaultWidgets()
    {
        return $this->getListingViewAllCategoriesDefaultWidgets();
    }

    /**
     * Returns the widgets that compose the Blog View All Categories
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getBlogViewAllCategoriesDefaultWidgets()
    {
        return $this->getListingViewAllCategoriesDefaultWidgets();
    }

    /**
     * Returns the widgets that compose the Listing View All Location
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getListingViewAllLocationsDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'All Locations',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'All Locations',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'All Locations',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box',
                'Leaderboard ad bar (728x90)',
                'All Locations',
                'Banner Large Mobile, one banner Sponsored Links and one Google Ads',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Event View All Location
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getEventViewAllLocationsDefaultWidgets()
    {
        return $this->getListingViewAllLocationsDefaultWidgets();
    }

    /**
     * Returns the widgets that compose the Classified View All Location
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getClassifiedViewAllLocationsDefaultWidgets()
    {
        return $this->getListingViewAllLocationsDefaultWidgets();
    }

    /**
     * Returns the widgets that compose the Deal View All Location
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getDealViewAllLocationsDefaultWidgets()
    {
        return $this->getListingViewAllLocationsDefaultWidgets();
    }

    /**
     * Returns the widgets that compose the Listing Reviews
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getListingReviewsDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Search box for Reviews page',
                'Leaderboard ad bar (728x90)',
                'Reviews block',
                '3 rectangle ad bar',
                'Download our apps bar',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Search box for Reviews page',
                'Leaderboard ad bar (728x90)',
                'Reviews block',
                '3 rectangle ad bar',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Search box for Reviews page',
                'Leaderboard ad bar (728x90)',
                'Reviews block',
                '3 rectangle ad bar',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Search box for Reviews page',
                'Leaderboard ad bar (728x90)',
                'Reviews block',
                '3 rectangle ad bar',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->theme];
    }

    /**
     * Returns the widgets that compose the Article Reviews
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getArticleReviewsDefaultWidgets()
    {
        return $this->getListingReviewsDefaultWidgets();
    }

    /**
     * Returns the widgets that compose the Custom Page
     * Used for load data and reset feature at sitemgr
     *
     * @return mixed
     */
    public function getCustomPageDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Header',
                'Custom Content',
                'Footer',
            ],
            Theme::DOCTOR_THEME     => [
                'Header with Contact Phone',
                'Custom Content',
                'Footer with Newsletter',
            ],
            Theme::RESTAURANT_THEME => [
                'Navigation with left Logo plus Social Media',
                'Custom Content',
                'Footer with Logo',
            ],
            Theme::WEDDING_THEME    => [
                'Navigation with Centered Logo',
                'Custom Content',
                'Footer with Social Media',
            ],
        ];

        return $pageWidgetsTheme[$this->getSelectedTheme()->getTitle()];
    }

    /**
     * CUSTOM ADDPAGE
     * here are an example of how you can create the default widgets for a Page
     * these list will be used to reset the Page
     */
    /*public function getTestPageDefaultWidgets()
    {
        $pageWidgetsTheme = [
            Theme::DEFAULT_THEME    => [
                'Widget test',
            ],
            Theme::DOCTOR_THEME     => [
                'Widget test',
            ],
            Theme::RESTAURANT_THEME => [
                'Widget test',
            ],
            Theme::WEDDING_THEME    => [
                'Widget test',
            ],
        ];

        return $pageWidgetsTheme[$this->getSelectedTheme()->getTitle()];
    }*/


    //endregion

    /**
     * Returns an array with all the standard pages and its own array of default widgets
     * USED IN LOAD DATA
     *
     * @return array
     */
    public function getAllPageDefaultWidgets()
    {
        $pagesDefault = [];
        $pagesDefault[Wysiwyg::HOME_PAGE] = $this->getHomePageDefaultWidgets();
        $pagesDefault[Wysiwyg::RESULTS_PAGE] = $this->getDirectoryResultsDefaultWidgets();
        $pagesDefault[Wysiwyg::LISTING_HOME_PAGE] = $this->getListingHomeDefaultWidgets();
        $pagesDefault[Wysiwyg::LISTING_DETAIL_PAGE] = $this->getListingDetailDefaultWidgets();
        $pagesDefault[Wysiwyg::LISTING_REVIEWS] = $this->getListingReviewsDefaultWidgets();
        $pagesDefault[Wysiwyg::LISTING_CATEGORIES_PAGE] = $this->getListingViewAllCategoriesDefaultWidgets();
        $pagesDefault[Wysiwyg::LISTING_ALL_LOCATIONS] = $this->getListingViewAllLocationsDefaultWidgets();
        $pagesDefault[Wysiwyg::EVENT_HOME_PAGE] = $this->getEventHomeDefaultWidgets();
        $pagesDefault[Wysiwyg::EVENT_DETAIL_PAGE] = $this->getEventDetailDefaultWidgets();
        $pagesDefault[Wysiwyg::EVENT_CATEGORIES_PAGE] = $this->getEventViewAllCategoriesDefaultWidgets();
        $pagesDefault[Wysiwyg::EVENT_ALL_LOCATIONS] = $this->getEventViewAllLocationsDefaultWidgets();
        $pagesDefault[Wysiwyg::CLASSIFIED_HOME_PAGE] = $this->getClassifiedHomeDefaultWidgets();
        $pagesDefault[Wysiwyg::CLASSIFIED_DETAIL_PAGE] = $this->getClassifiedDetailDefaultWidgets();
        $pagesDefault[Wysiwyg::CLASSIFIED_CATEGORIES_PAGE] = $this->getClassifiedViewAllCategoriesDefaultWidgets();
        $pagesDefault[Wysiwyg::CLASSIFIED_ALL_LOCATIONS] = $this->getClassifiedViewAllLocationsDefaultWidgets();
        $pagesDefault[Wysiwyg::ARTICLE_HOME_PAGE] = $this->getArticleHomeDefaultWidgets();
        $pagesDefault[Wysiwyg::ARTICLE_DETAIL_PAGE] = $this->getArticleDetailDefaultWidgets();
        $pagesDefault[Wysiwyg::ARTICLE_REVIEWS] = $this->getArticleReviewsDefaultWidgets();
        $pagesDefault[Wysiwyg::ARTICLE_CATEGORIES_PAGE] = $this->getArticleViewAllCategoriesDefaultWidgets();
        $pagesDefault[Wysiwyg::DEAL_HOME_PAGE] = $this->getDealHomeDefaultWidgets();
        $pagesDefault[Wysiwyg::DEAL_DETAIL_PAGE] = $this->getDealDetailDefaultWidgets();
        $pagesDefault[Wysiwyg::DEAL_CATEGORIES_PAGE] = $this->getDealViewAllCategoriesDefaultWidgets();
        $pagesDefault[Wysiwyg::DEAL_ALL_LOCATIONS] = $this->getDealViewAllLocationsDefaultWidgets();
        $pagesDefault[Wysiwyg::BLOG_HOME_PAGE] = $this->getBlogHomeDefaultWidgets();
        $pagesDefault[Wysiwyg::BLOG_DETAIL_PAGE] = $this->getBlogDetailDefaultWidgets();
        $pagesDefault[Wysiwyg::BLOG_CATEGORIES_PAGE] = $this->getBlogViewAllCategoriesDefaultWidgets();
        $pagesDefault[Wysiwyg::CONTACT_US_PAGE] = $this->getContactUsDefaultWidgets();
        $pagesDefault[Wysiwyg::ADVERTISE_PAGE] = $this->getAdvertisewithUsDefaultWidgets();
        $pagesDefault[Wysiwyg::FAQ_PAGE] = $this->getFaqDefaultWidgets();
        $pagesDefault[Wysiwyg::TERMS_OF_SERVICE_PAGE] = $this->getTermsofServiceDefaultWidgets();
        $pagesDefault[Wysiwyg::PRIVACY_POLICY_PAGE] = $this->getPrivacyPolicyDefaultWidgets();
        $pagesDefault[Wysiwyg::SITEMAP_PAGE] = $this->getSitemapDefaultWidgets();
        $pagesDefault[Wysiwyg::MAINTENANCE_PAGE] = $this->getMaintenancePageDefaultWidgets();
        $pagesDefault[Wysiwyg::ERROR404_PAGE] = $this->getErrorPageDefaultWidgets();
        $pagesDefault[Wysiwyg::ITEM_UNAVAILABLE_PAGE] = $this->getItemUnavailablePageDefaultWidgets();
        /**
         * CUSTOM ADDPAGE
         *  you have to add these line to be used in loadPageWidgetData, and when the sitemgr changes the theme.
         */
        /*$pagesDefault[Wysiwyg::TEST_PAGE] = $this->getTestPageDefaultWidgets();*/

        return $pagesDefault;
    }

    /**
     * Returns all the pages that have some widget that has any content different from its default
     * USED IN LOAD DATA
     *
     * @return array
     */
    public function getDefaultSpecificWidgetContents()
    {
        $translator = $this->container->get('translator');
        $language = substr($this->container->get("multi_domain.information")->getLocale(), 0, 2);

        // Set specific contents
        $contents = [];
        $contents[Wysiwyg::EVENT_HOME_PAGE]['Search Bar'] = json_encode(['labelExploreAndFind' => 'Explore and find Events']);
        $contents[Wysiwyg::CLASSIFIED_HOME_PAGE]['Search Bar'] = json_encode(['labelExploreAndFind' => 'Explore and find Classifieds']);
        $contents[Wysiwyg::ARTICLE_HOME_PAGE]['Search Bar'] = json_encode(['labelExploreAndFind' => 'Explore and find Articles']);
        $contents[Wysiwyg::BLOG_HOME_PAGE]['Search Bar'] = json_encode(['labelExploreAndFind' => 'Explore and find Blog']);
        $contents[Wysiwyg::DEAL_HOME_PAGE]['Search Bar'] = json_encode(['labelExploreAndFind' => 'Explore and find Deals']);
        $contents[Wysiwyg::EVENT_DETAIL_PAGE]['Search box module detail'] = json_encode(['labelExploreModule' => 'Events']);
        $contents[Wysiwyg::CLASSIFIED_DETAIL_PAGE]['Search box module detail'] = json_encode(['labelExploreModule' => 'Explore Classifieds']);
        $contents[Wysiwyg::ARTICLE_DETAIL_PAGE]['Search box module detail'] = json_encode(['labelExploreModule' => 'Explore Articles']);
        $contents[Wysiwyg::BLOG_DETAIL_PAGE]['Search box Blog detail'] = json_encode(['labelExploreModule' => 'Explore our Blog']);
        $contents[Wysiwyg::DEAL_DETAIL_PAGE]['Search box module detail'] = json_encode(['labelExploreModule' => 'Explore Deals']);
        $contents[Wysiwyg::TERMS_OF_SERVICE_PAGE]['Custom Content'] = json_encode([
            'customHtml' => '<h2>'.$translator->trans('Terms of Use', [], 'messages',
                    $language).'</h2><p>&nbsp;</p><p>Pellentesque nulla sem, suscipit quis mattis et, imperdiet nec massa. Mauris faucibus fermentum aliquam. Aliquam commodo egestas iaculis. Pellentesque ut mauris nisi, commodo gravida elit. Phasellus eget diam eros. Donec ante velit, dignissim in congue eget, congue in quam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed ut ipsum nisi, ut pulvinar augue. Quisque blandit facilisis velit non ornare. Cras et urna nunc. Praesent non ante urna. Sed vehicula nulla sit amet lacus mattis scelerisque. Sed non felis arcu. Morbi congue aliquet ante, quis vestibulum ipsum gravida non. Sed ante felis, lobortis ac pharetra fermentum, aliquet id elit.<br /><br />Maecenas lobortis eleifend turpis, eu luctus sapien ultricies vitae. Aliquam erat volutpat. Nullam dolor odio, dapibus sed pellentesque nec, adipiscing eget quam. Integer mi sem, pharetra ac convallis eget, sodales in mauris. Suspendisse quis urna non nisl ullamcorper imperdiet a quis eros. Vivamus egestas posuere consequat. Nulla a commodo nunc. Morbi ut enim lectus, vitae pretium dui. Phasellus lacinia, lorem id malesuada luctus, enim augue fermentum augue, eu luctus dolor magna et turpis. Praesent vitae ornare mauris.<br /><br />Nam eget libero at tortor auctor placerat at vitae orci. Fusce tempus luctus dolor. Vivamus pharetra erat vitae ipsum pharetra ut tincidunt lacus pharetra. Sed viverra interdum fringilla. Aenean cursus nulla at neque luctus et pellentesque ante dignissim. Ut luctus odio et velit suscipit imperdiet. Cras semper, leo quis venenatis elementum, nibh diam blandit nulla, ut dictum ipsum lectus non diam. Vivamus ac convallis velit. Nulla est magna, bibendum eu luctus sed, dignissim in libero. Etiam sit amet purus ut odio mollis varius. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec non velit vel augue mollis blandit eu eu metus. Morbi dapibus porttitor scelerisque. Praesent ultricies erat ac nisi laoreet sit amet consequat leo fringilla. Fusce egestas neque ut nisl mattis eget dignissim elit accumsan. Phasellus mollis dapibus tristique. Sed ut velit non nibh sagittis ornare sed feugiat nibh.</p>',
        ]);
        $contents[Wysiwyg::PRIVACY_POLICY_PAGE]['Custom Content'] = json_encode([
            'customHtml' => '<h2>'.$translator->trans('Privacy Policy', [], 'messages',
                    $language).'</h2><p>&nbsp;</p><p>Pellentesque nulla sem, suscipit quis mattis et, imperdiet nec massa. Mauris faucibus fermentum aliquam. Aliquam commodo egestas iaculis. Pellentesque ut mauris nisi, commodo gravida elit. Phasellus eget diam eros. Donec ante velit, dignissim in congue eget, congue in quam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed ut ipsum nisi, ut pulvinar augue. Quisque blandit facilisis velit non ornare. Cras et urna nunc. Praesent non ante urna. Sed vehicula nulla sit amet lacus mattis scelerisque. Sed non felis arcu. Morbi congue aliquet ante, quis vestibulum ipsum gravida non. Sed ante felis, lobortis ac pharetra fermentum, aliquet id elit.<br /><br />Maecenas lobortis eleifend turpis, eu luctus sapien ultricies vitae. Aliquam erat volutpat. Nullam dolor odio, dapibus sed pellentesque nec, adipiscing eget quam. Integer mi sem, pharetra ac convallis eget, sodales in mauris. Suspendisse quis urna non nisl ullamcorper imperdiet a quis eros. Vivamus egestas posuere consequat. Nulla a commodo nunc. Morbi ut enim lectus, vitae pretium dui. Phasellus lacinia, lorem id malesuada luctus, enim augue fermentum augue, eu luctus dolor magna et turpis. Praesent vitae ornare mauris.<br /><br />Nam eget libero at tortor auctor placerat at vitae orci. Fusce tempus luctus dolor. Vivamus pharetra erat vitae ipsum pharetra ut tincidunt lacus pharetra. Sed viverra interdum fringilla. Aenean cursus nulla at neque luctus et pellentesque ante dignissim. Ut luctus odio et velit suscipit imperdiet. Cras semper, leo quis venenatis elementum, nibh diam blandit nulla, ut dictum ipsum lectus non diam. Vivamus ac convallis velit. Nulla est magna, bibendum eu luctus sed, dignissim in libero. Etiam sit amet purus ut odio mollis varius. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec non velit vel augue mollis blandit eu eu metus. Morbi dapibus porttitor scelerisque. Praesent ultricies erat ac nisi laoreet sit amet consequat leo fringilla. Fusce egestas neque ut nisl mattis eget dignissim elit accumsan. Phasellus mollis dapibus tristique. Sed ut velit non nibh sagittis ornare sed feugiat nibh.</p>',
        ]);
        $contents[Wysiwyg::MAINTENANCE_PAGE]['Custom Content'] = json_encode([
            'customHtml' => '<p style="color: #efefef; font-size: 150px; text-align: center;"><span class="fa-stack fa-lg"> <em class="fa fa-circle fa-stack-2x"></em>&nbsp; <em class="fa fa-coffee fa-stack-1x fa-inverse"></em></span></p>
                                    <h1 style="text-align: center;"><span style="color: #cdcdcd; font-size: 30px; text-transform: uppercase;">'.$translator->trans('We are under maintenance',
                    [], 'widgets', $language).'</span></h1>
                                    <p style="text-align: center;"><span style="color: #999999;">&nbsp;</span></p>
                                    <p style="text-align: center;"><span style="color: #999999; font-size: 16px;">'.$translator->trans('Please come back later',
                    [], 'widgets', $language).'</span></p>',
        ]);
        $contents[Wysiwyg::ERROR404_PAGE]['Custom Content'] = json_encode([
            'customHtml' => '<h1 style="text-align: center;"><span style="color: #efefef; font-size: 300px;">404</span></h1>
                                        <p style="text-align: center;">&nbsp;</p>
                                        <h2 style="text-align: center;"><span style="color: #cdcdcd; font-size: 50px;">'.$translator->trans('Oops',
                    [], 'widgets', $language).'</span></h2>
                                        <p style="text-align: center;"><span style="color: #999999;">&nbsp;</span></p>
                                        <p style="text-align: center;"><span style="color: #999999; font-size: 24px;">'.$translator->trans('We couldn\'t find the page you are looking for.',
                    [], 'widgets', $language).'</span></p>
                                        <p style="text-align: center;"><span style="color: #999999;">&nbsp;</span></p>
                                        <p style="text-align: center;"><span style="color: #999999; font-size: 16px;">'.$translator->trans('Have you tried the search option to easily find what you are looking for?',
                    [], 'widgets', $language).'</span></p>
                                        <p style="text-align: center;"><span style="color: #999999;">...</span></p>',
        ]);
        $contents[Wysiwyg::ITEM_UNAVAILABLE_PAGE]['Custom Content'] = json_encode([
            'customHtml' => '<div class="container well well-light">
                                <div class="col-sm-12 search-toolbar">
                                    <div class="panel panel-default">
                    
                                        <div class="panel-body">
                                            <h1 class="panel-title small">'.$translator->trans('Sorry, this item isn\'t currently available.',
                    [], 'widgets', $language).'</h1>
                    
                                            <hr>
                                            <br>
                                            <h4>'.$translator->trans('This item was either temporarily suspended or deleted. Here are some suggestions to help you',
                    [], 'widgets', $language).':</h4>
                                            <ul>
                                                <li>'.$translator->trans('Start a new search to seek for similar items',
                    [], 'widgets', $language).'</li>
                                                <li>'.$translator->trans('Come back soon to check this page', [],
                    'widgets', $language).'</li>
                                                <li>'.$translator->trans('Is this item yours? %link_start%Contact us%link_end% for more information about it.',
                    [
                        '%link_start%' => '<a href="'.$this->container->get('router')->generate('web_contactus').'">',
                        '%link_end%'   => '</a>',
                    ], 'account', $language).'</li>
                                            </ul>
                                            <br><br>
                                        </div>
                                        <div class="panel-footer">
                                            '.$translator->trans('Try a search or send %link_start%enquiry%link_end% to request information',
                    [
                        '%link_start%' => '<a href="'.$this->container->get('router')->generate('web_contactus').'">',
                        '%link_end%'   => '</a>',
                    ], 'account', $language).'                                            
                                        </div>
                                    </div>
                                </div>
                            </div>',
        ]);
        $contents[Wysiwyg::LISTING_CATEGORIES_PAGE]['All Categories'] = json_encode(['labelExploreAllCategories' => 'Explore All Listings Categories']);
        $contents[Wysiwyg::ARTICLE_CATEGORIES_PAGE]['All Categories'] = json_encode(['labelExploreAllCategories' => 'Explore All Articles Categories']);
        $contents[Wysiwyg::CLASSIFIED_CATEGORIES_PAGE]['All Categories'] = json_encode(['labelExploreAllCategories' => 'Explore All Classifieds Categories']);
        $contents[Wysiwyg::EVENT_CATEGORIES_PAGE]['All Categories'] = json_encode(['labelExploreAllCategories' => 'Explore All Events Categories']);
        $contents[Wysiwyg::DEAL_CATEGORIES_PAGE]['All Categories'] = json_encode(['labelExploreAllCategories' => 'Explore All Deals Categories']);
        $contents[Wysiwyg::BLOG_CATEGORIES_PAGE]['All Categories'] = json_encode(['labelExploreAllCategories' => 'Explore All Blog Categories']);
        $contents[Wysiwyg::LISTING_ALL_LOCATIONS]['All Locations'] = json_encode(['labelExploreAllLocations' => 'Explore All Listings Locations']);
        $contents[Wysiwyg::EVENT_ALL_LOCATIONS]['All Locations'] = json_encode(['labelExploreAllLocations' => 'Explore All Events Locations']);
        $contents[Wysiwyg::CLASSIFIED_ALL_LOCATIONS]['All Locations'] = json_encode(['labelExploreAllLocations' => 'Explore All Classifieds Locations']);
        $contents[Wysiwyg::DEAL_ALL_LOCATIONS]['All Locations'] = json_encode(['labelExploreAllLocations' => 'Explore All Deal Locations']);

        return $contents;
    }

    /**
     * Return the base url to the wysiwyg pages
     *
     * @param string $pageType
     * @return string
     */
    public function getBaseUrl($pageType)
    {
        $uri = '';
        switch ($pageType) {
            case self::LISTING_ALL_LOCATIONS:
            case self::LISTING_CATEGORIES_PAGE:
            case self::LISTING_REVIEWS:
                $uri = $this->container->getParameter('alias_listing_module');
                break;
            case self::ARTICLE_CATEGORIES_PAGE:
            case self::ARTICLE_REVIEWS:
                $uri = $this->container->getParameter('alias_article_module');
                break;
            case self::BLOG_CATEGORIES_PAGE:
                $uri = $this->container->getParameter('alias_blog_module');
                break;
            case self::CLASSIFIED_ALL_LOCATIONS:
            case self::CLASSIFIED_CATEGORIES_PAGE:
                $uri = $this->container->getParameter('alias_classified_module');
                break;
            case self::DEAL_ALL_LOCATIONS:
            case self::DEAL_CATEGORIES_PAGE:
                $uri = $this->container->getParameter('alias_promotion_module');
                break;
            case self::EVENT_ALL_LOCATIONS:
            case self::EVENT_CATEGORIES_PAGE:
                $uri = $this->container->getParameter('alias_event_module');
                break;
        }

        return DEFAULT_URL.(($uri) ? '/'.$uri : $uri);
    }

    /**
     * @param $page Page
     * @return string
     */
    public function getFinalPageUrl($page)
    {
        $pageTypeTitle = $page->getPageType()->getTitle();

        $pageUrl = $this->getBaseUrl($pageTypeTitle).'/'.$page->getUrl();
        $pageUrl .= $pageTypeTitle == self::CUSTOM_PAGE ? '.html' : '';

        return $pageUrl;
    }

    /**
     * @param string $pageUrl The Page Url
     * @param string $pageType The Title of the PageType
     * @return bool|void
     */
    public function saveUrl($pageUrl, $pageType)
    {
        if ($pageType == self::CUSTOM_PAGE) {
            return false;
        }

        try {
            $url = [$this->urlToRoute[$pageType] => $pageUrl];

            // Saves configuration in yaml file
            $domain = new \Domain(SELECTED_DOMAIN_ID);
            $classSymfonyYml = new \Symfony('domains/'.$domain->getString('url').'.route.yml');
            $classSymfonyYml->save('Configs', ['parameters' => $url]);

            $fileConstPath = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/conf/constants.inc.php";
            system_writeConstantsFile($fileConstPath, SELECTED_DOMAIN_ID, $url);
        } catch (Exception $exception) {
            $this->container->get('logger')->error("Page Editor: Error on save page url in yaml and constants files, [$exception->getMessage()]");
        }
    }

    /**
     * @param string $pageType The title of the PageType
     * @return array
     */
    public function getMessageUrlConfirmation($pageType)
    {
        $return = [
            'no' => '',
            ``,
        ];

        $translator = $this->container->get('translator');
        setting_get("sitemgr_language", $sitemgr_language);
        $sitemgrLanguage = substr($sitemgr_language, 0, 2);

        switch ($pageType) {
            case self::LISTING_ALL_LOCATIONS:
            case self::EVENT_ALL_LOCATIONS:
            case self::CLASSIFIED_ALL_LOCATIONS:
            case self::DEAL_ALL_LOCATIONS:
                $return['text'] = $translator->trans('The new page URL will be applied for all locations page.', [],
                    'messages', $sitemgrLanguage);
                $return['yes'] = $translator->trans('Ok, continue', [], 'messages', $sitemgrLanguage);
                $return['replica'] = 'location';
                break;
            case self::LISTING_CATEGORIES_PAGE:
            case self::DEAL_CATEGORIES_PAGE:
            case self::CLASSIFIED_CATEGORIES_PAGE:
            case self::ARTICLE_CATEGORIES_PAGE:
            case self::EVENT_CATEGORIES_PAGE:
            case self::BLOG_CATEGORIES_PAGE:
                $return['text'] = $translator->trans('Would you like to update the page URL for all categories pages with the same value of this page?',
                    [], 'messages', $sitemgrLanguage);
                $return['yes'] = $translator->trans('Ok, continue', [], 'messages', $sitemgrLanguage);
                $return['no'] = $translator->trans('No', [], 'messages', $sitemgrLanguage);
                $return['replica'] = 'category';
                break;
            case self::ARTICLE_REVIEWS:
            case self::LISTING_REVIEWS:
                $return['text'] = $translator->trans('The new page URL will be applied for all reviews page.', [],
                    'messages', $sitemgrLanguage);
                $return['yes'] = $translator->trans('Ok, continue', [], 'messages', $sitemgrLanguage);
                $return['replica'] = 'review';
                break;
        }

        return $return;
    }

    /**
     * @param string $type
     * @return array
     */
    public function getCustomContentAndTitlePerPageType($type)
    {
        $pageType = $this->container->get('doctrine')->getRepository('WysiwygBundle:PageType')->findOneBy(['title' => $type]);

        $pageType && $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->findOneBy(['pageTypeId' => $pageType->getId()]);
        $page && $customContent = $this->container->get('doctrine')->getRepository('WysiwygBundle:Widget')
            ->findOneBy(['title' => 'Custom Content']);

        $customContent && $customWidgets = $this->container->get('doctrine')->getRepository('WysiwygBundle:PageWidget')
            ->findBy([
                'pageId'   => $page->getId(),
                'themeId'  => $this->getSelectedTheme()->getId(),
                'widgetId' => $customContent->getId(),
            ], ['order' => 'ASC']);

        $html = '';
        if ($customWidgets) {
            $count = 0;
            foreach ($customWidgets as $eachCustomWidget) {
                $content = json_decode($eachCustomWidget->getContent());
                $html .= ($count ? '<br />' : '').$content->{'customHtml'};
                $count++;
            }
        }

        return ['title' => $page ? $page->getTitle() : '', 'body' => $html];
    }

    /**
     * Returns widgets that cannot exist more than once on each page
     *
     * @return array
     */
    public function getWidgetNonDuplicate()
    {
        return $this->widgetNonDuplicate;
    }

    /**
     * @param int $pageId The Page Id
     * @return array
     */
    public function getPageWidget($pageId)
    {
        $return = [];

        $pageWidgets = $this->container->get('doctrine')->getRepository('WysiwygBundle:PageWidget')->findBy([
            'pageId'  => $pageId,
            'themeId' => $this->getSelectedTheme()->getId(),
        ]);

        /** @var PageWidget $pageWidget */
        foreach ($pageWidgets as $pageWidget) {
            /** @var Widget $widget */
            $widget = $pageWidget->getWidget();
            $return[$widget->getTitle()] = $widget;
        }

        return $return;
    }

    /**
     * @param $content
     * @param $trans
     * @return string
     */
    public function getGenericLabelInputs($content, $trans)
    {
        $inputs = '';
        foreach ($content as $key => $value) {
            if (strpos($key, 'label') !== false) {
                $inputs .= "<div class=\"form-group\">"
                    ."<label for=\"".$key."\" class=\"control-label\">".$trans[$key]."</label>"
                    ."<input type=\"text\" class=\"form-control\" name=\"".$key."\" value=\"".$value."\" id=\"".$key."\">"
                    ."</div>";
            } else {
                if (strpos($key, 'datainfo') === false) {
                    $inputs .= "<input type=\"hidden\" name=\"'.$key.'\" value=\".$value.'\" />";
                }
            }
        }

        return $inputs;
    }

    /**
     * This function returns the name of the twig file of the most used widget of its type
     * Is used to get the footer and header file name to profile and sponsor area.
     *
     * @param $widgetType
     * @return mixed
     */
    public function getWidgetFileName($widgetType)
    {
        $theme = $this->getSelectedTheme();

        /* get a list of widgets of a type order by how many pages contain it */
        $footerWidgets = $this->container->get("doctrine")->getRepository("WysiwygBundle:Widget")
            ->getWidgetsMostUsedByType($widgetType, $theme->getId());

        /* pick the first widget in the array which is the most used */
        /* @var Widget $mostUsedWidget */
        $mostUsedWidget = $footerWidgets[0];

        $twigFileParts = explode('/', $mostUsedWidget->getTwigFile());
        $lastPart = end($twigFileParts);

        return str_replace(".html.twig", "", $lastPart);

    }
}
