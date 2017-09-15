<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class CopyrightExtension extends \Twig_Extension
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
            new \Twig_SimpleFunction(
                'copyright',
                [$this, 'copyright'],
                ['needs_environment' => true, 'is_safe' => ['html']]
            ),
            new \Twig_SimpleFunction('getUrlEdirectory', [$this, 'getUrlEdirectory'])
        ];
    }

    /**
     * @param \Twig_Environment $twig_Environment
     * @param string $content
     *
     * @return string
     */
    public function copyright(\Twig_Environment $twig_Environment, $content = null, $widget = null)
    {
        $url = '';
        if ($this->container->get('multi_domain.information')->getBranded() == 'on') {
            $request = Request::createFromGlobals();
            $url = 'http://www.edirectory.com';
            $url .= strpos($request->getUri(), '.com.br') === true ? '.br' : '';
        }

        $twigFile = '::blocks/copyright';
        $twigFile .= $widget? $widget.'.html.twig' : '.html.twig';

        return $twig_Environment->render(
            $twigFile,
            [
                'content' => $content,
                'branded'        => $this->container->get('multi_domain.information')->getBranded(),
                'url_edirectory' => $url
            ]);
    }

    /**
     * @return string
     */
    public function getUrlEdirectory()
    {
        $url = '';
        if ($this->container->get('multi_domain.information')->getBranded() == 'on') {
            $request = Request::createFromGlobals();
            $url = 'http://www.edirectory.com';
            $url .= strpos($request->getUri(), '.com.br') === true ? '.br' : '';
        }

        return $url;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'copyright';
    }
}
