<?php

namespace ArcaSolutions\EventBundle\Search;

use ArcaSolutions\CoreBundle\Search\BaseConfiguration;
use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\EventBundle\Entity\Internal\EventLevelFeatures;
use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchBlock;
use ArcaSolutions\SearchBundle\Services\SearchEngine;
use Elastica\QueryBuilder;
use Elastica\Script\Script;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EventConfiguration extends BaseConfiguration
{
    /**
     * @var string|null
     */
    public static $elasticType = "event";
    /**
     * @var string
     */
    protected $moduleUrlName = null;

    function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->moduleUrlName = $container->getParameter("alias_event_module");
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'search.global'     => 'registerItem',
            'search.global.map' => 'registerItem',
            'featured.event'    => 'registerFeatured',
            'popular.event'     => 'registerPopular',
        ];
    }

    public function registerItem(SearchEvent $searchEvent)
    {
        if (in_array(self::$elasticType, array_keys($this->searchEngine->getActiveModules()))) {
            $this->register($searchEvent);
            $qB = SearchEngine::getElasticaQueryBuilder();

            $filter = $this->createFilter();

            $this->setElasticaQuery(
                $qB->query()->filtered($this->createDefaultSearchQuery(), $filter)
            );
        }
    }

    /**
     * Gets filter to event has not expired.
     *
     * @param QueryBuilder $queryBuilder
     * @return \Elastica\Filter\Script
     */
    private function getNotExpiredEvents(QueryBuilder $queryBuilder)
    {
        return $queryBuilder->filter()->script(new Script("notHasExpired", ["field" => "recurrent_date"], "native"));
    }

    /**
     * Gets features listings using elasticSearch
     *
     * @param SearchEvent $event
     */
    public function registerFeatured(SearchEvent $event)
    {
        /* registers this event */
        $this->register($event);

        $qb = SearchEngine::getElasticaQueryBuilder();

        /* all levels with module as a key */
        $this->getLevelFeatures($featuredLevels);

        /* getting just featured levels */
        $featuredLevels = array_filter(array_map(function ($array) {
            if ('y' == $array->isFeatured) {
                return $array->level;
            }
        }, current($featuredLevels)));

        /* query */
        $this->setElasticaQuery(
            $qb->query()
                ->filtered(
                /* gets all */
                    $qb->query()->match_all(),
                    $qb->filter()->bool()
                        /* sets level */
                        ->addMust($qb->filter()->terms()->setTerms('level', $featuredLevels))
                        /* sets status */
                        ->addMust($qb->filter()->term()->setTerm('status', true))
                        /* excludes previous items using var from SearchBlock */
                        ->addMustNot($qb->filter()->terms()
                            ->setTerms('_id', SearchBlock::$previousItems[self::$elasticType]))
                        /* conditions events */
                        ->addShould($this->getNotExpiredEvents($qb))
                )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getLevelFeatures(&$features)
    {
        /* Sets Event level information to be used while rendering the summary templates */
        $features[self::$elasticType] = EventLevelFeatures::getAllLevelsAndNormalize(
            $this->container->get("doctrine")
        );
    }

    /**
     * @param SearchEvent $searchEvent
     */
    public function registerPopular(SearchEvent $searchEvent)
    {
        /* registers this event */
        $this->register($searchEvent);

        $qb = SearchEngine::getElasticaQueryBuilder();

        $searchEvent->setDefaultSorter($this->container->get('sorter.view'));

        /* query */
        $this->setElasticaQuery(
            $qb->query()->filtered(
            /* gets all */
                $qb->query()->match_all(),
                $qb->filter()->bool()
                    /* sets status */
                    ->addMust($qb->filter()->term()->setTerm('status', true))
                    /* excludes previous items using var from SearchBlock */
                    ->addMustNot($qb->filter()->terms()
                        ->setTerms('_id', SearchBlock::$previousItems[self::$elasticType]))
                    /* conditions events */
                    ->addShould($this->getNotExpiredEvents($qb))
            )
        );
    }

    /**
     * @return mixed
     */
    protected function createFilter()
    {
        $qB = SearchEngine::getElasticaQueryBuilder();

        $filter = $qB->filter()->bool()
            ->addMust($qB->filter()->type(self::$elasticType))
            ->addMust($qB->filter()->term()->setTerm("status", true));

        return $filter;
    }
}
