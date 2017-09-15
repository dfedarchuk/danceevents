<?php

namespace ArcaSolutions\SearchBundle\Services;


use ArcaSolutions\CoreBundle\Search\CategoryConfiguration;
use ArcaSolutions\CoreBundle\Search\LocationConfiguration;
use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Location;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ParameterHandler
 *
 * This is the class responsible for extracting information from the URL parameters.
 *
 * @package eDirectory
 * @subpackage SearchBundle
 * @category Search
 * @author Lucas Trentim <lucas.trentim@arcasolutions.com>
 * @author Diego Mosela <diego.mosela@arcasolutions.com>
 * @author Marcos Sartori <marcos.sartori@arcasolutions.com>
 * @copyright ArcaSolutions Inc.
 * @version 1.2
 * @since File available since Release 11.0.00
 */
class ParameterHandler
{
    const MODULE_ARTICLE = "article";
    const MODULE_BLOG = "blog";
    const MODULE_CLASSIFIED = "classified";
    const MODULE_DEAL = "deal";
    const MODULE_EVENT = "event";
    const MODULE_LISTING = "listing";

    const SLUG_MODULE = "module";
    const SLUG_CATEGORY = "category";
    const SLUG_LOCATION = "location";
    const SLUG_KEYWORD = "keyword";
    const SLUG_WHERE = "where";
    const SLUG_STARTDATE = "startDate";
    const SLUG_ENDDATE = "endDate";

    /**
     * @var bool
     */
    private static $exception = true;

    /**
     * @var string
     */
    protected static $routePattern = '/\w+(?=_search_(\d+))/i';

    /**
     * @var string[]
     */
    protected $keywords = [];
    /**
     * @var string[]
     */
    protected $wheres = [];
    /**
     * @var array
     */
    protected $modules = [];
    /**
     * @var Category[]
     */
    protected $categories = [];
    /**
     * @var Location[]
     */
    protected $locations = [];
    /**
     * @var \DateTime
     */
    protected $startDate = null;
    /**
     * @var \DateTime
     */
    protected $endDate = null;
    /**
     * @var array
     */
    protected $queryParameters = [];
    /**
     * @var string
     */
    protected $routePrefix = "global";
    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @var int
     */
    protected $originalRouteParameterCount = 0;

    /**
     * @param ContainerInterface $container
     * @param bool $extractParametes
     */
    public function __construct(ContainerInterface $container, $extractParametes = true)
    {
        $this->container = $container;
        $extractParametes and $this->extractParameters();
    }

    /**
     * ets whether the exception will be thrown in the case of an invalid url.
     * @param bool $v
     */
    static function setException($v)
    {
        self::$exception = $v;
    }

    //region Keywords
    /**
     * Return all keywords
     * @return string[]
     */
    public function getKeywords()
    {
        $keywords = array_map(function ($keyword) {
            return urldecode($keyword);
        }, $this->keywords);

        return $keywords;
    }

    /**
     * Returns true if there are any keywords
     * @return bool
     */
    public function hasKeywords()
    {
        return !empty($this->keywords);
    }

    /**
     * Set the keywords array
     * @param string[] $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = (array)$keywords;
    }

    /**
     * Adds a new Keyword
     * @param string $keyword
     */
    public function addKeyword($keyword)
    {
        $this->keywords[$keyword] = $keyword;
    }

    /**
     * Toggles a keyword on or off
     * @param string[] $keyword
     */
    public function toggleKeyword($keyword)
    {
        $this->removeKeyword($keyword) or $this->addKeyword($keyword);
    }

