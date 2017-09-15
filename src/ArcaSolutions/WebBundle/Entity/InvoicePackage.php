<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoicePackage
 *
 * @ORM\Table(name="Invoice_Package", indexes={@ORM\Index(name="invoice_id", columns={"invoice_id"}), @ORM\Index(name="package_id", columns={"package_id"})})
 * @ORM\Entity
 */
class InvoicePackage
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
     * @var string
     *
     * @ORM\Column(name="renewal_period", type="string", length=1, nullable=false, options={"default"="M"})
     */
    private $renewalPeriod;



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
     * @return InvoicePackage
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
     * Set packageId
     *
     * @param integer $packageId
     * @return InvoicePackage
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
     * @return InvoicePackage
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
     * @return InvoicePackage
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
     * @return InvoicePackage
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
     * @return InvoicePackage
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
     * @return InvoicePackage
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
     * @return InvoicePackage
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

    /**
     * Set renewalPeriod
     *
     * @param string $renewalPeriod
     * @return InvoicePackage
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
}
