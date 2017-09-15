<?php

namespace ArcaSolutions\SearchBundle\Entity\Filters;

use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category;
use ArcaSolutions\SearchBundle\Entity\FilterMenuTreeNode;
use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\SearchBundle\Services\SearchEngine;
use Elastica\Script\Script;

class CategoryFilter extends BaseFilter
{
    /**
     * {@inheritdoc}
     */
    protected static $name                         = "CategoryFilter";
    protected        $selectedCategoryFriendlyUrls = [];

    private $aggregationInfo;

    public function registerItem(SearchEvent $event, $eventName)
    {
        $this->register($event, $eventName);

        $parameterInfo = $this->container->get("search.parameters");

        $qb = SearchEngine::getElasticaQueryBuilder();

        /* will only add filters if there are category information inside the request */
        if ($searchedCategories = $parameterInfo->getCategories()) {

            $reportHandler = $this->container->get("reporthandler");

            /* Creates reports for categories being searched */
            foreach ($searchedCategories as $category) {
                $filteredId = preg_replace("/[^\d+]/", "", $category->getId());

                /* @todo After 'promotion' has been changed to 'deal', change the line below */
                $intersect = array_intersect(['promotion', ParameterHandler::MODULE_LISTING,],
                    $parameterInfo->getModules());
                if ($category->getModule() == $parameterInfo::MODULE_LISTING and count($intersect) == 2) {
                    /* Report Listing */
                    $reportHandler->addCategorySearchReport(
                        $reportHandler->getReportModule(ParameterHandler::MODULE_LISTING),
                        (int)$filteredId);

                    /* Report Deal */
                    $reportHandler->addCategorySearchReport(
                        $reportHandler->getReportModule(ParameterHandler::MODULE_DEAL),
                        (int)$filteredId);
                } else {
                    /* @todo After 'promotion' has been changed to 'deal', change the line below */
                    $reportModule = ($category->getModule() == 'listing' and in_array('promotion',
                            $parameterInfo->getModules())) ? ParameterHandler::MODULE_DEAL : $category->getModule();

                    $reportHandler->addCategorySearchReport($reportHandler->getReportModule($reportModule),
                        (int)$filteredId);
                }
            }

            /* Attempts to get all subcategories as well */
            if ($results = $this->getRecursiveCategories($searchedCategories)) {
                /* the ID is the key of each category within the $results array */
                $categoryIds = array_keys($results);

                $elasticFilter = $qb->filter()->terms("categoryId", $categoryIds);

                $this->addElasticaPostFilter($elasticFilter);
            }
        }
    }

    /**
     * Starting from a friendly url, queries elasticsearch for information on the provided categories and also all of
     * their children recursively.
     *
     * In order to fetch multiple initial categories, please separate them with commas (,)
     *
     * @param $categories Category[]
     * @return array
     */
    public function getRecursiveCategories($categories)
    {
        $returnValue = $categories;
        $searchEngine = $this->container->get("search.engine");

        /* This guy will keep all children for later processing */
        $recursiveStack = [];

        foreach ($categories as $category) {

            /* We'll add all children to the stack to get their own subcategories */
            if ($children = $category->getSubCategoryId()) {
                $recursiveStack = array_merge($recursiveStack, $children);
            }
        }

        /* this will assemble a Id query and return every category within the stack */
        while ($recursiveStack) {
            $results = $searchEngine->categoryIdSearch($recursiveStack);
            /* Empties the array, for it's values have already been used above */
            $recursiveStack = [];

            foreach ($results as $category) {
                /* Checks if the category has already been processed */
                if (!isset($returnValue[$category->getId()])) {
                    $returnValue[$category->getId()] = $category;

                    /* We'll add all children here to get their own subcategories */
                    if ($children = $category->getSubCategoryId()) {
                        $recursiveStack = array_merge($recursiveStack, (array)$children);
                    }
                }
            }
        }

        return $returnValue;
    }

