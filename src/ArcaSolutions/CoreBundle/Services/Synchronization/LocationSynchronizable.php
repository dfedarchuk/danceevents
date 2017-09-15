<?php

namespace ArcaSolutions\CoreBundle\Services\Synchronization;

use ArcaSolutions\CoreBundle\Entity\Location1;
use ArcaSolutions\CoreBundle\Entity\Location2;
use ArcaSolutions\CoreBundle\Entity\Location3;
use ArcaSolutions\CoreBundle\Entity\Location4;
use ArcaSolutions\CoreBundle\Search\BaseConfiguration;
use ArcaSolutions\CoreBundle\Search\LocationConfiguration;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Modules\BaseSynchronizable;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Synchronization;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Location;
use Elastica\Document;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LocationSynchronizable extends BaseSynchronizable implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'edirectory.synchronization' => 'handleEvent',
        ];
    }

    public function handleEvent($event, $eventName)
    {
        $this->generateAll();
    }

    private $activeLocations = [];

    function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->configurationService = "location.search";
        $this->databaseType = Synchronization::DATABASE_MAIN;
        $this->upsertFormat = static::DOCUMENT_UPSERT;
        $this->deleteFormat = static::DELETE_ID_PREFORMATTED;

        $this->activeLocations = $this->container->get('doctrine')->getRepository('WebBundle:SettingLocation')->getLocationsEnabledID(false);

        sort($this->activeLocations);

        $this->idFormat = "L%d:%d";
    }

    /**
     * This function erases and rebuilds from scratch the entire location tree on Elasticsearch.
     * It takes quite a while to execute, so be patient. Avoid using this whenever possible.
     * @param null $output
     */
    public function generateAll($output = null)
    {
        $progressBar = null;
        $doctrine = $this->container->get('doctrine');

        if ($output) {
            $totalCount = 0;
            for ($i = 1; $i < 6; $i++) {
                $qB = $doctrine->getRepository("CoreBundle:Location{$i}", "main")->createQueryBuilder("location");
                $totalCount += $qB->select('COUNT(location.id)')->getQuery()->getSingleScalarResult();
            }

            $progressBar = new ProgressBar($output, $totalCount);
            $progressBar->start();
        }

        $this->container->get("search.engine")->clearType(LocationConfiguration::$elasticType);

        /* The first location level will ALWAYS exist, no matter what. */
        $firstLocationLevel = reset($this->activeLocations);
        $firstLevelLocations = $doctrine->getRepository("CoreBundle:Location{$firstLocationLevel}", 'main')->findAll();

        while ($location = array_pop($firstLevelLocations)) {
            $this->generateTree($location, 0, null, $progressBar);
            $doctrine->getManager()->clear();
        }
    }

    /**
     * This function will generate an entire tree branch in elasticsearch based on the Doctrine location $element. It
     * navigates through the available locations using the $i index paremeter, and recursivelly sends its id into the
     * next branch level through the $parentId parameter.
     *
     * <b>This is a Recursive function</b>.
     *
     * @param mixed $element
     * @param int $i
     * @param string|null $parentId
     * @param ProgressBar|null $progressBar
     * @param string|null $parentName
     * @return string
     */
    public function generateTree($element, $i, $parentId = null, $progressBar = null, $parentName = null)
    {
        $id = $element->getId();
        $level = $this->activeLocations[$i];
        $elasticId = $this->formatId($id, $level);

        $childLevel = ++$i < count($this->activeLocations) ? $this->activeLocations[$i] : null;
        $subLocationId = [];

        if ($childLevel) {
            $children = $this->container->get("doctrine")
                ->getRepository("CoreBundle:Location{$childLevel}", 'main')
                ->findBy(["location{$level}" => $id]);

            /* @var $child Location1|Location2|Location3|Location4 */
            foreach ($children as $child) {
                $subLocationId[] = $this->generateTree($child, $i, $elasticId, $progressBar, $element->getName());
            }
        }

        /* @var $element Location1 */
        $this->addUpsertDoc(
            $elasticId,
            $element->getName(),
            $element->getFriendlyUrl(),
            $parentId,
            $subLocationId,
            $level,
            $element->getName(),
            ['friendlyUrl' => $element->getFriendlyUrl()],
            $element->getSeoDescription(),
            $element->getSeoKeywords(),
            $element->getPageTitle(),
            $parentName
        );
        $progressBar and $progressBar->advance();

        return $elasticId;
    }

    /**
     * Adds a document containing location information to the elasticsearch upsert row
     *
     * @param string $id
     * @param string $title
     * @param string $friendlyUrl
     * @param string $parentId
     * @param string[] $subLocationId
     * @param int $level
     * @param string $suggestInput
     * @param string $suggestPayload
     * @param string $seoDescription
     * @param string $seoKeywords
     * @param string $seoTitle
     * @param null $parentName
     */
    public function addUpsertDoc(
        $id,
        $title,
        $friendlyUrl,
        $parentId,
        $subLocationId,
        $level,
        $suggestInput,
        $suggestPayload,
        $seoDescription,
        $seoKeywords,
        $seoTitle,
        $parentName = null
    ) {
        /* @var $configuration BaseConfiguration */
        $configuration = $this->container->get($this->getConfigurationService());

        $document = new Document(
            $id,
            [
                'title'         => $title,
                'friendlyUrl'   => $friendlyUrl,
                'parentId'      => $parentId,
                'subLocationId' => $subLocationId,
                'level'         => $level,
                'seo'           => [
                    'description' => $seoDescription,
                    'keywords'    => $seoKeywords,
                    'title'       => $seoTitle,
                ],
                'suggest'       => [
                    'where' => [
                        'input'   => $suggestInput,
                        'output'  => $suggestInput.(!empty($parentName) ? ", ".$parentName : ""),
                        'payload' => $suggestPayload,
                    ],
                ],
            ],
            $configuration->getElasticType(),
            $this->container->get("search.engine")->getElasticIndexName()
        );

        $document->setDocAsUpsert(true);

        $this->upsertStash[$id] = $document;

        if (count($this->upsertStash) > Synchronization::BULK_THRESHOLD) {
            $this->container->get('elasticsearch.synchronization')->synchronize();
        }
    }

    /**
     * Inserts a Location1 id for upsertion
     * @param int|int[] $ids
     */
    public function addLocation1Upsert($ids)
    {
        if (in_array("1", $this->activeLocations)) {
            $this->addUpsertId($ids, "1");
        }
    }

    /**
     * Inserts a Location2 id for upsertion
     * @param int|int[] $ids
     */
    public function addLocation2Upsert($ids)
    {
        if (in_array("2", $this->activeLocations)) {
            $this->addUpsertId($ids, "2");
        }
    }

    /**
     * Inserts a Location3 id for upsertion
     * @param int|int[] $ids
     */
    public function addLocation3Upsert($ids)
    {
        if (in_array("3", $this->activeLocations)) {
            $this->addUpsertId($ids, "3");
        }
    }

    /**
     * Inserts a Location4 id for upsertion
     * @param int|int[] $ids
     */
    public function addLocation4Upsert($ids)
    {
        if (in_array("4", $this->activeLocations)) {
            $this->addUpsertId($ids, "4");
        }
    }

    /**
     * Inserts a Location5 id for upsertion
     * @param int|int[] $ids
     */
    public function addLocation5Upsert($ids)
    {
        if (in_array("5", $this->activeLocations)) {
            $this->addUpsertId($ids, "5");
        }
    }

    /**
     * Inserts a Location1 id for deletion
     * @param int|int[] $ids
     */
    public function addLocation1Delete($ids)
    {
        if (in_array("1", $this->activeLocations)) {
            $this->addDeleteId($ids, "1");
        }
    }

    /**
     * Inserts a Location2 id for deletion
     * @param int|int[] $ids
     */
    public function addLocation2Delete($ids)
    {
        if (in_array("2", $this->activeLocations)) {
            $this->addDeleteId($ids, "2");
        }
    }


    /**
     * Inserts a Location3 id for deletion
     * @param int|int[] $ids
     */
    public function addLocation3Delete($ids)
    {
        if (in_array("3", $this->activeLocations)) {
            $this->addDeleteId($ids, "3");
        }
    }


    /**
     * Inserts a Location4 id for deletion
     * @param int|int[] $ids
     */
    public function addLocation4Delete($ids)
    {
        if (in_array("4", $this->activeLocations)) {
            $this->addDeleteId($ids, "4");
        }
    }


    /**
     * Inserts a Location5 id for deletion
     * @param int|int[] $ids
     */
    public function addLocation5Delete($ids)
    {
        if (in_array("5", $this->activeLocations)) {
            $this->addDeleteId($ids, "5");
        }
    }

    /**
     * Inserts an item Id in the delete queue. This function will remove the item from Elasticsearch
     * @param int|int[] $ids
     * @param int $level
     * @param bool $updateParent
     */
    public function addDeleteId($ids, $level, $updateParent = true)
    {
        if ($ids and $ids = (array)$ids) {
            $searchEngine = $this->container->get("search.engine");

            foreach ($ids as $id) {

                $elasticId = $this->formatId($id, $level);

                if (!isset($this->deleteStash[$elasticId])) {

                    /* @var Location $elasticLocation */
                    if ($elasticLocation = $searchEngine->locationIdSearch([$elasticId])) {
                        $elasticLocation = array_pop($elasticLocation);

                        /* Lets remove this guy from his parent's children */
                        if ($updateParent && $elasticLocation->getParentId()) {
                            /* @var Location $elasticParent */
                            $elasticParent = $searchEngine->locationIdSearch([$elasticLocation->getParentId()]);
                            $elasticParent = array_pop($elasticParent);

                            $elasticParent->setSubLocationId(
                                array_diff($elasticParent->getSubLocationId(),
                                    [$elasticId])
                            );

                            $seo = $elasticParent->getSeo();

                            $this->addUpsertDoc(
                                $elasticParent->getId(),
                                $elasticParent->getTitle(),
                                $elasticParent->getFriendlyUrl(),
                                $elasticParent->getParentId(),
                                $elasticParent->getSubLocationId(),
                                $elasticParent->getLevel(),
                                $elasticParent->getTitle(),
                                ['friendlyUrl' => $elasticParent->getFriendlyUrl()],
                                $seo["description"],
                                $seo["keywords"],
                                $seo["title"]
                            );
                        }

                        /* All children will also be obliterated */
                        foreach ($elasticLocation->getSubLocationId() as $child) {
                            $parts = [];

                            if (preg_match("/L(\d+):(\d+)/", $child, $parts)) {
                                /* Group 1 is Level, 2 is ID. Please note that we're getting recursive here, but since
                                 * the parent is being deleted, there is no need to update it. */
                                $this->addDeleteId($parts[2], $parts[1], false);
                            }
                        }

                        $this->deleteStash[$elasticId] = $elasticId;
                    }

                    unset($this->upsertStash[$id]);
                    unset($this->viewUpdateStash[$id]);
                    unset($this->averageReviewUpdateStash[$id]);
                }
            }

            if (count($this->deleteStash) > Synchronization::BULK_THRESHOLD) {
                $this->container->get('elasticsearch.synchronization')->synchronize();
            }
        }
    }

    /**
     * Updates a single location entry on the elasticsearch database
     * $updateParent Defines whether or not the parent should be updated
     *
     * @param int|int[] $ids
     * @param int $level
     * @param bool $updateParent
     */
    public function addUpsertId($ids, $level, $updateParent = true)
    {
        if ($ids and $ids = (array)$ids) {
            $doctrine = $this->container->get("doctrine");
            $parentLocation = null;

            foreach ($ids as $id) {
                if ($location = $doctrine->getRepository("CoreBundle:Location{$level}", 'main')->find($id)) {
                    $i = array_search($level, $this->activeLocations);

                    $parentId = null;
                    $parentLevel = ($i - 1) >= 0 ? $this->activeLocations[($i - 1)] : null;
                    $parentName = null;

                    /* This guy's parent should also be updated just in case this turns out to be an insertion */
                    if ($parentLevel) {
                        $parentGetterMethodName = "getLocation{$parentLevel}";

                        if (method_exists($location, $parentGetterMethodName)) {
                            $parentId = call_user_func([$location, $parentGetterMethodName]);

                            /* @var $parentLocation Location1|Location2|Location3|\Location4 */
                            $parentLocation = $doctrine->getRepository("CoreBundle:Location{$parentLevel}",
                                'main')->find($parentId);

                            if ($updateParent) {
                                $this->addUpsertId($parentId, $parentLevel, false);
                            }

                            $parentId = $this->formatId($parentId, $parentLevel);
                            $parentName = $parentLocation->getName();
                        }
                    }

                    $childLevel = ($i + 1) < count($this->activeLocations) ? $this->activeLocations[$i + 1] : null;
                    $subLocationId = [];

                    if ($childLevel) {
                        $children = $doctrine->getRepository("CoreBundle:Location{$childLevel}", 'main')
                            ->findBy(["location{$level}" => $id]);

                        foreach ($children as $child) {
                            $subLocationId[] = $this->formatId($child->getId(), $childLevel);
                        }
                    }

                    /* @var $location Location1 */
                    $this->addUpsertDoc(
                        $this->formatId($location->getId(), $level),
                        $location->getName(),
                        $location->getFriendlyUrl(),
                        $parentId,
                        $subLocationId,
                        $level,
                        $location->getName(),
                        ['friendlyUrl' => $location->getFriendlyUrl()],
                        $location->getSeoDescription(),
                        $location->getSeoKeywords(),
                        $location->getPageTitle(),
                        $parentName
                    );
                }

                /* (In)Sanity check. */
                unset($this->deleteStash[$id]);
                unset($this->viewUpdateStash[$id]);
                unset($this->averageReviewUpdateStash[$id]);
            }

            if (count($this->upsertStash) > Synchronization::BULK_THRESHOLD) {
                $this->container->get('elasticsearch.synchronization')->synchronize();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getUpsertStash()
    {
        return $this->upsertStash;
    }

    /**
     * {@inheritdoc}
     */
    public function addViewUpdate($ids)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function addAverageReviewUpdate($id, $value)
    {
    }

    /**
     * Returns the id of a certain location level id in elasticsearch format
     * @param $id
     * @param $level
     * @return string
     */
    public function formatId($id, $level)
    {
        return sprintf($this->idFormat, (int)$level, (int)$id);
    }
}
