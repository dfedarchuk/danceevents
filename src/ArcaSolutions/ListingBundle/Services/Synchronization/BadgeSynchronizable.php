<?php

namespace ArcaSolutions\ListingBundle\Services\Synchronization;

use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Modules\BaseSynchronizable;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Synchronization;
use ArcaSolutions\ImageBundle\Entity\Image;
use ArcaSolutions\ListingBundle\Entity\EditorChoice;
use ArcaSolutions\ListingBundle\Search\BadgeConfiguration;
use Elastica\Document;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BadgeSynchronizable extends BaseSynchronizable implements EventSubscriberInterface
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

    function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->configurationService = "badge.search";
        $this->databaseType = Synchronization::DATABASE_DOMAIN;
        $this->upsertFormat = static::DOCUMENT_UPSERT;
        $this->deleteFormat = static::DELETE_ID_RAW;
    }

    public function generateAll($output = null, $pageSize = Synchronization::BULK_THRESHOLD)
    {
        $progressBar = null;
        $doctrine = $this->container->get("doctrine");
        $qB = $doctrine->getRepository("ListingBundle:EditorChoice")->createQueryBuilder('badge');

        if ($output) {
            $totalCount = $qB->select('COUNT(badge.id)')->getQuery()->getSingleScalarResult();

            $progressBar = new ProgressBar($output, $totalCount);

            $progressBar->start();
        }

        $this->container->get("search.engine")->clearType(BadgeConfiguration::$elasticType);

        $iteration = 0;

        $query = $qB->select("badge.id");

        do {
            $query->setMaxResults($pageSize)->setFirstResult($pageSize * $iteration++);

            $ids = $query->getQuery()->getArrayResult();

            if ($foundCount = count($ids)) {
                array_walk($ids, function (&$value) {
                    $value = $value["id"];
                });

                $this->addUpsert($ids);
                $progressBar and $progressBar->advance($foundCount);
            }
            $doctrine->getManager()->clear();
        } while ($foundCount);

        $progressBar and $progressBar->finish();
    }

    /**
     * @param EditorChoice $element
     * @return string
     */
    public function generateDocFromEntity($element)
    {
        /* @var $image Image */
        if ($element->getImageId() and $image = $this->container->get("doctrine")->getRepository("ImageBundle:Image")->find($element->getImageId())) {
            $thumbnail = $this->container->get("imagehandler")->getPath($image);
        } else {
            $thumbnail = null;
        }

        $document = [
            "available" => $element->getAvailable(),
            "image"     => $thumbnail,
            "name"      => $element->getName()
        ];

        return $document;
    }

    /**
     * @param Editorchoice $badge
     * @return Document|null
     */
    public function getUpsertDocument($badge)
    {
        $document = null;

        if ($badge and is_object($badge)) {
            $document = new Document(
                $badge->getId(),
                $this->generateDocFromEntity($badge),
                $this->container->get($this->getConfigurationService())->getElasticType(),
                $this->container->get("search.engine")->getElasticIndexName()
            );

            $document->setDocAsUpsert(true);
        }

        return $document;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpsertStash()
    {
        $result = [];

        if ($ids = parent::getUpsertStash()) {
            $elements = $this->container->get("doctrine")->getRepository("ListingBundle:EditorChoice")->findBy(["id" => $ids]);

            while ($element = array_pop($elements)) {
                $result[] = $this->getUpsertDocument($element);
            }
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function extractFromResult($info)
    {
        return [
            '_id'       => $info['_id'],
            'available' => $info['available'],
            'image'     => $info['image'],
            'name'      => $info['name'],
        ];
    }

    public function addViewUpdate($ids)
    {
    }

    public function addAverageReviewUpdate($id, $value)
    {
    }
}
