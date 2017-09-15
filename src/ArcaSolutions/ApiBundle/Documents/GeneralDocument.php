<?php

namespace ArcaSolutions\ApiBundle\Documents;

use ArcaSolutions\ArticleBundle\ArticleItemDetail;
use ArcaSolutions\ArticleBundle\Entity\Article;
use ArcaSolutions\ClassifiedBundle\ClassifiedItemDetail;
use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\EventBundle\EventItemDetail;
use ArcaSolutions\EventBundle\Services\Recurring;
use ArcaSolutions\EventBundle\Twig\Extension\RecurringExtension;
use ArcaSolutions\ImageBundle\Entity\Image;
use ArcaSolutions\ListingBundle\Entity\Listing;
use ArcaSolutions\ListingBundle\ListingItemDetail;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class GeneralDocument
 * @package ArcaSolutions\ApiBundle\Documents
 */
class GeneralDocument
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var mixed|null|string
     */
    private $domain;

    /**
     * @var string
     */
    private $scheme;

    /** @var null|Request */
    private $request;

    /**
     * GeneralDocument constructor
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->domain = $container->get('settings')->getDomainSetting('default_url');

        $this->request = $container->get('request_stack')->getCurrentRequest();

        $this->scheme = $this->request->getScheme();
    }

    /**
     * Breaks a string into parts separated by the $delimiter and returns an array containing these parts
     *
     * Example: "Red, Blue, Green" -> ["Red", "Blue", "Green"]
     *
     * @param mixed $input
     * @param string $delimiter
     * @return array
     */
    public static function convertStringToArray($input, $delimiter = ",")
    {
        if (is_array($input)) {
            $return = $input;
        } elseif (is_string($input)) {
            $return = explode($delimiter, $input);
        } else {
            $return = (array)$input;
        }

        return $return;
    }

    /**
     * Convert string to camel case separated by a delimiter
     *
     * @param $str
     * @param $delim
     * @return string
     */
    public static function convertToCamel($str, $delim = '_')
    {
        $exploded_str = explode($delim, $str);

        $exploded_str_camel = array_map('ucwords', $exploded_str);

        return implode($exploded_str_camel);
    }

    /**
     * Return the choices(badges) array with icon
     *
     * @param Listing $item
     * @return mixed
     */
    public function getBadgesImagePath(Listing $item)
    {
        $badges = $item->getChoices();
        if (!empty($badges)) {
            foreach ($badges->toArray() as $item) {
                $badge = $item->getEditorChoice();
                $badge->setImageAPI($this->getImagePath($badge->getImage()));
            }
        }

        return $badges;
    }

    /**
     * Return the full image path
     *
     * @param Image $image
     * @return null|string
     */
    public function getImagePath($image)
    {
        $fullPath = null;

        if ($image) {
            $fileName = $this->container->get('imagehandler')->getPath($image);
            $imagePath = $this->container->get('templating.helper.assets')->getUrl($fileName, 'domain_images', null);

            $fullPath = $this->scheme.'://'.$this->domain.$imagePath;
        }

        return $fullPath;
    }

    /**
     * Return the full file path
     *
     * @param string $fileName
     * @return null|string
     */
    public function getFilePath($fileName)
    {
        $fullPath = null;

        if ($fileName) {
            $filePath = $this->container->get('templating.helper.assets')->getUrl($fileName, 'domain_extrafiles', null);

            $fullPath = $this->scheme.'://'.$this->domain.$filePath;
        }

        return $fullPath;
    }

    /**
     * Return an array with the path of each image of the gallery
     *
     * @param Listing | Classified | Event | Article $item
     * @param ListingItemDetail | ClassifiedItemDetail | EventItemDetail | ArticleItemDetail $itemDetail
     * @return array
     */
    public function getGallery($item, $itemDetail)
    {
        $galleryUrl = [];

        if ($itemDetail->getLevel()->imageCount > 0) {
            $gallery = $this->container->get('doctrine')->getRepository(get_class($item))
                ->getGallery($item, --$itemDetail->getLevel()->imageCount);

            foreach ($gallery as $image) {
                $galleryUrl[] = [
                    'image_caption' => $image->getImageCaption(),
                    'image_url'     => $this->getImagePath($image->getImage()),
                ];
            }
        }

        return $galleryUrl;
    }

    /**
     * Return the array fields that are stdClass as array
     * And escapes \n on text fields
     *
     * @param array $data
     * @return array
     */
    public function setStdClassFieldsToArray($data = [])
    {
        foreach ($data as &$field) {
            if ($field instanceof \stdClass) {
                $field = (array)$field;
            }
            if (is_array($field)) {
                $field = $this->setStdClassFieldsToArray($field);
            }
        }

        return $data;
    }

    /**
     * Return as array with all the elastic results treated to serialize
     *
     * @param array|null $results
     * @return array|null
     * @throws \Exception
     */
    public function getElasticResultsData(array $results = null)
    {
        $data = null;
        $accountId = $this->request->get('account_id', false);

        foreach ($results as $result) {
            switch ($result->getType()) {
                case 'listing':
                    $listing = $this->container->get('doctrine')
                        ->getRepository('ListingBundle:Listing')
                        ->find($result->getId());

                    /* Valid if the listing exist */
                    if (is_null($listing)) {
                        continue;
                    }

                    $listing->setType($result->getType());
                    $listing->setAddress($this->getItemLocationsImploded($listing));

                    $listingItemDetail = new ListingItemDetail($this->container, $listing);
                    if ($listingItemDetail->getLevel()->imageCount > 0) {
                        $listing->setImageUrl($this->getImagePath($listing->getMainImage()));
                    }

                    if ($accountId) {
                        $favId = $this->container->get('quicklist.handler')
                            ->getFavoriteId($listing->getId(), $accountId, 'listing');

                        $listing->setFavoriteId($favId);
                    }

                    $moduleLevel = new ModuleLevelDocument('listing');
                    $listing = $moduleLevel->applyModuleLevel($listing, $listingItemDetail->getLevel());

                    $reviews_enable = $this->container->get('doctrine')
                        ->getRepository('WebBundle:Setting')
                        ->getSetting('review_listing_enabled');
                    if (!$reviews_enable) {
                        $listing->setAvgReview(null);
                    }

                    /* gets listing's classifieds */
                    $classifieds = [];
                    foreach ($listing->getClassifieds() as $classified) {
                        /* @var $classified Classified */
                        if ($this->container->get('classified.handler')->isValid($classified)) {
                            $classifieds[] = $classified;
                        }
                    }

                    /* limit classifieds by listing level */
                    $listing->setClassifieds(array_slice($classifieds, 0,
                        $listingItemDetail->getLevel()->classifiedQuantityAssociation));

                    $data[] = $listing;
                    break;

                case 'event':
                    $event = $this->container->get('doctrine')->getRepository('EventBundle:Event')->find($result->getId());

                    /* Valid if the event exist */
                    if (is_null($event)) {
                        continue;
                    }

                    $event->setType($result->getType());
                    $event->setAddress($this->getItemLocationsImploded($event));

                    $eventItemDetail = new EventItemDetail($this->container, $event);
                    if ($eventItemDetail->getLevel()->imageCount > 0) {
                        $event->setImageUrl($this->getImagePath($event->getImage()));
                    }
                    /* set the recurring date of the event */
                    if ($event->getRecurring() == "Y") {
                        $recurring = new RecurringExtension($this->container);
                        $event->setRecurringPhrase($recurring->recurringPhrase($event));

                        $this->setStartDateToNextOccurrence($event);
                    }

                    $event = $this->setBadDateValueToNull($event);


                    $moduleLevel = new ModuleLevelDocument('event');
                    $event = $moduleLevel->applyModuleLevel($event, $eventItemDetail->getLevel());

                    if ($accountId) {
                        $favId = $this->container->get('quicklist.handler')
                            ->getFavoriteId($event->getId(), $accountId, 'event');

                        $event->setFavoriteId($favId);
                    }

                    $data[] = $event;
                    break;

                case 'classified':
                    $classified = $this->container->get('doctrine')->getRepository('ClassifiedBundle:Classified')->find($result->getId());

                    /* Valid if the classified exist */
                    if (is_null($classified)) {
                        continue;
                    }

                    $classified->setType($result->getType());
                    $classified->setAddress($this->getItemLocationsImploded($classified));

                    $classifiedItemDetail = new ClassifiedItemDetail($this->container, $classified);
                    if ($classifiedItemDetail->getLevel()->imageCount > 0) {
                        $classified->setImageUrl($this->getImagePath($classified->getImage()));
                    }

                    $moduleLevel = new ModuleLevelDocument('classified');
                    $classified = $moduleLevel->applyModuleLevel($classified, $classifiedItemDetail->getLevel());

                    $data[] = $classified;

                    if ($accountId) {
                        $favId = $this->container->get('quicklist.handler')
                            ->getFavoriteId($classified->getId(), $accountId, 'classified');

                        $classified->setFavoriteId($favId);
                    }

                    break;

                case 'article':
                    $article = $this->container->get('doctrine')->getRepository('ArticleBundle:Article')->find($result->getId());

                    /* Valid if the article exist */
                    if (is_null($article)) {
                        continue;
                    }

                    $article->setType($result->getType());
                    $article->setImageUrl($this->getImagePath($article->getImage()));

                    $reviews_enable = $this->container->get('doctrine')->getRepository('WebBundle:Setting')->getSetting('review_article_enabled');
                    if (!$reviews_enable) {
                        $article->setAvgReview(null);
                    }

                    if ($accountId) {
                        $favId = $this->container->get('quicklist.handler')
                            ->getFavoriteId($article->getId(), $accountId, 'article');

                        $article->setFavoriteId($favId);
                    }

                    $data[] = $article;
                    break;

                case 'blog':
                    $blog = $this->container->get('doctrine')->getRepository('BlogBundle:Post')->find($result->getId());

                    /* Valid if the blog exist */
                    if (is_null($blog)) {
                        continue;
                    }

                    $blog->setType($result->getType());
                    $blog->setImageUrl($this->getImagePath($blog->getImage()));
                    $blog->setContent(substr(strip_tags($blog->getContent()), 0, 200));

                    $data[] = $blog;
                    break;

                case 'deal':
                    $deal = $this->container->get('doctrine')
                        ->getRepository('DealBundle:Promotion')
                        ->find($result->getId());

                    /* Valid if the deal exist */
                    if (is_null($deal)) {
                        continue;
                    }

                    $deal->setType($result->getType());
                    $deal->setImageUrl($this->getImagePath($deal->getMainImage()));

                    if ($this->container->get('deal.handler')->isValid($deal)) {
                        $data[] = $deal;
                    }

                    break;
            }
        };

        return $data;
    }

    /**
     * Returns a string with the $item locations imploded
     *
     * @param Listing | Classified | Event $item
     * @return string
     */
    public function getItemLocationsImploded($item)
    {
        $address[] = $item->getAddress();

        if (method_exists($item, 'getAddress2')) {
            $address2 = $item->getAddress2();
            if (!empty($address2)) {
                $address[] = $address2;
            }
        }

        $locations = $this->container->get('location.service')->getLocations($item);
        $zipCode = $item->getZipCode();

        foreach (array_filter($locations) as $location) {
            if ($location->level == 1 && !empty($zipCode)) {
                $address[] = $zipCode;
            }

            $address[] = $location->getName();
        }

        if (!$locations['country'] && !empty($zipCode)) {
            $address[] = $zipCode;
        }

        return implode(', ', $address);

    }

    /**
     * @param Event $event
     */
    public function setStartDateToNextOccurrence(Event &$event)
    {
        $rrule = Recurring::getRRule_rfc2445($event);

        $startDate = Recurring::getNextOccurrence(
            $event->getStartDate(),
            str_replace("RRULE:", "", $rrule)
        );

        $event->setStartDate($startDate);

    }


    /**
     * @param $event Event
     * @return mixed
     */
    public function setBadDateValueToNull($event)
    {
        if ($event->getEndDate()->format("Y-m-d") == Utility::BAD_DATE_VALUE) {
            $event->setEndDate(null);
        }
        if ($event->getUntilDate()->format("Y-m-d") == Utility::BAD_DATE_VALUE) {
            $event->setUntilDate(null);
        }

        return $event;
    }
}
