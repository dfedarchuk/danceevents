<?php

namespace ArcaSolutions\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Event
 *
 * @ORM\Table(name="Event", uniqueConstraints={@ORM\UniqueConstraint(name="friendly_url_2", columns={"friendly_url"})}, indexes={@ORM\Index(name="start_date", columns={"start_date"}), @ORM\Index(name="end_date", columns={"end_date"}), @ORM\Index(name="account_id", columns={"account_id"}), @ORM\Index(name="latitude", columns={"latitude"}), @ORM\Index(name="longitude", columns={"longitude"}), @ORM\Index(name="country_id", columns={"location_1"}), @ORM\Index(name="state_id", columns={"location_2"}), @ORM\Index(name="region_id", columns={"location_3"}), @ORM\Index(name="status", columns={"status"}), @ORM\Index(name="level", columns={"level"}), @ORM\Index(name="city_id", columns={"location_4"}), @ORM\Index(name="area_id", columns={"location_5"}), @ORM\Index(name="title", columns={"title"}), @ORM\Index(name="cat_1_id", columns={"cat_1_id"}), @ORM\Index(name="parcat_1_level1_id", columns={"parcat_1_level1_id"}), @ORM\Index(name="cat_2_id", columns={"cat_2_id"}), @ORM\Index(name="parcat_2_level1_id", columns={"parcat_2_level1_id"}), @ORM\Index(name="cat_3_id", columns={"cat_3_id"}), @ORM\Index(name="parcat_3_level1_id", columns={"parcat_3_level1_id"}), @ORM\Index(name="cat_4_id", columns={"cat_4_id"}), @ORM\Index(name="parcat_4_level1_id", columns={"parcat_4_level1_id"}), @ORM\Index(name="cat_5_id", columns={"cat_5_id"}), @ORM\Index(name="parcat_5_level1_id", columns={"parcat_5_level1_id"}), @ORM\Index(name="fulltextsearch_keyword", columns={"fulltextsearch_keyword"}), @ORM\Index(name="fulltextsearch_where", columns={"fulltextsearch_where"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\EventBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"eventDetail", "Result"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="importID", type="integer", nullable=true)
     */
    private $importid;

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer", nullable=true)
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_id", type="string", length=10, nullable=false)
     */
    private $discountId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Serializer\Groups({"eventDetail", "Result"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=255, nullable=false)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="friendly_url", type="string", length=255, nullable=false)
     */
    private $friendlyUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="image_id", type="integer", nullable=true)
     */
    private $imageId;

    /**
     * @var integer
     *
     * @ORM\Column(name="thumb_id", type="integer", nullable=true)
     */
    private $thumbId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cover_id", type="integer", nullable=true)
     */
    private $coverId;

    /**
     * @var integer
     *
     * @ORM\Column(name="location_1", type="integer", nullable=true)
     */
    private $location1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_2", type="integer", nullable=true)
     */
    private $location2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_3", type="integer", nullable=true)
     */
    private $location3 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_4", type="integer", nullable=true)
     */
    private $location4 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_5", type="integer", nullable=true)
     */
    private $location5 = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Serializer\Groups({"eventDetail"})
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=255, nullable=false)
     */
    private $seoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="long_description", type="text", nullable=false)
     * @Serializer\Groups({"eventDetail"})
     */
    private $longDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="text", nullable=false)
     */
    private $keywords;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keywords", type="string", length=255, nullable=false)
     */
    private $seoKeywords;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entered", type="datetime", nullable=false)
     */
    private $entered = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date", nullable=false)
     * @Serializer\Groups({"eventDetail", "Result"})
     */
    private $startDate = '0000-00-00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="time", nullable=true)
     * @Serializer\Groups({"eventDetail", "Result"})
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date", nullable=true)
     * @Serializer\Groups({"eventDetail", "EventWithDay"})
     */
    private $endDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="time", nullable=true)
     * @Serializer\Groups({"eventDetail", "EventWithDay"})
     */
    private $endTime;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     * @Serializer\Groups({"eventDetail", "EventWithDay"})
     * @Serializer\SerializedName("location_name")
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     * @Serializer\Groups({"eventDetail", "Result"})
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=10, nullable=false)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=50, nullable=false)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=50, nullable=false)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     * @Serializer\Groups({"eventDetail"})
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_name", type="string", length=255, nullable=false)
     * @Serializer\Groups({"eventDetail"})
     */
    private $contactName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=false)
     * @Serializer\Groups({"eventDetail", "Result"})
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     * @Serializer\Groups({"eventDetail"})
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="renewal_date", type="date", nullable=false)
     */
    private $renewalDate = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_page", type="string", length=100, nullable=true)
     * @Serializer\Groups({"eventDetail"})
     */
    private $facebookPage;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_1_id", type="integer", nullable=true)
     */
    private $cat1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_1_level1_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat1Level1Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_1_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat1Level2Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_1_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat1Level3Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_1_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat1Level4Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_2_id", type="integer", nullable=true)
     */
    private $cat2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_2_level1_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat2Level1Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_2_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat2Level2Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_2_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat2Level3Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_2_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat2Level4Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_3_id", type="integer", nullable=true)
     */
    private $cat3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_3_level1_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat3Level1Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_3_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat3Level2Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_3_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat3Level3Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_3_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat3Level4Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_4_id", type="integer", nullable=true)
     */
    private $cat4Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_4_level1_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat4Level1Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_4_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat4Level2Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_4_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat4Level3Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_4_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat4Level4Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_5_id", type="integer", nullable=true)
     */
    private $cat5Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_5_level1_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat5Level1Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_5_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat5Level2Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_5_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat5Level3Id = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_5_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat5Level4Id = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="fulltextsearch_keyword", type="text", nullable=false)
     */
    private $fulltextsearchKeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="fulltextsearch_where", type="text", nullable=false)
     */
    private $fulltextsearchWhere;

    /**
     * @var string
     *
     * @ORM\Column(name="video_snippet", type="text", nullable=false)
     * @Serializer\Groups({"eventDetail"})
     */
    private $videoSnippet;

    /**
     * @var string
     *
     * @ORM\Column(name="video_url", type="string", length=255, nullable=false)
     * @Serializer\Groups({"eventDetail"})
     */
    private $videoUrl = '';

    /**
     * @var string
     *
     * @ORM\Column(name="recurring", type="string", length=1, nullable=false)
     * @Serializer\Groups({"eventDetail"})
     */
    private $recurring;

    /**
     * @var integer
     *
     * @ORM\Column(name="day", type="integer", nullable=false)
     */
    private $day = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="dayofweek", type="string", length=15, nullable=false)
     */
    private $dayofweek;

    /**
     * @var string
     *
     * @ORM\Column(name="week", type="string", length=255, nullable=false)
     */
    private $week;

    /**
     * @var integer
     *
     * @ORM\Column(name="month", type="integer", nullable=false)
     */
    private $month = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="until_date", type="date", nullable=true)
     * @Serializer\Groups({"eventDetail", "Result"})
     */
    private $untilDate;

    /**
     * @var string
     *
     * @ORM\Column(name="repeat_event", type="string", length=1, nullable=false)
     * @Serializer\Groups({"eventDetail"})
     */
    private $repeatEvent;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_views", type="integer", nullable=false)
     */
    private $numberViews = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="map_zoom", type="integer", nullable=false)
     */
    private $mapZoom;

    /**
     * @var integer
     *
     * @ORM\Column(name="package_id", type="integer", nullable=false)
     */
    private $packageId;

    /**
     * @var string
     *
     * @ORM\Column(name="package_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $packagePrice;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_id", type="string", length=255, nullable=true)
     */
    private $customId;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\EventBundle\Entity\EventLevel")
     * @ORM\JoinColumn(name="level", referencedColumnName="value")
     */
    private $levelObj;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\EventBundle\Entity\Eventcategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_1_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category1;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\EventBundle\Entity\Eventcategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_2_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category2;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\EventBundle\Entity\Eventcategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_3_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category3;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\EventBundle\Entity\Eventcategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_4_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category4;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\EventBundle\Entity\Eventcategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_5_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category5;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="cover_id", referencedColumnName="id")
     */
    private $coverImage;

    /**
     * @Serializer\Groups({"Result"})
     * @var
     */
    private $imageUrl;

    /**
     * @Serializer\Groups({"eventDetail"})
     * @Serializer\SerializedName("gallery")
     * @var array
     */
    private $galleryAPI;

    /**
     * @var string
     * @Serializer\Groups({"eventDetail", "Result"})
     */
    private $type = 'event';

    /**
     * @var string
     * @Serializer\Groups({"eventDetail", "Result"})
     */
    private $recurringPhrase;

    /**
     * @var integer
     * @Serializer\Groups({"eventDetail", "Result"})
     */
    private $favoriteId;

    /**
     * Event's day
     * @var \DateTime
     * @Serializer\Groups({"EventWithDay"})
     * @Serializer\SerializedName("next_event_day")
     */
    private $recurringEventDay;

    /**
     * @var string
     * @Serializer\Groups({"eventDetail"})
     */
    private $detailUrl;

    /**
     * @return array
     */
    public function getGalleryAPI()
    {
        return $this->galleryAPI;
    }

    /**
     * @param array $galleryAPI
     */
    public function setGalleryAPI($galleryAPI)
    {
        $this->galleryAPI = $galleryAPI;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get importid
     *
     * @return integer
     */
    public function getImportid()
    {
        return $this->importid;
    }

    /**
     * Set importid
     *
     * @param integer $importid
     *
     * @return Event
     */
    public function setImportid($importid)
    {
        $this->importid = $importid;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set accountId
     *
     * @param integer $accountId
     *
     * @return Event
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get discountId
     *
     * @return string
     */
    public function getDiscountId()
    {
        return $this->discountId;
    }

    /**
     * Set discountId
     *
     * @param string $discountId
     * @return Event
     */
    public function setDiscountId($discountId)
    {
        $this->discountId = $discountId;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get seoTitle
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     * @return Event
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    /**
     * Get friendlyUrl
     *
     * @return string
     */
    public function getFriendlyUrl()
    {
        return $this->friendlyUrl;
    }

    /**
     * Set friendlyUrl
     *
     * @param string $friendlyUrl
     * @return Event
     */
    public function setFriendlyUrl($friendlyUrl)
    {
        $this->friendlyUrl = $friendlyUrl;

        return $this;
    }

    /**
     * Get imageId
     *
     * @return integer
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * Set imageId
     *
     * @param integer $imageId
     * @return Event
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;

        return $this;
    }

    /**
     * Get thumbId
     *
     * @return integer
     */
    public function getThumbId()
    {
        return $this->thumbId;
    }

    /**
     * Set thumbId
     *
     * @param integer $thumbId
     * @return Event
     */
    public function setThumbId($thumbId)
    {
        $this->thumbId = $thumbId;

        return $this;
    }

    /**
     * Get location1
     *
     * @return integer
     */
    public function getLocation1()
    {
        return $this->location1;
    }

    /**
     * Set location1
     *
     * @param integer $location1
     * @return Event
     */
    public function setLocation1($location1)
    {
        $this->location1 = $location1;

        return $this;
    }

    /**
     * Get location2
     *
     * @return integer
     */
    public function getLocation2()
    {
        return $this->location2;
    }

    /**
     * Set location2
     *
     * @param integer $location2
     * @return Event
     */
    public function setLocation2($location2)
    {
        $this->location2 = $location2;

        return $this;
    }

    /**
     * Get location3
     *
     * @return integer
     */
    public function getLocation3()
    {
        return $this->location3;
    }

    /**
     * Set location3
     *
     * @param integer $location3
     * @return Event
     */
    public function setLocation3($location3)
    {
        $this->location3 = $location3;

        return $this;
    }

    /**
     * Get location4
     *
     * @return integer
     */
    public function getLocation4()
    {
        return $this->location4;
    }

    /**
     * Set location4
     *
     * @param integer $location4
     * @return Event
     */
    public function setLocation4($location4)
    {
        $this->location4 = $location4;

        return $this;
    }

    /**
     * Get location5
     *
     * @return integer
     */
    public function getLocation5()
    {
        return $this->location5;
    }

    /**
     * Set location5
     *
     * @param integer $location5
     * @return Event
     */
    public function setLocation5($location5)
    {
        $this->location5 = $location5;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return Event
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * Set longDescription
     *
     * @param string $longDescription
     * @return Event
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return Event
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get seoKeywords
     *
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * Set seoKeywords
     *
     * @param string $seoKeywords
     * @return Event
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Event
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get entered
     *
     * @return \DateTime
     */
    public function getEntered()
    {
        return $this->entered;
    }

    /**
     * Set entered
     *
     * @param \DateTime $entered
     * @return Event
     */
    public function setEntered($entered)
    {
        $this->entered = $entered;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return Event
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Event
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Event
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Event
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     * @return Event
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Event
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Event
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Event
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get contactName
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set contactName
     *
     * @param string $contactName
     * @return Event
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Event
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Event
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get renewalDate
     *
     * @return \DateTime
     */
    public function getRenewalDate()
    {
        return $this->renewalDate;
    }

    /**
     * Set renewalDate
     *
     * @param \DateTime $renewalDate
     * @return Event
     */
    public function setRenewalDate($renewalDate)
    {
        $this->renewalDate = $renewalDate;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Event
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get facebookPage
     *
     * @return string
     */
    public function getFacebookPage()
    {
        return $this->facebookPage;
    }

    /**
     * Set facebookPage
     *
     * @param string $facebookPage
     * @return Event
     */
    public function setFacebookPage($facebookPage)
    {
        $this->facebookPage = $facebookPage;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Event
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get cat1Id
     *
     * @return integer
     */
    public function getCat1Id()
    {
        return $this->cat1Id;
    }

    /**
     * Set cat1Id
     *
     * @param integer $cat1Id
     * @return Event
     */
    public function setCat1Id($cat1Id)
    {
        $this->cat1Id = $cat1Id;

        return $this;
    }

    /**
     * Get parcat1Level1Id
     *
     * @return integer
     */
    public function getParcat1Level1Id()
    {
        return $this->parcat1Level1Id;
    }

    /**
     * Set parcat1Level1Id
     *
     * @param integer $parcat1Level1Id
     * @return Event
     */
    public function setParcat1Level1Id($parcat1Level1Id)
    {
        $this->parcat1Level1Id = $parcat1Level1Id;

        return $this;
    }

    /**
     * Get parcat1Level2Id
     *
     * @return integer
     */
    public function getParcat1Level2Id()
    {
        return $this->parcat1Level2Id;
    }

    /**
     * Set parcat1Level2Id
     *
     * @param integer $parcat1Level2Id
     * @return Event
     */
    public function setParcat1Level2Id($parcat1Level2Id)
    {
        $this->parcat1Level2Id = $parcat1Level2Id;

        return $this;
    }

    /**
     * Get parcat1Level3Id
     *
     * @return integer
     */
    public function getParcat1Level3Id()
    {
        return $this->parcat1Level3Id;
    }

    /**
     * Set parcat1Level3Id
     *
     * @param integer $parcat1Level3Id
     * @return Event
     */
    public function setParcat1Level3Id($parcat1Level3Id)
    {
        $this->parcat1Level3Id = $parcat1Level3Id;

        return $this;
    }

    /**
     * Get parcat1Level4Id
     *
     * @return integer
     */
    public function getParcat1Level4Id()
    {
        return $this->parcat1Level4Id;
    }

    /**
     * Set parcat1Level4Id
     *
     * @param integer $parcat1Level4Id
     * @return Event
     */
    public function setParcat1Level4Id($parcat1Level4Id)
    {
        $this->parcat1Level4Id = $parcat1Level4Id;

        return $this;
    }

    /**
     * Get cat2Id
     *
     * @return integer
     */
    public function getCat2Id()
    {
        return $this->cat2Id;
    }

    /**
     * Set cat2Id
     *
     * @param integer $cat2Id
     * @return Event
     */
    public function setCat2Id($cat2Id)
    {
        $this->cat2Id = $cat2Id;

        return $this;
    }

    /**
     * Get parcat2Level1Id
     *
     * @return integer
     */
    public function getParcat2Level1Id()
    {
        return $this->parcat2Level1Id;
    }

    /**
     * Set parcat2Level1Id
     *
     * @param integer $parcat2Level1Id
     * @return Event
     */
    public function setParcat2Level1Id($parcat2Level1Id)
    {
        $this->parcat2Level1Id = $parcat2Level1Id;

        return $this;
    }

    /**
     * Get parcat2Level2Id
     *
     * @return integer
     */
    public function getParcat2Level2Id()
    {
        return $this->parcat2Level2Id;
    }

    /**
     * Set parcat2Level2Id
     *
     * @param integer $parcat2Level2Id
     * @return Event
     */
    public function setParcat2Level2Id($parcat2Level2Id)
    {
        $this->parcat2Level2Id = $parcat2Level2Id;

        return $this;
    }

    /**
     * Get parcat2Level3Id
     *
     * @return integer
     */
    public function getParcat2Level3Id()
    {
        return $this->parcat2Level3Id;
    }

    /**
     * Set parcat2Level3Id
     *
     * @param integer $parcat2Level3Id
     * @return Event
     */
    public function setParcat2Level3Id($parcat2Level3Id)
    {
        $this->parcat2Level3Id = $parcat2Level3Id;

        return $this;
    }

    /**
     * Get parcat2Level4Id
     *
     * @return integer
     */
    public function getParcat2Level4Id()
    {
        return $this->parcat2Level4Id;
    }

    /**
     * Set parcat2Level4Id
     *
     * @param integer $parcat2Level4Id
     * @return Event
     */
    public function setParcat2Level4Id($parcat2Level4Id)
    {
        $this->parcat2Level4Id = $parcat2Level4Id;

        return $this;
    }

    /**
     * Get cat3Id
     *
     * @return integer
     */
    public function getCat3Id()
    {
        return $this->cat3Id;
    }

    /**
     * Set cat3Id
     *
     * @param integer $cat3Id
     * @return Event
     */
    public function setCat3Id($cat3Id)
    {
        $this->cat3Id = $cat3Id;

        return $this;
    }

    /**
     * Get parcat3Level1Id
     *
     * @return integer
     */
    public function getParcat3Level1Id()
    {
        return $this->parcat3Level1Id;
    }

    /**
     * Set parcat3Level1Id
     *
     * @param integer $parcat3Level1Id
     * @return Event
     */
    public function setParcat3Level1Id($parcat3Level1Id)
    {
        $this->parcat3Level1Id = $parcat3Level1Id;

        return $this;
    }

    /**
     * Get parcat3Level2Id
     *
     * @return integer
     */
    public function getParcat3Level2Id()
    {
        return $this->parcat3Level2Id;
    }

    /**
     * Set parcat3Level2Id
     *
     * @param integer $parcat3Level2Id
     * @return Event
     */
    public function setParcat3Level2Id($parcat3Level2Id)
    {
        $this->parcat3Level2Id = $parcat3Level2Id;

        return $this;
    }

    /**
     * Get parcat3Level3Id
     *
     * @return integer
     */
    public function getParcat3Level3Id()
    {
        return $this->parcat3Level3Id;
    }

    /**
     * Set parcat3Level3Id
     *
     * @param integer $parcat3Level3Id
     * @return Event
     */
    public function setParcat3Level3Id($parcat3Level3Id)
    {
        $this->parcat3Level3Id = $parcat3Level3Id;

        return $this;
    }

    /**
     * Get parcat3Level4Id
     *
     * @return integer
     */
    public function getParcat3Level4Id()
    {
        return $this->parcat3Level4Id;
    }

    /**
     * Set parcat3Level4Id
     *
     * @param integer $parcat3Level4Id
     * @return Event
     */
    public function setParcat3Level4Id($parcat3Level4Id)
    {
        $this->parcat3Level4Id = $parcat3Level4Id;

        return $this;
    }

    /**
     * Get cat4Id
     *
     * @return integer
     */
    public function getCat4Id()
    {
        return $this->cat4Id;
    }

    /**
     * Set cat4Id
     *
     * @param integer $cat4Id
     * @return Event
     */
    public function setCat4Id($cat4Id)
    {
        $this->cat4Id = $cat4Id;

        return $this;
    }

    /**
     * Get parcat4Level1Id
     *
     * @return integer
     */
    public function getParcat4Level1Id()
    {
        return $this->parcat4Level1Id;
    }

    /**
     * Set parcat4Level1Id
     *
     * @param integer $parcat4Level1Id
     * @return Event
     */
    public function setParcat4Level1Id($parcat4Level1Id)
    {
        $this->parcat4Level1Id = $parcat4Level1Id;

        return $this;
    }

    /**
     * Get parcat4Level2Id
     *
     * @return integer
     */
    public function getParcat4Level2Id()
    {
        return $this->parcat4Level2Id;
    }

    /**
     * Set parcat4Level2Id
     *
     * @param integer $parcat4Level2Id
     * @return Event
     */
    public function setParcat4Level2Id($parcat4Level2Id)
    {
        $this->parcat4Level2Id = $parcat4Level2Id;

        return $this;
    }

    /**
     * Get parcat4Level3Id
     *
     * @return integer
     */
    public function getParcat4Level3Id()
    {
        return $this->parcat4Level3Id;
    }

    /**
     * Set parcat4Level3Id
     *
     * @param integer $parcat4Level3Id
     * @return Event
     */
    public function setParcat4Level3Id($parcat4Level3Id)
    {
        $this->parcat4Level3Id = $parcat4Level3Id;

        return $this;
    }

    /**
     * Get parcat4Level4Id
     *
     * @return integer
     */
    public function getParcat4Level4Id()
    {
        return $this->parcat4Level4Id;
    }

    /**
     * Set parcat4Level4Id
     *
     * @param integer $parcat4Level4Id
     * @return Event
     */
    public function setParcat4Level4Id($parcat4Level4Id)
    {
        $this->parcat4Level4Id = $parcat4Level4Id;

        return $this;
    }

    /**
     * Get cat5Id
     *
     * @return integer
     */
    public function getCat5Id()
    {
        return $this->cat5Id;
    }

    /**
     * Set cat5Id
     *
     * @param integer $cat5Id
     * @return Event
     */
    public function setCat5Id($cat5Id)
    {
        $this->cat5Id = $cat5Id;

        return $this;
    }

    /**
     * Get parcat5Level1Id
     *
     * @return integer
     */
    public function getParcat5Level1Id()
    {
        return $this->parcat5Level1Id;
    }

    /**
     * Set parcat5Level1Id
     *
     * @param integer $parcat5Level1Id
     * @return Event
     */
    public function setParcat5Level1Id($parcat5Level1Id)
    {
        $this->parcat5Level1Id = $parcat5Level1Id;

        return $this;
    }

    /**
     * Get parcat5Level2Id
     *
     * @return integer
     */
    public function getParcat5Level2Id()
    {
        return $this->parcat5Level2Id;
    }

    /**
     * Set parcat5Level2Id
     *
     * @param integer $parcat5Level2Id
     * @return Event
     */
    public function setParcat5Level2Id($parcat5Level2Id)
    {
        $this->parcat5Level2Id = $parcat5Level2Id;

        return $this;
    }

    /**
     * Get parcat5Level3Id
     *
     * @return integer
     */
    public function getParcat5Level3Id()
    {
        return $this->parcat5Level3Id;
    }

    /**
     * Set parcat5Level3Id
     *
     * @param integer $parcat5Level3Id
     * @return Event
     */
    public function setParcat5Level3Id($parcat5Level3Id)
    {
        $this->parcat5Level3Id = $parcat5Level3Id;

        return $this;
    }

    /**
     * Get parcat5Level4Id
     *
     * @return integer
     */
    public function getParcat5Level4Id()
    {
        return $this->parcat5Level4Id;
    }

    /**
     * Set parcat5Level4Id
     *
     * @param integer $parcat5Level4Id
     * @return Event
     */
    public function setParcat5Level4Id($parcat5Level4Id)
    {
        $this->parcat5Level4Id = $parcat5Level4Id;

        return $this;
    }

    /**
     * Get fulltextsearchKeyword
     *
     * @return string
     */
    public function getFulltextsearchKeyword()
    {
        return $this->fulltextsearchKeyword;
    }

    /**
     * Set fulltextsearchKeyword
     *
     * @param string $fulltextsearchKeyword
     * @return Event
     */
    public function setFulltextsearchKeyword($fulltextsearchKeyword)
    {
        $this->fulltextsearchKeyword = $fulltextsearchKeyword;

        return $this;
    }

    /**
     * Get fulltextsearchWhere
     *
     * @return string
     */
    public function getFulltextsearchWhere()
    {
        return $this->fulltextsearchWhere;
    }

    /**
     * Set fulltextsearchWhere
     *
     * @param string $fulltextsearchWhere
     * @return Event
     */
    public function setFulltextsearchWhere($fulltextsearchWhere)
    {
        $this->fulltextsearchWhere = $fulltextsearchWhere;

        return $this;
    }

    /**
     * Get videoSnippet
     *
     * @return string
     */
    public function getVideoSnippet()
    {
        return $this->videoSnippet;
    }

    /**
     * Set videoSnippet
     *
     * @param string $videoSnippet
     * @return Event
     */
    public function setVideoSnippet($videoSnippet)
    {
        $this->videoSnippet = $videoSnippet;

        return $this;
    }

    /**
     * Get videoUrl
     *
     * @return string
     */
    public function getVideoUrl()
    {
        return $this->videoUrl;
    }

    /**
     * Set videoUrl
     *
     * @param string $videoUrl
     * @return Event
     */
    public function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    /**
     * Get recurring
     *
     * @return string
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * Set recurring
     *
     * @param string $recurring
     * @return Event
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set day
     *
     * @param integer $day
     * @return Event
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get dayofweek
     *
     * @return string
     */
    public function getDayofweek()
    {
        return $this->dayofweek;
    }

    /**
     * Set dayofweek
     *
     * @param string $dayofweek
     * @return Event
     */
    public function setDayofweek($dayofweek)
    {
        $this->dayofweek = $dayofweek;

        return $this;
    }

    /**
     * Get week
     *
     * @return string
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * Set week
     *
     * @param string $week
     * @return Event
     */
    public function setWeek($week)
    {
        $this->week = $week;

        return $this;
    }

    /**
     * Get month
     *
     * @return integer
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set month
     *
     * @param integer $month
     * @return Event
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get untilDate
     *
     * @return \DateTime
     */
    public function getUntilDate()
    {
        return $this->untilDate;
    }

    /**
     * Set untilDate
     *
     * @param \DateTime $untilDate
     * @return Event
     */
    public function setUntilDate($untilDate)
    {
        $this->untilDate = $untilDate;

        return $this;
    }

    /**
     * Get repeatEvent
     *
     * @return string
     */
    public function getRepeatEvent()
    {
        return $this->repeatEvent;
    }

    /**
     * Set repeatEvent
     *
     * @param string $repeatEvent
     * @return Event
     */
    public function setRepeatEvent($repeatEvent)
    {
        $this->repeatEvent = $repeatEvent;

        return $this;
    }

    /**
     * Get numberViews
     *
     * @return integer
     */
    public function getNumberViews()
    {
        return $this->numberViews;
    }

    /**
     * Set numberViews
     *
     * @param integer $numberViews
     * @return Event
     */
    public function setNumberViews($numberViews)
    {
        $this->numberViews = $numberViews;

        return $this;
    }

    /**
     * Get mapZoom
     *
     * @return integer
     */
    public function getMapZoom()
    {
        return $this->mapZoom;
    }

    /**
     * Set mapZoom
     *
     * @param integer $mapZoom
     * @return Event
     */
    public function setMapZoom($mapZoom)
    {
        $this->mapZoom = $mapZoom;

        return $this;
    }

    /**
     * Get packageId
     *
     * @return integer
     */
    public function getPackageId()
    {
        return $this->packageId;
    }

    /**
     * Set packageId
     *
     * @param integer $packageId
     * @return Event
     */
    public function setPackageId($packageId)
    {
        $this->packageId = $packageId;

        return $this;
    }

    /**
     * Get packagePrice
     *
     * @return string
     */
    public function getPackagePrice()
    {
        return $this->packagePrice;
    }

    /**
     * Set packagePrice
     *
     * @param string $packagePrice
     * @return Event
     */
    public function setPackagePrice($packagePrice)
    {
        $this->packagePrice = $packagePrice;

        return $this;
    }

    /**
     * Get customId
     *
     * @return string
     */
    public function getCustomId()
    {
        return $this->customId;
    }

    /**
     * Set customId
     *
     * @param string $customId
     * @return Event
     */
    public function setCustomId($customId)
    {
        $this->customId = $customId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getCategory1()
    {
        return $this->category1;
    }

    /**
     * @param mixed $category1
     */
    public function setCategory1($category1)
    {
        $this->category1 = $category1;
    }

    /**
     * @return mixed
     */
    public function getCategory2()
    {
        return $this->category2;
    }

    /**
     * @param mixed $category2
     */
    public function setCategory2($category2)
    {
        $this->category2 = $category2;
    }

    /**
     * @return mixed
     */
    public function getCategory3()
    {
        return $this->category3;
    }

    /**
     * @param mixed $category3
     */
    public function setCategory3($category3)
    {
        $this->category3 = $category3;
    }

    /**
     * @return mixed
     */
    public function getCategory5()
    {
        return $this->category5;
    }

    /**
     * @param mixed $category5
     */
    public function setCategory5($category5)
    {
        $this->category5 = $category5;
    }

    /**
     * @return mixed
     */
    public function getCategory4()
    {
        return $this->category4;
    }

    /**
     * @param mixed $category4
     */
    public function setCategory4($category4)
    {
        $this->category4 = $category4;
    }

    /**
     * Get all categories related to an event
     *
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("categories")
     * @Serializer\Groups({"eventDetail"})
     *
     * @return array
     */
    public function getCategories()
    {
        $categories_array = [];

        for ($i = 1; $i <= 5; $i++) {
            if (0 < $this->{'cat'.$i.'Id'}) {
                $cat = $this->{'category'.$i};
                if ($cat->getEnabled() == 'n') {
                    continue;
                }

                $categories_array[] = $cat;
            }
        }

        return $categories_array;
    }

    /**
     * @return int
     */
    public function getCoverId()
    {
        return $this->coverId;
    }

    /**
     * @param int $coverId
     *
     * @return Event
     */
    public function setCoverId($coverId)
    {
        $this->coverId = $coverId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoverImage()
    {
        return $this->coverImage;
    }

    /**
     * @param mixed $coverImage
     *
     * @return Event
     */
    public function setCoverImage($coverImage)
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLevelObj()
    {
        return $this->levelObj;
    }

    /**
     * @param mixed $levelObj
     *
     * @return $this
     */
    public function setLevelObj($levelObj)
    {
        $this->levelObj = $levelObj;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecurringPhrase()
    {
        return $this->recurringPhrase;
    }

    /**
     * @param mixed $recurringPhrase
     */
    public function setRecurringPhrase($recurringPhrase)
    {
        $this->recurringPhrase = $recurringPhrase;
    }

    /**
     * @return int
     */
    public function getFavoriteId()
    {
        return $this->favoriteId;
    }

    /**
     * @param int $favoriteId
     */
    public function setFavoriteId($favoriteId)
    {
        $this->favoriteId = $favoriteId;
    }

    /**
     * @return \DateTime
     */
    public function getRecurringEventDay()
    {
        return $this->recurringEventDay;
    }

    /**
     * @param \DateTime $recurringEventDay
     * @return $this
     */
    public function setRecurringEventDay($recurringEventDay)
    {
        $this->recurringEventDay = $recurringEventDay;

        return $this;
    }

    /**
     * @return string
     */
    public function getDetailUrl()
    {
        return $this->detailUrl;
    }

    /**
     * @param string $detailUrl
     */
    public function setDetailUrl($detailUrl)
    {
        $this->detailUrl = $detailUrl;
    }

    /**
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("geo")
     * @Serializer\Groups({"eventDetail", "Result"})
     *
     * @return array
     */
    public function getGeoLocation()
    {
        $geoLocation = null;

        if ($this->latitude || $this->longitude) {
            $geoLocation = [
                'lat' => (double)$this->latitude,
                'lng' => (double)$this->longitude,
            ];
        }

        return $geoLocation;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}
