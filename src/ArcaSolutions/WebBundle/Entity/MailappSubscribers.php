<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailappSubscribers
 *
 * @ORM\Table(name="MailApp_Subscribers")
 * @ORM\Entity
 */
class MailappSubscribers
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
     * @ORM\Column(name="subscriber_name", type="string", length=100, nullable=false)
     */
    private $subscriberName;

    /**
     * @var string
     *
     * @ORM\Column(name="subscriber_email", type="string", length=100, nullable=false)
     */
    private $subscriberEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="subscriber_type", type="string", length=20, nullable=false)
     */
    private $subscriberType;

    /**
     * @var string
     *
     * @ORM\Column(name="list_id", type="string", length=255, nullable=false)
     */
    private $listId;



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
     * @return MailappSubscribers
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
     * Set subscriberName
     *
     * @param string $subscriberName
     * @return MailappSubscribers
     */
    public function setSubscriberName($subscriberName)
    {
        $this->subscriberName = $subscriberName;

        return $this;
    }

    /**
     * Get subscriberName
     *
     * @return string 
     */
    public function getSubscriberName()
    {
        return $this->subscriberName;
    }

    /**
     * Set subscriberEmail
     *
     * @param string $subscriberEmail
     * @return MailappSubscribers
     */
    public function setSubscriberEmail($subscriberEmail)
    {
        $this->subscriberEmail = $subscriberEmail;

        return $this;
    }

    /**
     * Get subscriberEmail
     *
     * @return string 
     */
    public function getSubscriberEmail()
    {
        return $this->subscriberEmail;
    }

    /**
     * Set subscriberType
     *
     * @param string $subscriberType
     * @return MailappSubscribers
     */
    public function setSubscriberType($subscriberType)
    {
        $this->subscriberType = $subscriberType;

        return $this;
    }

    /**
     * Get subscriberType
     *
     * @return string 
     */
    public function getSubscriberType()
    {
        return $this->subscriberType;
    }

    /**
     * Set listId
     *
     * @param string $listId
     * @return MailappSubscribers
     */
    public function setListId($listId)
    {
        $this->listId = $listId;

        return $this;
    }

    /**
     * Get listId
     *
     * @return string 
     */
    public function getListId()
    {
        return $this->listId;
    }
}
