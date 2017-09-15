<?php

namespace ArcaSolutions\BannersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Banner
 *
 * @ORM\Table(name="Banner", indexes={@ORM\Index(name="status", columns={"status"}), @ORM\Index(name="type", columns={"type"}), @ORM\Index(name="section", columns={"section"}), @ORM\Index(name="expiration_setting", columns={"expiration_setting"}), @ORM\Index(name="impressions", columns={"impressions"}), @ORM\Index(name="account_id", columns={"account_id"}), @ORM\Index(name="category_id", columns={"category_id"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\BannersBundle\Repository\BannerRepository")
 */
class Banner
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="category_id", type="integer", nullable=true)
     */
    private $categoryId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="renewal_date", type="date", nullable=true)
     */
    private $renewalDate;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_id", type="string", length=10, nullable=false)
     */
    private $discountId;

    /**
     * @var string
     *
     * @ORM\Column(name="caption", type="string", length=100, nullable=false)
     */
    private $caption;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status = 'P';

    /**
     * @var integer
     *
     * @ORM\Column(name="target_window", type="integer", nullable=false)
     */
    private $targetWindow = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="section", type="string", length=255, nullable=false)
     */
    private $section = 'general';

    /**
     * @var string
     *
     * @ORM\Column(name="content_line1", type="string", length=35, nullable=false)
     */
    private $contentLine1;

    /**
     * @var string
     *
     * @ORM\Column(name="content_line2", type="string", length=35, nullable=false)
     */
    private $contentLine2;

    /**
     * @var string
     *
     * @ORM\Column(name="destination_protocol", type="string", length=10, nullable=false)
     */
    private $destinationProtocol;

    /**
     * @var string
     *
     * @ORM\Column(name="display_url", type="string", length=200, nullable=false)
     */
    private $displayUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="destination_url", type="text", nullable=false)
     */
    private $destinationUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="unpaid_impressions", type="integer", nullable=false)
     */
    private $unpaidImpressions = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="impressions", type="integer", nullable=false)
     */
    private $impressions = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="unlimited_impressions", type="string", length=1, nullable=false)
     */
    private $unlimitedImpressions = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="expiration_setting", type="string", length=1, nullable=false)
     */
    private $expirationSetting;

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
     * @var boolean
     *
     * @ORM\Column(name="show_type", type="boolean", nullable=false, options={"default" = false})
     */
    private $showType = false;

    /**
     * @var string
     *
     * @ORM\Column(name="script", type="text", nullable=true)
     */
    private $script;

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
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;


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
     * @return Banner
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
     * @return Banner
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
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Banner
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set renewalDate
     *
     * @param \DateTime $renewalDate
     * @return Banner
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
     * @return Banner
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
     * Set caption
     *
     * @param string $caption
     * @return Banner
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Get caption
     *
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Banner
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
     * Set targetWindow
     *
     * @param integer $targetWindow
     * @return Banner
     */
    public function setTargetWindow($targetWindow)
    {
        $this->targetWindow = $targetWindow;

        return $this;
    }

    /**
     * Get targetWindow
     *
     * @return integer
     */
    public function getTargetWindow()
    {
        return $this->targetWindow;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Banner
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set section
     *
     * @param string $section
     * @return Banner
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set contentLine1
     *
     * @param string $contentLine1
     * @return Banner
     */
    public function setContentLine1($contentLine1)
    {
        $this->contentLine1 = $contentLine1;

        return $this;
    }

    /**
     * Get contentLine1
     *
     * @return string
     */
    public function getContentLine1()
    {
        return $this->contentLine1;
    }

    /**
     * Set contentLine2
     *
     * @param string $contentLine2
     * @return Banner
     */
    public function setContentLine2($contentLine2)
    {
        $this->contentLine2 = $contentLine2;

        return $this;
    }

    /**
     * Get contentLine2
     *
     * @return string
     */
    public function getContentLine2()
    {
        return $this->contentLine2;
    }

    /**
     * Set destinationProtocol
     *
     * @param string $destinationProtocol
     * @return Banner
     */
    public function setDestinationProtocol($destinationProtocol)
    {
        $this->destinationProtocol = $destinationProtocol;

        return $this;
    }

    /**
     * Get destinationProtocol
     *
     * @return string
     */
    public function getDestinationProtocol()
    {
        return $this->destinationProtocol;
    }

    /**
     * Set displayUrl
     *
     * @param string $displayUrl
     * @return Banner
     */
    public function setDisplayUrl($displayUrl)
    {
        $this->displayUrl = $displayUrl;

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
     * Set destinationUrl
     *
     * @param string $destinationUrl
     * @return Banner
     */
    public function setDestinationUrl($destinationUrl)
    {
        $this->destinationUrl = $destinationUrl;

        return $this;
    }

    /**
     * Get destinationUrl
     *
     * @return string
     */
    public function getDestinationUrl()
    {
        return $this->destinationUrl;
    }

    /**
     * Set unpaidImpressions
     *
     * @param integer $unpaidImpressions
     * @return Banner
     */
    public function setUnpaidImpressions($unpaidImpressions)
    {
        $this->unpaidImpressions = $unpaidImpressions;

        return $this;
    }

    /**
     * Get unpaidImpressions
     *
     * @return integer
     */
    public function getUnpaidImpressions()
    {
        return $this->unpaidImpressions;
    }

    /**
     * Set impressions
     *
     * @param integer $impressions
     * @return Banner
     */
    public function setImpressions($impressions)
    {
        $this->impressions = $impressions;

        return $this;
    }

    /**
     * Get impressions
     *
     * @return integer
     */
    public function getImpressions()
    {
        return $this->impressions;
    }

    /**
     * Set unlimitedImpressions
     *
     * @param string $unlimitedImpressions
     * @return Banner
     */
    public function setUnlimitedImpressions($unlimitedImpressions)
    {
        $this->unlimitedImpressions = $unlimitedImpressions;

        return $this;
    }

    /**
     * Get unlimitedImpressions
     *
     * @return string
     */
    public function getUnlimitedImpressions()
    {
        return $this->unlimitedImpressions;
    }

    /**
     * Set expirationSetting
     *
     * @param string $expirationSetting
     * @return Banner
     */
    public function setExpirationSetting($expirationSetting)
    {
        $this->expirationSetting = $expirationSetting;

        return $this;
    }

    /**
     * Get expirationSetting
     *
     * @return string
     */
    public function getExpirationSetting()
    {
        return $this->expirationSetting;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Banner
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
     * @return Banner
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
     * Set showType
     *
     * @param boolean $showType
     * @return Banner
     */
    public function setShowType($showType)
    {
        $this->showType = $showType;

        return $this;
    }

    /**
     * Get showType
     *
     * @return boolean
     */
    public function getShowType()
    {
        return $this->showType;
    }

    /**
     * Set script
     *
     * @param string $script
     * @return Banner
     */
    public function setScript($script)
    {
        $this->script = $script;

        return $this;
    }

    /**
     * Get script
     *
     * @return string
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * Set packageId
     *
     * @param integer $packageId
     * @return Banner
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
     * @return Banner
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param \ArcaSolutions\ImageBundle\Entity\Image $image
     * @return Banner
     */
    public function setImage(\ArcaSolutions\ImageBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }
}
