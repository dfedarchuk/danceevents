<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceListing
 *
 * @ORM\Table(name="Invoice_Listing", indexes={@ORM\Index(name="invoice_id", columns={"invoice_id"}), @ORM\Index(name="listing_id", columns={"listing_id"})})
 * @ORM\Entity
 */
class InvoiceListing
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
     * @ORM\Column(name="invoice_id", type="integer", nullable=false)
     */
    private $invoiceId;

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
     * @ORM\Column(name="discount_id", type="string", length=10, nullable=true)
     */
    private $discountId;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=true)
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
     * @ORM\Column(name="renewal_date", type="date", nullable=true)
     */
    private $renewalDate;

    /**
     * @var string
     *
     * @ORM\Column(name="renewal_period", type="string", length=1, nullable=false, options={"default"="M"})
     */
    private $renewalPeriod;

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
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=true)
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
     * Set invoiceId
     *
     * @param integer $invoiceId
     * @return InvoiceListing
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * Get invoiceId
     *
     * @return integer
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * Set listingId
     *
     * @param integer $listingId
     * @return InvoiceListing
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
     * @return InvoiceListing
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
     * @return InvoiceListing
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
     * @return InvoiceListing
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
     * @return InvoiceListing
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
     * @return InvoiceListing
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
     * Set renewalPeriod
     *
     * @param string $renewalPeriod
     * @return InvoiceListing
     */
    public function setRenewalPeriod($renewalPeriod)
    {
        $this->renewalPeriod = $renewalPeriod;

        return $this;
    }

    /**
     * Get renewalPeriod
     *
     * @return string
     */
    public function getRenewalPeriod()
    {
        return $this->renewalPeriod;
    }

    /**
     * Set categories
     *
     * @param integer $categories
     * @return InvoiceListing
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
     * @return InvoiceListing
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
     * @return InvoiceListing
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
     * @return InvoiceListing
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
