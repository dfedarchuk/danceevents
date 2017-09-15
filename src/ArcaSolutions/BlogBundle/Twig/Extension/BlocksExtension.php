<?php
namespace ArcaSolutions\BlogBundle\Twig\Extension;

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
            new \Twig_SimpleFunction('popularPost', [$this, 'popularPost'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('recentPost', [$this, 'recentPost'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
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
    public function popularPost(\Twig_Environment $twig_Environment, $quantity = 4, $class = '', $grid = 'vertical')
    {
        if (!$this->container->get('modules')->isModuleAvailable('blog')) {
            return '';
        }

        $items = $this->container->get('search.block')->getPopular('blog', $quantity);

        if (!$items) {
            return '';
        }

        return $twig_Environment->render('::modules/blog/blocks/popular.html.twig', [
            'items' => $items,
            'class' => $class,
            'grid'  => $grid,
        ]);
    }

    /**
     * @param \Twig_Environment $twig_Environment
     * @param int $quantity
     * @param string $class_date
     * @param string $class_item
     * @param string $grid
     *
     * @return string
     */
    public function recentPost(
        \Twig_Environment $twig_Environment,
        $quantity = 4,
        $class_date = '',
        $class_item = '',
        $grid = 'vertical'
    ) {
        if (!$this->container->get('modules')->isModuleAvailable('blog')) {
            return '';
        }

        $items = $this->container->get('search.block')->getRecent('blog', $quantity);

        if (!$items) {
            return '';
        }

        if (in_array($grid, ['vertical', 'vertical-xs'])) {
            $view = $twig_Environment->render('::modules/blog/blocks/popular.html.twig', [
                'items' => $items,
                'class' => $class_date,
                'grid'  => $grid,
            ]);
        } else {
            $view = $twig_Environment->render('::modules/blog/blocks/recent.html.twig', [
                'items'      => $items,
                'class_date' => $class_date,
                'class_item' => $class_item,
                'grid'       => $grid,
            ]);
        }

        return $view;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'blocks_blog';
    }
}