    public function getElasticaAggregations()
    {
        $subscribedEvents = self::getSubscribedEvents();

        switch ($subscribedEvents[$this->eventName]) {
            case 'registerItem' :
                $qb = SearchEngine::getElasticaQueryBuilder();

                $script = new Script("_doc['parentCategoryId'].values + _doc['categoryId'].values");
                $aggregation = $qb->aggregation()->terms(static::$name)
                    ->setScript($script)
                    ->setSize($this->searchConfig['settings']['aggregationSize']);

                $filters = $this->searchEvent->getElasticaPostFilters();
                unset ($filters[static::$name]);

                if ($filters) {
                    $aggregation->addAggregation(
                        $qb->aggregation()->filter(
                            "filtered",
                            $qb->filter()
                                ->bool()
                                ->addMust($filters)
                        )
                    );
                }

                $this->addElasticaAggregation($aggregation);

                break;
        }

        return $this->elasticaAggregations;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'search.global'     => 'registerItem',
            'search.global.map' => 'registerMapItem',
        ];
    }

    public function registerMapItem(SearchEvent $event, $eventName)
    {
        $this->register($event, $eventName);

        /* will only add filters if there are category information inside the request */
        $parameterHandler = $this->container->get("search.parameters");

        if ($searchedCategories = $parameterHandler->getCategories()) {
            /* Attempts to get all subcategories as well */
            if ($results = $this->getRecursiveCategories($searchedCategories)) {
                /* the ID is the key of each category within the $results array */
                $categoryIds = array_keys($results);

                $this->addElasticaFilter(
                    SearchEngine::getElasticaQueryBuilder()->filter()->terms("categoryId", $categoryIds)
                );
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getFilterView()
    {
        $return = null;

        if ($this->aggregationInfo) {

            $javaScriptHandler = $this->container->get("javascripthandler");
            $javaScriptHandler->addJSExternalFile("assets/js/search/utility.js");
            $javaScriptHandler->addJSBlock("::js/filters/category.js.twig");

            /* Gets categories being searched for */
            $requestedCategories = $this->container->get("search.parameters")->getCategories();

            $categoryTree = $this->getCategoryTree();

            $return = $this->container->get("twig")->render(
                "::blocks/filters/category.html.twig",
                [
                    "categoryTree" => $categoryTree,
                    "selected"     => $requestedCategories,
                ]
            );
        }

        return $return;
    }

    /**
     * Return a tree containing all the categories within the resultset
     *
     * @return \ArcaSolutions\SearchBundle\Entity\FilterMenuTreeNode[]|null
     */
    public function getCategoryTree()
    {

        $categoryTree = null;

        if ($this->aggregationInfo) {
            $searchEngine = $this->container->get("search.engine");

            /* Gets categories being searched for */
            $requestedCategories = $this->container->get("search.parameters")->getCategories();

            /* Array containing all friendly Urls of categories being searched */
            $this->selectedCategoryFriendlyUrls = array_map(function ($category) {
                /* @var $category Category */
                return $category->getFriendlyUrl();
            }, $requestedCategories);

            /* Gets all the categories within the resultset */
            $resultCategories = $searchEngine->categoryIdSearch(array_keys($this->aggregationInfo));

            /* Fills the Dictionary with information about the categories contained in the resultset */
            $categoryDictionary = [];
            $this->extractFromResultSet($resultCategories, $categoryDictionary);

            /* Transforms the dictionary into a tree */
            $categoryTree = $this->linkElements($categoryDictionary);

            foreach ($categoryTree as $node) {
                $this->bubbleCounts($node);
                $this->sortTree($node);
            }

            usort($categoryTree, [$this, "categorySort"]);
        }

        return $categoryTree;
    }

    /**
     * Extracts category data from the Resultset
     * @param Category[] $categories
     * @param $dictionary
     */
    public function extractFromResultSet($categories, &$dictionary)
    {
        $parents = [];

        foreach ($categories as $result) {
            if (isset($dictionary[$result->getId()])) {
                continue;
            }

            $resultCount = isset($this->aggregationInfo[$result->getId()]) ? $this->aggregationInfo[$result->getId()]["numberOfItems"] : 0;

            if ($result->getParentId() && !isset($dictionary[$result->getParentId()])) {
                $parents[$result->getParentId()] = true;
            }

            $dictionary[$result->getId()] = new FilterMenuTreeNode(
                $result->getParentId(),
                $result->getSubCategoryId(),
                $result->getTitle(),
                $result->getFriendlyUrl(),
                $result->getModule(),
                $result->getId(),
                in_array($result->getFriendlyUrl(), $this->selectedCategoryFriendlyUrls),
                null,
                $resultCount
            );
        }

        if ($parents) {
            $resultCategories = $this->container->get("search.engine")->categoryIdSearch(array_keys($parents));
            $this->extractFromResultSet($resultCategories, $dictionary);
        }
    }

    /**
     * Assembles a tree based on the CategoryDictionary connections
     * @param FilterMenuTreeNode[] $categoryDictionary
     * @return FilterMenuTreeNode[]
     */
    public function linkElements(&$categoryDictionary)
    {
        $selectedItemParents = [];
        $parentlessItems = [];


        foreach ($categoryDictionary as &$category) {
            /* Links to the Parent, if any */
            if ($category->parentId && isset($categoryDictionary[$category->parentId])) {
                $category->parent = $categoryDictionary[$category->parentId];

                if ($category->isSelected) {
                    if ($category->parent && !isset($selectedItemParents[$category->parent->id])) {
                        $selectedItemParents[$category->parent->id] = $category->parent;
                    }
                }
            } elseif (!isset($parentlessItems[$category->id])) {
                $parentlessItems[$category->id] = $category;
            }

            /* Links to the children, if any */
            foreach ($category->childrenId as $childId) {
                if (isset($categoryDictionary[$childId])) {
                    $category->children[$childId] = &$categoryDictionary[$childId];
                }
            }
        }

        /* @var FilterMenuTreeNode $element */
        while ($element = array_pop($selectedItemParents)) {
            if (!$element->isParentOfSelected) {
                $element->isParentOfSelected = true;
                $element->parent and array_push($selectedItemParents, $element->parent);
            }
        }

        return $parentlessItems;
    }

    /**
     * Calculates the amount of items within nodes properly.
     * <b> Recursive Function </b>
     *
     * @param FilterMenuTreeNode $category
     * @param array $parents
     * @return int
     */
    public function bubbleCounts($category, $parents = [])
    {
        $category->searchPageUrl = $this->getSearchPageUrl($category, $parents);

        if ($category->children) {
            $parents[] = $category->friendlyUrl;

            foreach ($category->children as $child) {
                $this->bubbleCounts($child, $parents);
            }
        }
    }

    /**
     * @param FilterMenuTreeNode $category
     * @param array $parents
     * @return array
     */
    private function getSearchPageUrl($category, $parents = [])
    {
        $childrenFriendlyUrls = [];
        $children = (array)$category->children;

        /* @var $child FilterMenuTreeNode */
        while ($child = array_pop($children)) {
            $children = array_merge($children, (array)$child->children);
            $childrenFriendlyUrls = $child->friendlyUrl;
        }

        /* Excludes children and parents from selected category filters.  */
        $categoryFriendlyUrls = array_diff($this->selectedCategoryFriendlyUrls, (array)$parents,
            (array)$childrenFriendlyUrls);

        $index = array_search($category->friendlyUrl, $categoryFriendlyUrls);

        if ($index === false) {
            $categoryFriendlyUrls[] = $category->friendlyUrl;
        } else {
            unset($categoryFriendlyUrls[$index]);
        }


        return $this->container->get("search.parameters")->buildUrl(
            1,
            [ParameterHandler::SLUG_CATEGORY => $categoryFriendlyUrls]
        );
    }

    /**
     * @param $category FilterMenuTreeNode
     */
    public function sortTree($category)
    {
        if ($category->children) {
            usort($category->children, [$this, "categorySort"]);
            foreach ($category->children as $child) {
                $this->sortTree($child);
            }
        }
    }

    /**
     * @param $a FilterMenuTreeNode
     * @param $b FilterMenuTreeNode
     * @return int
     */
    public function categorySort($a, $b)
    {
        $result = 0;

        $a->isSelected and $result -= 100000;
        $b->isSelected and $result += 100000;

        $a->isParentOfSelected and $result -= 50000;
        $b->isParentOfSelected and $result += 50000;

        $a->resultCount > 0 and $result -= 75000;
        $b->resultCount > 0 and $result += 75000;

        $result += strcmp($a->title, $b->title);

        return $result;
    }

    /**
     * @return mixed
     */
    public function getAggregationInfo()
    {
        return $this->aggregationInfo;
    }

    /**
     * {@inheritdoc}
     */
    protected function processAggregationBuckets($filterAggregationBuckets)
    {
        $this->aggregationInfo = null;

        foreach ($filterAggregationBuckets as $bucket) {
            if ($documentCount = isset($bucket['filtered']) ? $bucket['filtered']['doc_count'] : $bucket['doc_count']) {
                $this->aggregationInfo[$bucket['key']] = ["numberOfItems" => $documentCount];
            }
        }
    }
}
