<?php

namespace ArcaSolutions\ApiBundle\Documents;


use ArcaSolutions\CoreBundle\Inflector;
use ArcaSolutions\CoreBundle\Services\Modules;
use ArcaSolutions\CoreBundle\Services\Settings;
use ArcaSolutions\WebBundle\Entity\SettingNavigation;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\AssetsHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Translation\TranslatorInterface;

class ConfigDocument
{
    const CUSTOM_PREFIX = 'cp_';
    const CUSTOM_TYPE_NAME = 'custom';
    const HOME_TYPE_NAME = 'home';
    const DEFAULT_COLOR = '4698db';
    const DEFAULT_TINT = '89b1d2';

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Settings
     */
    protected $settings;

    /**
     * @var DataCollectorTranslator
     */
    protected $translator;

    /**
     * @var Registry
     */
    protected $doctrine;

    /**
     * @var AssetsHelper
     */
    protected $assetsHelper;

    /**
     * @var Modules
     */
    protected $modules;

    /**
     * @var array
     */
    protected $colorModules = [
        'listing'    => 'be8885',
        'article'    => 'e88f30',
        'event'      => '278c90',
        'deal'       => 'bc6baa',
        'classified' => '867fb6',
        'blog'       => '5e96c6',
    ];

    /**
     * @var array
     */
    private $content;

    /**
     * @var array
     */
    private $theme;

    /**
     * @var array
     */
    private $menu;

    /**
     * @var array
     */
    private $about;

    /**
     * @var array
     */
    private $socialNetworks = [
        'linkedin'   => 'setting_linkedin_link',
        'facebook'   => 'setting_facebook_link',
        'instagram'  => 'setting_instagram_link',
        'googleplus' => 'setting_googleplus_link',
        'pintrest'   => 'setting_pinterest_link',
        'twitter'    => 'twitter_account',
    ];

    /**
     * configDocument constructor.
     *
     * @param Request $request
     * @param Settings $settings
     * @param TranslatorInterface $translator
     * @param Registry $doctrine
     * @param AssetsHelper $assetsHelper
     * @param Modules $modules
     */
    public function __construct(
        Request $request,
        Settings $settings,
        TranslatorInterface $translator,
        Registry $doctrine,
        AssetsHelper $assetsHelper,
        Modules $modules
    ) {
        $this->settings = $settings;
        $this->translator = $translator;
        $this->doctrine = $doctrine;
        $this->request = $request;
        $this->assetsHelper = $assetsHelper;
        $this->modules = $modules;
    }

    /**
     * @return array
     */
    public function getContent()
    {
        if ($this->content === null) {
            $this->buildContent();
        }

        return $this->content;
    }

    private function buildContent()
    {
        /** Module active */
        $reviewModule = [];
        $this->settings->getDomainSetting('review_listing_enabled') == 'on' and $reviewModule[] = 'listing';
        $this->settings->getDomainSetting('review_article_enabled') == 'on' and $reviewModule[] = 'article';

        /** Module force login */
        $reviewLogin = [];
        $this->settings->getSettingSocialNetwork('listing_rate') == 'yes' and $reviewLogin[] = 'listing';
        $this->settings->getSettingSocialNetwork('article_rate') == 'yes' and $reviewLogin[] = 'article';

        $reviews = null;
        if (count($reviewModule) > 0) {
            $reviews = [
                "requiredFields" => $this->settings->getDomainSetting('review_manditory') == 'on' ? true : false,
                "forceLogin"     => $reviewLogin,
                "modules"        => $reviewModule,
            ];
        }

        $this->content = [
            "currency"      => $this->settings->getSettingPayment('CURRENCY_SYMBOL'),
            "distanceUnity" => $this->translator->trans('distance.unit', [], 'units'),
            "dateFormat"    => $this->translator->trans('date.format', [], 'units'),
            "reviews"       => $reviews,
        ];
    }

    /**
     * @return array
     */
    public function getTheme()
    {
        if ($this->theme === null) {
            $this->buildTheme();
        }

        return $this->theme;
    }


