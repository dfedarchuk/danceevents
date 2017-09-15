<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentCustominvoiceLog
 *
 * @ORM\Table(name="Payment_CustomInvoice_Log", indexes={@ORM\Index(name="payment_log_id", columns={"payment_log_id"}), @ORM\Index(name="custom_invoice_id", columns={"custom_invoice_id"})})
 * @ORM\Entity
 */
class PaymentCustominvoiceLog
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
     * @ORM\Column(name="custom_invoice_id", type="integer", nullable=false)
     */
    private $customInvoiceId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

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
     * @return PaymentCustominvoiceLog
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
     * Set customInvoiceId
     *
     * @param integer $customInvoiceId
     * @return PaymentCustominvoiceLog
     */
    public function setCustomInvoiceId($customInvoiceId)
    {
        $this->customInvoiceId = $customInvoiceId;

        return $this;
    }

    /**
     * Get customInvoiceId
     *
     * @return integer 
     */
    public function getCustomInvoiceId()
    {
        return $this->customInvoiceId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return PaymentCustominvoiceLog
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
     * Set date
     *
     * @param \DateTime $date
     * @return PaymentCustominvoiceLog
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set items
     *
     * @param string $items
     * @return PaymentCustominvoiceLog
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
     * @return PaymentCustominvoiceLog
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
     * @return PaymentCustominvoiceLog
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
