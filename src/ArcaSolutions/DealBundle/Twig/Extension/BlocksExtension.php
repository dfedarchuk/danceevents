<?php
namespace ArcaSolutions\DealBundle\Twig\Extension;

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
            new \Twig_SimpleFunction('popularDeal', [$this, 'popularDeal'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ]),
            new \Twig_SimpleFunction('newDeal', [$this, 'newDeal'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ]),
            new \Twig_SimpleFunction('specialsDeal', [$this, 'specialsDeal'], [
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
    public function popularDeal(\Twig_Environment $twig_Environment, $quantity = 4, $class = '', $grid = 'vertical')
    {
        if (!$this->container->get('modules')->isModuleAvailable('deal')) {
            return '';
        }

        $items = $this->container->get('search.block')->getPopular('deal', $quantity);

        if (!$items) {
            return '';
        }

        return $twig_Environment->render('::modules/deal/blocks/popular.html.twig', [
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
    public function newDeal(
        \Twig_Environment $twig_Environment,
        $quantity = 4,
        $class = '',
        $grid = 'vertical'
    )
    {
        if (!$this->container->get('modules')->isModuleAvailable('deal')) {
            return '';
        }

        $items = $this->container->get('search.block')->getRecent('deal', $quantity);

        if (!$items) {
            return '';
        }

        return $twig_Environment->render('::modules/deal/blocks/new.html.twig', [
            'items' => $items,
            'class' => $class,
            'grid' => $grid
        ]);
    }

    public function specialsDeal(
        \Twig_Environment $twig_Environment,
        $quantity = 4,
        $class = '',
        $grid = 'vertical'
    )
    {
        if (!$this->container->get('modules')->isModuleAvailable('deal')) {
            return '';
        }

        // orded by number views
        $items = $this->container->get('search.block')->getPopular('deal', $quantity);

        if (!$items) {
            return '';
        }

        return $twig_Environment->render('::modules/deal/blocks/special.html.twig', [
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
        return 'blocks_deal';
    }
}