    private function buildTheme()
    {
        /* Default Color */
        $colors = explode('-', $this->settings->getDomainSetting('appbuilder_colorscheme'), 2);

        $this->theme = [
            'primary' => self::DEFAULT_COLOR,
            'tint'    => self::DEFAULT_TINT,
        ];

        if (count($colors) == 2) {
            if ($colors[0] !== null and $colors[0] != '') {
                $this->theme['primary'] = $colors[0];
            }

            if ($colors[1] !== null and $colors[1] != '') {
                $this->theme['tint'] = $colors[1];
            }
        }

        /* Modules Colors */
        foreach ($this->colorModules as $module => $color) {
            if ($this->modules->isModuleAvailable($module)) {
                /* Blog is post in settings */
                $_module = $module;
                $_module == 'blog' and $_module = 'post';
                $_module == 'deal' and $_module = 'promotion';

                /* Default Color */
                $this->theme[$module] = $color;

                /* User Color */
                $settingColor = 'appbuilder_colorscheme_'.$_module;
                $color = $this->settings->getDomainSetting($settingColor);
                if ($color !== null and $color != '') {
                    $this->theme[$module] = $color;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getMenu()
    {
        if ($this->menu === null) {
            $this->buildMenu();
        }

        return $this->menu;
    }

    private function buildMenu()
    {
        $menuItems = $this->settings->getNavigationSetting('tabbar');
        $modulesAvailable = $this->modules->getAvailableModules();

        /** @var SettingNavigation $item */
        foreach ($menuItems as $key => $item) {
            $menuItems[$key] = [
                'type'  => $item->getLink(),
                'label' => /** @Ignore */
                    $item->getLabel(),
            ];

            $custom = mb_strpos($item->getLink(), self::CUSTOM_PREFIX);
            if ($custom !== false) {
                /** Gets Custom Page */
                list(, $cpId) = explode("_", $item->getLink());
                $customPage = $this->doctrine->getRepository("WebBundle:Appcustompages")->find($cpId);
                $menuItems[$key]['type'] = self::CUSTOM_TYPE_NAME;
                $menuItems[$key]['icon'] = sprintf("%s/assets/icons/api/%s.png", $this->request->getSchemeAndHttpHost(),
                    $customPage->getIcon(), 'png');
                $menuItems[$key]['id'] = $cpId;
            } else {
                /* Check module available */
                if ($menuItems[$key]['type'] != self::HOME_TYPE_NAME) {
                    $module = Inflector::singularize($menuItems[$key]['type']);
                    $module == 'deal' and $module = 'promotion';
                    if (isset($modulesAvailable[$module]) && $modulesAvailable[$module] === false) {
                        unset($menuItems[$key]);
                    }

                }
            }
        }

        $this->menu = array_values($menuItems);
    }

    /**
     * @return array
     */
    public function getAbout()
    {
        if ($this->about === null) {
            $this->buildAbout();
        }

        return $this->about;
    }

    private function buildAbout()
    {
        /** Sets Url to Cover Image */
        $coverImage = null;
        $logoID = $this->settings->getDomainSetting('appbuilder_logo_id');
        $logoExtension = $this->settings->getDomainSetting('appbuilder_logo_extension');
        if ($logoID && $logoExtension) {
            $coverName = sprintf("appbuilder_logo_%s.%s", $logoID, $logoExtension);
            $coverPath = $this->assetsHelper->getUrl($coverName, 'domain_content');
            $coverImage = $this->request->getSchemeAndHttpHost() . $coverPath;
        }

        /** Sets SocialNetwork */
        $socialNetwork = [];
        foreach ($this->socialNetworks as $key => $name) {
            if ($link = $this->settings->getDomainSetting($name)) {
                $socialNetwork[$key] = $key == 'twitter' ? 'https://twitter.com/'.$link : $link;
            }
        }

        /** Sets Address information */
        $contactAddress = $this->settings->getDomainSetting('contact_address');
        $contactCity = $this->settings->getDomainSetting('contact_city');
        $contactState = $this->settings->getDomainSetting('contact_state');

        $addressInfo = array();
        if ($contactAddress) {
            $addressInfo[] = $contactAddress;
        }
        if ($contactCity) {
            $addressInfo[] = $contactCity;
        }
        if ($contactState) {
            $addressInfo[] = $contactState;
        }

        $address = implode($addressInfo, ", ");

        $contactZipcode = $this->settings->getDomainSetting('contact_zipcode');
        $contactCountry = $this->settings->getDomainSetting('contact_country');

        $addressInfo = array();
        if ($contactZipcode) {
            $addressInfo[] = $contactZipcode;
        }
        if ($contactCountry) {
            $addressInfo[] = $contactCountry;
        }

        $address = $address.($address ? " " : "").implode($addressInfo, ", ");

        /** Sets Lat/long information */
        $geoInfo = null;
        $contactLat = $this->settings->getDomainSetting('contact_latitude');
        $contactLong = $this->settings->getDomainSetting('contact_longitude');
        if ($contactLat && $contactLong) {
            $geoInfo = [
                'lat' => $this->settings->getDomainSetting('contact_latitude'),
                'lng' => $this->settings->getDomainSetting('contact_longitude'),
            ];
        }

        $this->about = [
            'text'    => $this->settings->getDomainSetting('appbuilder_about_text'),
            'email'   => $this->settings->getDomainSetting('appbuilder_about_email'),
            'phone'   => $this->settings->getDomainSetting('appbuilder_about_phone'),
            'website' => $this->settings->getDomainSetting('appbuilder_about_website'),
            'cover'   => $coverImage,
            'address' => $address,
            'geo'     => $geoInfo,
            'social'  => $socialNetwork,
        ];
    }

    /**
     * Returns the url of the icon and splash
     *
     * @return array|null
     */
    public function getPreviewer()
    {
        $iconExt = $this->settings->getDomainSetting('appbuilder_icon_extension');
        $iconId = $this->settings->getDomainSetting('appbuilder_icon_id');
        $splashExt = $this->settings->getDomainSetting('appbuilder_splash_extension');
        $splashId = $this->settings->getDomainSetting('appbuilder_splash_id');
        $iconUrl = null;
        $splashUrl = null;

        if ($iconId && $iconExt) {
            $iconName = sprintf("appbuilder_icon_%s.%s", $iconId, $iconExt);
            $iconPath = $this->assetsHelper->getUrl($iconName, 'domain_content');
            $iconUrl = $this->request->getSchemeAndHttpHost() . $iconPath;
        }
        if ($splashId && $splashExt) {
            $splashName = sprintf("appbuilder_splash_%s.%s", $splashId, $splashExt);
            $splashPath = $this->assetsHelper->getUrl($splashName, 'domain_content');
            $splashUrl = $this->request->getSchemeAndHttpHost() . $splashPath;
        }

        return  $iconUrl || $splashUrl? ['icon' => $iconUrl, 'splash' => $splashUrl] : null;
    }
}
