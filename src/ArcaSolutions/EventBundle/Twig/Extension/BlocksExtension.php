<?php
namespace ArcaSolutions\EventBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BlocksExtension
 *
 * @package ArcaSolutions\EventBundle\Twig\Extension
 */
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
            new \Twig_SimpleFunction('featuredEvent', [$this, 'featuredEvent'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ]),
            new \Twig_SimpleFunction('specialsEvent', [$this, 'specialsEvent'], [
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
    public function featuredEvent(\Twig_Environment $twig_Environment, $quantity = 4, $class = '', $grid = 'vertical')
    {
        if (!$this->container->get('modules')->isModuleAvailable('event')) {
            return '';
        }

        $items = $this->container->get('search.block')->getFeatured('event', $quantity);

        if (!$items) {
            return '';
        }

        $this->getEventEntityObject($items);

        return $twig_Environment->render('::modules/event/blocks/featured.html.twig', [
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
    public function specialsEvent(
        \Twig_Environment $twig_Environment,
        $quantity = 4,
        $class = '',
        $grid = 'vertical'
    )
    {
        if (!$this->container->get('modules')->isModuleAvailable('event')) {
            return '';
        }

        // orded by number views
        $items = $this->container->get('search.block')->getPopular('event', $quantity);

        if (!$items) {
            return '';
        }

        $this->getEventEntityObject($items);

        return $twig_Environment->render('::modules/event/blocks/special.html.twig', [
            'items' => $items,
            'class' => $class,
            'grid' => $grid
        ]);
    }

    /**
     * It's alters $items adding Event Entity in elastic result.
     * This entry is used to show recurring message in view
     *
     * @param $items
     */
    private function getEventEntityObject($items)
    {
        foreach ($items as $item) {
            $item->event = $this->container->get('doctrine')->getRepository('EventBundle:Event')
                ->find($item->getId());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'blocks_event';
    }
}
