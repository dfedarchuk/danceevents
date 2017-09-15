<?php

namespace ArcaSolutions\ArticleBundle\Services\Synchronization;

use ArcaSolutions\ArticleBundle\Entity\Article;
use ArcaSolutions\ArticleBundle\Entity\Articlecategory;
use ArcaSolutions\ArticleBundle\Search\ArticleConfiguration;
use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Modules\BaseSynchronizable;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Synchronization;
use ArcaSolutions\ImageBundle\Entity\Image;
use Elastica\Document;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ArticleSynchronizable extends BaseSynchronizable implements EventSubscriberInterface
{
    function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->configurationService = "article.search";
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
        $qB = $doctrine->getRepository("ArticleBundle:Article")->createQueryBuilder('article');

        if ($output) {
            $totalCount = $qB->select('COUNT(article.id)')->getQuery()->getSingleScalarResult();

            $progressBar = new ProgressBar($output, $totalCount);

            $progressBar->start();
        }

        $this->container->get("search.engine")->clearType(ArticleConfiguration::$elasticType);

        $iteration = 0;

        $query = $qB->select("article.id")
            ->where("article.status = :articleStatus")
            ->setParameter("articleStatus", "A");

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
            $elements = $this->container->get("doctrine")->getRepository("ArticleBundle:Article")->findBy(["id" => $ids]);

            while ($element = array_pop($elements)) {
                $result[] = $this->getUpsertDocument($element);
            }
        }

        return $result;
    }

    /**
     * @param Article $article
     * @return Document|null
     */
    public function getUpsertDocument($article)
    {
        $document = null;

        if ($article and is_object($article)) {
            $document = new Document(
                $article->getId(),
                $this->generateDocFromEntity($article),
                $this->container->get($this->getConfigurationService())->getElasticType(),
                $this->container->get("search.engine")->getElasticIndexName()
            );

            $document->setDocAsUpsert(true);
        }

        return $document;
    }

    /**
     * @param Article $element
     * @return array
     */
    public function generateDocFromEntity($element)
    {
        if ($categories = $element->getCategories()) {
            $categoryIds = [];

            /* @var $category Articlecategory */
            while ($category = array_pop($categories)) {
                $categoryIds[] = $this->container->get("article.category.synchronization")
                    ->normalizeId($category->getId());
            }

            $categoryId = implode(" ", $categoryIds);
        } else {
            $categoryId = null;
        }

        $parentCategoryIds = [];
        for ($i = 1; $i <= 5; $i++) {
            $prop = sprintf('getCat%dId', $i);

            if (!$element->$prop()) {
                continue;
            }

            for ($j = 1; $j <= 4; $j++) {
                $prop = sprintf('getParcat%dLevel%dId', $i, $j);
                if ($element->$prop() > 0) {
                    $parentCategoryIds[] = $this->container->get("article.category.synchronization")
                        ->normalizeId($element->$prop());
                }
            }
        }

        if ($reviewCount = $this->container->get("doctrine")
            ->getRepository("WebBundle:Review")
            ->getTotalByItemId($element->getId(), "article")
        ) {
            is_array($reviewCount) and $reviewCount = array_pop($reviewCount);
        }

        $suggest = [
            'input'   => $element->getFulltextsearchKeyword(),
            'output'  => $element->getTitle(),
            'payload' => [
                'friendlyUrl' => $element->getFriendlyUrl(),
                'type'        => 'article',
                'id'          => $element->getId(),
            ],
            'weight'  => 90,
        ];

        /* @var $image Image */
        if ($element->getThumbId() and $image = $this->container->get("doctrine")->getRepository("ImageBundle:Image")->find($element->getThumbId())) {
            $thumbnail = $this->container->get("imagehandler")->getPath($image);
        } else {
            $thumbnail = null;
        }

        $publicationDate = $element->getPublicationDate()->format("Y-m-d");
        $document =
            [
                "abstract"        => $element->getAbstract(),
                "accountId"       => $element->getAccountId(),
                "author"          => [
                    "name" => $element->getAuthor(),
                    "url"  => $element->getAuthorUrl(),
                ],
                "averageReview"   => $element->getAvgReview(),
                "categoryId"      => $categoryId,
                "parentCategoryId"  => implode(' ', array_unique($parentCategoryIds)) ?: null,
                "friendlyUrl"     => $element->getFriendlyUrl(),
                "level"           => $element->getLevel(),
                "publicationDate" => $publicationDate == Utility::BAD_DATE_VALUE ? null : $publicationDate,
                "reviewCount"     => $reviewCount,
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
            ];

        return $document;
    }

    /**
     * @inheritdoc
     */
    public function extractFromResult($info)
    {
        return [
            'abstract'        => $info['abstract'],
            'accountId'       => $info['accountId'],
            'author'          => [
                'name' => $info['author.name'],
                'url'  => $info['author.url'],
            ],
            'averageReview'   => $info['averageReview'],
            'friendlyUrl'     => $info['friendlyUrl'],
            '_id'             => $info['_id'],
            'level'           => $info['level'],
            'publicationDate' => $info['publicationDate'],
            'reviewCount'     => $info['reviewCount'],
            'searchInfo'      => [
                'keyword' => $info['searchInfo.keyword'],
            ],
            'status'          => $info['status'],
            'thumbnail'       => $info['thumbnail'],
            'title'           => $info['title'],
            'views'           => $info['views'],
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
}
