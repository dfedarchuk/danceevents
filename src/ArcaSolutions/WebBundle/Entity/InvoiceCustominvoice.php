<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceCustominvoice
 *
 * @ORM\Table(name="Invoice_CustomInvoice", indexes={@ORM\Index(name="invoice_id", columns={"invoice_id"}), @ORM\Index(name="custom_invoice_id", columns={"custom_invoice_id"})})
 * @ORM\Entity
 */
class InvoiceCustominvoice
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
     * @ORM\Column(name="subtotal", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $subtotal;

    /**
     * @var string
     *
     * @ORM\Column(name="tax", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $tax;

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
     * Set invoiceId
     *
     * @param integer $invoiceId
     * @return InvoiceCustominvoice
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
     * Set customInvoiceId
     *
     * @param integer $customInvoiceId
     * @return InvoiceCustominvoice
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
     * @return InvoiceCustominvoice
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
     * @return InvoiceCustominvoice
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
     * @return InvoiceCustominvoice
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
     * @return InvoiceCustominvoice
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
     * Set subtotal
     *
     * @param string $subtotal
     * @return InvoiceCustominvoice
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get subtotal
     *
     * @return string 
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set tax
     *
     * @param string $tax
     * @return InvoiceCustominvoice
     */
    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax
     *
     * @return string 
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set amount
     *
     * @param string $amount
     * @return InvoiceCustominvoice
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
