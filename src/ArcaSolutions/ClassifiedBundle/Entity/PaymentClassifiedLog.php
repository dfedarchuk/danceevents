<?php

namespace ArcaSolutions\ClassifiedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentClassifiedLog
 *
 * @ORM\Table(name="Payment_Classified_Log", indexes={@ORM\Index(name="payment_log_id", columns={"payment_log_id"}), @ORM\Index(name="classified_id", columns={"classified_id"})})
 * @ORM\Entity
 */
class PaymentClassifiedLog
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
    private $paymentLogId = '0';

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
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level = '0';

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
    private $renewalDate = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $amount = '0.00';



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
     * @return PaymentClassifiedLog
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
     * Set classifiedId
     *
     * @param integer $classifiedId
     * @return PaymentClassifiedLog
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
     * @return PaymentClassifiedLog
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
     * @return PaymentClassifiedLog
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
     * @return PaymentClassifiedLog
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
     * @return PaymentClassifiedLog
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
     * @return PaymentClassifiedLog
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
     * Set amount
     *
     * @param string $amount
     * @return PaymentClassifiedLog
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
