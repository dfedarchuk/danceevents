<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentLog
 *
 * @ORM\Table(name="Payment_Log", indexes={@ORM\Index(name="account_id", columns={"account_id"})})
 * @ORM\Entity
 */
class PaymentLog
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
     * @ORM\Column(name="account_id", type="integer", nullable=false)
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=false)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_id", type="string", length=255, nullable=false)
     */
    private $transactionId;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_status", type="string", length=255, nullable=false)
     */
    private $transactionStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="transaction_datetime", type="datetime", nullable=false)
     */
    private $transactionDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_subtotal", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $transactionSubtotal;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_tax", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $transactionTax;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $transactionAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_currency", type="string", length=3, nullable=false)
     */
    private $transactionCurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="system_type", type="string", length=255, nullable=true)
     */
    private $systemType;

    /**
     * @var string
     *
     * @ORM\Column(name="recurring", type="string", length=1, nullable=false, options={"default"="n","comment":"y/n"})
     */
    private $recurring;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    private $notes;

    /**
     * @var string
     *
     * @ORM\Column(name="return_fields", type="text", nullable=true)
     */
    private $returnFields;

    /**
     * @var string
     *
     * @ORM\Column(name="hidden", type="string", length=1, nullable=false, options={"default"="n","comment":"y/n"})
     */
    private $hidden;



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
     * @return PaymentLog
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
     * Set username
     *
     * @param string $username
     * @return PaymentLog
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return PaymentLog
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set transactionId
     *
     * @param string $transactionId
     * @return PaymentLog
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * Get transactionId
     *
     * @return string 
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set transactionStatus
     *
     * @param string $transactionStatus
     * @return PaymentLog
     */
    public function setTransactionStatus($transactionStatus)
    {
        $this->transactionStatus = $transactionStatus;

        return $this;
    }

    /**
     * Get transactionStatus
     *
     * @return string 
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }

    /**
     * Set transactionDatetime
     *
     * @param \DateTime $transactionDatetime
     * @return PaymentLog
     */
    public function setTransactionDatetime($transactionDatetime)
    {
        $this->transactionDatetime = $transactionDatetime;

        return $this;
    }

    /**
     * Get transactionDatetime
     *
     * @return \DateTime 
     */
    public function getTransactionDatetime()
    {
        return $this->transactionDatetime;
    }

    /**
     * Set transactionSubtotal
     *
     * @param string $transactionSubtotal
     * @return PaymentLog
     */
    public function setTransactionSubtotal($transactionSubtotal)
    {
        $this->transactionSubtotal = $transactionSubtotal;

        return $this;
    }

    /**
     * Get transactionSubtotal
     *
     * @return string 
     */
    public function getTransactionSubtotal()
    {
        return $this->transactionSubtotal;
    }

    /**
     * Set transactionTax
     *
     * @param string $transactionTax
     * @return PaymentLog
     */
    public function setTransactionTax($transactionTax)
    {
        $this->transactionTax = $transactionTax;

        return $this;
    }

    /**
     * Get transactionTax
     *
     * @return string 
     */
    public function getTransactionTax()
    {
        return $this->transactionTax;
    }

    /**
     * Set transactionAmount
     *
     * @param string $transactionAmount
     * @return PaymentLog
     */
    public function setTransactionAmount($transactionAmount)
    {
        $this->transactionAmount = $transactionAmount;

        return $this;
    }

    /**
     * Get transactionAmount
     *
     * @return string 
     */
    public function getTransactionAmount()
    {
        return $this->transactionAmount;
    }

    /**
     * Set transactionCurrency
     *
     * @param string $transactionCurrency
     * @return PaymentLog
     */
    public function setTransactionCurrency($transactionCurrency)
    {
        $this->transactionCurrency = $transactionCurrency;

        return $this;
    }

    /**
     * Get transactionCurrency
     *
     * @return string 
     */
    public function getTransactionCurrency()
    {
        return $this->transactionCurrency;
    }

    /**
     * Set systemType
     *
     * @param string $systemType
     * @return PaymentLog
     */
    public function setSystemType($systemType)
    {
        $this->systemType = $systemType;

        return $this;
    }

    /**
     * Get systemType
     *
     * @return string 
     */
    public function getSystemType()
    {
        return $this->systemType;
    }

    /**
     * Set recurring
     *
     * @param string $recurring
     * @return PaymentLog
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;

        return $this;
    }

    /**
     * Get recurring
     *
     * @return string 
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return PaymentLog
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set returnFields
     *
     * @param string $returnFields
     * @return PaymentLog
     */
    public function setReturnFields($returnFields)
    {
        $this->returnFields = $returnFields;

        return $this;
    }

    /**
     * Get returnFields
     *
     * @return string 
     */
    public function getReturnFields()
    {
        return $this->returnFields;
    }

    /**
     * Set hidden
     *
     * @param string $hidden
     * @return PaymentLog
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * Get hidden
     *
     * @return string 
     */
    public function getHidden()
    {
        return $this->hidden;
    }
}
