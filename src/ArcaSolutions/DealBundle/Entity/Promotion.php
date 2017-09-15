<?php

namespace ArcaSolutions\DealBundle\Entity;

use ArcaSolutions\ListingBundle\Entity\Listing;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Promotion
 *
 * @ORM\Table(name="Promotion", indexes={@ORM\Index(name="account_id", columns={"account_id"}), @ORM\Index(name="start_date", columns={"start_date"}), @ORM\Index(name="end_date", columns={"end_date"}), @ORM\Index(name="name", columns={"name"}), @ORM\Index(name="listing_level", columns={"listing_level"}), @ORM\Index(name="listing_id", columns={"listing_id", "listing_status"}), @ORM\Index(name="fulltextsearch_keyword", columns={"fulltextsearch_keyword"}), @ORM\Index(name="fulltextsearch_where", columns={"fulltextsearch_where"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\DealBundle\Repository\PromotionRepository")
 */
class Promotion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"dealDetail", "listingDetail", "Result", "dealRedeem"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer", nullable=true)
     */
    private $accountId;

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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Serializer\Groups({"dealDetail", "listingDetail", "Result", "dealRedeem"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_name", type="string", length=255, nullable=false)
     */
    private $seoName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Serializer\Groups({"dealDetail", "Result"})
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="long_description", type="text", nullable=false)
     * @Serializer\Groups({"dealDetail"})
     */
    private $longDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=255, nullable=false)
     */
    private $seoDescription;

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
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date", nullable=false)
     */
    private $startDate = '0000-00-00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date", nullable=false)
     * @Serializer\Groups({"dealDetail", "dealRedeem", "listingDetail"})
     * @Serializer\SerializedName("end_date")
     */
    private $endDate = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="conditions", type="text", nullable=false)
     * @Serializer\Groups({"dealDetail"})
     */
    private $conditions;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_views", type="integer", nullable=false)
     */
    private $numberViews = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="visibility_start", type="integer", nullable=false)
     */
    private $visibilityStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="visibility_end", type="integer", nullable=false)
     */
    private $visibilityEnd;

    /**
     * @var float
     *
     * @ORM\Column(name="realvalue", type="float", precision=8, scale=2, nullable=false)
     * @Serializer\Groups({"dealDetail", "Result", "listingDetail", "dealRedeem"})
     * @Serializer\SerializedName("real_value")
     */
    private $realvalue;

    /**
     * @var float
     *
     * @ORM\Column(name="dealvalue", type="float", precision=8, scale=2, nullable=false)
     * @Serializer\Groups({"dealDetail", "Result", "listingDetail", "dealRedeem"})
     * @Serializer\SerializedName("deal_value")
     */
    private $dealvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="deal_type", type="string", length=20, nullable=false)
     */
    private $dealType = 'monetary value';

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
     * @Serializer\Groups({"dealDetail", "dealRedeem", "Result"})
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="friendly_url", type="string", length=250, nullable=false)
     */
    private $friendlyUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="listing_id", type="integer", nullable=true)
     */
    private $listingId;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_status", type="string", length=1, nullable=false)
     */
    private $listingStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="listing_level", type="integer", nullable=false)
     */
    private $listingLevel;

    /**
     * @var integer
     *
     * @ORM\Column(name="listing_location1", type="integer", nullable=true)
     */
    private $listingLocation1;

    /**
     * @var integer
     *
     * @ORM\Column(name="listing_location2", type="integer", nullable=true)
     */
    private $listingLocation2;

    /**
     * @var integer
     *
     * @ORM\Column(name="listing_location3", type="integer", nullable=true)
     */
    private $listingLocation3;

    /**
     * @var integer
     *
     * @ORM\Column(name="listing_location4", type="integer", nullable=true)
     */
    private $listingLocation4;

    /**
     * @var integer
     *
     * @ORM\Column(name="listing_location5", type="integer", nullable=true)
     */
    private $listingLocation5;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_address", type="string", length=50, nullable=true)
     */
    private $listingAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_address2", type="string", length=50, nullable=true)
     */
    private $listingAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_zipcode", type="string", length=10, nullable=true)
     */
    private $listingZipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_latitude", type="string", length=50, nullable=false)
     */
    private $listingLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_longitude", type="string", length=50, nullable=false)
     */
    private $listingLongitude;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ListingBundle\Entity\Listing", inversedBy="deals", fetch="EAGER")
     * @ORM\JoinColumn(name="listing_id", referencedColumnName="id")
     * @Serializer\Groups({"dealDetail", "Result"})
     */
    private $listing;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $mainImage;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="cover_id", referencedColumnName="id")
     */
    private $coverImage;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\DealBundle\Entity\PromotionRedeem", mappedBy="deal")
     * @Serializer\Groups({"listingDetail", "dealDetail"})
     * @Serializer\Type("ArcaSolutions\DealBundle\Entity\PromotionRedeem")
     */
    private $redeem;

    /**
     * @Serializer\Groups({"dealDetail", "Result", "listingDetail", "dealRedeem"})
     * @var
     */
    private $imageUrl;

    /**
     * @var string
     * @Serializer\Groups({"Result"})
     */
    private $type;

    /**
     * @var string
     * @Serializer\Groups({"dealDetail"})
     */
    private $detailUrl;

    /**
     * Promotion constructor.
     */
    public function __construct()
    {
        $this->redeem = new ArrayCollection();
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
     * Set accountId
     *
     * @param integer $accountId
     * @return Promotion
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

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
     * Set imageId
     *
     * @param integer $imageId
     * @return Promotion
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;

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
     * Set thumbId
     *
     * @param integer $thumbId
     * @return Promotion
     */
    public function setThumbId($thumbId)
    {
        $this->thumbId = $thumbId;

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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Promotion
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

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
     * Set entered
     *
     * @param \DateTime $entered
     * @return Promotion
     */
    public function setEntered($entered)
    {
        $this->entered = $entered;

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
     * Set name
     *
     * @param string $name
     * @return Promotion
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set seoName
     *
     * @param string $seoName
     * @return Promotion
     */
    public function setSeoName($seoName)
    {
        $this->seoName = $seoName;

        return $this;
    }

    /**
     * Get seoName
     *
     * @return string
     */
    public function getSeoName()
    {
        return $this->seoName;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Promotion
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Set longDescription
     *
     * @param string $longDescription
     * @return Promotion
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

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
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return Promotion
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

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
     * Set keywords
     *
     * @param string $keywords
     * @return Promotion
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

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
     * Set seoKeywords
     *
     * @param string $seoKeywords
     * @return Promotion
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;

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
     * Set fulltextsearchKeyword
     *
     * @param string $fulltextsearchKeyword
     * @return Promotion
     */
    public function setFulltextsearchKeyword($fulltextsearchKeyword)
    {
        $this->fulltextsearchKeyword = $fulltextsearchKeyword;

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
     * Set fulltextsearchWhere
     *
     * @param string $fulltextsearchWhere
     * @return Promotion
     */
    public function setFulltextsearchWhere($fulltextsearchWhere)
    {
        $this->fulltextsearchWhere = $fulltextsearchWhere;

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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Promotion
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

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
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Promotion
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

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
     * Set conditions
     *
     * @param string $conditions
     * @return Promotion
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return string
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set numberViews
     *
     * @param integer $numberViews
     * @return Promotion
     */
    public function setNumberViews($numberViews)
    {
        $this->numberViews = $numberViews;

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
     * Set visibilityStart
     *
     * @param integer $visibilityStart
     * @return Promotion
     */
    public function setVisibilityStart($visibilityStart)
    {
        $this->visibilityStart = $visibilityStart;

        return $this;
    }

    /**
     * Get visibilityStart
     *
     * @return integer
     */
    public function getVisibilityStart()
    {
        return $this->visibilityStart;
    }

    /**
     * Set visibilityEnd
     *
     * @param integer $visibilityEnd
     * @return Promotion
     */
    public function setVisibilityEnd($visibilityEnd)
    {
        $this->visibilityEnd = $visibilityEnd;

        return $this;
    }

    /**
     * Get visibilityEnd
     *
     * @return integer
     */
    public function getVisibilityEnd()
    {
        return $this->visibilityEnd;
    }

    /**
     * Set realvalue
     *
     * @param float $realvalue
     * @return Promotion
     */
    public function setRealvalue($realvalue)
    {
        $this->realvalue = $realvalue;

        return $this;
    }

    /**
     * Get realvalue
     *
     * @return float
     */
    public function getRealvalue()
    {
        return $this->realvalue;
    }

    /**
     * Set dealvalue
     *
     * @param float $dealvalue
     * @return Promotion
     */
    public function setDealvalue($dealvalue)
    {
        $this->dealvalue = $dealvalue;

        return $this;
    }

    /**
     * Get dealvalue
     *
     * @return float
     */
    public function getDealvalue()
    {
        return $this->dealvalue;
    }

    /**
     * Set dealType
     *
     * @param string $dealType
     * @return Promotion
     */
    public function setDealType($dealType)
    {
        $this->dealType = $dealType;

        return $this;
    }

    /**
     * Get dealType
     *
     * @return string
     */
    public function getDealType()
    {
        return $this->dealType;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return Promotion
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set friendlyUrl
     *
     * @param string $friendlyUrl
     * @return Promotion
     */
    public function setFriendlyUrl($friendlyUrl)
    {
        $this->friendlyUrl = $friendlyUrl;

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
     * Set listingId
     *
     * @param integer $listingId
     * @return Promotion
     */
    public function setListingId($listingId)
    {
        $this->listingId = $listingId;

        return $this;
    }

    /**
     * Get listingId
     *
     * @return integer
     */
    public function getListingId()
    {
        return $this->listingId;
    }

    /**
     * Set listingStatus
     *
     * @param string $listingStatus
     * @return Promotion
     */
    public function setListingStatus($listingStatus)
    {
        $this->listingStatus = $listingStatus;

        return $this;
    }

    /**
     * Get listingStatus
     *
     * @return string
     */
    public function getListingStatus()
    {
        return $this->listingStatus;
    }

    /**
     * Workaround to fix the problem with patterns in edirectory DB
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getListingStatus();
    }

    /**
     * Set listingLevel
     *
     * @param integer $listingLevel
     * @return Promotion
     */
    public function setListingLevel($listingLevel)
    {
        $this->listingLevel = $listingLevel;

        return $this;
    }

    /**
     * Get listingLevel
     *
     * @return integer
     */
    public function getListingLevel()
    {
        return $this->listingLevel;
    }

    /**
     * Set listingLocation1
     *
     * @param integer $listingLocation1
     * @return Promotion
     */
    public function setListingLocation1($listingLocation1)
    {
        $this->listingLocation1 = $listingLocation1;

        return $this;
    }

    /**
     * Get listingLocation1
     *
     * @return integer
     */
    public function getListingLocation1()
    {
        return $this->listingLocation1;
    }

    /**
     * Set listingLocation2
     *
     * @param integer $listingLocation2
     * @return Promotion
     */
    public function setListingLocation2($listingLocation2)
    {
        $this->listingLocation2 = $listingLocation2;

        return $this;
    }

    /**
     * Get listingLocation2
     *
     * @return integer
     */
    public function getListingLocation2()
    {
        return $this->listingLocation2;
    }

    /**
     * Set listingLocation3
     *
     * @param integer $listingLocation3
     * @return Promotion
     */
    public function setListingLocation3($listingLocation3)
    {
        $this->listingLocation3 = $listingLocation3;

        return $this;
    }

    /**
     * Get listingLocation3
     *
     * @return integer
     */
    public function getListingLocation3()
    {
        return $this->listingLocation3;
    }

    /**
     * Set listingLocation4
     *
     * @param integer $listingLocation4
     * @return Promotion
     */
    public function setListingLocation4($listingLocation4)
    {
        $this->listingLocation4 = $listingLocation4;

        return $this;
    }

    /**
     * Get listingLocation4
     *
     * @return integer
     */
    public function getListingLocation4()
    {
        return $this->listingLocation4;
    }

    /**
     * Set listingLocation5
     *
     * @param integer $listingLocation5
     * @return Promotion
     */
    public function setListingLocation5($listingLocation5)
    {
        $this->listingLocation5 = $listingLocation5;

        return $this;
    }

    /**
     * Get listingLocation5
     *
     * @return integer
     */
    public function getListingLocation5()
    {
        return $this->listingLocation5;
    }

    /**
     * Set listingAddress
     *
     * @param string $listingAddress
     * @return Promotion
     */
    public function setListingAddress($listingAddress)
    {
        $this->listingAddress = $listingAddress;

        return $this;
    }

    /**
     * Get listingAddress
     *
     * @return string
     */
    public function getListingAddress()
    {
        return $this->listingAddress;
    }

    /**
     * Set listingAddress2
     *
     * @param string $listingAddress2
     * @return Promotion
     */
    public function setListingAddress2($listingAddress2)
    {
        $this->listingAddress2 = $listingAddress2;

        return $this;
    }

    /**
     * Get listingAddress2
     *
     * @return string
     */
    public function getListingAddress2()
    {
        return $this->listingAddress2;
    }

    /**
     * Set listingZipcode
     *
     * @param string $listingZipcode
     * @return Promotion
     */
    public function setListingZipcode($listingZipcode)
    {
        $this->listingZipcode = $listingZipcode;

        return $this;
    }

    /**
     * Get listingZipcode
     *
     * @return string
     */
    public function getListingZipcode()
    {
        return $this->listingZipcode;
    }

    /**
     * Set listingLatitude
     *
     * @param string $listingLatitude
     * @return Promotion
     */
    public function setListingLatitude($listingLatitude)
    {
        $this->listingLatitude = $listingLatitude;

        return $this;
    }

    /**
     * Get listingLatitude
     *
     * @return string
     */
    public function getListingLatitude()
    {
        return $this->listingLatitude;
    }

    /**
     * Set listingLongitude
     *
     * @param string $listingLongitude
     * @return Promotion
     */
    public function setListingLongitude($listingLongitude)
    {
        $this->listingLongitude = $listingLongitude;

        return $this;
    }

    /**
     * Get listingLongitude
     *
     * @return string
     */
    public function getListingLongitude()
    {
        return $this->listingLongitude;
    }

    /**
     * @return Listing
     */
    public function getListing()
    {
        return $this->listing;
    }

    /**
     * @param Listing $listing
     */
    public function setListing(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * @return mixed
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }

    /**
     * @param mixed $mainImage
     */
    public function setMainImage($mainImage)
    {
        $this->mainImage = $mainImage;
    }

    /**
     * @param int $coverId
     *
     * @return Promotion
     */
    public function setCoverId($coverId)
    {
        $this->coverId = $coverId;

        return $this;
    }

    /**
     * @return int
     */
    public function getCoverId()
    {
        return $this->coverId;
    }

    /**
     * @param mixed $coverImage
     *
     * @return Promotion
     */
    public function setCoverImage($coverImage)
    {
        $this->coverImage = $coverImage;

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
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getRedeem()
    {
        return $this->redeem;
    }

    /**
     * @param mixed $redeem
     * @return Promotion
     */
    public function addRedeem($redeem)
    {
        if (!$this->redeem->contains($redeem)) {
            $this->redeem->add($redeem);
        }

        return $this;
    }

    /**
     * Sets redeem, with it is possible to change its behavior
     *
     * @param $redeem
     * @return $this
     */
    public function setRedeem($redeem)
    {
        $this->redeem = $redeem;

        return $this;
    }

    /**
     * Cleans redeem object
     * @param bool $setNull
     * @return $this
     */
    public function cleanRedeem($setNull = false)
    {
        $setNull ? $this->redeem = null : $this->redeem->clear();

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


}
