<?php

namespace ArcaSolutions\ClassifiedBundle\Search;

use ArcaSolutions\ClassifiedBundle\Entity\Internal\ClassifiedLevelFeatures;
use ArcaSolutions\CoreBundle\Search\BaseConfiguration;
use ArcaSolutions\SearchBundle\Events\SearchEvent;
use ArcaSolutions\SearchBundle\Services\SearchBlock;
use ArcaSolutions\SearchBundle\Services\SearchEngine;
use Elastica\Query;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ClassifiedConfiguration extends BaseConfiguration
{
    /**
     * @var string|null
     */
    public static $elasticType = "classified";
    /**
     * @var string
     */
    protected $moduleUrlName = null;

    function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->moduleUrlName = $container->getParameter("alias_classified_module");
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'search.global'       => 'registerItem',
            'search.global.map'   => 'registerItem',
            'featured.classified' => 'registerFeatured',
            'bestof.classified'   => 'registerBestOf',
            'recent.classified'   => 'registerRecent',
        ];
    }

    public function registerItem(SearchEvent $searchEvent)
    {
        if (in_array(self::$elasticType, array_keys($this->searchEngine->getActiveModules()))) {
            $this->register($searchEvent);

            $qB = SearchEngine::getElasticaQueryBuilder();

            $this->setElasticaQuery(
                $qB->query()->filtered(
                    $this->createDefaultSearchQuery(),
                    $qB->filter()->bool()
                        ->addMust($qB->filter()->type(self::$elasticType))
                        ->addMust($qB->filter()->term()->setTerm("status", true))
                )
            );
        }
    }

    /**
     * Gets features classified using elasticSearch
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
            $qb->query()->filtered(
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
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getLevelFeatures(&$features)
    {
        /* Sets Classified level information to be used while rendering the summary templates */
        $features[self::$elasticType] = ClassifiedLevelFeatures::getAllLevelsAndNormalize(
            $this->container->get("doctrine")
        );
    }

    /**
     * @param SearchEvent $searchEvent
     *
     * @throws \Exception
     */
    public function registerBestOf(SearchEvent $searchEvent)
    {
        /* registers this event */
        $this->register($searchEvent);

        /* gets options */
        $options = $searchEvent->getOptions();

        if (!is_array($options) || !isset($options['category_id'])) {
            throw new \Exception('You must pass a category ID in best of event.');
        }

        $qb = SearchEngine::getElasticaQueryBuilder();

        /* query */
        $this->setElasticaQuery(
            $qb->query()->filtered(
            /* gets all */
                $qb->query()->match_all(),
                $qb->filter()->bool()
                    /* sets level */
                    /* in elasticsearch, all categories's id are concatenated with a letter that link with there module */
                    ->addMust($qb->filter()->term()->setTerm('categoryId', 'C:'.$options['category_id']))
                    /* sets status */
                    ->addMust($qb->filter()->term()->setTerm('status', true))
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
            )
        );
    }
}