    /**
     * Removes a specific keyword
     * @param $keyword
     * @return bool
     */
    public function removeKeyword($keyword)
    {
        if (array_key_exists($keyword, $this->keywords)) {
            unset($this->keywords[$keyword]);
            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }

    /**
     * Removes all keywords
     */
    public function clearKeyword()
    {
        $this->keywords = [];
    }

    //endregion

    //region Wheres
    /**
     * Return all wheres
     * @return string[]
     */
    public function getWheres()
    {
        return $this->wheres;
    }

    /**
     * Returns true if there are any wheres
     * @return bool
     */
    public function hasWheres()
    {
        return !empty($this->wheres);
    }

    /**
     * Set the Wheres array
     * @param string[] $wheres
     */
    public function setWheres($wheres)
    {
        $this->wheres = (array)$wheres;
    }

    /**
     * Adds a new Where
     * @param string $where
     */
    public function addWhere($where)
    {
        $this->wheres[$where] = $where;
    }

    /**
     * Toggles a where on or off
     * @param string[] $where
     */
    public function toggleWhere($where)
    {
        $this->removeWhere($where) or $this->addWhere($where);
    }

    /**
     * Removes a specific where
     * @param $where
     * @return bool
     */
    public function removeWhere($where)
    {
        if (array_key_exists($where, $this->wheres)) {
            unset($this->wheres[$where]);
            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }

    /**
     * Removes all wheres
     */
    public function clearWhere()
    {
        $this->wheres = [];
    }

    //endregion

    //region Modules
    /**
     * Return all modules
     * @return string[]
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Returns true if there are any modules
     * @return bool
     */
    public function hasModules()
    {
        return !empty($this->modules);
    }

    /**
     * Set the modules array
     * @param string[] $modules
     */
    public function setModules($modules)
    {
        $this->modules = (array)$modules;
    }

    /**
     * Adds a new Module
     * @param string $module
     */
    public function addModule($module)
    {
        $this->modules[$module] = $module;
    }

    /**
     * Toggles a module on or off
     * @param string[] $module
     */
    public function toggleModule($module)
    {
        $this->removeModule($module) or $this->addModule($module);
    }

    /**
     * Removes a specific module
     * @param $module
     * @return bool
     */
    public function removeModule($module)
    {
        if (array_key_exists($module, $this->modules)) {
            unset($this->modules[$module]);
            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }

    /**
     * Removes all modules
     */
    public function clearModule()
    {
        $this->modules = [];
    }
    //endregions

    //region Categories
    /**
     * @return \ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Returns true if there are any categories
     * @return bool
     */
    public function hasCategories()
    {
        return !empty($this->categories);
    }

    /**
     * Sets the entire category array.
     * @param Category[] $categories
     */
    public function setCategories($categories)
    {
        $this->categories = (array)$categories;
    }

    /**
     * Adds a Category
     * @param Category $category
     */
    public function addCategory(Category $category)
    {
        $this->categories[$category->getId()] = $category;
    }

    /**
     * Adds a category based on its Id
     * @param string $categoryId
     */
    public function addCategoryById($categoryId)
    {
        if (!array_key_exists($categoryId, $this->categories)) {
            if ($categories = $this->container->get("search.engine")->categoryIdSearch($categoryId)) {
                $this->addCategory(array_pop($categories));
            }
        }
    }

    /**
     * Toggles a Category from the route
     * @param string $categoryId
     */
    public function toggleCategoryId($categoryId)
    {
        $this->removeCategoryById($categoryId) or $this->addCategoryById($categoryId);
    }

    /**
     * Removes a Category
     * @param Category $category
     * @return bool
     */
    public function removeCategory(Category $category)
    {
        return $this->removeCategoryById($category->getId());
    }

    /**
     * Remove a category by its Id
     * @param $categoryId
     * @return bool
     */
    public function removeCategoryById($categoryId)
    {
        if (array_key_exists($categoryId, $this->categories)) {
            unset ($this->categories[$categoryId]);
            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }

    /**
     * Removes all categories
     */
    public function clearCategories()
    {
        $this->categories = [];
    }
    //endregion

    //region Locations
    /**
     * @return Location[]
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Returns true if there are any categories
     * @return bool
     */
    public function hasLocations()
    {
        return !empty($this->locations);
    }

    /**
     * Sets the entire location array.
     * @param Location[] $locations
     */
    public function setLocations($locations)
    {
        $this->locations = (array)$locations;
    }

    /**
     * Adds a Location
     * @param Location $location
     */
    public function addLocation(Location $location)
    {
        $this->locations[$location->getId()] = $location;
    }

    /**
     * Adds a location based on its Id
     * @param string $locationId
     */
    public function addLocationById($locationId)
    {
        if (!array_key_exists($locationId, $this->locations)) {
            if ($locations = $this->container->get("search.engine")->locationIdSearch($locationId)) {
                $this->addLocation(array_pop($locations));
            }
        }
    }

    /**
     * Toggles a Location from the route
     * @param string $locationId
     */
    public function toggleLocationId($locationId)
    {
        $this->removeLocationById($locationId) or $this->addLocationById($locationId);
    }

    /**
     * Removes a Location
     * @param Location $location
     * @return bool
     */
    public function removeLocation(Location $location)
    {
        return $this->removeLocationById($location->getId());
    }

    /**
     * Remove a location by its Id
     * @param $locationId
     * @return bool
     */
    public function removeLocationById($locationId)
    {
        if (array_key_exists($locationId, $this->locations)) {
            unset ($this->locations[$locationId]);
            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }

    /**
     * Removes all locations
     */
    public function clearLocations()
    {
        $this->locations = [];
    }
    //endregion

    //region startDate
    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return boolean
     */
    public function hasStartDate()
    {
        return $this->startDate !== null;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    public function clearStartDate()
    {
        $this->startDate = null;
    }
    //endregion

    //region endDate
    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @return boolean
     */
    public function hasEndDate()
    {
        return $this->endDate !== null;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    public function clearEndDate()
    {
        $this->endDate = null;
    }
    //endregion

    //region QueryParameter
    /**
     * @param string $node
     *
     * @return array
     */
    public function getQueryParameter($node = null)
    {
        if ($node) {
            $return = isset($this->queryParameters[$node]) ? $this->queryParameters[$node] : [];
        } else {
            $return = $this->queryParameters;
        }

        return $return;
    }

    /**
     * @param $node
     * @param $information
     */
    public function toggleQueryParameter($node, $information)
    {
        if (!empty($this->queryParameters[$node]) && in_array($information, $this->queryParameters[$node])) {
            $this->removeQueryParameter($node, $information);
        } else {
            $this->addQueryParameter($node, $information);
        }
    }

    /**
     * @param string $node
     * @param string $information
     */
    public function removeQueryParameter($node, $information = null)
    {
        if (!empty($this->queryParameters[$node])) {
            if ($information === null) {
                unset($this->queryParameters[$node]);
            } else {
                $this->queryParameters[$node] = array_diff($this->queryParameters[$node], [$information]);
            }
        }
    }

    /**
     * @param string $node
     * @param array $information
     */
    public function addQueryParameter($node, $information)
    {
        $this->queryParameters[$node][] = $information;
    }

    /**
     * @param string $node
     */
    public function clearQueryParameter($node)
    {
        unset($this->queryParameters[$node]);
    }

    public function clearAllQueryParameters()
    {
        $this->queryParameters = [];
    }
    //endregion

    /**
     * Creates a URL following the patterns of the system
     *
     * @param int $page This is the page id
     * @param array $overrideParameters Parameter to replace default values for [keywords, wheres, locations, startdate, enddate, module and categories]
     * @return string
     */
    public function buildUrl($page = 1, $overrideParameters = [])
    {
        $parameterNumber = 0;

        // @formatter:off
        $this->hasKeywords()   || array_key_exists(self::SLUG_KEYWORD, $overrideParameters)   and $parameterNumber++;
        $this->hasWheres()     || array_key_exists(self::SLUG_WHERE, $overrideParameters)     and $parameterNumber++;
        $this->hasLocations()  || array_key_exists(self::SLUG_LOCATION, $overrideParameters)  and $parameterNumber++;
        $this->hasStartDate()  || array_key_exists(self::SLUG_STARTDATE, $overrideParameters) and $parameterNumber++;
        $this->hasEndDate()    || array_key_exists(self::SLUG_ENDDATE, $overrideParameters)   and $parameterNumber++;
        $this->hasModules()    || array_key_exists(self::SLUG_MODULE, $overrideParameters)    and $parameterNumber++;
        $this->hasCategories() || array_key_exists(self::SLUG_CATEGORY, $overrideParameters)  and $parameterNumber++;
        // @formatter:on

        if ($parameterNumber) {
            $searchEngine = $this->container->get("search.engine");

            $routeParameters = [
                "page" => $searchEngine->convertToPaginationFormat($page),
            ];

            $parameterNumber = 0;

            $urlFormat = array_reverse($searchEngine->getFriendlyUrlOrder());

            while ($slug = array_pop($urlFormat)) {
                $data = null;

                if (array_key_exists($slug, $overrideParameters)) {
                    $data = $overrideParameters[$slug];
                } else {
                    $data = $this->getDataForSlug($slug);
                }

                if ($data) {
                    $routeParameters["a{$parameterNumber}"] = Utility::convertArrayToString($data);
                    $parameterNumber++;
                }
            }

            $queryParameters = array_map(function ($a) {
                return Utility::convertArrayToString($a, "-");
            }, array_filter($this->queryParameters));

            /* Route parameters are more important than query parameters. So they are passed as the second argument
             * to the merge function in order to retain their value in case a query parameter accidentally overwrote one */
            $routeParameters = array_merge($queryParameters, $routeParameters);
            if ($parameterNumber > 0) {
                $route = "global_search_{$parameterNumber}";
            } else {
                $route = "{$this->routePrefix}_homepage";
            }
        } else {
            $route = "{$this->routePrefix}_homepage";
            $routeParameters = [];
        }

        return $this->container->get("router")->generate($route, $routeParameters);
    }

    /**
     * Builds internal arrays with information contained inside the route's parameters
     */
    public function extractParameters()
    {
        $request = $this->container->get("request_stack")->getCurrentRequest();

        if (preg_match(self::$routePattern, $request->get("_route"), $routeMatches)) {
            $searchEngine = $this->container->get("search.engine");

            $this->routePrefix = reset($routeMatches);
            $this->originalRouteParameterCount = (int)end($routeMatches);

            $activeModules = $searchEngine->getActiveModules();

            $dateFormatString = $this->container->get('languagehandler')->getDateFormat();
            $dateFormat = preg_replace("/[^\w]/", "-", $dateFormatString);

            for ($i = 0; $i < $this->originalRouteParameterCount; $i++) {
                $rawInput = strtolower($request->get("a{$i}"));
                $parameterInformation = Utility::convertStringToArray($rawInput);

                if (!$this->hasKeywords() and $rawKeyword = $searchEngine->convertFromKeywordFormat($rawInput)) {
                    $parameterInformation = Utility::convertStringToArray($rawKeyword);
                    foreach ($parameterInformation as $parameter) {
                        $this->addKeyword($parameter);
                    }
                    continue;
                } elseif (!$this->hasWheres() and $rawWhere = $searchEngine->convertFromWhereFormat($rawInput)) {
                    $parameterInformation = Utility::convertStringToArray($rawWhere);
                    foreach ($parameterInformation as $parameter) {
                        $this->addWhere($parameter);
                    }
                    continue;
                } elseif (!$this->hasModules() and $modules = array_intersect($activeModules, $parameterInformation)) {
                    foreach ($modules as $key => $value) {
                        $this->addModule($key);
                    }
                    continue;
                } elseif (!$this->hasStartDate() and $date = \DateTime::createFromFormat($dateFormat, $rawInput)) {
                    $this->setStartDate($date);
                    continue;
                } elseif (!$this->hasEndDate() and $date = \DateTime::createFromFormat($dateFormat, $rawInput)) {
                    $this->setEndDate($date);
                    continue;
                } elseif (!$this->hasCategories() || !$this->hasLocations() and $elasticType = $searchEngine->getFriendlyUrlType($parameterInformation)) {
                    switch ($elasticType) {
                        case CategoryConfiguration::$elasticType:
                            if (!$this->hasCategories()) {
                                $this->setCategories($searchEngine->categoryFriendlyURLSearch($parameterInformation));
                            }
                            break;
                        case LocationConfiguration::$elasticType:
                            if (!$this->hasLocations()) {
                                $this->setLocations($searchEngine->locationFriendlyURLSearch($parameterInformation));
                            }
                            break;
                    }

                    continue;
                }

                if (self::$exception) {
                    throw new NotFoundHttpException();
                }
            }
        }

        foreach ($request->query->all() as $key => $value) {
            $this->queryParameters[$key] = Utility::convertStringToArray($value, "-");
        }
    }

    /**
     * Clears all internal arrays, including:
     * Module, StartDate, EndDate, Categories, Locations, Keyword
     */
    public function clearAllParameters()
    {
        $this->clearModule();
        $this->clearStartDate();
        $this->clearEndDate();
        $this->clearCategories();
        $this->clearLocations();
        $this->clearKeyword();
    }

    /**
     * @param $slug
     * @return array
     */
    private function getDataForSlug($slug)
    {
        $data = [];

        switch ($slug) {
            case self::SLUG_MODULE:
                if ($this->hasModules()) {
                    foreach ($this->getModules() as $module) {
                        $data[] = $this->container->get("search.engine")->getModuleAlias($module);
                    }
                }
                break;
            case self::SLUG_CATEGORY:
                if ($this->hasCategories()) {
                    $data = array_map(function ($category) {
                        /* @var $category Category */
                        return $category->getFriendlyUrl();
                    }, $this->getCategories());
                }
                break;
            case self::SLUG_LOCATION:
                if ($this->hasLocations()) {
                    $data = array_map(function ($location) {
                        /* @var $location Location */
                        return $location->getFriendlyUrl();
                    }, $this->getLocations());
                }
                break;
            case self::SLUG_KEYWORD:
                if ($this->hasKeywords()) {
                    $keywords = implode(" ", $this->getKeywords());
                    /* Encode the keyword to accept '/' and other characters */
                    $keywords = urlencode(urldecode($keywords));
                    $data = $this->container->get("search.engine")->convertToKeywordFormat($keywords);
                }
                break;
            case self::SLUG_WHERE:
                if ($this->hasWheres()) {
                    $wheres = implode(" ", $this->getWheres());
                    $data = $this->container->get("search.engine")->convertToWhereFormat($wheres);
                }
                break;
            case self::SLUG_STARTDATE:
                if ($this->hasStartDate()) {
                    $dateFormat = $this->container->get("filter.date")->getUrlDateFormat();
                    $data[] = $this->getStartDate()->format($dateFormat);
                }
                break;
            case self::SLUG_ENDDATE:
                if ($this->hasEndDate()) {
                    $dateFormat = $this->container->get("filter.date")->getUrlDateFormat();
                    $data[] = $this->getEndDate()->format($dateFormat);
                }
                break;
        }

        return $data;
    }
}

