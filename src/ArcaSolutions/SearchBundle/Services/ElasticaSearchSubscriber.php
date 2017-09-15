<?php

namespace ArcaSolutions\SearchBundle\Services;

use Elastica\Search;
use Knp\Component\Pager\Event\ItemsEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Elastica search pagination.
 *
 */
class ElasticaSearchSubscriber implements EventSubscriberInterface
{
    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return [
            'knp_pager.items' => ['items', 0], /* triggers before a standard array subscriber*/
        ];
    }

    public function items(ItemsEvent $event)
    {
        if (!$event->target instanceof Search) {
            return;
        }
        $search = $event->target;
        $query = $search->getQuery();

        $query->setFrom($event->getOffset());
        $query->setSize($event->getLimit());
        $results = $search->search($query);

        $event->count = $results->getTotalHits();

        if ($results->hasAggregations()) {
            $event->setCustomPaginationParameter('aggregations', $results->getAggregations());
        }

        $badges = [];
        $categories = [];
        $locations = [];

        foreach ($results as $result) {
            $data = $this->container->get('utility')->extractDataFromResult($result);

            if (!empty($data['badgeId'])) {
                $itemBadges = explode(" ", $data['badgeId']);

                foreach ($itemBadges as $badge) {
                    if (!isset($badges[$badge])) {
                        $badges[$badge] = true;
                    }
                }
            }

            if (!empty($data['categoryId'])) {
                $itemCategories = explode(" ", $data['categoryId']);

                foreach ($itemCategories as $cat) {
                    if (!isset($categories[$cat])) {
                        $categories[$cat] = true;
                    }
                }
            }

            if (!empty($data['locationId'])) {
                $itemLocations = explode(" ", $data['locationId']);

                foreach ($itemLocations as $loc) {
                    if (!isset($locations[$loc])) {
                        $locations[$loc] = true;
                    }
                }
            }
        }

        $searchEngine = $this->container->get("search.engine");

        $event->setCustomPaginationParameter(
            'pageBadges',
            $searchEngine->badgeIdSearch(array_keys($badges))
        );

        $event->setCustomPaginationParameter(
            'pageCategories',
            $searchEngine->categoryIdSearch(array_keys($categories))
        );

        $event->setCustomPaginationParameter(
            'pageLocations',
            $searchEngine->locationIdSearch(array_keys($locations))
        );

        $event->setCustomPaginationParameter('resultSet', $results);
        $event->items = $results->getResults();
        $event->stopPropagation();
    }
}
