<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentListingLog
 *
 * @ORM\Table(name="Payment_Listing_Log", indexes={@ORM\Index(name="payment_log_id", columns={"payment_log_id"}), @ORM\Index(name="listing_id", columns={"listing_id"})})
 * @ORM\Entity
 */
class PaymentListingLog
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
     * @ORM\Column(name="payment_log_id", type="integer", nullable=false)
     */
    private $paymentLogId;

    /**
     * @var integer
     *
     * @ORM\Column(name="listing_id", type="integer", nullable=false)
     */
    private $listingId;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_title", type="string", length=255, nullable=false)
     */
    private $listingTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_id", type="string", length=10, nullable=false)
     */
    private $discountId;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="level_label", type="string", length=255, nullable=false)
     */
    private $levelLabel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="renewal_date", type="date", nullable=false)
     */
    private $renewalDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="categories", type="integer", nullable=false)
     */
    private $categories;

    /**
     * @var integer
     *
     * @ORM\Column(name="extra_categories", type="integer", nullable=false)
     */
    private $extraCategories;

    /**
     * @var string
     *
     * @ORM\Column(name="listingtemplate_title", type="string", length=255, nullable=false)
     */
    private $listingtemplateTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $amount;



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
     * Set paymentLogId
     *
     * @param integer $paymentLogId
     * @return PaymentListingLog
     */
    public function setPaymentLogId($paymentLogId)
    {
        $this->paymentLogId = $paymentLogId;

        return $this;
    }

    /**
     * Get paymentLogId
     *
     * @return integer 
     */
    public function getPaymentLogId()
    {
        return $this->paymentLogId;
    }

    /**
     * Set listingId
     *
     * @param integer $listingId
     * @return PaymentListingLog
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
     * Set listingTitle
     *
     * @param string $listingTitle
     * @return PaymentListingLog
     */
    public function setListingTitle($listingTitle)
    {
        $this->listingTitle = $listingTitle;

        return $this;
    }

    /**
     * Get listingTitle
     *
     * @return string 
     */
    public function getListingTitle()
    {
        return $this->listingTitle;
    }

    /**
     * Set discountId
     *
     * @param string $discountId
     * @return PaymentListingLog
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
     * Set level
     *
     * @param integer $level
     * @return PaymentListingLog
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
     * Set levelLabel
     *
     * @param string $levelLabel
     * @return PaymentListingLog
     */
    public function setLevelLabel($levelLabel)
    {
        $this->levelLabel = $levelLabel;

        return $this;
    }

    /**
     * Get levelLabel
     *
     * @return string 
     */
    public function getLevelLabel()
    {
        return $this->levelLabel;
    }

    /**
     * Set renewalDate
     *
     * @param \DateTime $renewalDate
     * @return PaymentListingLog
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
     * Set categories
     *
     * @param integer $categories
     * @return PaymentListingLog
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return integer 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set extraCategories
     *
     * @param integer $extraCategories
     * @return PaymentListingLog
     */
    public function setExtraCategories($extraCategories)
    {
        $this->extraCategories = $extraCategories;

        return $this;
    }

    /**
     * Get extraCategories
     *
     * @return integer 
     */
    public function getExtraCategories()
    {
        return $this->extraCategories;
    }

    /**
     * Set listingtemplateTitle
     *
     * @param string $listingtemplateTitle
     * @return PaymentListingLog
     */
    public function setListingtemplateTitle($listingtemplateTitle)
    {
        $this->listingtemplateTitle = $listingtemplateTitle;

        return $this;
    }

    /**
     * Get listingtemplateTitle
     *
     * @return string 
     */
    public function getListingtemplateTitle()
    {
        return $this->listingtemplateTitle;
    }

    /**
     * Set amount
     *
     * @param string $amount
     * @return PaymentListingLog
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
