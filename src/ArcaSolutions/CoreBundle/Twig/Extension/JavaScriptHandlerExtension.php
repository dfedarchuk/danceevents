<?php

namespace ArcaSolutions\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\Container;

class JavaScriptHandlerExtension extends \Twig_Extension
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'renderJS',
                [$this, 'render'],
                ['is_safe' => ['all']]
            ),
            new \Twig_SimpleFunction(
                'addJSTwig',
                [$this, 'addJSTwig']
            ),
            new \Twig_SimpleFunction(
                'addJSTwigParameter',
                [$this, 'addJSTwigParameter']
            ),
            new \Twig_SimpleFunction(
                'addJSFile',
                [$this, 'addJSFile']
            )
        ];
    }

    /**
     * Twig extension that renders the banners
     *
     * @return string
     */
    public function render()
    {
        return $this->container->get("javascripthandler")->render();
    }

    public function addJSTwig($path)
    {
        $this->container->get("javascripthandler")->addJSBlock($path);
    }

    public function addJSTwigParameter($id, $value)
    {
        $this->container->get("javascripthandler")->addTwigParameter($id, $value);
    }

    public function addJSFile($path)
    {
        $this->container->get("javascripthandler")->addJSExternalFile($path);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'javaScriptHandler';
    }
}
