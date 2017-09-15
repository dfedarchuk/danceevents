<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class NavigationExtension extends \Twig_Extension
{
    /**
     * ContainerInterface
     *
     * @var object
     */
    protected $container;

    /**
     * @param $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('navigationHeader', [$this, 'navigationHeader'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('navigationFooter', [$this, 'navigationFooter'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
        ];
    }

    /**
     * Render header navigation view
     *
     * @param \Twig_Environment $twig_Environment
     * @param $content
     *
     * @return string
     */
    public function navigationHeader(\Twig_Environment $twig_Environment, $content = null, $widget = null)
    {
        $items = $this->container->get('navigation.handler')->getHeader();

        // doesn't have items
        if (false === $items) {
            return '';
        }
        $twigFile = '::blocks/navigation/header-navigation';
        $twigFile .= $widget? $widget.'.html.twig' : '.html.twig';

        return $twig_Environment->render($twigFile, [
            'items'   => $items,
            'content' => $content,
        ]);
    }

    /**
     * Render footer navigation view
     *
     * @param \Twig_Environment $twig_Environment
     * @param string $content
     *
     * @return string
     */
    public function navigationFooter(\Twig_Environment $twig_Environment, $content = null, $widget = null)
    {
        $items = $this->container->get('navigation.handler')->getFooter();

        // doesn't have items
        if (false === $items) {
            return '';
        }

        $twigFile = '::blocks/navigation/footer-navigation';
        $twigFile .= $widget? $widget.'.html.twig': '.html.twig';
        return $twig_Environment->render($twigFile,
            [
                'items'   => $items,
                'content' => $content,
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'navigation_front';
    }
}
