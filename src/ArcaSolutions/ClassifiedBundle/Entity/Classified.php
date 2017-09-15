<?php

namespace ArcaSolutions\ClassifiedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Classified
 *
 * @ORM\Table(name="Classified", indexes={@ORM\Index(name="country_id", columns={"location_1"}), @ORM\Index(name="state_id", columns={"location_2"}), @ORM\Index(name="region_id", columns={"location_3"}), @ORM\Index(name="latitude", columns={"latitude"}), @ORM\Index(name="longitude", columns={"longitude"}), @ORM\Index(name="level", columns={"level"}), @ORM\Index(name="status", columns={"status"}), @ORM\Index(name="account_id", columns={"account_id"}), @ORM\Index(name="city_id", columns={"location_4"}), @ORM\Index(name="area_id", columns={"location_5"}), @ORM\Index(name="title", columns={"title"}), @ORM\Index(name="friendly_url", columns={"friendly_url"}), @ORM\Index(name="cat_1_id", columns={"cat_1_id"}), @ORM\Index(name="parcat_1_level1_id", columns={"parcat_1_level1_id"}), @ORM\Index(name="fulltextsearch_keyword", columns={"fulltextsearch_keyword"}), @ORM\Index(name="fulltextsearch_where", columns={"fulltextsearch_where"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\ClassifiedBundle\Repository\ClassifiedRepository")
 */
class Classified
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"classifiedDetail", "Result", "listingDetail"})
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
     * @ORM\Column(name="entered", type="datetime", nullable=false)
     */
    private $entered = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="renewal_date", type="date", nullable=false)
     */
    private $renewalDate = '0000-00-00';

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
     * @Serializer\Groups({"classifiedDetail", "Result", "listingDetail"})
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     * @Serializer\Groups({"classifiedDetail"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     * @Serializer\Groups({"classifiedDetail"})
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="contactname", type="string", length=255, nullable=false)
     * @Serializer\Groups({"classifiedDetail"})
     * @Serializer\SerializedName("contact_name")
     */
    private $contactname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     * @Serializer\Groups({"classifiedDetail", "Result"})
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=255, nullable=false)
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=false)
     * @Serializer\Groups({"classifiedDetail", "Result"})
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=false)
     * @Serializer\Groups({"classifiedDetail"})
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="summarydesc", type="string", length=255, nullable=false)
     * @Serializer\Groups({"classifiedDetail", "Result", "listingDetail"})
     * @Serializer\SerializedName("summary_desc")
     */
    private $summarydesc;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_summarydesc", type="string", length=255, nullable=false)
     */
    private $seoSummarydesc;

    /**
     * @var string
     *
     * @ORM\Column(name="detaildesc", type="text", nullable=false)
     * @Serializer\Groups({"classifiedDetail"})
     * @Serializer\SerializedName("detail_desc")
     */
    private $detaildesc;

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
     * @var integer
     *
     * @ORM\Column(name="location_1", type="integer", nullable=false)
     */
    private $location1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_2", type="integer", nullable=false)
     */
    private $location2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_3", type="integer", nullable=false)
     */
    private $location3 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_4", type="integer", nullable=false)
     */
    private $location4 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_5", type="integer", nullable=false)
     */
    private $location5 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status;

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
    private $parcat1Level1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_1_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat1Level2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_1_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat1Level3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_1_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat1Level4Id;

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
    private $parcat2Level1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_2_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat2Level2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_2_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat2Level3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_2_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat2Level4Id;

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
    private $parcat3Level1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_3_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat3Level2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_3_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat3Level3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_3_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat3Level4Id;

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
    private $parcat4Level1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_4_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat4Level2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_4_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat4Level3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_4_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat4Level4Id;

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
    private $parcat5Level1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_5_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat5Level2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_5_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat5Level3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_5_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat5Level4Id;

    /**
     * @var float
     *
     * @ORM\Column(name="classified_price", type="float", precision=9, scale=2, nullable=true)
     * @Serializer\Groups({"classifiedDetail", "Result", "listingDetail"})
     * @Serializer\SerializedName("price")
     */
    private $classifiedPrice;

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
     * @var integer
     *
     * @ORM\Column(name="listing_id", type="integer", nullable=true)
     */
    private $listingId;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ListingBundle\Entity\Listing", inversedBy="classifieds")
     * @ORM\JoinColumn(name="listing_id", referencedColumnName="id")
     * @Serializer\Groups({"classifiedDetail"})
     */
    private $listing;

    /**
     * @var string
     *
     * @ORM\Column(name="package_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $packagePrice;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ClassifiedBundle\Entity\ClassifiedLevel")
     * @ORM\JoinColumn(name="level", referencedColumnName="value")
     */
    private $levelObj;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ClassifiedBundle\Entity\Classifiedcategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_1_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category1;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ClassifiedBundle\Entity\Classifiedcategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_2_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category2;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ClassifiedBundle\Entity\Classifiedcategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_3_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category3;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ClassifiedBundle\Entity\Classifiedcategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_4_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category4;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ClassifiedBundle\Entity\Classifiedcategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_5_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category5;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="cover_id", referencedColumnName="id")
     */
    private $coverImage;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

    /**
     * @Serializer\Groups({"Result", "listingDetail"})
     * @var
     */
    private $imageUrl;

    /**
     * @Serializer\Groups({"classifiedDetail"})
     * @Serializer\SerializedName("gallery")
     * @var array
     */
    private $galleryAPI;

    /**
     * @var string
     * @Serializer\Groups({"Result"})
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="video_snippet", type="text", nullable=true)
     * @Serializer\Groups({"classifiedDetailV2"})
     */
    private $videoSnippet;

    /**
     * @var string
     *
     * @ORM\Column(name="video_url", type="string", length=255, nullable=true)
     * @Serializer\Groups({"classifiedDetailV2"})
     */
    private $videoUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="video_description", type="string", length=255, nullable=true)
     * @Serializer\Groups({"classifiedDetailV2"})
     */
    private $videoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="attachment_file", type="string", length=255, nullable=false)
     * @Serializer\Groups({"classifiedDetailV2"})
     */
    private $attachmentFile;

    /**
     * @var string
     *
     * @ORM\Column(name="attachment_caption", type="string", length=255, nullable=false)
     * @Serializer\Groups({"classifiedDetailV2"})
     */
    private $attachmentCaption;

    /**
     * @var integer
     * @Serializer\Groups({"classifiedDetail", "Result"})
     */
    private $favoriteId;

    /**
     * @var string
     * @Serializer\Groups({"classifiedDetail"})
     */
    private $detailUrl;

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * @return Classified
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
     * @return Classified
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
     * @return Classified
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
     * Set entered
     *
     * @param \DateTime $entered
     * @return Classified
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Classified
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
     * Set renewalDate
     *
     * @param \DateTime $renewalDate
     * @return Classified
     */
    public function setRenewalDate($renewalDate)
    {
        $this->renewalDate = $renewalDate;

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
     * Set discountId
     *
     * @param string $discountId
     * @return Classified
     */
    public function setDiscountId($discountId)
    {
        $this->discountId = $discountId;

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
     * Set title
     *
     * @param string $title
     * @return Classified
     */
    public function setTitle($title)
    {
        $this->title = $title;

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
     * Set seoTitle
     *
     * @param string $seoTitle
     * @return Classified
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;

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
     * Set friendlyUrl
     *
     * @param string $friendlyUrl
     * @return Classified
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
     * Set email
     *
     * @param string $email
     * @return Classified
     */
    public function setEmail($email)
    {
        $this->email = $email;

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
     * Set url
     *
     * @param string $url
     * @return Classified
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
     * Set contactname
     *
     * @param string $contactname
     * @return Classified
     */
    public function setContactname($contactname)
    {
        $this->contactname = $contactname;

        return $this;
    }

    /**
     * Get contactname
     *
     * @return string
     */
    public function getContactname()
    {
        return $this->contactname;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Classified
     */
    public function setAddress($address)
    {
        $this->address = $address;

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
     * Set address2
     *
     * @param string $address2
     * @return Classified
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Classified
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

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
     * Set fax
     *
     * @param string $fax
     * @return Classified
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set summarydesc
     *
     * @param string $summarydesc
     * @return Classified
     */
    public function setSummarydesc($summarydesc)
    {
        $this->summarydesc = $summarydesc;

        return $this;
    }

    /**
     * Get summarydesc
     *
     * @return string
     */
    public function getSummarydesc()
    {
        return $this->summarydesc;
    }

    /**
     * Set seoSummarydesc
     *
     * @param string $seoSummarydesc
     * @return Classified
     */
    public function setSeoSummarydesc($seoSummarydesc)
    {
        $this->seoSummarydesc = $seoSummarydesc;

        return $this;
    }

    /**
     * Get seoSummarydesc
     *
     * @return string
     */
    public function getSeoSummarydesc()
    {
        return $this->seoSummarydesc;
    }

    /**
     * Set detaildesc
     *
     * @param string $detaildesc
     * @return Classified
     */
    public function setDetaildesc($detaildesc)
    {
        $this->detaildesc = $detaildesc;

        return $this;
    }

    /**
     * Get detaildesc
     *
     * @return string
     */
    public function getDetaildesc()
    {
        return $this->detaildesc;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return Classified
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
     * @return Classified
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
     * @return Classified
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
     * @return Classified
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
     * Set zipCode
     *
     * @param string $zipCode
     * @return Classified
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

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
     * Set latitude
     *
     * @param string $latitude
     * @return Classified
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

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
     * Set longitude
     *
     * @param string $longitude
     * @return Classified
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

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
     * Set location1
     *
     * @param integer $location1
     * @return Classified
     */
    public function setLocation1($location1)
    {
        $this->location1 = $location1;

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
     * Set location2
     *
     * @param integer $location2
     * @return Classified
     */
    public function setLocation2($location2)
    {
        $this->location2 = $location2;

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
     * Set location3
     *
     * @param integer $location3
     * @return Classified
     */
    public function setLocation3($location3)
    {
        $this->location3 = $location3;

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
     * Set location4
     *
     * @param integer $location4
     * @return Classified
     */
    public function setLocation4($location4)
    {
        $this->location4 = $location4;

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
     * Set location5
     *
     * @param integer $location5
     * @return Classified
     */
    public function setLocation5($location5)
    {
        $this->location5 = $location5;

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
     * Set level
     *
     * @param integer $level
     * @return Classified
     */
    public function setLevel($level)
    {
        $this->level = $level;

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
     * Set status
     *
     * @param string $status
     * @return Classified
     */
    public function setStatus($status)
    {
        $this->status = $status;

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
     * Set cat1Id
     *
     * @param integer $cat1Id
     * @return Classified
     */
    public function setCat1Id($cat1Id)
    {
        $this->cat1Id = $cat1Id;

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
     * Set parcat1Level1Id
     *
     * @param integer $parcat1Level1Id
     * @return Classified
     */
    public function setParcat1Level1Id($parcat1Level1Id)
    {
        $this->parcat1Level1Id = $parcat1Level1Id;

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
     * Set parcat1Level2Id
     *
     * @param integer $parcat1Level2Id
     * @return Classified
     */
    public function setParcat1Level2Id($parcat1Level2Id)
    {
        $this->parcat1Level2Id = $parcat1Level2Id;

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
     * Set parcat1Level3Id
     *
     * @param integer $parcat1Level3Id
     * @return Classified
     */
    public function setParcat1Level3Id($parcat1Level3Id)
    {
        $this->parcat1Level3Id = $parcat1Level3Id;

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
     * Set parcat1Level4Id
     *
     * @param integer $parcat1Level4Id
     * @return Classified
     */
    public function setParcat1Level4Id($parcat1Level4Id)
    {
        $this->parcat1Level4Id = $parcat1Level4Id;

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
     * Set cat2Id
     *
     * @param integer $cat2Id
     * @return Classified
     */
    public function setCat2Id($cat2Id)
    {
        $this->cat2Id = $cat2Id;

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
     * Set parcat2Level1Id
     *
     * @param integer $parcat2Level1Id
     * @return Classified
     */
    public function setParcat2Level1Id($parcat2Level1Id)
    {
        $this->parcat2Level1Id = $parcat2Level1Id;

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
     * Set parcat2Level2Id
     *
     * @param integer $parcat2Level2Id
     * @return Classified
     */
    public function setParcat2Level2Id($parcat2Level2Id)
    {
        $this->parcat2Level2Id = $parcat2Level2Id;

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
     * Set parcat2Level3Id
     *
     * @param integer $parcat2Level3Id
     * @return Classified
     */
    public function setParcat2Level3Id($parcat2Level3Id)
    {
        $this->parcat2Level3Id = $parcat2Level3Id;

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
     * Set parcat2Level4Id
     *
     * @param integer $parcat2Level4Id
     * @return Classified
     */
    public function setParcat2Level4Id($parcat2Level4Id)
    {
        $this->parcat2Level4Id = $parcat2Level4Id;

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
     * Set cat3Id
     *
     * @param integer $cat3Id
     * @return Classified
     */
    public function setCat3Id($cat3Id)
    {
        $this->cat3Id = $cat3Id;

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
     * Set parcat3Level1Id
     *
     * @param integer $parcat3Level1Id
     * @return Classified
     */
    public function setParcat3Level1Id($parcat3Level1Id)
    {
        $this->parcat3Level1Id = $parcat3Level1Id;

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
     * Set parcat3Level2Id
     *
     * @param integer $parcat3Level2Id
     * @return Classified
     */
    public function setParcat3Level2Id($parcat3Level2Id)
    {
        $this->parcat3Level2Id = $parcat3Level2Id;

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
     * Set parcat3Level3Id
     *
     * @param integer $parcat3Level3Id
     * @return Classified
     */
    public function setParcat3Level3Id($parcat3Level3Id)
    {
        $this->parcat3Level3Id = $parcat3Level3Id;

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
     * Set parcat3Level4Id
     *
     * @param integer $parcat3Level4Id
     * @return Classified
     */
    public function setParcat3Level4Id($parcat3Level4Id)
    {
        $this->parcat3Level4Id = $parcat3Level4Id;

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
     * Set cat4Id
     *
     * @param integer $cat4Id
     * @return Classified
     */
    public function setCat4Id($cat4Id)
    {
        $this->cat4Id = $cat4Id;

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
     * Set parcat4Level1Id
     *
     * @param integer $parcat4Level1Id
     * @return Classified
     */
    public function setParcat4Level1Id($parcat4Level1Id)
    {
        $this->parcat4Level1Id = $parcat4Level1Id;

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
     * Set parcat4Level2Id
     *
     * @param integer $parcat4Level2Id
     * @return Classified
     */
    public function setParcat4Level2Id($parcat4Level2Id)
    {
        $this->parcat4Level2Id = $parcat4Level2Id;

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
     * Set parcat4Level3Id
     *
     * @param integer $parcat4Level3Id
     * @return Classified
     */
    public function setParcat4Level3Id($parcat4Level3Id)
    {
        $this->parcat4Level3Id = $parcat4Level3Id;

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
     * Set parcat4Level4Id
     *
     * @param integer $parcat4Level4Id
     * @return Classified
     */
    public function setParcat4Level4Id($parcat4Level4Id)
    {
        $this->parcat4Level4Id = $parcat4Level4Id;

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
     * Set cat5Id
     *
     * @param integer $cat5Id
     * @return Classified
     */
    public function setCat5Id($cat5Id)
    {
        $this->cat5Id = $cat5Id;

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
     * Set parcat5Level1Id
     *
     * @param integer $parcat5Level1Id
     * @return Classified
     */
    public function setParcat5Level1Id($parcat5Level1Id)
    {
        $this->parcat5Level1Id = $parcat5Level1Id;

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
     * Set parcat5Level2Id
     *
     * @param integer $parcat5Level2Id
     * @return Classified
     */
    public function setParcat5Level2Id($parcat5Level2Id)
    {
        $this->parcat5Level2Id = $parcat5Level2Id;

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
     * Set parcat5Level3Id
     *
     * @param integer $parcat5Level3Id
     * @return Classified
     */
    public function setParcat5Level3Id($parcat5Level3Id)
    {
        $this->parcat5Level3Id = $parcat5Level3Id;

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
     * Set parcat5Level4Id
     *
     * @param integer $parcat5Level4Id
     * @return Classified
     */
    public function setParcat5Level4Id($parcat5Level4Id)
    {
        $this->parcat5Level4Id = $parcat5Level4Id;

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
     * Set classifiedPrice
     *
     * @param float $classifiedPrice
     * @return Classified
     */
    public function setClassifiedPrice($classifiedPrice)
    {
        $this->classifiedPrice = $classifiedPrice;

        return $this;
    }

    /**
     * Get classifiedPrice
     *
     * @return float
     */
    public function getClassifiedPrice()
    {
        return $this->classifiedPrice;
    }

    /**
     * Set numberViews
     *
     * @param integer $numberViews
     * @return Classified
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
     * Set mapZoom
     *
     * @param integer $mapZoom
     * @return Classified
     */
    public function setMapZoom($mapZoom)
    {
        $this->mapZoom = $mapZoom;

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
     * Set packageId
     *
     * @param integer $packageId
     * @return Classified
     */
    public function setPackageId($packageId)
    {
        $this->packageId = $packageId;

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
     * Set packagePrice
     *
     * @param string $packagePrice
     * @return Classified
     */
    public function setPackagePrice($packagePrice)
    {
        $this->packagePrice = $packagePrice;

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
     * @return mixed
     */
    public function getCategory1()
    {
        return $this->category1;
    }

    /**
     * @param mixed $category1
     *
     * @return $this
     */
    public function setCategory1($category1)
    {
        $this->category1 = $category1;

        return $this;
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
     *
     * @return $this
     */
    public function setCategory2($category2)
    {
        $this->category2 = $category2;

        return $this;
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
     *
     * @return $this
     */
    public function setCategory3($category3)
    {
        $this->category3 = $category3;

        return $this;
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
     *
     * @return $this
     */
    public function setCategory4($category4)
    {
        $this->category4 = $category4;

        return $this;
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
     *
     * @return $this
     */
    public function setCategory5($category5)
    {
        $this->category5 = $category5;

        return $this;
    }

    /**
     * Get all categories related to an event
     *
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("categories")
     * @Serializer\Groups({"classifiedDetail"})
     *
     * @return array
     */
    public function getCategories()
    {
        $categories_array = [];

        for ($i = 1; $i <= 5; $i++) {
            if (0 < $this->{'cat' . $i . 'Id'}) {
                $cat = $this->{'category' . $i};
                if ($cat->getEnabled() == 'n')
                    continue;

                $categories_array[] = $cat;
            }
        }

        return $categories_array;
    }

    /**
     * @param int $coverId
     *
     * @return Classified
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
     * @return Classified
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
     * @return int
     */
    public function getListingId()
    {
        return $this->listingId;
    }

    /**
     * @param int $listingId
     * @return $this
     */
    public function setListingId($listingId)
    {
        $this->listingId = $listingId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getListing()
    {
        return $this->listing;
    }

    public function removeListing()
    {
        unset($this->listing);
    }

    /**
     * @param mixed $listing
     * @return $this
     */
    public function setListing($listing)
    {
        $this->listing = $listing;

        return $this;
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
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("geo")
     * @Serializer\Groups({"classifiedDetail", "Result"})
     *
     * @return array
     */
    public function getGeoLocation(){

        $geoLocation = null;

        if ($this->latitude || $this->longitude){
            $geoLocation = [
                'lat' => (double)$this->latitude,
                'lng' => (double)$this->longitude
            ];
        }

        return $geoLocation;
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
     * @return Classified
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
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
     * @return string
     */
    public function getVideoSnippet()
    {
        return $this->videoSnippet;
    }

    /**
     * @param $videoSnippet
     * @return $this
     */
    public function setVideoSnippet($videoSnippet)
    {
        $this->videoSnippet = $videoSnippet;

        return $this;
    }

    /**
     * @return string
     */
    public function getVideoUrl()
    {
        return $this->videoUrl;
    }

    /**
     * @param string $videoUrl
     */
    public function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;
    }

    /**
     * @return string
     */
    public function getVideoDescription()
    {
        return $this->videoDescription;
    }

    /**
     * @param string $videoDescription
     */
    public function setVideoDescription($videoDescription)
    {
        $this->videoDescription = $videoDescription;
    }

    /**
     * @return string
     */
    public function getAttachmentFile()
    {
        return $this->attachmentFile;
    }

    /**
     * @param string $attachmentFile
     */
    public function setAttachmentFile($attachmentFile)
    {
        $this->attachmentFile = $attachmentFile;

        return $this;
    }

    /**
     * @return string
     */
    public function getAttachmentCaption()
    {
        return $this->attachmentCaption;
    }

    /**
     * @param string $attachmentCaption
     */
    public function setAttachmentCaption($attachmentCaption)
    {
        $this->attachmentCaption = $attachmentCaption;

        return $this;
    }

}
