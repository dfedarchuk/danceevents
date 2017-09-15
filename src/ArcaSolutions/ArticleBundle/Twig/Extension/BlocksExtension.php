<?php
namespace ArcaSolutions\ArticleBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class BlocksExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $containerInterface
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        $this->container = $containerInterface;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('recentArticle', [$this, 'recentArticle'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ]),
            new \Twig_SimpleFunction('mustReadArticle', [$this, 'mustReadArticle'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ]),
        ];
    }

    /**
     * @param \Twig_Environment $twig_Environment
     * @param int $quantity
     * @param string $class
     * @param string $grid
     *
     * @return string
     */
    public function recentArticle(\Twig_Environment $twig_Environment, $quantity = 4, $class = '', $grid = 'vertical')
    {
        if (!$this->container->get('modules')->isModuleAvailable('article')) {
            return '';
        }

        $items = $this->container->get('search.block')->getRecent('article', $quantity);

        if (!$items) {
            return '';
        }

        return $twig_Environment->render('::modules/article/blocks/recent.html.twig', [
            'items' => $items,
            'class' => $class,
            'grid' => $grid
        ]);
    }

    /**
     * @param \Twig_Environment $twig_Environment
     * @param int $quantity
     * @param string $class
     * @param string $grid
     *
     * @return string
     */
    public function mustReadArticle(\Twig_Environment $twig_Environment, $quantity = 4, $class = '', $grid = 'vertical')
    {
        if (!$this->container->get('modules')->isModuleAvailable('article')) {
            return '';
        }

        /* must read is popular */
        $items = $this->container->get('search.block')->getPopular('article', $quantity);

        return $twig_Environment->render('::modules/article/blocks/must-read.html.twig', [
            'items' => $items,
            'class' => $class,
            'grid' => $grid
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'blocks_article';
    }
}
