<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use ArcaSolutions\CoreBundle\Services\Settings;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GoogleTagsExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Settings
     */
    protected $settings;

    /**
     * GoogleTagsExtension constructor.
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
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('googleTagAnalytics', [$this, 'googleTagAnalytics'], [
                'needs_environment' => true,
                'is_safe' => ['html', 'meta']
            ]),
            new \Twig_SimpleFunction('googleTagManager', [$this, 'googleTagManager'], [
                'needs_environment' => true,
                'is_safe' => ['html', 'meta']
            ])
        ];
    }

    /**
     * Return google analytic code
     *
     * @param \Twig_Environment $twig
     *
     * @return string
     */
    public function googleTagAnalytics(\Twig_Environment $twig)
    {
        if ($this->settings->getSettingGoogle('analytics_front') == 'on') {
            return $twig->render('::blocks/google-analytics.js.twig', array(
                'code' => $this->settings->getSettingGoogle('analytics_account')
            ));
        }

        return '';
    }

    /**
     * Returns google tag manager
     *
     * @param \Twig_Environment $twig_Environment
     *
     * @return string
     */
    public function googleTagManager(\Twig_Environment $twig_Environment)
    {
        if ($this->settings->getSettingGoogle('tag_status') == 'on') {
            return $twig_Environment->render('::blocks/google-tag-manager.html.twig',
                array(
                    'code' => $this->settings->getSettingGoogle('tag_client')
                ));
        }

        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'google_extension';
    }
}
