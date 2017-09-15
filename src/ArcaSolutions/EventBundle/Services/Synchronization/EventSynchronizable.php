<?php

namespace ArcaSolutions\EventBundle\Services\Synchronization;

use ArcaSolutions\CoreBundle\Entity\Location1;
use ArcaSolutions\CoreBundle\Entity\Location2;
use ArcaSolutions\CoreBundle\Entity\Location3;
use ArcaSolutions\CoreBundle\Entity\Location4;
use ArcaSolutions\CoreBundle\Entity\Location5;
use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Modules\BaseSynchronizable;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Synchronization;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\EventBundle\Entity\EventCategory;
use ArcaSolutions\EventBundle\Search\EventConfiguration;
use ArcaSolutions\EventBundle\Services\Recurring;
use ArcaSolutions\ImageBundle\Entity\Image;
use Elastica\Document;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventSynchronizable extends BaseSynchronizable implements EventSubscriberInterface
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

        $this->configurationService = "event.search";
        $this->databaseType = Synchronization::DATABASE_DOMAIN;
        $this->upsertFormat = static::DOCUMENT_UPSERT;
        $this->deleteFormat = static::DELETE_ID_RAW;
    }

    public function generateAll($output = null, $pageSize = Synchronization::BULK_THRESHOLD)
    {
        $progressBar = null;
        $qB = $this->container->get("doctrine")->getRepository("EventBundle:Event")->createQueryBuilder('event');

        if ($output) {
            $totalCount = $qB->select('COUNT(event.id)')->getQuery()->getSingleScalarResult();

            $progressBar = new ProgressBar($output, $totalCount);

            $progressBar->start();
        }

        $this->container->get("search.engine")->clearType(EventConfiguration::$elasticType);

        $iteration = 0;

        $query = $qB->select("event.id")
            ->where("event.status = :eventStatus")
            ->setParameter("eventStatus", "A");

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
        } while ($foundCount);

        $progressBar and $progressBar->finish();
    }

    /**
     * @param Event $element
     * @return string
     */
    public function generateDocFromEntity($element)
    {
        if ($categories = $element->getCategories()) {
            $categoryIds = [];

            /* @var $category EventCategory */
            while ($category = array_pop($categories)) {
                $categoryIds[] = $this->container->get("event.category.synchronization")
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
                    $parentCategoryIds[] = $this->container->get("event.category.synchronization")
                        ->normalizeId($element->$prop());
                }
            }
        }

        if ($latitude = $element->getLatitude() and $longitude = $element->getLongitude()) {
            $geoLocation = [
                "lat" => $latitude,
                "lon" => $longitude,
            ];
        } else {
            $geoLocation = null;
        }

        $startDate = $element->getStartDate()->format("Y-m-d");

        if ($element->getRecurring() == "Y") {
            $recurrentDate = [
                "start_date" => $startDate,
                "rrule"      => Recurring::getRRule_rfc2445($element),
            ];
        } else {
            $recurrentDate = [
                "start_date" => $startDate,
            ];
            if (null != $element->getEndDate()) {
                $recurrentDate["end_date"] = $element->getEndDate()->format("Y-m-d");
            }
        }

        $locationIds = [];
        $locationSynchronizable = $this->container->get("location.synchronization");

        /* @var $location1 Location1 */
        if ($location1 = $element->getLocation1()) {
            $locationIds[] = $locationSynchronizable->formatId($location1, 1);
        }

        /* @var $location2 Location2 */
        if ($location2 = $element->getLocation2()) {
            $locationIds[] = $locationSynchronizable->formatId($location2, 2);
        }

        /* @var $location3 Location3 */
        if ($location3 = $element->getLocation3()) {
            $locationIds[] = $locationSynchronizable->formatId($location3, 3);
        }

        /* @var $location4 Location4 */
        if ($location4 = $element->getLocation4()) {
            $locationIds[] = $locationSynchronizable->formatId($location4, 4);
        }

        /* @var $location5 Location5 */
        if ($location5 = $element->getLocation5()) {
            $locationIds[] = $locationSynchronizable->formatId($location5, 5);
        }

        $locationId = implode(" ", $locationIds);

        $suggest = [
            'input'   => $element->getFulltextsearchKeyword(),
            'output'  => $element->getTitle(),
            'payload' => [
                'friendlyUrl' => $element->getFriendlyUrl(),
                'type'        => 'event',
                'id'          => $element->getId(),
            ],
            'weight'  => 100 - $element->getLevel(),
        ];

        /* @var $image Image */
        if ($element->getThumbId() and $image = $this->container->get("doctrine")->getRepository("ImageBundle:Image")->find($element->getThumbId())) {
            $thumbnail = $this->container->get("imagehandler")->getPath($image);
        } else {
            $thumbnail = null;
        }

        if ($endDate = $element->getEndDate()) {
            $endDate = $endDate->format("Y-m-d");
        }

        if ($element->getUntilDate()) {
            $recurringUntil = $element->getUntilDate()->format("Y-m-d");
        } else {
            $recurringUntil = null;
        }

        $document = [
            "address"     => [
                "location" => $element->getLocation(),
                "street"   => $element->getAddress(),
                "zipcode"  => $element->getZipCode(),
            ],
            "categoryId"  => $categoryId,
            "parentCategoryId" => implode(' ', array_unique($parentCategoryIds)) ?: null,
            "date"        => [
                "start" => $startDate == Utility::BAD_DATE_VALUE ? null : $startDate,
                "end"   => $endDate == Utility::BAD_DATE_VALUE ? null : $endDate,
            ],
            "time"        => [
                "start" => $element->getStartTime() ? $element->getStartTime()->format("H:i:s") : null,
                "end"   => $element->getEndTime() ? $element->getEndTime()->format("H:i:s") : null,
            ],
            "description" => $element->getDescription(),
            "email"       => $element->getEmail(),
            "friendlyUrl" => $element->getFriendlyUrl(),
            "geoLocation" => $geoLocation,
            "level"       => $element->getLevel(),
            "locationId"  => $locationId,
            "phone"       => $element->getPhone(),
            "recurring"   => [
                "enabled" => $element->getRecurring() == "Y",
                "until"   => $recurringUntil == Utility::BAD_DATE_VALUE ? null : $recurringUntil,
            ],
            "searchInfo"  => [
                "keyword"  => $element->getFulltextsearchKeyword(),
                "location" => $element->getFulltextsearchWhere(),
            ],
            "status"      => $element->getStatus() == "A",
            "suggest"     => [
                "what" => $suggest,
            ],
            "thumbnail"   => $thumbnail,
            "title"       => $element->getTitle(),
            "url"         => $element->getUrl(),
            "views"       => $element->getNumberViews(),
        ];

        if ($recurrentDate != null) {
            $document["recurrent_date"] = $recurrentDate;
        }

        return $document;
    }

    /**
     * @param Event $event
     * @return Document|null
     */
    public function getUpsertDocument($event)
    {
        $document = null;

        if ($event and is_object($event)) {
            $document = new Document(
                $event->getId(),
                $this->generateDocFromEntity($event),
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
            $elements = $this->container->get("doctrine")->getRepository("EventBundle:Event")->findBy(["id" => $ids]);

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
            'address'     => [
                'street'   => $info['address.street'],
                'zipcode'  => $info['address.zipcode'],
                'location' => $info['address.location'],
            ],
            'categoryId'  => $info['categoryId'],
            'date'        => [
                'end'   => $info['date.end'],
                'start' => $info['date.start'],
            ],
            'description' => $info['description'],
            'email'       => $info['email'],
            'friendlyUrl' => $info['friendlyUrl'],
            'geoLocation' => [
                'lat' => $info['geoLocation.lat'],
                'lon' => $info['geoLocation.lon'],
            ],
            '_id'         => $info['_id'],
            'level'       => $info['level'],
            'locationId'  => $info['locationId'],
            'phone'       => $info['phone'],
            'recurring'   => [
                'until'   => $info['recurring.until'],
                'enabled' => $info['recurring.enabled'],
            ],
            'searchInfo'  => [
                'keyword'  => $info['searchInfo.keyword'],
                'location' => $info['searchInfo.location'],
            ],
            'status'      => $info['status'],
            'thumbnail'   => $info['thumbnail'],
            'title'       => $info['title'],
            'url'         => $info['url'],
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
}
