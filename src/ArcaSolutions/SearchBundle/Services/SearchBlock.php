<?php

namespace ArcaSolutions\SearchBundle\Services;

use ArcaSolutions\SearchBundle\Events\SearchEvent;
use Elastica\Query;
use Elastica\Result;
use Elastica\Search;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SearchBlock
 *
 * @package ArcaSolutions\SearchBundle\Services
 */
final class SearchBlock
{
    /**
     * Stores any previous listing found in home pages
     *
     * @var array
     */
    static $previousItems
        = [
            'listing'    => [],
            'classified' => [],
            'event'      => [],
            'article'    => [],
            'deal'       => [],
            'blog'       => []
        ];

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Database name
     *
     * @var string
     */
    private $indexName;

    /**
     * @param ContainerInterface $containerInterface
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        $this->container = $containerInterface;

        $this->indexName = $this->container->get("search.engine")->getElasticIndexName();
    }

    /**
     * Gets featured items from elasticSearch using events from <module>Configuration
     *
     * @param string $type
     * @param int    $size
     *
     * @return \Elastica\Result[]|null
     */
    public function getFeatured($type = '', $size = 1)
    {
        $searchEvent = new SearchEvent('keyword');

        /* e.g: featured.listing */
        $this->container->get('event_dispatcher')->dispatch('featured.' . $type, $searchEvent);
        /* gets modules (in this case, just one module) */
        $modules = $searchEvent->getModules();
        /* gets the one */
        $module = array_pop($modules);

        $searchEngine = $this->container->get('search.engine');

        $search = new Search($searchEngine->getElasticaClient());
        /* sets node in elasticsearch server */
        $search->addIndex($this->indexName);
        /* sets type (e.g: listing, classified,etc) */
        $search->addType($module->getElasticType());

        /* Query Builder */
        $qb = $searchEngine->getElasticaQueryBuilder();

        $finalQuery = new Query();

        /* Randomizes the ResultSet */
        $mainQuery = $qb->query()
            ->function_score()
            ->setRandomScore(rand())
            /* gets query from <modules>Configurations using event triggered in dispatch */
            ->setQuery(current($module->getElasticaQuery()));

        /* builds query */
        $finalQuery->setQuery($mainQuery);

        /* limit */
        $finalQuery->setSize($size);

        /* gets results */
        $result = $search->setQuery($finalQuery)->search()->getResults();

        /* adds item's id to exclude after */
        array_map(function ($item) {
            /* @var $item Result */
            self::$previousItems[$item->getType()][] = $item->getId();
        }, $result);

        $this->getCategories($result);

        return $result;
    }

    /**
     * Internally changes the items param, adding categories in each item
     *
     * @param $items
     */
    private function getCategories($items)
    {
        foreach ($items as $item) {
            /* gets categories */
            $categories = $this->container->get('search.engine')->categoryIdSearch(explode(' ', $item->categoryId));
            /* sets categories */
            $item->categories = $categories;
        }
    }

    /**
     * @param string $type
     * @param int    $size
     *
     * @return \Elastica\Result[]
     */
    public function getRecent($type = '', $size = 1)
    {
        $searchEvent = new SearchEvent('keyword');

        /* e.g: featured.listing */
        $this->container->get('event_dispatcher')->dispatch('recent.' . $type, $searchEvent);

        $search = $this->container->get('search.engine')->search($searchEvent, $size);

        /* gets results */
        $result = $search->search()->getResults();

        /* adds item's id to exclude after */
        array_map(function ($item) {
            /* @var $item Result */
            self::$previousItems[$item->getType()][] = $item->getId();
        }, $result);

        $this->getCategories($result);

        return $result;
    }

    /**
     * @param string $type
     * @param int    $size
     *
     * @return \Elastica\Result[]
     */
    public function getPopular($type = '', $size = 1)
    {
        $searchEvent = new SearchEvent('keyword');

        /* e.g: featured.listing */
        $this->container->get('event_dispatcher')->dispatch('popular.' . $type, $searchEvent);

        $search = $this->container->get('search.engine')->search($searchEvent, $size);

        /* gets results */
        $result = $search->search()->getResults();

        /* adds item's id to exclude after */
        array_map(function ($item) {
            /* @var $item Result */
            self::$previousItems[$item->getType()][] = $item->getId();
        }, $result);

        $this->getCategories($result);

        if ('article' == $type) {
            $this->getAccount($result);
        }

        return $result;
    }

    /**
     * @param array $items
     */
    private function getAccount($items = [])
    {
        foreach ($items as $item) {
            if ($item->accountId) {
                $item->profile = $this->container->get('doctrine')->getRepository('WebBundle:Accountprofilecontact')
                    ->find($item->accountId);
            }
        }
    }

    /**
     * @param string $type
     * @param int    $size
     * @param int    $category_id
     *
     * @return \Elastica\Result[]
     * @throws \Exception When it's not passed a int ID
     */
    public function getBestOf($type = '', $size = 1, $category_id = null)
    {
        if (is_array($category_id) || !is_int($category_id)) {
            throw new \Exception('You must pass one category ID');
        }

        $searchEvent = new SearchEvent('keyword', null, ['category_id' => $category_id]);

        /* e.g: featured.listing */
        $this->container->get('event_dispatcher')->dispatch('bestof.' . $type, $searchEvent);

        $search = $this->container->get('search.engine')->search($searchEvent, $size);

        /* gets results */
        $result = $search->search()->getResults();

        /* adds item's id to exclude after */
        array_map(function ($item) {
            /* @var $item Result */
            self::$previousItems[$item->getType()][] = $item->getId();
        }, $result);

        $this->getCategories($result);
        $this->getReviews($result, $type);

        return $result;
    }

    /**
     * @param array  $items
     * @param string $type
     *
     * @internal param string|'listing'|'classified'|'event' $type
     */
    private function getReviews($items = [], $type = '')
    {
        if ($items) {
            foreach ($items as $item) {
                /* @var $item Result */
                /* gets a review */
                $item->review = $this->container->get('doctrine')
                    ->getRepository('WebBundle:Review')
                    ->getOneGoodReview($item->getId(), $type);
                /* gets total of reviews */
                $item->reviewTotal = current($this->container->get('doctrine')
                    ->getRepository('WebBundle:Review')
                    ->getTotalByItemId($item->getId(), $type));
            }
        }
    }
}
