<?php

namespace ArcaSolutions\CoreBundle\Services\Synchronization;

use ArcaSolutions\BlogBundle\Entity\Blogcategory;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Modules\BaseSynchronizable;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Synchronization;
use Elastica\Document;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class BaseCategorySynchronizable extends BaseSynchronizable implements EventSubscriberInterface
{
    protected $repository;
    protected $elasticType;
    protected $moduleName;

    function __construct(ContainerInterface $container, $idFormat, $repository, $moduleName)
    {
        parent::__construct($container);

        $this->moduleName = $moduleName;
        $this->repository = $repository;
        $this->configurationService = "category.search";
        $this->idFormat = $idFormat;

        $this->databaseType = Synchronization::DATABASE_DOMAIN;
        $this->upsertFormat = static::DOCUMENT_UPSERT;
        $this->deleteFormat = static::DELETE_ID_PREFORMATTED;
        $this->elasticType = $container->get($this->getConfigurationService())->getElasticType();
    }

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

    public function generateAll($output = null, $pageSize = Synchronization::BULK_THRESHOLD)
    {
        $progressBar = null;
        $doctrine = $this->container->get("doctrine");
        $qB = $doctrine->getRepository($this->repository)->createQueryBuilder('category');

        if ($output) {
            $totalCount = $qB->select('COUNT(category.id)')->getQuery()->getSingleScalarResult();

            $progressBar = new ProgressBar($output, $totalCount);

            $progressBar->start();
        }

        $iteration = 0;

        $query = $qB->select("category.id");

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
     * {@inheritdoc}
     */
    public function getUpsertStash()
    {
        $result = [];

        if ($ids = parent::getUpsertStash()) {
            $elements = $this->container->get("doctrine")->getRepository($this->repository)->findBy(["id" => $ids]);

            while ($element = array_pop($elements)) {
                $result[] = $this->getUpsertDocument($element);
            }
        }

        return $result;
    }

    /**
     * @param $category
     * @return Document|null
     */
    public function getUpsertDocument($category)
    {
        $document = null;

        if ($category and is_object($category)) {
            $document = new Document(
                $this->normalizeId($category->getId()),
                $this->generateDocFromEntity($category),
                $this->elasticType,
                $this->container->get("search.engine")->getElasticIndexName()
            );

            $document->setDocAsUpsert(true);
        }

        return $document;
    }

    /**
     * @param Blogcategory $element
     * @return array
     */
    public function generateDocFromEntity($element)
    {
        if ($categories = $this->container->get("doctrine")->getRepository($this->repository)->findBy(["categoryId" => $element->getId()])) {
            $categoryIds = [];

            /* @var $category Blogcategory */
            while ($category = array_pop($categories)) {
                $categoryIds[] = $this->normalizeId($category->getId());
            }

            $subCategoryId = implode(" ", $categoryIds);
        } else {
            $subCategoryId = null;
        }

        $suggest = [
            'input'   => $element->getTitle(),
            'payload' => [
                'id'          => $element->getId(),
                'friendlyUrl' => $element->getFriendlyUrl(),
                'type'        => $this->moduleName."Category",
            ],
            'weight'  => 100,
        ];

        $thumbnail = null;

        if ($element->getThumbId() and $image = $this->container->get('doctrine')->getRepository("ImageBundle:Image")->find(
                $element->getThumbId()
            )
        ) {
            $thumbnail = $this->container->get("imagehandler")->getPath($image);
        }

        $document = [
            'description'   => $element->getSummaryDescription(),
            'friendlyUrl'   => $element->getFriendlyUrl(),
            'module'        => $this->moduleName,
            'content'       => $element->getContent(),
            'parentId'      => $element->getCategoryId() ? $this->normalizeId($element->getCategoryId()) : null,
            'seo'           => [
                'description' => $element->getSeoDescription(),
                'keywords'    => $element->getSeoKeywords(),
                'title'       => $element->getPageTitle(),
            ],
            'subCategoryId' => $subCategoryId,
            'suggest'       => [
                'what' => $suggest,
            ],
            'thumbnail'     => $thumbnail,
            'title'         => $element->getTitle(),
            'featured'      => $element->getFeatured() == 'y',
            'enabled'       => $element->getEnabled() == 'y',
        ];

        return $document;
    }

    /**
     * @inheritdoc
     */
    public function extractFromResult($info)
    {
        return [
            '_id'           => $info['_id'],
            'title'         => $info['title'],
            'content'       => $info['content'],
            'description'   => $info['description'],
            'friendlyUrl'   => $info['friendlyUrl'],
            'parentId'      => $info['parentId'],
            'subCategoryId' => $info['subCategoryId'],
            'module'        => $info['module'],
            'thumbnail'     => $info['thumbnail'],
            'seo'           => [
                'description' => $info['seo.description'],
                'keywords'    => $info['seo.keywords'],
                'title'       => $info['seo.title'],
            ],
            'suggest'       => [
                'what' => [
                    'input'   => $info['suggest.what.input'],
                    'payload' => $info['suggest.what.payload'],
                    'weight'  => $info['suggest.what.weight'],
                ],
            ],
            'enabled'       => $info['enabled'],
            'featured'      => $info['featured'],
        ];
    }

    public function addViewUpdate($ids)
    {
    }

    public function addAverageReviewUpdate($id, $value)
    {
    }
}
