<?php

namespace ArcaSolutions\BannersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentBannerLog
 *
 * @ORM\Table(name="Payment_Banner_Log", indexes={@ORM\Index(name="payment_log_id", columns={"payment_log_id"}), @ORM\Index(name="banner_id", columns={"banner_id"})})
 * @ORM\Entity
 */
class PaymentBannerLog
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
     * @ORM\Column(name="banner_id", type="integer", nullable=false)
     */
    private $bannerId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="banner_caption", type="string", length=255, nullable=false)
     */
    private $bannerCaption;

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
     * @var integer
     *
     * @ORM\Column(name="impressions", type="integer", nullable=false)
     */
    private $impressions = '0';

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
     * @return PaymentBannerLog
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
     * Set bannerId
     *
     * @param integer $bannerId
     * @return PaymentBannerLog
     */
    public function setBannerId($bannerId)
    {
        $this->bannerId = $bannerId;

        return $this;
    }

    /**
     * Get bannerId
     *
     * @return integer
     */
    public function getBannerId()
    {
        return $this->bannerId;
    }

    /**
     * Set bannerCaption
     *
     * @param string $bannerCaption
     * @return PaymentBannerLog
     */
    public function setBannerCaption($bannerCaption)
    {
        $this->bannerCaption = $bannerCaption;

        return $this;
    }

    /**
     * Get bannerCaption
     *
     * @return string
     */
    public function getBannerCaption()
    {
        return $this->bannerCaption;
    }

    /**
     * Set discountId
     *
     * @param string $discountId
     * @return PaymentBannerLog
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
     * @return PaymentBannerLog
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
     * @return PaymentBannerLog
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
     * @return PaymentBannerLog
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
     * Set impressions
     *
     * @param integer $impressions
     * @return PaymentBannerLog
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
     * Set amount
     *
     * @param string $amount
     * @return PaymentBannerLog
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
