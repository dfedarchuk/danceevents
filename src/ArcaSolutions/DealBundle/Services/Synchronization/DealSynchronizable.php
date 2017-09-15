<?php

namespace ArcaSolutions\DealBundle\Services\Synchronization;

use ArcaSolutions\CoreBundle\Entity\Location1;
use ArcaSolutions\CoreBundle\Entity\Location2;
use ArcaSolutions\CoreBundle\Entity\Location3;
use ArcaSolutions\CoreBundle\Entity\Location4;
use ArcaSolutions\CoreBundle\Entity\Location5;
use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\DealBundle\Entity\Promotion;
use ArcaSolutions\DealBundle\Search\DealConfiguration;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Modules\BaseSynchronizable;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Synchronization;
use ArcaSolutions\ImageBundle\Entity\Image;
use ArcaSolutions\ListingBundle\Entity\Listing;
use ArcaSolutions\ListingBundle\Entity\ListingCategory;
use Elastica\Document;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DealSynchronizable extends BaseSynchronizable implements EventSubscriberInterface
{
    function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->configurationService = "deal.search";
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
        $repo = $doctrine->getRepository("DealBundle:Promotion");

        if ($output) {
            $totalCount = $repo->countValidDeals();

            $progressBar = new ProgressBar($output, $totalCount);

            $progressBar->start();
        }

        $this->container->get("search.engine")->clearType(DealConfiguration::$elasticType);

        $iteration = 0;

        $query = $repo->findValidDeals();

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
            $elements = $this->container->get("doctrine")->getRepository("DealBundle:Promotion")->findBy(["id" => $ids]);

            while ($element = array_pop($elements)) {
                $result[] = $this->getUpsertDocument($element);
            }
        }

        return $result;
    }

    /**
     * @param Promotion $deal
     * @return Document|null
     */
    public function getUpsertDocument($deal)
    {
        $document = null;

        if ($deal and is_object($deal)) {
            $document = new Document(
                $deal->getId(),
                $this->generateDocFromEntity($deal),
                $this->container->get($this->getConfigurationService())->getElasticType(),
                $this->container->get("search.engine")->getElasticIndexName()
            );

            $document->setDocAsUpsert(true);
        }

        return $document;
    }

    /**
     * @param Promotion $element
     * @return array
     */
    public function generateDocFromEntity($element)
    {
        $doctrine = $this->container->get("doctrine");

        $geoLocation = null;
        $listingFriendlyUrl = null;
        $listingTitle = null;
        $listingStatus = null;
        $categoryIds = [];
        $parentCategoryIds = [];

        /* @var $listing Listing */
        if ($listing = $element->getListing() and $listing->getId()) {
            $listingFriendlyUrl = $listing->getFriendlyUrl();
            $listingTitle = $listing->getTitle();
            $listingStatus = $listing->getStatus();

            /** @var $categories ListingCategory[] */
            $categories = array_map(function ($item) {
                return $item->getCategory();
            }, $listing->getCategories()->getValues());

            $syncService = $this->container->get("listing.category.synchronization");

            while ($category = array_pop($categories)) {
                $categoryIds[] = $syncService->normalizeId($category->getId());

                $parents = $category->getParentIds($category);

                for ($i = 0; $i < count($parents); $i++) {
                    $parents[$i] = $syncService->normalizeId($parents[$i]);
                }

                $parentCategoryIds = array_merge($parentCategoryIds, $parents);
            }

            if ($latitude = $listing->getLatitude() and $longitude = $listing->getLongitude()) {
                $geoLocation = [
                    "lat" => $latitude,
                    "lon" => $longitude,
                ];
            }
        }

        $locationIds = [];
        $locationSynchronizable = $this->container->get("location.synchronization");

        /* @var $location1 Location1 */
        if ($location1 = $element->getListingLocation1()) {
            $locationIds[] = $locationSynchronizable->formatId($location1, 1);
        }

        /* @var $location2 Location2 */
        if ($location2 = $element->getListingLocation2()) {
            $locationIds[] = $locationSynchronizable->formatId($location2, 2);
        }

        /* @var $location3 Location3 */
        if ($location3 = $element->getListingLocation3()) {
            $locationIds[] = $locationSynchronizable->formatId($location3, 3);
        }

        /* @var $location4 Location4 */
        if ($location4 = $element->getListingLocation4()) {
            $locationIds[] = $locationSynchronizable->formatId($location4, 4);
        }

        /* @var $location5 Location5 */
        if ($location5 = $element->getListingLocation5()) {
            $locationIds[] = $locationSynchronizable->formatId($location5, 5);
        }

        $locationId = implode(" ", $locationIds);

        $suggest = [
            'input'   => $element->getFulltextsearchKeyword(),
            'output'  => $element->getName(),
            'payload' => [
                'friendlyUrl' => $element->getFriendlyUrl(),
                'type'        => 'deal',
                'id'          => $element->getId(),
            ],
            'weight'  => 100 - $element->getListingLevel(),
        ];

        /* @var $image Image */
        if ($element->getThumbId() and $image = $doctrine->getRepository("ImageBundle:Image")->find($element->getThumbId())) {
            $thumbnail = $this->container->get("imagehandler")->getPath($image);
        } else {
            $thumbnail = null;
        }

        $endDate = $element->getEndDate()->format("Y-m-d");
        $startDate = $element->getStartDate()->format("Y-m-d");

        $document = [
            "address"          => [
                "complement" => $element->getListingAddress2(),
                "street"     => $element->getListingAddress(),
            ],
            "amount"           => $element->getAmount(),
            "categoryId"       => implode(" ", $categoryIds) ?: null,
            "parentCategoryId" => implode(' ', $parentCategoryIds) ?: null,
            "date"             => [
                "end"   => $endDate == Utility::BAD_DATE_VALUE ? null : $endDate,
                "start" => $startDate == Utility::BAD_DATE_VALUE ? null : $startDate,
            ],
            "description"      => $element->getDescription(),
            "friendlyUrl"      => $element->getFriendlyUrl(),
            "geoLocation"      => $geoLocation,
            "level"            => $element->getListingLevel(),
            "listing"          => [
                "friendlyUrl" => $listingFriendlyUrl,
                "title"       => $listingTitle,
            ],
            "locationId"       => $locationId,
            "searchInfo"       => [
                "keyword"  => $element->getFulltextsearchKeyword(),
                "location" => $element->getFulltextsearchWhere(),
            ],
            "status"           => $listingStatus == "A",
            "suggest"          => [
                "what" => $suggest,
            ],
            "thumbnail"        => $thumbnail,
            "title"            => $element->getName(),
            "value"            => [
                "deal" => $element->getDealvalue(),
                "real" => $element->getRealvalue(),
            ],
            "views"            => $element->getNumberViews(),
        ];

        return $document;
    }

    /**
     * @inheritdoc
     */
    public function extractFromResult($info)
    {
        return [
            'address'     => [
                'street'     => $info['address.street'],
                'complement' => $info['address.complement'],
            ],
            'amount'      => $info['amount'],
            'categoryId'  => $info['categoryId'],
            'date'        => [
                'end'   => $info['date.end'],
                'start' => $info['date.start'],
            ],
            'description' => $info['description'],
            'friendlyUrl' => $info['friendlyUrl'],
            'geoLocation' => [
                'lat' => $info['geoLocation.lat'],
                'lon' => $info['geoLocation.lon'],
            ],
            '_id'         => $info['_id'],
            'level'       => $info['level'],
            'listing'     => [
                'friendlyUrl' => $info['listing.friendlyUrl'],
                'title'       => $info['listing.title'],
            ],
            'locationId'  => $info['locationId'],
            'searchInfo'  => [
                'keyword'  => $info['searchInfo.keyword'],
                'location' => $info['searchInfo.location'],
            ],
            'status'      => $info['status'],
            'thumbnail'   => $info['thumbnail'],
            'title'       => $info['title'],
            'value'       => [
                'deal' => $info['value.deal'],
                'real' => $info['value.real'],
            ],
            'views'       => $info['views'],
            'suggest'     => [
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
