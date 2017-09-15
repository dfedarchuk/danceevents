<?php
namespace ArcaSolutions\WebBundle\Services;

use ArcaSolutions\CoreBundle\Services\Modules;
use ArcaSolutions\MultiDomainBundle\Doctrine\DoctrineRegistry;
use ArcaSolutions\MultiDomainBundle\Services\Settings;
use ArcaSolutions\WebBundle\Entity\SettingNavigation;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class NavigationHandler
 * @package ArcaSolutions\WebBundle\Services
 */
final class NavigationHandler
{
    /**
     * @var Settings
     */
    private $multidomainSettings;

    /**
     * @var DoctrineRegistry
     */
    private $doctrine;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Modules
     */
    private $modules;

    /**
     * NavigationHandler constructor.
     * @param Settings $multidomainSettings
     * @param DoctrineRegistry $doctrine
     * @param ContainerInterface $container
     * @param Modules $modules
     */
    public function __construct(Settings $multidomainSettings, DoctrineRegistry $doctrine, ContainerInterface $container, Modules $modules)
    {
        $this->multidomainSettings = $multidomainSettings;
        $this->doctrine = $doctrine;
        $this->container = $container;
        $this->modules = $modules;
    }

    /**
     * Gets header menu
     *
     * @return array
     * @throws \Exception
     */
    public function getHeader()
    {
        $settingNavigation = $this->doctrine->getRepository('WebBundle:SettingNavigation');
        $settingNavigation->clear();
        $menu = $settingNavigation->getMenuByArea('header');

        $this->removesDisabledModules($menu);

        return $this->translateLinks($menu);
    }

    /**
     * It removes disabled modules from menu directly
     *
     * @param array $menu
     */
    private function removesDisabledModules(&$menu = [])
    {
        $modules_available = $this->modules->getAvailableModules();

        foreach ($menu as $key => $item) {
            /* @var SettingNavigation $item */

            /* skip item if it is a custom link */
            if ('y' == $item->getCustom()) {
                continue;
            }

            /* skip item if it is the main home page link */
            if ('DEFAULT_URL' == $item->getLink()) {
                continue;
            }

            /* skip item if it is from advertise, contact us, faq, sitemap, terms of use or privacy plocy */
            if (false !== strpos($item->getLink(), 'ALIAS')) {
                continue;
            }

            /* getting module's name by link */
            $module = explode('_', $item->getLink());
            $module = current($module);
            $module = strtolower($module);
            /* it is enabled or not */
            if ($modules_available[$module] === false) {
                unset($menu[$key]);
            }
        }
    }

    /**
     * Substitutes links from DB to symfony's way
     *
     * @param array $menu
     *
     * @return array|null
     */
    private function translateLinks($menu = [])
    {
        if (empty($menu)) {
            return null;
        }

        foreach ($menu as $item) {
            /* @var SettingNavigation $item */
            if ('n' != $item->getCustom()) {
                continue;
            }

            $link = $item->getLink();

            if ($link == 'DEFAULT_URL') {
                /* homepage */
                $link = 'web_homepage';
            } elseif (false === strpos($link, 'ALIAS')) {
                /* when it is not a real module */
                $link = substr($link, 0, strpos($link, '_')) . '_homepage';
            } else {
                /* constant with ALIAS, get the middle word */
                $link = explode('_', $link);
                $link = 'web_' . $link[1];
            }

            $link = strtolower($link);

            $item->setLink($link);

            /* it should changes the link of terms, privacy, sitemap */
            $this->replacesRoutes($item);
        }

        return $menu;
    }

    /**
     * Replaces routes that don't match or aren't in symfony's way
     *
     * @param SettingNavigation $item
     */
    private function replacesRoutes(SettingNavigation $item)
    {
        $replace_route = $this->getRoutesToReplace();
        if (!array_key_exists($item->getLink(), $replace_route)) {
            return;
        }

        /* replace route */
        $item->setLink($replace_route[$item->getLink()]);

        /* terms|privacy|sitemap must be a custom link, for now */
        if (strpos($item->getLink(), $this->container->getParameter('alias_terms_url_divisor')) !== false
            || strpos($item->getLink(), $this->container->getParameter('alias_privacy_url_divisor')) !== false
            || strpos($item->getLink(), $this->container->getParameter('alias_sitemap_url_divisor')) !== false
        ) {
            $item->setCustom('y');
        }
    }

    /**
     * It's used to change de url that sitemgr uses to symfony
     *
     * @return array
     */
    private function getRoutesToReplace()
    {
        return [
            'contactus_page' => 'web_contactus',
            'promotion_homepage' => 'deal_homepage',
            'web_terms' => '/' . $this->container->getParameter('alias_terms_url_divisor'),
            'web_privacy' => '/' . $this->container->getParameter('alias_privacy_url_divisor'),
            'web_sitemap' => '/' . $this->container->getParameter('alias_sitemap_url_divisor')
        ];
    }

    /**
     * Gets footer menu
     *
     * @return array|null
     * @throws \Exception
     */
    public function getFooter()
    {
        $menu = $this->doctrine->getRepository('WebBundle:SettingNavigation')->getMenuByArea('footer');

        $this->removesDisabledModules($menu);

        return $this->translateLinks($menu);
    }
}
