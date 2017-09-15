<?php

namespace ArcaSolutions\ClassifiedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceClassified
 *
 * @ORM\Table(name="Invoice_Classified", indexes={@ORM\Index(name="invoice_id", columns={"invoice_id"}), @ORM\Index(name="classified_id", columns={"classified_id"})})
 * @ORM\Entity
 */
class InvoiceClassified
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
    private $invoiceId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="classified_id", type="integer", nullable=false)
     */
    private $classifiedId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="classified_title", type="string", length=255, nullable=false)
     */
    private $classifiedTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_id", type="string", length=10, nullable=false)
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
     * @return InvoiceClassified
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
     * Set classifiedId
     *
     * @param integer $classifiedId
     * @return InvoiceClassified
     */
    public function setClassifiedId($classifiedId)
    {
        $this->classifiedId = $classifiedId;

        return $this;
    }

    /**
     * Get classifiedId
     *
     * @return integer
     */
    public function getClassifiedId()
    {
        return $this->classifiedId;
    }

    /**
     * Set classifiedTitle
     *
     * @param string $classifiedTitle
     * @return InvoiceClassified
     */
    public function setClassifiedTitle($classifiedTitle)
    {
        $this->classifiedTitle = $classifiedTitle;

        return $this;
    }

    /**
     * Get classifiedTitle
     *
     * @return string
     */
    public function getClassifiedTitle()
    {
        return $this->classifiedTitle;
    }

    /**
     * Set discountId
     *
     * @param string $discountId
     * @return InvoiceClassified
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
     * @return InvoiceClassified
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
     * @return InvoiceClassified
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
     * @return InvoiceClassified
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
     * @return InvoiceClassified
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
     * Set amount
     *
     * @param string $amount
     * @return InvoiceClassified
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
