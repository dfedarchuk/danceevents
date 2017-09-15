<?php

namespace ArcaSolutions\ListingBundle\Entity;

use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use JMS\Serializer\Annotation as Serializer;


/**
 * Listing
 *
 * @ORM\Table(name="Listing", indexes={@ORM\Index(name="title", columns={"title"}), @ORM\Index(name="country_id", columns={"location_1"}), @ORM\Index(name="state_id", columns={"location_2"}), @ORM\Index(name="region_id", columns={"location_3"}), @ORM\Index(name="account_id", columns={"account_id"}), @ORM\Index(name="renewal_date", columns={"renewal_date"}), @ORM\Index(name="status", columns={"status"}), @ORM\Index(name="latitude", columns={"latitude"}), @ORM\Index(name="longitude", columns={"longitude"}), @ORM\Index(name="level", columns={"level"}), @ORM\Index(name="city_id", columns={"location_4"}), @ORM\Index(name="area_id", columns={"location_5"}), @ORM\Index(name="zip_code", columns={"zip_code"}), @ORM\Index(name="friendly_url", columns={"friendly_url"}), @ORM\Index(name="listingtemplate_id", columns={"listingtemplate_id"}), @ORM\Index(name="image_id", columns={"image_id"}), @ORM\Index(name="thumb_id", columns={"thumb_id"}), @ORM\Index(name="idx_fulltextsearch_keyword", columns={"fulltextsearch_keyword"}), @ORM\Index(name="idx_fulltextsearch_where", columns={"fulltextsearch_where"}), @ORM\Index(name="updated_date", columns={"updated"}), @ORM\Index(name="clicktocall_number", columns={"clicktocall_number"}), @ORM\Index(name="Listing_Promotion", columns={"level", "account_id", "title", "id"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\ListingBundle\Repository\ListingRepository")
 */
