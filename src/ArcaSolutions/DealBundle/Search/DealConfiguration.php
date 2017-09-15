<?php

namespace ArcaSolutions\DealBundle\Search;

use ArcaSolutions\CoreBundle\Search\BaseConfiguration;
use ArcaSolutions\ElasticsearchBundle\Entity\DecayFunction;
use ArcaSolutions\ListingBundle\Entity\Internal\ListingLevelFeatures;
use ArcaSolutions\ListingBundle\Search\ListingConfiguration;
use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchBlock;
use ArcaSolutions\SearchBundle\Services\SearchEngine;
use Elastica\Query;
use Elastica\Query\FunctionScore;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DealConfiguration extends BaseConfiguration
{
    /**
     * @var string|null
     */
    public static $elasticType = "deal";
    /**
     * @var string
     */
    protected $moduleUrlName = null;

    function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->moduleUrlName = $container->getParameter("alias_promotion_module");
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'search.global'     => 'registerItem',
            'search.global.map' => 'registerItem',
            'popular.deal'      => 'registerPopular',
            'recent.deal'       => 'registerRecent',
        ];
    }

    public function registerItem(SearchEvent $searchEvent)
    {
        /* @todo After 'promotion' has been changed to 'deal', change the line below */
        if (in_array('promotion', array_keys($this->searchEngine->getActiveModules()))) {
            $this->register($searchEvent);
            $qB = SearchEngine::getElasticaQueryBuilder();

            $this->setElasticaQuery(
                $qB->query()->filtered(
                    $this->createDefaultSearchQuery(),
                    $qB->filter()->bool_and([
                        $qB->filter()->type(self::$elasticType),
                        $qB->filter()->term()->setTerm("status", true),
                        $qB->filter()->range('date.start', ['lte' => 'now']),
                        $qB->filter()->range('date.end', ['gte' => 'now/d']),
                        $qB->filter()->range("amount", ['gt' => 0]),
                        $qB->filter()->exists('listing.friendlyUrl'),
                    ])
                )
            );
        }
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
                    ->addMust($qb->filter()->range('date.start', ['lte' => 'now']))
                    ->addMust($qb->filter()->range('date.end', ['gte' => 'now/d']))
                    ->addMust($qb->filter()->exists('listing.friendlyUrl'))
                    /* excludes previous items using var from SearchBlock */
                    ->addMustNot($qb->filter()->terms()
                        ->setTerms('_id', SearchBlock::$previousItems[self::$elasticType]))
            )
        );
    }

    /**
     * @param SearchEvent $searchEvent
     */
    public function registerRecent(SearchEvent $searchEvent)
    {
        /* registers this event */
        $this->register($searchEvent);

        $qb = SearchEngine::getElasticaQueryBuilder();

//        $searchEvent->setDefaultSorter($this->container->get('sorter.upcoming'));
        $searchEvent->addDecayfunction(new DecayFunction(FunctionScore::DECAY_GAUSS, 'date.start', 'now', '1d'));

        /* query */
        $this->setElasticaQuery(
            $qb->query()->filtered(
            /* gets all */
                $qb->query()->match_all(),
                $qb->filter()->bool()
                    /* sets status */
                    ->addMust($qb->filter()->term()->setTerm('status', true))
                    ->addMust($qb->filter()->range('date.start', ['lte' => 'now']))
                    ->addMust($qb->filter()->range('date.end', ['gte' => 'now/d']))
                    ->addMust($qb->filter()->exists('listing.friendlyUrl'))
                    /* excludes previous items using var from SearchBlock */
                    ->addMustNot($qb->filter()->terms()
                        ->setTerms('_id', SearchBlock::$previousItems[self::$elasticType]))
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getLevelFeatures(&$features)
    {
        if (empty($features[ListingConfiguration::$elasticType])) {
            /* Sets Listing level information to be used while rendering the summary templates */
            $features[ListingConfiguration::$elasticType] = ListingLevelFeatures::getAllLevelsAndNormalize(
                $this->container->get("doctrine")
            );
        }
    }
}
