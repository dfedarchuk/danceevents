<?php

namespace ArcaSolutions\SearchBundle\Repository\Elasticsearch;

use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\SearchBundle\Services\SearchEngine;
use Elastica\Query;
use Elastica\QueryBuilder;
use Elastica\ScanAndScroll;
use Elastica\Script\Script;
use Elastica\Search;

class CategoryRepository
{
    const ELASTIC_TYPE = 'category';

    /** @var SearchEngine */
    private $searchEngine;

    function __construct(SearchEngine $searchEngine)
    {
        $this->searchEngine = $searchEngine;
    }

    /**
     * Search categories that has valid itens (status = 'S')
     *
     * @param string $module
     * @param boolean $featured
     * @return Category[]
     */
    public function findCategoriesWithItens($module, $featured = null)
    {
        $categories = $this->findCategoriesByModule($module, $featured);

        $this->removeCategoriesWithoutItens($categories);

        return $categories;
    }

    /**
     * Find all enabled categories by module
     *
     * @param string $module
     * @param boolean|null $featured
     * @return Category[]
     */
    public function findCategoriesByModule($module, $featured = null)
    {
        $qb = SearchEngine::getElasticaQueryBuilder();

        $filter = $qb->query()
            ->bool()
            ->addMust($qb->query()->term(['enabled' => true]));

        if (ParameterHandler::MODULE_DEAL == $module) {
            $filter->addMust($qb->query()->term(['module' => ParameterHandler::MODULE_LISTING]));
        } else {
            $filter->addMust($qb->query()->term(['module' => $module]));
        }

        if (null !== $featured) {
            $filter->addMust($qb->query()->term(['featured' => $featured]));
        }

        $query = new Query($qb->query()->bool()->addFilter($filter));

        $search = new Search($this->searchEngine->getElasticaClient());

        $search = $search->addIndex($this->searchEngine->getElasticaIndex())
            ->addType(self::ELASTIC_TYPE)
            ->setQuery($query);

        $scroll = new ScanAndScroll($search);

        $categories = [];
        foreach ($scroll as $page) {
            foreach ($page->getResults() as $result) {
                $categories[$result->getId()] = Category::buildFromElasticResult($result);
            }
        }

        $categories = $this->countCategoriesItens($categories, $module);

        $categories = $this->mountCategoryTree($categories);

        return $categories;
    }

    /**
     * Populate the count field
     *
     * @param Category[] $categories
     * @param string $module
     * @return Category[]
     */
    private function countCategoriesItens($categories = [], $module)
    {
        $qb = SearchEngine::getElasticaQueryBuilder();

        $query = new Query();

        switch ($module) {
            case ParameterHandler::MODULE_DEAL:
                $this->filterDeal($qb, $query);
                break;
            case ParameterHandler::MODULE_EVENT:
                $this->filterEvent($qb, $query);
                break;
            default:
                $query->setQuery($qb->query()->bool()->addMust(
                    $qb->query()->term(['status' => true])
                ));
        }

        $ids = [];
        foreach ($categories as $category) {
            $ids[] = $category->getId();
        }

        $terms = $qb->query()->terms('categoryId', $ids);

        $query->setPostFilter($qb->query()->bool()->addFilter($terms));

        $script = new Script("_doc['parentCategoryId'].values + _doc['categoryId'].values");

        $query->addAggregation(
            $qb->aggregation()
                ->terms('category')
                ->setScript($script)
                ->setSize(0)
        );

        // Get aggregations only
        $query->setSize(0);
        $result = null;

        $search = new Search($this->searchEngine->getElasticaClient());
        $result = $search->addIndex($this->searchEngine->getElasticIndexName())
            ->addType($module)
            ->setQuery($query)
            ->search();

        $agg = $result->getAggregation('category');

        foreach ($agg['buckets'] as $result) {
            if(isset($categories[$result['key']])){
                $categories[$result['key']]->setCount($result['doc_count']);
            }
        }

        return $categories;
    }

    /**
     * @param QueryBuilder $qb
     * @param Query $query
     */
    private function filterDeal(QueryBuilder $qb, Query $query)
    {
        $now = new \DateTime();

        $query->setQuery(
            $qb->query()
                ->bool()
                ->addMust($qb->query()->term(['status' => true]))
                ->addMust($qb->query()->range('amount', ['gt' => 0]))
                ->addMust($qb->query()->range('date.start', ['lte' => $now->format('Y-m-d')]))
                ->addMust($qb->query()->range('date.end', ['gte' => $now->format('Y-m-d')]))
        );
    }

    /**
     * @param QueryBuilder $qb
     * @param Query $query
     */
    private function filterEvent(QueryBuilder $qb, Query $query)
    {
        $args = [
            'query' => [
                'bool' => [
                    'filter' => [
                        'script' => [
                            'script' => 'notHasExpired',
                            'lang'   => 'native',
                            'params' => [
                                'field' => 'recurrent_date',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $query->setRawQuery($args);
    }

    /**
     * @param Category[] $categories
     * @return array
     */
    private function mountCategoryTree($categories)
    {
        $aux = [];

        foreach ($categories as $id => $category) {
            if ($category->getParentId()) {
                if (isset($categories[$category->getParentId()])) {
                    $categories[$category->getParentId()]->addChild($category);
                }
            } else {
                $aux[$category->getId()] = $category;
            }
        }

        uasort($aux, function ($a, $b) {
            return strcmp($a->getTitle(), $b->getTitle());
        });

        return $aux;
    }

    /**
     * @param Category[] $categories
     */
    private function removeCategoriesWithoutItens(&$categories)
    {
        foreach ($categories as $category) {
            if ($category->getTotalCount() == 0) {
                unset($categories[$category->getId()]);
            }

            foreach ($category->getChildren() as $child) {
                if ($child->getTotalCount() == 0) {
                    $category->removeChild($child);
                }
            }
        }
    }
}