<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentPackageLog
 *
 * @ORM\Table(name="Payment_Package_Log", indexes={@ORM\Index(name="payment_log_id", columns={"payment_log_id"}), @ORM\Index(name="package_id", columns={"package_id"})})
 * @ORM\Entity
 */
class PaymentPackageLog
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
     * @ORM\Column(name="package_id", type="integer", nullable=false)
     */
    private $packageId;

    /**
     * @var string
     *
     * @ORM\Column(name="package_title", type="string", length=100, nullable=false)
     */
    private $packageTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="items", type="text", nullable=false)
     */
    private $items;

    /**
     * @var string
     *
     * @ORM\Column(name="items_price", type="text", nullable=false)
     */
    private $itemsPrice;

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
     * @return PaymentPackageLog
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
     * Set packageId
     *
     * @param integer $packageId
     * @return PaymentPackageLog
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
     * Set packageTitle
     *
     * @param string $packageTitle
     * @return PaymentPackageLog
     */
    public function setPackageTitle($packageTitle)
    {
        $this->packageTitle = $packageTitle;

        return $this;
    }

    /**
     * Get packageTitle
     *
     * @return string 
     */
    public function getPackageTitle()
    {
        return $this->packageTitle;
    }

    /**
     * Set items
     *
     * @param string $items
     * @return PaymentPackageLog
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return string 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set itemsPrice
     *
     * @param string $itemsPrice
     * @return PaymentPackageLog
     */
    public function setItemsPrice($itemsPrice)
    {
        $this->itemsPrice = $itemsPrice;

        return $this;
    }

    /**
     * Get itemsPrice
     *
     * @return string 
     */
    public function getItemsPrice()
    {
        return $this->itemsPrice;
    }

    /**
     * Set amount
     *
     * @param string $amount
     * @return PaymentPackageLog
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
