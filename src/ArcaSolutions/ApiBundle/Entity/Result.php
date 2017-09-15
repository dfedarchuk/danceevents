<?php


namespace ArcaSolutions\ApiBundle\Entity;


use ArcaSolutions\ApiBundle\Documents\GeneralDocument;
use ArcaSolutions\SearchBundle\Entity\Filters\CategoryFilter;
use ArcaSolutions\SearchBundle\Entity\Filters\DateFilter;
use ArcaSolutions\SearchBundle\Entity\Filters\LocationFilter;
use ArcaSolutions\SearchBundle\Entity\Filters\RatingFilter;
use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchEngine;
use JMS\Serializer\Annotation\Groups;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Symfony\Component\DependencyInjection\ContainerInterface;


class Result
{

    /**
     * @var array
     * @Groups({"Result"})
     */
    private $paging;

    /**
     * @var array
     * @Groups({"Result"})
     */
    private $sorting;

    /**
     * @var array
     * @Groups({"Result"})
     */
    private $filtering;

    /**
     * @var array
     * @Groups({"Result"})
     */
    private $data;

    private $container;

    function __construct(
        SlidingPagination $pagination,
        SearchEvent $searchEvent,
        SearchEngine $searchEngine,
        ContainerInterface $containerInterface
    ) {
        if ($pagination == null) {
            return;
        }

        $this->container = $containerInterface;
        $parameterHandler = $this->container->get("search.parameters");

        /* Paging */
        $this->paging = [
            'page'  => $pagination->getCurrentPageNumber(),
            'pages' => $pagination->getPageCount(),
            'total' => $pagination->getTotalItemCount(),
        ];

        /* Sorting */
        $sorters = [];
        $sorterParam = $this->container->get("translator")->trans("sort", [], "filters");
        $sorterSelected = $parameterHandler->getQueryParameter($sorterParam);

        /* when sort selected is the default */
        if (empty($sorterSelected)) {
            $sorterSelected = [$searchEvent->getDefaultSorter()->getTranslatedName()];
        }

        foreach ($searchEvent->getSorters() as $key => $val) {
            $sorters[] = new Sort($val->getTranslatedName(), $key, $val->getName(), in_array($key, $sorterSelected));
        }

        /* Remove distance order */
        if (!$this->container->get('request')->get('lat') and !$this->container->get('request')->get('lng')) {
            $dist = array_filter($sorters, function ($var) {
                /** @var $var Sort */
                return ($var->getType() == 'distance');
            });
            unset($sorters[key($dist)]);
            $sorters = array_values($sorters);
        }

        $this->sorting = [
            'param'  => $sorterParam,
            'values' => $sorters,
        ];

        /* Filtering */
        $aggr = $pagination->getCustomParameter("aggregations");

        /* prepare module Filter */
        if (isset($aggr["ModuleFilter"]["buckets"])) {
            $values = [];
            /* removes the modules that doesn't have any item in the filtered result */
            $filteredAggr = array_filter($aggr["ModuleFilter"]["buckets"], function ($bucket) {
                if (isset($bucket['filtered'])) {
                    return ($bucket['filtered']['doc_count'] > 0);
                }

                return $bucket;
            });
            /* prepare possible values and labels for the module filter */
            foreach ($filteredAggr as $bucket) {
                /* @todo After 'promotion' has been changed to 'deal', change the line below */
                $key = $bucket['key'] == 'deal' ? 'promotion' : $bucket['key'];

                array_push($values, [
                    'label'       => /** @Ignore */
                        $searchEngine->getModuleAlias($bucket['key']),
                    'type'        => $bucket['key'],
                    'value'       => $bucket['key'],
                    'is_selected' => in_array($key, $parameterHandler->getModules()),
                ]);
            }

            /* guarantee that has at least two options */
            if (count($values) > 1) {
                $this->filtering['module'] = [
                    'param'    => 'module',
                    'multiple' => true,
                    'values'   => $values,
                ];
            }
        }

        foreach ($searchEvent->getFilters() as $filter) {
            /* prepare category Filter */
            if ($filter instanceof CategoryFilter && $filter->getAggregationInfo()) {
                $categoryTree = $filter->getCategoryTree();

                $this->filtering['categories'] = [
                    'param'    => 'category',
                    'multiple' => true,
                    'values'   => $categoryTree,
                ];
            }
            /* prepare location Filter */
            if ($filter instanceof LocationFilter && $filter->getAggregationInfo()) {
                $locationTree = $filter->getLocationTree();

                $this->filtering['locations'] = [
                    'param'    => 'location',
                    'multiple' => true,
                    'values'   => $locationTree,
                ];
            }

            /* prepare rating Filter */
            if ($filter instanceof RatingFilter && $filter->getAggregationInfo()) {
                $ratingParam = $searchEvent->getFilters()['RatingFilter']->getTranslatedName();

                $ratingTree = $filter->getRatingTree();

                sort($ratingTree);

                $this->filtering['rating'] = [
                    'param'    => $ratingParam,
                    'multiple' => true,
                    'values'   => array_values($ratingTree),
                ];
            }

            /* prepare date filter */
            if ($filter instanceof DateFilter) {
                /* API date format */
                $dateFormat = 'Y-m-d';
                /* dates selected */
                $startDate = $parameterHandler->hasStartDate() ? $parameterHandler->getStartDate()->format($dateFormat) : null;
                $endDate = $parameterHandler->hasEndDate() ? $parameterHandler->getEndDate()->format($dateFormat) : null;

                $values = [];
                /* ranges possible */
                /* Any Date */
                $values[] = [
                    'label' => /** @Ignore */
                        ucwords($this->container->get("translator")->trans('Any Date', [], 'messages')),
                    'value' => null,
                ];
                /* Today */
                $values[] = [
                    'label' => /** @Ignore */
                        ucwords($this->container->get("translator")->trans('Today', [], 'messages')),
                    'value' => (new \DateTime("today"))->format($dateFormat).",".(new \DateTime("today"))->format($dateFormat),
                ];
                /* This week */
                $values[] = [
                    'label' => /** @Ignore */
                        ucwords($this->container->get("translator")->trans('This week', [], 'messages')),
                    'value' => (new \DateTime("today"))->format($dateFormat).",".(new \DateTime("next Saturday"))->format($dateFormat),
                ];
                /* This weekend */
                $values[] = [
                    'label' => /** @Ignore */
                        ucwords($this->container->get("translator")->trans('This weekend', [], 'messages')),
                    'value' => (new \DateTime("next Saturday"))->format($dateFormat).",".(new \DateTime("next Sunday"))->format($dateFormat),
                ];
                /* This month */
                $values[] = [
                    'label' => /** @Ignore */
                        ucwords($this->container->get("translator")->trans('This month', [], 'messages')),
                    'value' => (new \DateTime("today"))->format($dateFormat).",".(new \DateTime("last day of this month"))->format($dateFormat),
                ];
                /* Custom Date */
                $customDate = [
                    'label'       => /** @Ignore */
                        ucwords($this->container->get("translator")->trans('Custom Date', [], 'messages')),
                    'value'       => $startDate && $endDate ? $startDate.",".$endDate : null,
                    'is_selected' => true,
                ];
                /* Set which possible date is selected */
                /* Custom Date will be always selected unless another one is */
                foreach ($values as &$value) {
                    $value['is_selected'] = ($startDate && $endDate) ? ($value['value'] == $startDate.",".$endDate) : $value['value'] == null;
                    if ($value['is_selected']) {
                        $customDate['is_selected'] = false;
                    }
                }
                $values[] = $customDate;

                /* multiple values separated by hyphen ( - ) */
                $this->filtering['date'] = [
                    'param'      => 'date',
                    'multiple'   => false,
                    'dateFormat' => $dateFormat,
                    'values'     => $values,
                ];
            }
        }

        /* Data results */
        $generalDocument = new GeneralDocument($this->container);
        $this->data = $generalDocument->getElasticResultsData($pagination->getItems());
    }
}
