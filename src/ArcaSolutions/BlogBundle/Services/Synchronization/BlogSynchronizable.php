<?php

namespace ArcaSolutions\BlogBundle\Services\Synchronization;

use ArcaSolutions\BlogBundle\Entity\Blogcategory;
use ArcaSolutions\BlogBundle\Entity\Post;
use ArcaSolutions\BlogBundle\Search\BlogConfiguration;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Modules\BaseSynchronizable;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Synchronization;
use ArcaSolutions\ImageBundle\Entity\Image;
use Elastica\Document;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BlogSynchronizable extends BaseSynchronizable implements EventSubscriberInterface
{
    function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->configurationService = "blog.search";
        $this->databaseType = Synchronization::DATABASE_DOMAIN;
        $this->upsertFormat = static::DOCUMENT_UPSERT;
        $this->deleteFormat = static::DELETE_ID_RAW;
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
        $qB = $doctrine->getRepository("BlogBundle:Post")->createQueryBuilder('blog');

        if ($output) {
            $totalCount = $qB->select('COUNT(blog.id)')->getQuery()->getSingleScalarResult();

            $progressBar = new ProgressBar($output, $totalCount);

            $progressBar->start();
        }

        $this->container->get("search.engine")->clearType(BlogConfiguration::$elasticType);

        $iteration = 0;

        $query = $qB->select("blog.id");

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
            $elements = $this->container->get("doctrine")->getRepository("BlogBundle:Post")->findBy(["id" => $ids]);

            while ($element = array_pop($elements)) {
                $result[] = $this->getUpsertDocument($element);
            }
        }

        return $result;
    }

    /**
     * @param Post $blog
     * @return Document|null
     */
    public function getUpsertDocument($blog)
    {
        $document = null;

        if ($blog and is_object($blog)) {
            $document = new Document(
                $blog->getId(),
                $this->generateDocFromEntity($blog),
                $this->container->get($this->getConfigurationService())->getElasticType(),
                $this->container->get("search.engine")->getElasticIndexName()
            );

            $document->setDocAsUpsert(true);
        }

        return $document;
    }

    /**
     * @param Post $element
     * @return array
     */
    public function generateDocFromEntity($element)
    {
        $doctrine = $this->container->get("doctrine");

        /* @var $categories Blogcategory[] */
        $categories = array_map(function ($item) {
            return $item->getCategory();
        }, $element->getCategories()->getValues());

        $categoryIds = [];
        $parentCategoryIds = [];
        $syncService = $this->container->get("blog.category.synchronization");

        while ($category = array_pop($categories)) {
            $categoryIds[] = $syncService->normalizeId($category->getId());

            $parents = $category->getParentIds($category);

            for ($i = 0; $i < count($parents); $i++) {
                $parents[$i] = $syncService->normalizeId($parents[$i]);
            }

            $parentCategoryIds = array_merge($parentCategoryIds, $parents);
        }

        $commentCount = $doctrine->getRepository("BlogBundle:Comments")
            ->createQueryBuilder("comments")
            ->select('COUNT(comments.id)')
            ->where("comments.postId = :commentsPostId")
            ->setParameter("commentsPostId", $element->getId())
            ->getQuery()
            ->getSingleScalarResult();

        $suggest = [
            'input'   => $element->getFulltextsearchKeyword(),
            'output'  => $element->getTitle(),
            'payload' => [
                'friendlyUrl' => $element->getFriendlyUrl(),
                'type'        => 'blog',
                'id'          => $element->getId(),
            ],
            'weight'  => 90,
        ];

        /* @var $image Image */
        if ($element->getThumbId() and $image = $doctrine->getRepository("ImageBundle:Image")->find($element->getThumbId())) {
            $thumbnail = $this->container->get("imagehandler")->getPath($image);
        } else {
            $thumbnail = null;
        }

        $publicationDate = $element->getEntered()->format("Y-m-d");

        $document = [
            "categoryId"      => implode(' ', $categoryIds) ?: null,
            "parentCategoryId"  => implode(' ', array_unique($parentCategoryIds)) ?: null,
            "commentCount"    => $commentCount,
            "content"         => $element->getContent(),
            "friendlyUrl"     => $element->getFriendlyUrl(),
            "level"           => 10,
            "publicationDate" => $publicationDate,
            "searchInfo"      => [
                "keyword" => $element->getFulltextsearchKeyword(),
            ],
            "status"          => $element->getStatus() == "A",
            "suggest"         => [
                "what" => $suggest,
            ],
            "thumbnail"       => $thumbnail,
            "title"           => $element->getTitle(),
            "views"           => $element->getNumberViews(),
        ];;

        return $document;
    }

    /**
     * @inheritdoc
     */
    public function extractFromResult($info)
    {
        return [
            '_id'             => $info['_id'],
            'categoryId'      => $info['categoryId'],
            'thumbnail'       => $info['thumbnail'],
            'views'           => $info['views'],
            'friendlyUrl'     => $info['friendlyUrl'],
            'title'           => $info['title'],
            'content'         => $info['content'],
            'status'          => $info['status'],
            'searchInfo'      => [
                'keyword' => $info['searchInfo.keyword'],
            ],
            'publicationDate' => $info['publicationDate'],
            'commentCount'    => $info['commentCount'],
            'level'           => $info['level'],
            'suggest'         => [
                'what' => [
                    'input'   => $info['suggest.what.input'],
                    'output'  => $info['suggest.what.output'],
                    'payload' => $info['suggest.what.payload'],
                    'weight'  => $info['suggest.what.weight'],
                ],
            ],
        ];
    }

    public function addAverageReviewUpdate($id, $value)
    {
    }
}

?>
