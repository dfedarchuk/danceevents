<?php

namespace ArcaSolutions\ArticleBundle;

use ArcaSolutions\ArticleBundle\Entity\Article;
use ArcaSolutions\ArticleBundle\Entity\Internal\ArticleLevelFeatures;
use ArcaSolutions\CoreBundle\Interfaces\ItemDetailInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DealItemDetail
 *
 * @package ArcaSolutions\EventBundle
 */
final class ArticleItemDetail implements ItemDetailInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Article
     */
    private $item = null;

    /**
     * Doesn't have it
     */
    private $level = null;

    /**
     * @param ContainerInterface $containerInterface
     * @param Article $article
     *
     */
    public function __construct(ContainerInterface $containerInterface, Article $article)
    {
        $this->container = $containerInterface;
        $this->item = $article;

        /* sets item's level */
        $this->setLevel();
    }

    /**
     * Sets item's level
     */
    private function setLevel()
    {
        /* gets levels */
        $this->level = ArticleLevelFeatures::normalizeLevel($this->getItem()->getLevelObj());
    }

    /** {@inheritdoc} */
    public function getModuleName()
    {
        return 'article';
    }

    /** {@inheritdoc} */
    public function getLevel()
    {
        return $this->level;
    }

    /** {@inheritdoc} */
    public function getItem()
    {
        /* checks if item was seated */
        if (is_null($this->item)) {
            throw new \Exception('You must set the item');
        }

        return $this->item;
    }

    /**
     * Returns container object to give access on services
     *
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }
}
