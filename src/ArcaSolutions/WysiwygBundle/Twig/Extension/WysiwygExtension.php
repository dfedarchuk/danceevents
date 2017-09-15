<?php

namespace ArcaSolutions\WysiwygBundle\Twig\Extension;


use ArcaSolutions\WysiwygBundle\Entity\PageWidget;
use ArcaSolutions\WysiwygBundle\Entity\Widget;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class WysiwygExtension
 *
 * @package ArcaSolutions\WysiwygBundle\Twig\Extension
 */
class WysiwygExtension extends \Twig_Extension
{
    /**
     * ContainerInterface
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
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
            new \Twig_SimpleFunction('renderPage', [$this, 'renderPage'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('getModule', [$this, 'getModule']),
            new \Twig_SimpleFunction('getModuleBanner', [$this, 'getModuleBanner']),
            new \Twig_SimpleFunction('isSitemgrSession', [$this, 'isSitemgrSession']),
        ];
    }

    /**
     * This function renders the whole page using the information of the DB
     * Ordering the widgets of the page
     *
     * @param \Twig_Environment $twig_Environment
     * @return string
     */
    public function renderPage(\Twig_Environment $twig_Environment, $pageId = null)
    {
        $main = false;
        $return = '';

        $theme = $this->container->get("wysiwyg.service")->getSelectedTheme();

        $pageWidgets = $this->container->get('doctrine')->getRepository('WysiwygBundle:PageWidget')->findBy([
            'pageId'  => $pageId,
            'themeId' => $theme->getId(),
        ], ['order' => 'ASC']);

        /* @var PageWidget $pageWidget */
        foreach ($pageWidgets as $pageWidget) {
            /* @var Widget $widget */
            $widget = $pageWidget->getWidget();

            /* Open tag main when there isn't more header widgets */
            if ($widget->getType() != Widget::HEADER_TYPE && $widget->getType() != Widget::FOOTER_TYPE && !$main) {
                $return .= '<main>'.PHP_EOL;
                $main = true;
            }

            /* Close tag main when there isn't more main widgets  */
            if ($widget->getType() == Widget::FOOTER_TYPE && $main) {
                $return .= '</main>'.PHP_EOL;
                $main = false;
            }

            $return .= $twig_Environment->render('::widgets'.$widget->getTwigFile(),
                [
                    'content' => json_decode($pageWidget->getContent()),
                ]
            );
        }

        /* Close tag main when not exist the footer widget */
        $return .= !$main ? '' : "</main>".PHP_EOL;

        return $return;
    }

    /**
     * @return mixed
     */
    public function isSitemgrSession()
    {
        return $this->container->get('request_stack')->getCurrentRequest()->getSession()->get('SM_LOGGEDIN');
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->container->get("wysiwyg.service")->getModule();
    }

    /**
     * @return string
     */
    public function getModuleBanner()
    {
        return $this->container->get("wysiwyg.service")->getModuleBanner();
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'wysiwyg';
    }
}
