<?php

namespace ArcaSolutions\SearchBundle\Entity\Summary;


use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Location;
use ArcaSolutions\SearchBundle\Entity\FilterMenuTreeNode;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SummaryTitle
{
    /**
     * @var ContainerInterface
     */
    private $container;
    private $keyword;
    private $where;
    private $category;
    private $location;
    /**
     * @var FilterMenuTreeNode
     */
    private $date;
    private $description;
    private $module;

    private $content;
    private $SEOTitle;
    private $SEODescription;
    private $SEOKeywords;

    private $flags;

    /**
     * SummaryTitle constructor.
     * @param ContainerInterface $container
     * @param $module
     * @param $keyword
     * @param $category
     * @param $location
     * @param $date
     * @param $description
     * @param $flags
     * @param $content
     * @param $SEOTitle
     * @param $SEODescription
     * @param $SEOKeywords
     */
    public function __construct(
        ContainerInterface $container,
        $module,
        $keyword,
        $where,
        $category,
        $location,
        $date,
        $description,
        $flags,
        $content,
        $SEOTitle,
        $SEODescription,
        $SEOKeywords
    )
    {
        $this->container = $container;
        $this->keyword = $keyword;
        $this->where = $where;
        $this->category = $category;
        $this->location = $location;
        $this->date = $date;
        $this->description = $description;
        $this->module = $module;
        $this->flags = $flags;
        $this->content = $content;
        $this->SEOTitle = $SEOTitle;
        $this->SEODescription = $SEODescription;
        $this->SEOKeywords = $SEOKeywords;
    }

    /**
     * Generates a SummaryTitle instance based on the content stored in the $parameterHandler instance.
     *
     * @param ParameterHandler $parameterHandler
     * @param ContainerInterface $container
     * @return SummaryTitle
     */
    public static function extract(ParameterHandler $parameterHandler, ContainerInterface $container)
    {
        $SEOInfoCounter = 0;
        $categoryContent = null;

        $categorySEOInfo = null;
        $locationSEOInfo = null;
        $SEOKeywords[] = $container->get('customtexthandler')->get('header_keywords');

        $flags = 0;

        $date = null;
        $description = null;
        $moduleString = null;
        $keywordString = null;
        $whereString = null;
        $categoryString = null;
        $locationString = null;

        if ($keywordArray = $parameterHandler->getKeywords()) {
            $keywordString = $container->get("utility")->convertArrayToHumanReadableString(array_unique($keywordArray));
            $flags |= 1;
        }

        if ($whereArray = $parameterHandler->getWheres()) {
            $whereString = $container->get("utility")->convertArrayToHumanReadableString(array_unique($whereArray));
            $flags |= 2;
        }

        if ($modules = $parameterHandler->getModules()) {

            /*
             * Workaround to pluralize module's name
             */
            $translator = $container->get("translator");

            $arrayModulesName = [
                ParameterHandler::MODULE_ARTICLE => $translator->trans("articles"),
                ParameterHandler::MODULE_BLOG => $translator->trans("posts"),
                ParameterHandler::MODULE_CLASSIFIED => $translator->trans("classifieds"),
                ParameterHandler::MODULE_DEAL => $translator->trans("deals"),
                ParameterHandler::MODULE_EVENT => $translator->trans("events"),
                ParameterHandler::MODULE_LISTING => $translator->trans("listings")
            ];

            $pluralModules = [];

            foreach ($modules as $module) {
                //Fix deal module translation
                if($module == "promotion") $module = "deal";
                //
                if (array_key_exists($module, $arrayModulesName)) {
                    $pluralModules[] = ucfirst($arrayModulesName[$module]);
                } else {
                    $pluralModules[] = ucfirst($module);
                }
            }

            $moduleString = $container->get("utility")->convertArrayToHumanReadableString(array_unique($pluralModules));
        }

        if ($categories = $parameterHandler->getCategories()) {

            /* @var Category $category */
            $category = array_pop($categories);
            $categoryTitleArray[] = trim($category->getTitle());
            $seoInfo = $category->getSeo();
            $SEOKeywords[] = $seoInfo["keywords"];
            $SEOInfoCounter++;

            if (empty($categories)) {
                $description = $category->getDescription();
                $categoryContent = $category->getContent();
                $categorySEOInfo = $category->getSeo();
            } else {
                while ($category = array_pop($categories)) {
                    $SEOInfoCounter++;
                    $categoryTitleArray[] = trim($category->getTitle());
                    $seoInfo = $category->getSeo();
                    $SEOKeywords[] = $seoInfo["keywords"];
                }
            }

            $categoryString = $container->get("utility")->convertArrayToHumanReadableString(array_unique($categoryTitleArray));
            $flags |= 4;
        }

        if ($locations = $parameterHandler->getLocations()) {
            $locationTitleArray = [];

            /* @var Location $location */
            $location = array_pop($locations);
            $locationTitleArray[] = trim($location->getTitle());
            $seoInfo = $location->getSeo();
            $SEOKeywords[] = $seoInfo["keywords"];
            $SEOInfoCounter++;

            if (empty($locations)) {
                $seoInfo = $location->getSeo();
                $seoInfo["title"] = $location->getTitle();
                $locationSEOInfo = $seoInfo;
            } else {
                while ($location = array_pop($locations)) {
                    $SEOInfoCounter++;
                    $locationTitleArray[] = trim($location->getTitle());
                    $seoInfo = $location->getSeo();
                    $SEOKeywords[] = $seoInfo["keywords"];
                }
            }

            $locationString = $container->get("utility")->convertArrayToHumanReadableString(array_unique($locationTitleArray));
            $flags |= 8;
        }

        $dateFilter = $container->get('filter.date');

        if ($selectedFilter = $dateFilter->getSelectedFilter()) {
            $date = $selectedFilter;
            $flags |= 16;
        }

        $SEOTitle = null;
        $SEODescription = null;

        if ($SEOInfoCounter == 1 and ($locationSEOInfo xor $categorySEOInfo)) {
            if ($locationSEOInfo) {
                $SEOTitle = $locationSEOInfo["title"];
                $SEODescription = $locationSEOInfo["description"];
            } else {
                $SEOTitle = $categorySEOInfo["title"];
                $SEODescription = $categorySEOInfo["description"];
            }
        }

        $SEOKeywords = preg_replace("/\s+/", ",", implode(",", $SEOKeywords));

        return new SummaryTitle(
            $container,
            $moduleString,
            $keywordString,
            $whereString,
            $categoryString,
            $locationString,
            $date,
            $description,
            $flags,
            $categoryContent,
            $SEOTitle,
            $SEODescription,
            $SEOKeywords
        );
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function getSeoInformation()
    {
        $title = '';

        $locations = [];
        $this->container->get('search.parameters')->hasLocations() and $locations = $this->container->get('search.parameters')->getLocations();

        /*
         * It has locations?
         */
        if (1 === count($locations)) {
            /* @var Location $location */
            $location = current($locations);
            $seo = $location->getSeo();

            $seo['title'] and $title = $seo['title'];
            $seo['description'] and $this->SEODescription = $seo['description'];
            $seo['keywords'] and $this->SEOKeywords = $seo['keywords'];
        }

        $categories = [];
        $thumbnail = '';
        $this->container->get('search.parameters')->hasCategories() and $categories = $this->container->get('search.parameters')->getCategories();

        /*
         * It has no location and one category?
         * Because it just shows one or another
         */
        if (0 === count($locations) && 1 === count($categories)) {
            /* @var Category $category */
            $category = current($categories);
            $seo = $category->getSeo();

            $seo['title'] and $title = $seo['title'];
            $seo['description'] and $this->SEODescription = $seo['description'];
            $seo['keywords'] and $this->SEOKeywords = $seo['keywords'];

            if ($category->getThumbnail()) {
                $thumbnail = $this->container->get("request_stack")->getCurrentRequest()->getSchemeAndHttpHost() .
                    $this->container->get("templating.helper.assets")->getUrl($category->getThumbnail(), "domain_images");
            }
        }

        /* Default values */
        $this->SEOTitle or $this->SEOTitle = $this->getTitleString();

        $title or $title = $this->container->get("translator")->trans(
            "%pageTitle% | %directoryTitle%",
            [
                "%pageTitle%" => $this->SEOTitle,
                "%directoryTitle%" => $this->container->get("multi_domain.information")->getTitle()
            ]
        );

        $this->SEODescription or $this->SEODescription = $this->SEOTitle;

        return $this->container->get("twig")->render(
            "::blocks/seo/base.og.html.twig",
            [
                "title" => $title,
                "description" => $this->SEODescription,
                "keywords" => $this->SEOKeywords,
                "author" => $this->container->get('customtexthandler')->get('header_author'),
                "og" => [
                    "url" => $this->container->get('request_stack')->getCurrentRequest()->getUri(),
                    "type" => "website",
                    "title" => $title,
                    "image" => $thumbnail,
                    "description" => $this->SEODescription
                ],
            ]
        );
    }

    /**
     * Builds a string representing what is being searched for, to be used withing the title head tag and h1 body tag
     * @param null $keywordSurroundingTag
     * @return string
     */
    public function getTitleString($keywordSurroundingTag = null)
    {
        $return = null;

        $flags = $this->flags;

        $translator = $this->container->get("translator");
        $isNearbyEnabled = $this->container->get("nearby.handler")->isNearbyEnabled();

        if ($flags == 0) {
            if ($this->module) {
                $return[] = $this->module;
            } else {
                $return[] = $translator->trans("directory results");
            }

            $return[] = $translator->trans("in");
            $return[] = $this->container->get("multi_domain.information")->getTitle();
        } else {
            if ($flags & 1) {
                ~$flags & 4 and ~$flags & 8 and $return[] = $translator->trans("Results for");
                $return[] = $keywordSurroundingTag ? "<{$keywordSurroundingTag}>{$this->keyword}</{$keywordSurroundingTag}>" : $this->keyword;
            } elseif ($this->module) {
                $flags |= 1;
                $return[] = $this->module;
            }

            if ($flags & 2){
                ~$flags & 1 and ~$flags & 4 and ~$flags & 8 and $return[] = $translator->trans("Results");
                ~$flags & 4 and ~ $flags & 8 and $return[] = $isNearbyEnabled? $translator->trans("near") : $translator->trans("in");
                $return[] = $this->where;
            }

            ($flags & 1) || ($flags & 2) and $flags & 4 and $return[] = $translator->trans("in");
            ~$flags & 1 and ~$flags & 2 and $flags & 4 and $return[] = $translator->trans("Results for");
            $flags & 4 and $return[] = $this->category;

            ~$flags & 1 and ~$flags & 2 and ~$flags & 4 and $flags & 8 and $return[] = $translator->trans("Results") and $flags |= 1;
            ($flags & 1) || ($flags & 2) || ($flags & 4) and $flags & 8 and $return[] = $isNearbyEnabled? $translator->trans("near") : $translator->trans("in");
            $flags & 8 and $return[] = $this->location;

            if ($flags & 16) {
                if (empty($return)) {
                    $return[] = $translator->trans("Events");
                }

                switch ($this->date->title) {
                    case "fromToday":
                        $return[] = $translator->trans("from today on");
                        break;
                    case "today":
                        $return[] = $translator->trans("today");
                        break;
                    case "week":
                        $return[] = $translator->trans("this week");
                        break;
                    case "weekend":
                        $return[] = $translator->trans("this weekend");
                        break;
                    case "month":
                        $return[] = $translator->trans("this month");
                        break;
                    case "custom":
                        $dates = [];
                        $dateFilter = $this->container->get("filter.date");

                        $dateFilter->getStartDate() and $dates["%startDate%"] = $dateFilter->getStartDateString();
                        $dateFilter->getEndDate() and $dates["%endDate%"] = $dateFilter->getEndDateString();

                        switch (count($dates)) {
                            default:
                                $return[] = $translator->trans("currently on course", $dates);
                                break;
                            case 1:
                                $return[] = $translator->trans("happening from %startDate% on", $dates);
                                break;
                            case 2:
                                $return[] = $translator->trans("happening between %startDate% and %endDate%", $dates);
                                break;
                        }
                        break;
                }
            }
        }

        return implode(" ", $return);
    }
}