class Listing
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"listingDetail", "Result", "classifiedDetail", "dealDetail", "reviewItem"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Account")
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
     * @ORM\Column(name="renewal_date", type="date", nullable=false)
     */
    private $renewalDate = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="discount_id", type="string", length=10, nullable=true)
     */
    private $discountId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Serializer\Groups({"listingDetail", "Result", "classifiedDetail", "dealDetail", "reviewItem"})
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
     * @ORM\Column(name="friendly_url", type="string", length=255, nullable=false, unique=true)
     * @Serializer\Groups("listingDetail")
     */
    private $friendlyUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     * @Serializer\Groups({"listingDetail"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="show_email", type="string", nullable=false, options={"default"="y"})
     */
    private $showEmail = 'y';

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     * @Serializer\Groups({"listingDetail"})
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="display_url", type="string", length=255, nullable=false)
     */
    private $displayUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=50, nullable=false)
     * @Serializer\Groups({"listingDetail", "Result", "dealDetail", "classifiedDetail"})
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=50, nullable=false)
     */
    private $address2;

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
     * @ORM\Column(name="phone", type="string", length=255, nullable=false)
     * @Serializer\Groups({"listingDetail", "Result"})
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=false)
     * @Serializer\Groups({"listingDetail"})
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Serializer\Groups({"listingDetail"})
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
     * @Serializer\Groups({"listingDetail"})
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
     * @var string
     *
     * @ORM\Column(name="attachment_file", type="string", length=255, nullable=true)
     * @Serializer\Groups({"listingDetail"})
     */
    private $attachmentFile;

    /**
     * @var string
     *
     * @ORM\Column(name="attachment_caption", type="string", length=255, nullable=true)
     * @Serializer\Groups({"listingDetail"})
     */
    private $attachmentCaption;

    /**
     * @var string
     *
     * @ORM\Column(name="features", type="text", nullable=true)
     * @Serializer\Groups({"listingDetail"})
     */
    private $features;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="social_network", type="json_array", nullable=true)
     * @Serializer\Groups({"listingDetail"})
     */
    private $socialNetwork;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=true)
     */
    private $level;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reminder", type="integer", nullable=false, options={"default"="0"})
     */
    private $reminder;

    /**
     * @var string
     *
     * @ORM\Column(name="fulltextsearch_keyword", type="text", nullable=true)
     */
    private $fulltextsearchKeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="fulltextsearch_where", type="text", nullable=true)
     */
    private $fulltextsearchWhere;

    /**
     * @var string
     *
     * @ORM\Column(name="video_snippet", type="text", nullable=true)
     * @Serializer\Groups({"listingDetail"})
     */
    private $videoSnippet;

    /**
     * @var string
     *
     * @ORM\Column(name="video_url", type="string", length=255, nullable=true)
     * @Serializer\Groups({"listingDetail"})
     */
    private $videoUrl = '';

    /**
     * @var string
     *
     * @ORM\Column(name="video_description", type="string", length=255, nullable=true)
     * @Serializer\Groups({"listingDetail"})
     */
    private $videoDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="importID", type="integer", nullable=true)
     */
    private $importid;

    /**
     * @var string
     *
     * @ORM\Column(name="hours_work", type="text", nullable=true)
     * @Serializer\Groups({"listingDetail"})
     */
    private $hoursWork;

    /**
     * @var string
     *
     * @ORM\Column(name="locations", type="text", nullable=true)
     * @Serializer\Groups({"listingDetail"})
     */
    private $locations;

    /**
     * @var string
     *
     * @ORM\Column(name="claim_disable", type="string", length=1, nullable=false, options={"default"="n"})
     */
    private $claimDisable;

    /**
     * @var integer
     *
     * @ORM\Column(name="listingtemplate_id", type="integer", nullable=true)
     */
    private $listingtemplateId;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_checkbox0", type="string", length=1, nullable=true)
     */
    private $customCheckbox0;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_checkbox1", type="string", length=1, nullable=true)
     */
    private $customCheckbox1;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_checkbox2", type="string", length=1, nullable=true)
     */
    private $customCheckbox2;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_checkbox3", type="string", length=1, nullable=true)
     */
    private $customCheckbox3;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_checkbox4", type="string", length=1, nullable=true)
     */
    private $customCheckbox4;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_checkbox5", type="string", length=1, nullable=true)
     */
    private $customCheckbox5;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_checkbox6", type="string", length=1, nullable=true)
     */
    private $customCheckbox6;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_checkbox7", type="string", length=1, nullable=true)
     */
    private $customCheckbox7;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_checkbox8", type="string", length=1, nullable=true)
     */
    private $customCheckbox8;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_checkbox9", type="string", length=1, nullable=true)
     */
    private $customCheckbox9;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_dropdown0", type="string", length=255, nullable=true)
     */
    private $customDropdown0;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_dropdown1", type="string", length=255, nullable=true)
     */
    private $customDropdown1;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_dropdown2", type="string", length=255, nullable=true)
     */
    private $customDropdown2;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_dropdown3", type="string", length=255, nullable=true)
     */
    private $customDropdown3;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_dropdown4", type="string", length=255, nullable=true)
     */
    private $customDropdown4;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_dropdown5", type="string", length=255, nullable=true)
     */
    private $customDropdown5;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_dropdown6", type="string", length=255, nullable=true)
     */
    private $customDropdown6;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_dropdown7", type="string", length=255, nullable=true)
     */
    private $customDropdown7;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_dropdown8", type="string", length=255, nullable=true)
     */
    private $customDropdown8;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_dropdown9", type="string", length=255, nullable=true)
     */
    private $customDropdown9;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_text0", type="string", length=255, nullable=true)
     */
    private $customText0;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_text1", type="string", length=255, nullable=true)
     */
    private $customText1;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_text2", type="string", length=255, nullable=true)
     */
    private $customText2;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_text3", type="string", length=255, nullable=true)
     */
    private $customText3;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_text4", type="string", length=255, nullable=true)
     */
    private $customText4;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_text5", type="string", length=255, nullable=true)
     */
    private $customText5;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_text6", type="string", length=255, nullable=true)
     */
    private $customText6;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_text7", type="string", length=255, nullable=true)
     */
    private $customText7;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_text8", type="string", length=255, nullable=true)
     */
    private $customText8;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_text9", type="string", length=255, nullable=true)
     */
    private $customText9;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_short_desc0", type="string", length=255, nullable=true)
     */
    private $customShortDesc0;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_short_desc1", type="string", length=255, nullable=true)
     */
    private $customShortDesc1;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_short_desc2", type="string", length=255, nullable=true)
     */
    private $customShortDesc2;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_short_desc3", type="string", length=255, nullable=true)
     */
    private $customShortDesc3;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_short_desc4", type="string", length=255, nullable=true)
     */
    private $customShortDesc4;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_short_desc5", type="string", length=255, nullable=true)
     */
    private $customShortDesc5;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_short_desc6", type="string", length=255, nullable=true)
     */
    private $customShortDesc6;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_short_desc7", type="string", length=255, nullable=true)
     */
    private $customShortDesc7;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_short_desc8", type="string", length=255, nullable=true)
     */
    private $customShortDesc8;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_short_desc9", type="string", length=255, nullable=true)
     */
    private $customShortDesc9;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_long_desc0", type="text", nullable=true)
     */
    private $customLongDesc0;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_long_desc1", type="text", nullable=true)
     */
    private $customLongDesc1;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_long_desc2", type="text", nullable=true)
     */
    private $customLongDesc2;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_long_desc3", type="text", nullable=true)
     */
    private $customLongDesc3;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_long_desc4", type="text", nullable=true)
     */
    private $customLongDesc4;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_long_desc5", type="text", nullable=true)
     */
    private $customLongDesc5;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_long_desc6", type="text", nullable=true)
     */
    private $customLongDesc6;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_long_desc7", type="text", nullable=true)
     */
    private $customLongDesc7;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_long_desc8", type="text", nullable=true)
     */
    private $customLongDesc8;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_long_desc9", type="text", nullable=true)
     */
    private $customLongDesc9;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_views", type="integer", nullable=false, options={"default"="0"})
     */
    private $numberViews;

    /**
     * @var integer
     *
     * @ORM\Column(name="avg_review", type="integer", nullable=false, options={"default"="0"})
     * @Serializer\Groups({"listingDetail", "Result", "dealDetail", "classifiedDetail"})
     * @Serializer\SerializedName("rating")
     */
    private $avgReview;

    /**
     * @var integer
     *
     * @ORM\Column(name="map_zoom", type="integer", nullable=true)
     */
    private $mapZoom;

    /**
     * @var integer
     *
     * @ORM\Column(name="package_id", type="integer", nullable=true)
     */
    private $packageId;

    /**
     * @var string
     *
     * @ORM\Column(name="package_price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $packagePrice;

    /**
     * @var string
     *
     * @ORM\Column(name="clicktocall_number", type="string", length=15, nullable=true)
     */
    private $clicktocallNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="clicktocall_extension", type="integer", nullable=true)
     */
    private $clicktocallExtension;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="clicktocall_date", type="date", nullable=true)
     */
    private $clicktocallDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_traffic_sent", type="date", nullable=true)
     */
    private $lastTrafficSent;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_id", type="string", length=255, nullable=true)
     */
    private $customId;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\ClassifiedBundle\Entity\Classified", mappedBy="listing")
     * @ORM\OrderBy({"status" = "ASC"})
     * @Serializer\Groups({"listingDetail", "Result"})
     * @Serializer\Type("array")
     */
    private $classifieds;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\DealBundle\Entity\Promotion", mappedBy="listing", fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="listing_id")
     * @Serializer\Groups("listingDetail")
     * @Serializer\Type("array")
     */
    private $deals;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ListingBundle\Entity\ListingLevel")
     * @ORM\JoinColumn(name="level", referencedColumnName="value")
     */
    private $levelObj;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\ListingBundle\Entity\ListingChoice", mappedBy="listing")
     * @Serializer\SerializedName("badges")
     * @Serializer\Groups("listingDetail")
     * @Serializer\Type("array")
     */
    private $choices;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\ListingBundle\Entity\ListingCategory1", mappedBy="listing")
     * @Serializer\Groups({"listingDetail", "dealDetail"})
     * @Serializer\Type("array")
     */
    private $categories;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $mainImage;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ListingBundle\Entity\Listingtemplate", inversedBy="listings", fetch="EAGER")
     * @JoinColumn(name="listingtemplate_id", referencedColumnName="id")
     * @Serializer\Exclude()
     */
    private $template;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\WebBundle\Entity\Accountprofilecontact", inversedBy="listings", fetch="EAGER")
     * @JoinColumn(name="account_id", referencedColumnName="account_id", onDelete="CASCADE")
     * @Serializer\Exclude()
     */
    private $account;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="cover_id", referencedColumnName="id")
     */
    private $coverImage;

    /**
     * @Serializer\Groups({"Result", "classifiedDetail", "dealDetail"})
     * @var
     */
    private $imageUrl;

    /**
     * @Serializer\Groups({"listingDetail"})
     * @Serializer\SerializedName("gallery")
     * @var array
     */
    private $galleryAPI;

    /**
     * @Serializer\Groups({"listingDetail"})
     * @var integer
     */
    private $reviewsTotal;

    /**
     * @var string
     * @Serializer\Groups({"Result", "reviewItem"})
     */
    private $type;

    /**
     * @var array
     * @Serializer\Groups({"listingDetail"})
     */
    private $extraFields;

    /**
     * @var integer
     * @Serializer\Groups({"listingDetail", "Result"})
     */
    private $favoriteId;

    /**
     * @var string
     * @Serializer\Groups({"listingDetail"})
     */
    private $detailUrl;

    /**
     * Listing constructor.
     */
    public function __construct()
    {
        $this->classifieds = new ArrayCollection();
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
     * @return Listing
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

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
     *
     * @return Listing
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
     *
     * @return Listing
     */
    public function setThumbId($thumbId)
    {
        $this->thumbId = $thumbId;

        return $this;
    }

    /**
     * Set coverId
     *
     * @param integer $coverId
     * @return Listing
     */
    public function setCoverId($coverId)
    {
        $this->coverId = $coverId;

        return $this;
    }

    /**
     * Get coverId
     *
     * @return integer
     */
    public function getCoverId()
    {
        return $this->coverId;
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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
     */
    public function setLocation5($location5)
    {
        $this->location5 = $location5;

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
     *
     * @return Listing
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
     *
     * @return Listing
     */
    public function setEntered($entered)
    {
        $this->entered = $entered;

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
     *
     * @return Listing
     */
    public function setRenewalDate($renewalDate)
    {
        $this->renewalDate = $renewalDate;

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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
     */
    public function setFriendlyUrl($friendlyUrl)
    {
        $this->friendlyUrl = $friendlyUrl;

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
     *
     * @return Listing
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get showEmail
     *
     * @return string
     */
    public function getShowEmail()
    {
        return $this->showEmail;
    }

    /**
     * Set showEmail
     *
     * @param string $showEmail
     *
     * @return Listing
     */
    public function setShowEmail($showEmail)
    {
        $this->showEmail = $showEmail;

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
     *
     * @return Listing
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get displayUrl
     *
     * @return string
     */
    public function getDisplayUrl()
    {
        return $this->displayUrl;
    }

    /**
     * Set displayUrl
     *
     * @param string $displayUrl
     *
     * @return Listing
     */
    public function setDisplayUrl($displayUrl)
    {
        $this->displayUrl = $displayUrl;

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
     *
     * @return Listing
     */
    public function setAddress($address)
    {
        $this->address = $address;

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
     * Set address2
     *
     * @param string $address2
     *
     * @return Listing
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

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
     *
     * @return Listing
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

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
     * Set fax
     *
     * @param string $fax
     *
     * @return Listing
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    /**
     * Get attachmentFile
     *
     * @return string
     */
    public function getAttachmentFile()
    {
        return $this->attachmentFile;
    }

    /**
     * Set attachmentFile
     *
     * @param string $attachmentFile
     *
     * @return Listing
     */
    public function setAttachmentFile($attachmentFile)
    {
        $this->attachmentFile = $attachmentFile;

        return $this;
    }

    /**
     * Get attachmentCaption
     *
     * @return string
     */
    public function getAttachmentCaption()
    {
        return $this->attachmentCaption;
    }

    /**
     * Set attachmentCaption
     *
     * @param string $attachmentCaption
     *
     * @return Listing
     */
    public function setAttachmentCaption($attachmentCaption)
    {
        $this->attachmentCaption = $attachmentCaption;

        return $this;
    }

    /**
     * Get features
     *
     * @return string
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * Set features
     *
     * @param string $features
     *
     * @return Listing
     */
    public function setFeatures($features)
    {
        $this->features = $features;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Listing
     */
    public function setPrice($price)
    {
        $this->price = $price;

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
     *
     * @return Listing
     */
    public function setStatus($status)
    {
        $this->status = $status;

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
     *
     * @return Listing
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get reminder
     *
     * @return boolean
     */
    public function getReminder()
    {
        return $this->reminder;
    }

    /**
     * Set reminder
     *
     * @param boolean $reminder
     *
     * @return Listing
     */
    public function setReminder($reminder)
    {
        $this->reminder = $reminder;

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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
     */
    public function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    /**
     * Get videoDescription
     *
     * @return string
     */
    public function getVideoDescription()
    {
        return $this->videoDescription;
    }

    /**
     * Set videoDescription
     *
     * @param string $videoDescription
     *
     * @return Listing
     */
    public function setVideoDescription($videoDescription)
    {
        $this->videoDescription = $videoDescription;

        return $this;
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
     * @return Listing
     */
    public function setImportid($importid)
    {
        $this->importid = $importid;

        return $this;
    }

    /**
     * Get hoursWork
     *
     * @return string
     */
    public function getHoursWork()
    {
        return $this->hoursWork;
    }

    /**
     * Set hoursWork
     *
     * @param string $hoursWork
     *
     * @return Listing
     */
    public function setHoursWork($hoursWork)
    {
        $this->hoursWork = $hoursWork;

        return $this;
    }

    /**
     * Get locations
     *
     * @return string
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * Set locations
     *
     * @param string $locations
     *
     * @return Listing
     */
    public function setLocations($locations)
    {
        $this->locations = $locations;

        return $this;
    }

    /**
     * Get claimDisable
     *
     * @return string
     */
    public function getClaimDisable()
    {
        return $this->claimDisable;
    }

    /**
     * Set claimDisable
     *
     * @param string $claimDisable
     *
     * @return Listing
     */
    public function setClaimDisable($claimDisable)
    {
        $this->claimDisable = $claimDisable;

        return $this;
    }

    /**
     * Get listingtemplateId
     *
     * @return integer
     */
    public function getListingtemplateId()
    {
        return $this->listingtemplateId;
    }

    /**
     * Set listingtemplateId
     *
     * @param integer $listingtemplateId
     *
     * @return Listing
     */
    public function setListingtemplateId($listingtemplateId)
    {
        $this->listingtemplateId = $listingtemplateId;

        return $this;
    }

    /**
     * Get customCheckbox0
     *
     * @return string
     */
    public function getCustomCheckbox0()
    {
        return $this->customCheckbox0;
    }

    /**
     * Set customCheckbox0
     *
     * @param string $customCheckbox0
     *
     * @return Listing
     */
    public function setCustomCheckbox0($customCheckbox0)
    {
        $this->customCheckbox0 = $customCheckbox0;

        return $this;
    }

    /**
     * Get customCheckbox1
     *
     * @return string
     */
    public function getCustomCheckbox1()
    {
        return $this->customCheckbox1;
    }

    /**
     * Set customCheckbox1
     *
     * @param string $customCheckbox1
     *
     * @return Listing
     */
    public function setCustomCheckbox1($customCheckbox1)
    {
        $this->customCheckbox1 = $customCheckbox1;

        return $this;
    }

    /**
     * Get customCheckbox2
     *
     * @return string
     */
    public function getCustomCheckbox2()
    {
        return $this->customCheckbox2;
    }

    /**
     * Set customCheckbox2
     *
     * @param string $customCheckbox2
     *
     * @return Listing
     */
    public function setCustomCheckbox2($customCheckbox2)
    {
        $this->customCheckbox2 = $customCheckbox2;

        return $this;
    }

    /**
     * Get customCheckbox3
     *
     * @return string
     */
    public function getCustomCheckbox3()
    {
        return $this->customCheckbox3;
    }

    /**
     * Set customCheckbox3
     *
     * @param string $customCheckbox3
     *
     * @return Listing
     */
    public function setCustomCheckbox3($customCheckbox3)
    {
        $this->customCheckbox3 = $customCheckbox3;

        return $this;
    }

    /**
     * Get customCheckbox4
     *
     * @return string
     */
    public function getCustomCheckbox4()
    {
        return $this->customCheckbox4;
    }

    /**
     * Set customCheckbox4
     *
     * @param string $customCheckbox4
     *
     * @return Listing
     */
    public function setCustomCheckbox4($customCheckbox4)
    {
        $this->customCheckbox4 = $customCheckbox4;

        return $this;
    }

    /**
     * Get customCheckbox5
     *
     * @return string
     */
    public function getCustomCheckbox5()
    {
        return $this->customCheckbox5;
    }

    /**
     * Set customCheckbox5
     *
     * @param string $customCheckbox5
     *
     * @return Listing
     */
    public function setCustomCheckbox5($customCheckbox5)
    {
        $this->customCheckbox5 = $customCheckbox5;

        return $this;
    }

    /**
     * Get customCheckbox6
     *
     * @return string
     */
    public function getCustomCheckbox6()
    {
        return $this->customCheckbox6;
    }

    /**
     * Set customCheckbox6
     *
     * @param string $customCheckbox6
     *
     * @return Listing
     */
    public function setCustomCheckbox6($customCheckbox6)
    {
        $this->customCheckbox6 = $customCheckbox6;

        return $this;
    }

    /**
     * Get customCheckbox7
     *
     * @return string
     */
    public function getCustomCheckbox7()
    {
        return $this->customCheckbox7;
    }

    /**
     * Set customCheckbox7
     *
     * @param string $customCheckbox7
     *
     * @return Listing
     */
    public function setCustomCheckbox7($customCheckbox7)
    {
        $this->customCheckbox7 = $customCheckbox7;

        return $this;
    }

    /**
     * Get customCheckbox8
     *
     * @return string
     */
    public function getCustomCheckbox8()
    {
        return $this->customCheckbox8;
    }

    /**
     * Set customCheckbox8
     *
     * @param string $customCheckbox8
     *
     * @return Listing
     */
    public function setCustomCheckbox8($customCheckbox8)
    {
        $this->customCheckbox8 = $customCheckbox8;

        return $this;
    }

    /**
     * Get customCheckbox9
     *
     * @return string
     */
    public function getCustomCheckbox9()
    {
        return $this->customCheckbox9;
    }

    /**
     * Set customCheckbox9
     *
     * @param string $customCheckbox9
     *
     * @return Listing
     */
    public function setCustomCheckbox9($customCheckbox9)
    {
        $this->customCheckbox9 = $customCheckbox9;

        return $this;
    }

    /**
     * Get customDropdown0
     *
     * @return string
     */
    public function getCustomDropdown0()
    {
        return $this->customDropdown0;
    }

    /**
     * Set customDropdown0
     *
     * @param string $customDropdown0
     *
     * @return Listing
     */
    public function setCustomDropdown0($customDropdown0)
    {
        $this->customDropdown0 = $customDropdown0;

        return $this;
    }

    /**
     * Get customDropdown1
     *
     * @return string
     */
    public function getCustomDropdown1()
    {
        return $this->customDropdown1;
    }

    /**
     * Set customDropdown1
     *
     * @param string $customDropdown1
     *
     * @return Listing
     */
    public function setCustomDropdown1($customDropdown1)
    {
        $this->customDropdown1 = $customDropdown1;

        return $this;
    }

    /**
     * Get customDropdown2
     *
     * @return string
     */
    public function getCustomDropdown2()
    {
        return $this->customDropdown2;
    }

    /**
     * Set customDropdown2
     *
     * @param string $customDropdown2
     *
     * @return Listing
     */
    public function setCustomDropdown2($customDropdown2)
    {
        $this->customDropdown2 = $customDropdown2;

        return $this;
    }

    /**
     * Get customDropdown3
     *
     * @return string
     */
    public function getCustomDropdown3()
    {
        return $this->customDropdown3;
    }

    /**
     * Set customDropdown3
     *
     * @param string $customDropdown3
     *
     * @return Listing
     */
    public function setCustomDropdown3($customDropdown3)
    {
        $this->customDropdown3 = $customDropdown3;

        return $this;
    }

    /**
     * Get customDropdown4
     *
     * @return string
     */
    public function getCustomDropdown4()
    {
        return $this->customDropdown4;
    }

    /**
     * Set customDropdown4
     *
     * @param string $customDropdown4
     *
     * @return Listing
     */
    public function setCustomDropdown4($customDropdown4)
    {
        $this->customDropdown4 = $customDropdown4;

        return $this;
    }

    /**
     * Get customDropdown5
     *
     * @return string
     */
    public function getCustomDropdown5()
    {
        return $this->customDropdown5;
    }

    /**
     * Set customDropdown5
     *
     * @param string $customDropdown5
     *
     * @return Listing
     */
    public function setCustomDropdown5($customDropdown5)
    {
        $this->customDropdown5 = $customDropdown5;

        return $this;
    }

    /**
     * Get customDropdown6
     *
     * @return string
     */
    public function getCustomDropdown6()
    {
        return $this->customDropdown6;
    }

    /**
     * Set customDropdown6
     *
     * @param string $customDropdown6
     *
     * @return Listing
     */
    public function setCustomDropdown6($customDropdown6)
    {
        $this->customDropdown6 = $customDropdown6;

        return $this;
    }

    /**
     * Get customDropdown7
     *
     * @return string
     */
    public function getCustomDropdown7()
    {
        return $this->customDropdown7;
    }

    /**
     * Set customDropdown7
     *
     * @param string $customDropdown7
     *
     * @return Listing
     */
    public function setCustomDropdown7($customDropdown7)
    {
        $this->customDropdown7 = $customDropdown7;

        return $this;
    }

    /**
     * Get customDropdown8
     *
     * @return string
     */
    public function getCustomDropdown8()
    {
        return $this->customDropdown8;
    }

    /**
     * Set customDropdown8
     *
     * @param string $customDropdown8
     *
     * @return Listing
     */
    public function setCustomDropdown8($customDropdown8)
    {
        $this->customDropdown8 = $customDropdown8;

        return $this;
    }

    /**
     * Get customDropdown9
     *
     * @return string
     */
    public function getCustomDropdown9()
    {
        return $this->customDropdown9;
    }

    /**
     * Set customDropdown9
     *
     * @param string $customDropdown9
     *
     * @return Listing
     */
    public function setCustomDropdown9($customDropdown9)
    {
        $this->customDropdown9 = $customDropdown9;

        return $this;
    }

    /**
     * Get customText0
     *
     * @return string
     */
    public function getCustomText0()
    {
        return $this->customText0;
    }

    /**
     * Set customText0
     *
     * @param string $customText0
     *
     * @return Listing
     */
    public function setCustomText0($customText0)
    {
        $this->customText0 = $customText0;

        return $this;
    }

    /**
     * Get customText1
     *
     * @return string
     */
    public function getCustomText1()
    {
        return $this->customText1;
    }

    /**
     * Set customText1
     *
     * @param string $customText1
     *
     * @return Listing
     */
    public function setCustomText1($customText1)
    {
        $this->customText1 = $customText1;

        return $this;
    }

    /**
     * Get customText2
     *
     * @return string
     */
    public function getCustomText2()
    {
        return $this->customText2;
    }

    /**
     * Set customText2
     *
     * @param string $customText2
     *
     * @return Listing
     */
    public function setCustomText2($customText2)
    {
        $this->customText2 = $customText2;

        return $this;
    }

    /**
     * Get customText3
     *
     * @return string
     */
    public function getCustomText3()
    {
        return $this->customText3;
    }

    /**
     * Set customText3
     *
     * @param string $customText3
     *
     * @return Listing
     */
    public function setCustomText3($customText3)
    {
        $this->customText3 = $customText3;

        return $this;
    }

    /**
     * Get customText4
     *
     * @return string
     */
    public function getCustomText4()
    {
        return $this->customText4;
    }

    /**
     * Set customText4
     *
     * @param string $customText4
     *
     * @return Listing
     */
    public function setCustomText4($customText4)
    {
        $this->customText4 = $customText4;

        return $this;
    }

    /**
     * Get customText5
     *
     * @return string
     */
    public function getCustomText5()
    {
        return $this->customText5;
    }

    /**
     * Set customText5
     *
     * @param string $customText5
     *
     * @return Listing
     */
    public function setCustomText5($customText5)
    {
        $this->customText5 = $customText5;

        return $this;
    }

    /**
     * Get customText6
     *
     * @return string
     */
    public function getCustomText6()
    {
        return $this->customText6;
    }

    /**
     * Set customText6
     *
     * @param string $customText6
     *
     * @return Listing
     */
    public function setCustomText6($customText6)
    {
        $this->customText6 = $customText6;

        return $this;
    }

    /**
     * Get customText7
     *
     * @return string
     */
    public function getCustomText7()
    {
        return $this->customText7;
    }

    /**
     * Set customText7
     *
     * @param string $customText7
     *
     * @return Listing
     */
    public function setCustomText7($customText7)
    {
        $this->customText7 = $customText7;

        return $this;
    }

    /**
     * Get customText8
     *
     * @return string
     */
    public function getCustomText8()
    {
        return $this->customText8;
    }

    /**
     * Set customText8
     *
     * @param string $customText8
     *
     * @return Listing
     */
    public function setCustomText8($customText8)
    {
        $this->customText8 = $customText8;

        return $this;
    }

    /**
     * Get customText9
     *
     * @return string
     */
    public function getCustomText9()
    {
        return $this->customText9;
    }

    /**
     * Set customText9
     *
     * @param string $customText9
     *
     * @return Listing
     */
    public function setCustomText9($customText9)
    {
        $this->customText9 = $customText9;

        return $this;
    }

    /**
     * Get customShortDesc0
     *
     * @return string
     */
    public function getCustomShortDesc0()
    {
        return $this->customShortDesc0;
    }

    /**
     * Set customShortDesc0
     *
     * @param string $customShortDesc0
     *
     * @return Listing
     */
    public function setCustomShortDesc0($customShortDesc0)
    {
        $this->customShortDesc0 = $customShortDesc0;

        return $this;
    }

    /**
     * Get customShortDesc1
     *
     * @return string
     */
    public function getCustomShortDesc1()
    {
        return $this->customShortDesc1;
    }

    /**
     * Set customShortDesc1
     *
     * @param string $customShortDesc1
     *
     * @return Listing
     */
    public function setCustomShortDesc1($customShortDesc1)
    {
        $this->customShortDesc1 = $customShortDesc1;

        return $this;
    }

    /**
     * Get customShortDesc2
     *
     * @return string
     */
    public function getCustomShortDesc2()
    {
        return $this->customShortDesc2;
    }

    /**
     * Set customShortDesc2
     *
     * @param string $customShortDesc2
     *
     * @return Listing
     */
    public function setCustomShortDesc2($customShortDesc2)
    {
        $this->customShortDesc2 = $customShortDesc2;

        return $this;
    }

    /**
     * Get customShortDesc3
     *
     * @return string
     */
    public function getCustomShortDesc3()
    {
        return $this->customShortDesc3;
    }

    /**
     * Set customShortDesc3
     *
     * @param string $customShortDesc3
     *
     * @return Listing
     */
    public function setCustomShortDesc3($customShortDesc3)
    {
        $this->customShortDesc3 = $customShortDesc3;

        return $this;
    }

    /**
     * Get customShortDesc4
     *
     * @return string
     */
    public function getCustomShortDesc4()
    {
        return $this->customShortDesc4;
    }

    /**
     * Set customShortDesc4
     *
     * @param string $customShortDesc4
     *
     * @return Listing
     */
    public function setCustomShortDesc4($customShortDesc4)
    {
        $this->customShortDesc4 = $customShortDesc4;

        return $this;
    }

    /**
     * Get customShortDesc5
     *
     * @return string
     */
    public function getCustomShortDesc5()
    {
        return $this->customShortDesc5;
    }

    /**
     * Set customShortDesc5
     *
     * @param string $customShortDesc5
     *
     * @return Listing
     */
    public function setCustomShortDesc5($customShortDesc5)
    {
        $this->customShortDesc5 = $customShortDesc5;

        return $this;
    }

    /**
     * Get customShortDesc6
     *
     * @return string
     */
    public function getCustomShortDesc6()
    {
        return $this->customShortDesc6;
    }

    /**
     * Set customShortDesc6
     *
     * @param string $customShortDesc6
     *
     * @return Listing
     */
    public function setCustomShortDesc6($customShortDesc6)
    {
        $this->customShortDesc6 = $customShortDesc6;

        return $this;
    }

    /**
     * Get customShortDesc7
     *
     * @return string
     */
    public function getCustomShortDesc7()
    {
        return $this->customShortDesc7;
    }

    /**
     * Set customShortDesc7
     *
     * @param string $customShortDesc7
     *
     * @return Listing
     */
    public function setCustomShortDesc7($customShortDesc7)
    {
        $this->customShortDesc7 = $customShortDesc7;

        return $this;
    }

    /**
     * Get customShortDesc8
     *
     * @return string
     */
    public function getCustomShortDesc8()
    {
        return $this->customShortDesc8;
    }

    /**
     * Set customShortDesc8
     *
     * @param string $customShortDesc8
     *
     * @return Listing
     */
    public function setCustomShortDesc8($customShortDesc8)
    {
        $this->customShortDesc8 = $customShortDesc8;

        return $this;
    }

    /**
     * Get customShortDesc9
     *
     * @return string
     */
    public function getCustomShortDesc9()
    {
        return $this->customShortDesc9;
    }

    /**
     * Set customShortDesc9
     *
     * @param string $customShortDesc9
     *
     * @return Listing
     */
    public function setCustomShortDesc9($customShortDesc9)
    {
        $this->customShortDesc9 = $customShortDesc9;

        return $this;
    }

    /**
     * Get customLongDesc0
     *
     * @return string
     */
    public function getCustomLongDesc0()
    {
        return $this->customLongDesc0;
    }

    /**
     * Set customLongDesc0
     *
     * @param string $customLongDesc0
     *
     * @return Listing
     */
    public function setCustomLongDesc0($customLongDesc0)
    {
        $this->customLongDesc0 = $customLongDesc0;

        return $this;
    }

    /**
     * Get customLongDesc1
     *
     * @return string
     */
    public function getCustomLongDesc1()
    {
        return $this->customLongDesc1;
    }

    /**
     * Set customLongDesc1
     *
     * @param string $customLongDesc1
     *
     * @return Listing
     */
    public function setCustomLongDesc1($customLongDesc1)
    {
        $this->customLongDesc1 = $customLongDesc1;

        return $this;
    }

    /**
     * Get customLongDesc2
     *
     * @return string
     */
    public function getCustomLongDesc2()
    {
        return $this->customLongDesc2;
    }

    /**
     * Set customLongDesc2
     *
     * @param string $customLongDesc2
     *
     * @return Listing
     */
    public function setCustomLongDesc2($customLongDesc2)
    {
        $this->customLongDesc2 = $customLongDesc2;

        return $this;
    }

    /**
     * Get customLongDesc3
     *
     * @return string
     */
    public function getCustomLongDesc3()
    {
        return $this->customLongDesc3;
    }

    /**
     * Set customLongDesc3
     *
     * @param string $customLongDesc3
     *
     * @return Listing
     */
    public function setCustomLongDesc3($customLongDesc3)
    {
        $this->customLongDesc3 = $customLongDesc3;

        return $this;
    }

    /**
     * Get customLongDesc4
     *
     * @return string
     */
    public function getCustomLongDesc4()
    {
        return $this->customLongDesc4;
    }

    /**
     * Set customLongDesc4
     *
     * @param string $customLongDesc4
     *
     * @return Listing
     */
    public function setCustomLongDesc4($customLongDesc4)
    {
        $this->customLongDesc4 = $customLongDesc4;

        return $this;
    }

    /**
     * Get customLongDesc5
     *
     * @return string
     */
    public function getCustomLongDesc5()
    {
        return $this->customLongDesc5;
    }

    /**
     * Set customLongDesc5
     *
     * @param string $customLongDesc5
     *
     * @return Listing
     */
    public function setCustomLongDesc5($customLongDesc5)
    {
        $this->customLongDesc5 = $customLongDesc5;

        return $this;
    }

    /**
     * Get customLongDesc6
     *
     * @return string
     */
    public function getCustomLongDesc6()
    {
        return $this->customLongDesc6;
    }

    /**
     * Set customLongDesc6
     *
     * @param string $customLongDesc6
     *
     * @return Listing
     */
    public function setCustomLongDesc6($customLongDesc6)
    {
        $this->customLongDesc6 = $customLongDesc6;

        return $this;
    }

    /**
     * Get customLongDesc7
     *
     * @return string
     */
    public function getCustomLongDesc7()
    {
        return $this->customLongDesc7;
    }

    /**
     * Set customLongDesc7
     *
     * @param string $customLongDesc7
     *
     * @return Listing
     */
    public function setCustomLongDesc7($customLongDesc7)
    {
        $this->customLongDesc7 = $customLongDesc7;

        return $this;
    }

    /**
     * Get customLongDesc8
     *
     * @return string
     */
    public function getCustomLongDesc8()
    {
        return $this->customLongDesc8;
    }

    /**
     * Set customLongDesc8
     *
     * @param string $customLongDesc8
     *
     * @return Listing
     */
    public function setCustomLongDesc8($customLongDesc8)
    {
        $this->customLongDesc8 = $customLongDesc8;

        return $this;
    }

    /**
     * Get customLongDesc9
     *
     * @return string
     */
    public function getCustomLongDesc9()
    {
        return $this->customLongDesc9;
    }

    /**
     * Set customLongDesc9
     *
     * @param string $customLongDesc9
     *
     * @return Listing
     */
    public function setCustomLongDesc9($customLongDesc9)
    {
        $this->customLongDesc9 = $customLongDesc9;

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
     *
     * @return Listing
     */
    public function setNumberViews($numberViews)
    {
        $this->numberViews = $numberViews;

        return $this;
    }

    /**
     * Get avgReview
     *
     * @return integer
     */
    public function getAvgReview()
    {
        return $this->avgReview;
    }

    /**
     * Set avgReview
     *
     * @param integer $avgReview
     *
     * @return Listing
     */
    public function setAvgReview($avgReview)
    {
        $this->avgReview = $avgReview;

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
     *
     * @return Listing
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
     *
     * @return Listing
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
     *
     * @return Listing
     */
    public function setPackagePrice($packagePrice)
    {
        $this->packagePrice = $packagePrice;

        return $this;
    }

    /**
     * Get clicktocallNumber
     *
     * @return string
     */
    public function getClicktocallNumber()
    {
        return $this->clicktocallNumber;
    }

    /**
     * Set clicktocallNumber
     *
     * @param string $clicktocallNumber
     *
     * @return Listing
     */
    public function setClicktocallNumber($clicktocallNumber)
    {
        $this->clicktocallNumber = $clicktocallNumber;

        return $this;
    }

    /**
     * Get clicktocallExtension
     *
     * @return integer
     */
    public function getClicktocallExtension()
    {
        return $this->clicktocallExtension;
    }

    /**
     * Set clicktocallExtension
     *
     * @param integer $clicktocallExtension
     *
     * @return Listing
     */
    public function setClicktocallExtension($clicktocallExtension)
    {
        $this->clicktocallExtension = $clicktocallExtension;

        return $this;
    }

    /**
     * Get clicktocallDate
     *
     * @return \DateTime
     */
    public function getClicktocallDate()
    {
        return $this->clicktocallDate;
    }

    /**
     * Set clicktocallDate
     *
     * @param \DateTime $clicktocallDate
     *
     * @return Listing
     */
    public function setClicktocallDate($clicktocallDate)
    {
        $this->clicktocallDate = $clicktocallDate;

        return $this;
    }

    /**
     * Get lastTrafficSent
     *
     * @return \DateTime
     */
    public function getLastTrafficSent()
    {
        return $this->lastTrafficSent;
    }

    /**
     * Set lastTrafficSent
     *
     * @param \DateTime $lastTrafficSent
     *
     * @return Listing
     */
    public function setLastTrafficSent($lastTrafficSent)
    {
        $this->lastTrafficSent = $lastTrafficSent;

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
     *
     * @return Listing
     */
    public function setCustomId($customId)
    {
        $this->customId = $customId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeals()
    {
        return $this->deals;
    }

    /**
     * @param mixed $deals
     *
     * @return Listing
     */
    public function setDeals($deals)
    {
        $this->deals = $deals;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param mixed $choices
     *
     * @return Listing
     */
    public function setChoices($choices)
    {
        $this->choices = $choices;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
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
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @param mixed $coverImage
     *
     * @return Listing
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
     * @return ListingLevel
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
     * @return string
     */
    public function getSocialNetwork()
    {
        return $this->socialNetwork;
    }

    /**
     * @param string $socialNetwork
     *
     * @return Listing
     */
    public function setSocialNetwork($socialNetwork)
    {
        $this->socialNetwork = $socialNetwork;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClassifieds()
    {
        return $this->classifieds;
    }

    /**
     * @param mixed $classifieds
     * @return Listing
     */
    public function setClassifieds($classifieds)
    {
        $this->classifieds = $classifieds;

        return $this;
    }

    /**
     * @param bool $setNull
     * @return $this
     */
    public function cleanClassifieds($setNull = false)
    {
        $setNull ? $this->classifieds = null : $this->classifieds->clear();

        return $this;
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
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $reviewsTotal
     */
    public function setReviewsTotal($reviewsTotal)
    {
        $this->reviewsTotal = $reviewsTotal;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getExtraFields()
    {
        return $this->extraFields;
    }

    /**
     * @param array $extraFields
     */
    public function setExtraFields($extraFields)
    {
        $this->extraFields = $extraFields;
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
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("geo")
     * @Serializer\Groups({"listingDetail", "Result"})
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
}
