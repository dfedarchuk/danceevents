<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use ArcaSolutions\CoreBundle\Services\Settings;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ParametersExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var object
     */
    protected $domain = null;

    /**
     * @var Settings
     */
    protected $settings;

    /**
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
            new \Twig_SimpleFunction(
                'getParameter',
                [$this, 'getParameter'],
                ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'getDomainParameter',
                [$this, 'getDomainParameter'],
                ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'getSetting',
                [$this, 'getSetting'],
                ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'getSettingSearchTag',
                [$this, 'getSettingSearchTag'],
                ['is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction(
                'getGoogleSetting',
                [$this, 'getGoogleSetting'],
                ['is_safe' => ['html']]
            ),
        ];
    }

    /**
     * Returns the value of named parameter from domain parameters
     * It use getters functions to get parameters
     *
     * @param string $parameterName
     *
     * @return string
     */
    public function getDomainParameter($parameterName)
    {
        if (is_null($this->domain)) {
            $this->domain = $this->container->get('multi_domain.information');
        }

        $parameterName = ucfirst($parameterName);

        return $this->domain->{'get'.$parameterName}();
    }

    /**
     * Returns the value of named parameter
     *
     * @param string $parameterName
     *
     * @return string
     */
    public function getParameter($parameterName)
    {
        return $this->container->getParameter($parameterName);
    }

    /**
     * Returns the value from settings table
     *
     * @param $key
     *
     * @return mixed|null|string
     */
    public function getSetting($key)
    {
        return $this->settings->getDomainSetting($key);
    }

    /**
     * Returns the value from google settings table
     *
     * @param $key
     *
     * @return mixed|null|string
     */
    public function getGoogleSetting($key)
    {
        return $this->settings->getSettingGoogle($key);
    }

    /**
     * Returns the value from settings search tag table
     *
     * @param $key
     *
     * @return mixed|string
     */
    public function getSettingSearchTag($key)
    {
        return $this->settings->getSettingSearchTag($key);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'parameters';
    }
}
