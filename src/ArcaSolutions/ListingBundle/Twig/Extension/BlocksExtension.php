<?php

namespace ArcaSolutions\ListingBundle\Twig\Extension;

use ArcaSolutions\WebBundle\Entity\Review;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BlocksExtension
 *
 * @package ArcaSolutions\ListingBundle\Twig\Extension
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
            new \Twig_SimpleFunction('featuredListing', [$this, 'featuredListing'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('reviewListing', [$this, 'reviewListing'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('bestOfListing', [$this, 'bestOfListing'], [
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
    public function featuredListing(\Twig_Environment $twig_Environment, $quantity = 4, $class = '', $grid = 'vertical')
    {
        $items = $this->container->get('search.block')->getFeatured('listing', $quantity);

        if (!$items) {
            return '';
        }

        return $twig_Environment->render('::modules/listing/blocks/featured.html.twig', [
            'items' => $items,
            'class' => $class,
            'grid'  => $grid,
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
    public function reviewListing(\Twig_Environment $twig_Environment, $quantity = 4, $class = '', $grid = 'vertical')
    {
        if ($this->container->get("settings")->getDomainSetting("review_listing_enabled") != "on") {
            return false;
        }

        $info = [];

        $doctrine = $this->container->get("doctrine");

        $items = $doctrine->getRepository("WebBundle:Review")->findBy([
            "itemType" => "listing",
            "approved" => 1,
        ], ["added" => "DESC"], $quantity);

        /* @var $review Review */
        foreach ($items as $review) {
            $listing = $doctrine->getRepository("ListingBundle:Listing")->find($review->getItemId());
            $info[] = [
                "review" => $review,
                "module" => $listing,
            ];
        }

        return $info ? $twig_Environment->render('::blocks/recent-reviews.html.twig', ['reviews' => $info]) : '';
    }

    /**
     * @param \Twig_Environment $twig_Environment
     * @param int $categories_quantity
     * @param int $quantity
     * @param string $class
     * @param string $grid
     * @param null $content
     *
     * @return string
     */
    public function bestOfListing(
        \Twig_Environment $twig_Environment,
        $categories_quantity = 1,
        $quantity = 4,
        $class = '',
        $grid = 'vertical',
        $content = null
    ) {
        $items = [];
        $searchBlock = $this->container->get('search.block');
        $categories = $this->container->get('search.repository.category')
            ->findCategoriesWithItens('listing');

        // Categories with most valid itens comes first
        uasort($categories, function ($a, $b) {
            $countA = $a->getTotalCount();
            $countB = $b->getTotalCount();

            if ($countA == $countB) {
                return 0;
            }

            return $countB > $countA ? 1 : -1;
        });

        $categories = array_slice($categories, 0, $categories_quantity);

        uasort($categories, function ($a, $b) {
            return strcmp($a->getTitle(), $b->getTitle());
        });

        foreach ($categories as $category) {
            if(!preg_match('/L:([0-9]+)/', $category->getId(), $matches)){
                continue;
            }

            $id = (int)$matches[1];
            if ($content = $searchBlock->getBestOf('listing', $quantity, $id)) {
                $items[] = [
                    'category' => $category,
                    'items'    => $content,
                ];
            }
        }

        if (count($items) == 0) {
            return '';
        }

        return $twig_Environment->render('::modules/listing/blocks/bestof.html.twig', [
            'items'   => $items,
            'class'   => $class,
            'grid'    => $grid,
            'content' => $content,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'blocks_listing';
    }
}
