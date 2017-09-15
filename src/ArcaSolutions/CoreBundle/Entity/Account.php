<?php

namespace ArcaSolutions\CoreBundle\Entity;

use ArcaSolutions\CoreBundle\Entity\Contact;
use ArcaSolutions\CoreBundle\Entity\Profile;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Account
 *
 * @ORM\Table(name="Account", indexes={@ORM\Index(name="username", columns={"username"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\AccountRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Account implements UserInterface, \Serializable
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
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entered", type="datetime", nullable=false)
     */
    private $entered;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastlogin", type="datetime", nullable=true)
     */
    private $lastlogin;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_username", type="string", length=100, nullable=true)
     */
    private $facebookUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=100, nullable=false, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="foreignaccount", type="string", length=1, nullable=true)
     */
    private $foreignaccount;

    /**
     * @var integer
     *
     * @ORM\Column(name="faillogin_count", type="integer", nullable=false, options={"default" = 0})
     */
    private $failloginCount = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="faillogin_datetime", type="datetime", nullable=true)
     */
    private $failloginDatetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="importID", type="integer", nullable=false, options={"default" = 0})
     */
    private $importid = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="domain_importID", type="integer", nullable=true)
     */
    private $domainImportid;

    /**
     * @var integer
     *
     * @ORM\Column(name="importID_event", type="integer", nullable=false, options={"default" = 0})
     */
    private $importidEvent = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="domain_importID_event", type="integer", nullable=true)
     */
    private $domainImportidEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="is_sponsor", type="string", length=1, nullable=false, options={"default" = "n"})
     */
    private $isSponsor = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="has_profile", type="string", length=1, nullable=false, options={"default" = "y"})
     */
    private $hasProfile = 'y';

    /**
     * @var string
     *
     * @ORM\Column(name="publish_contact", type="string", length=1, nullable=false, options={"default" = "n"})
     */
    private $publishContact = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="notify_traffic_listing", type="string", length=1, nullable=true, options={"default" = "n"})
     */
    private $notifyTrafficListing;

    /**
     * @var string
     *
     * @ORM\Column(name="complementary_info", type="string", length=255, nullable=true)
     */
    private $complementaryInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=1, nullable=false, options={"default" = "n"})
     */
    private $active = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="newsletter", type="string", length=1, nullable=false, options={"default" = "n"})
     */
    private $newsletter = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="stripe_id", type="string", nullable=true)
     */
    private $stripeId;

    /**
     * @var string
     */
    private $salt;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\CoreBundle\Entity\Contact")
     * @ORM\JoinColumn(name="id", referencedColumnName="account_id")
     */
    private $contact;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\CoreBundle\Entity\Profile")
     * @ORM\JoinColumn(name="id", referencedColumnName="account_id")
     */
    private $profile;

    /**
     * Gets triggered on update and insert
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updatedTimestamps()
    {
        $this->updated = new \DateTime("now");

        if ($this->getEntered() == null) {
            $this->entered = new \DateTime("now");
        }
    }

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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Account
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set entered
     *
     * @param \DateTime $entered
     * @return Account
     */
    public function setEntered($entered)
    {
        $this->entered = $entered;

        return $this;
    }

    /**
     * Get entered
     *
     * @return \DateTime
     */
    public function getEntered()
    {
        return $this->entered;
    }

    /**
     * Set lastlogin
     *
     * @param \DateTime $lastlogin
     * @return Account
     */
    public function setLastlogin($lastlogin)
    {
        $this->lastlogin = $lastlogin;

        return $this;
    }

    /**
     * Get lastlogin
     *
     * @return \DateTime
     */
    public function getLastlogin()
    {
        return $this->lastlogin;
    }

    /**
     * Set facebookUsername
     *
     * @param string $facebookUsername
     * @return Account
     */
    public function setFacebookUsername($facebookUsername)
    {
        $this->facebookUsername = $facebookUsername;

        return $this;
    }

    /**
     * Get facebookUsername
     *
     * @return string
     */
    public function getFacebookUsername()
    {
        return $this->facebookUsername;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Account
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
     * Set password
     *
     * @param string $password
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set foreignaccount
     *
     * @param string $foreignaccount
     * @return Account
     */
    public function setForeignaccount($foreignaccount)
    {
        $this->foreignaccount = $foreignaccount;

        return $this;
    }

    /**
     * Get foreignaccount
     *
     * @return string
     */
    public function getForeignaccount()
    {
        return $this->foreignaccount;
    }

    /**
     * Set failloginCount
     *
     * @param integer $failloginCount
     * @return Account
     */
    public function setFailloginCount($failloginCount)
    {
        $this->failloginCount = $failloginCount;

        return $this;
    }

    /**
     * Get failloginCount
     *
     * @return integer
     */
    public function getFailloginCount()
    {
        return $this->failloginCount;
    }

    /**
     * Set failloginDatetime
     *
     * @param \DateTime $failloginDatetime
     * @return Account
     */
    public function setFailloginDatetime($failloginDatetime)
    {
        $this->failloginDatetime = $failloginDatetime;

        return $this;
    }

    /**
     * Get failloginDatetime
     *
     * @return \DateTime
     */
    public function getFailloginDatetime()
    {
        return $this->failloginDatetime;
    }

    /**
     * Set importid
     *
     * @param integer $importid
     * @return Account
     */
    public function setImportid($importid)
    {
        $this->importid = $importid;

        return $this;
    }

    /**
     * Get importid
     *
     * @return integer
     */
    public function getImportid()
    {
        return $this->importid;
    }

    /**
     * Set domainImportid
     *
     * @param integer $domainImportid
     * @return Account
     */
    public function setDomainImportid($domainImportid)
    {
        $this->domainImportid = $domainImportid;

        return $this;
    }

    /**
     * Get domainImportid
     *
     * @return integer
     */
    public function getDomainImportid()
    {
        return $this->domainImportid;
    }

    /**
     * Set importidEvent
     *
     * @param integer $importidEvent
     * @return Account
     */
    public function setImportidEvent($importidEvent)
    {
        $this->importidEvent = $importidEvent;

        return $this;
    }

    /**
     * Get importidEvent
     *
     * @return integer
     */
    public function getImportidEvent()
    {
        return $this->importidEvent;
    }

    /**
     * Set domainImportidEvent
     *
     * @param integer $domainImportidEvent
     * @return Account
     */
    public function setDomainImportidEvent($domainImportidEvent)
    {
        $this->domainImportidEvent = $domainImportidEvent;

        return $this;
    }

    /**
     * Get domainImportidEvent
     *
     * @return integer
     */
    public function getDomainImportidEvent()
    {
        return $this->domainImportidEvent;
    }

    /**
     * Set isSponsor
     *
     * @param string $isSponsor
     * @return Account
     */
    public function setIsSponsor($isSponsor)
    {
        $this->isSponsor = $isSponsor;

        return $this;
    }

    /**
     * Get isSponsor
     *
     * @return string
     */
    public function getIsSponsor()
    {
        return $this->isSponsor;
    }

    /**
     * Set hasProfile
     *
     * @param string $hasProfile
     * @return Account
     */
    public function setHasProfile($hasProfile)
    {
        $this->hasProfile = $hasProfile;

        return $this;
    }

    /**
     * Get hasProfile
     *
     * @return string
     */
    public function getHasProfile()
    {
        return $this->hasProfile;
    }

    /**
     * Set publishContact
     *
     * @param string $publishContact
     * @return Account
     */
    public function setPublishContact($publishContact)
    {
        $this->publishContact = $publishContact;

        return $this;
    }

    /**
     * Get publishContact
     *
     * @return string
     */
    public function getPublishContact()
    {
        return $this->publishContact;
    }

    /**
     * Set notifyTrafficListing
     *
     * @param string $notifyTrafficListing
     * @return Account
     */
    public function setNotifyTrafficListing($notifyTrafficListing)
    {
        $this->notifyTrafficListing = $notifyTrafficListing;

        return $this;
    }

    /**
     * Get notifyTrafficListing
     *
     * @return string
     */
    public function getNotifyTrafficListing()
    {
        return $this->notifyTrafficListing;
    }

    /**
     * Set complementaryInfo
     *
     * @param string $complementaryInfo
     * @return Account
     */
    public function setComplementaryInfo($complementaryInfo)
    {
        $this->complementaryInfo = $complementaryInfo;

        return $this;
    }

    /**
     * Get complementaryInfo
     *
     * @return string
     */
    public function getComplementaryInfo()
    {
        return $this->complementaryInfo;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return Account
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set newsletter
     *
     * @param string $newsletter
     * @return Account
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return string
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set stripeId
     *
     * @param string $stripeId
     * @return Account
     */
    public function stripeId($stripeId)
    {
        $this->stripeId = $stripeId;

        return $this;
    }

    /**
     * Get stripeId
     *
     * @return string
     */
    public function getstripeId()
    {
        return $this->stripeId;
    }

    /**
     * @inheritdoc
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /**
     * @inheritdoc
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
        ) = unserialize($serialized);
    }

    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritdoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set contact
     *
     * @param Contact $contact
     * @return Account
     */
    public function setContact(Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Set profile
     *
     * @param Profile $profile
     * @return Account
     */
    public function setProfile(Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }
}
