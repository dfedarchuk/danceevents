<?php
namespace ArcaSolutions\ClassifiedBundle\Twig\Extension;

use ArcaSolutions\ClassifiedBundle\Entity\Classifiedcategory;
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
            new \Twig_SimpleFunction('featuredClassified', [$this, 'featuredClassified'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ]),
            new \Twig_SimpleFunction('popularClassified', [$this, 'popularClassified'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ]),
            new \Twig_SimpleFunction('newClassifieds', [$this, 'newClassifieds'], [
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
    public function featuredClassified(
        \Twig_Environment $twig_Environment,
        $quantity = 4,
        $class = '',
        $grid = 'vertical'
    )
    {
        if (!$this->container->get('modules')->isModuleAvailable('classified')) {
            return '';
        }

        $items = $this->container->get('search.block')->getFeatured('classified', $quantity);

        if (!$items) {
            return '';
        }

        return $twig_Environment->render('::modules/classified/blocks/featured.html.twig', [
            'items' => $items,
            'class' => $class,
            'grid' => $grid
        ]);
    }

    /**
     * @param \Twig_Environment $twig_Environment
     * @param int $categories_quantity
     * @param int $quantity
     * @param string $class
     * @param string $grid
     *
     * @return string
     * @throws \Exception
     */
    public function popularClassified(
        \Twig_Environment $twig_Environment,
        $categories_quantity = 1,
        $quantity = 4,
        $class = '',
        $grid = 'vertical'
    )
    {
        if (!$this->container->get('modules')->isModuleAvailable('classified')) {
            return '';
        }

        $categories = $this->container->get('doctrine')->getRepository('ClassifiedBundle:Classifiedcategory')
            ->getPopularCategories();

        shuffle($categories);

        $searchBlock = $this->container->get('search.block');
        $items = [];
        $count = 0;

        while ($count < $categories_quantity && count($categories)) {
            $category = array_pop($categories);
            /* Ignores empty categories */
            if ($content = $searchBlock->getBestOf('classified', $quantity, $category->getId())) {
                /* @var $category Classifiedcategory */
                $items[] = [
                    'category' => $category,
                    'items' => $content
                ];
                $count++;
            }
        }

        return $items ? $twig_Environment->render('::modules/classified/blocks/popular.html.twig', [
            'items' => $items,
            'class' => $class,
            'grid' => $grid
        ]) : "";
    }

    /**
     * @param \Twig_Environment $twig_Environment
     * @param int $quantity
     * @param string $class
     * @param string $grid
     *
     * @return string
     */
    public function newClassifieds(
        \Twig_Environment $twig_Environment,
        $quantity = 4,
        $class = '',
        $grid = 'vertical'
    )
    {
        if (!$this->container->get('modules')->isModuleAvailable('classified')) {
            return '';
        }

        $items = $this->container->get('search.block')->getRecent('classified', $quantity);

        if (!$items) {
            return '';
        }

        return $twig_Environment->render('::modules/classified/blocks/new.html.twig', [
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
        return 'blocks_classified';
    }
}
