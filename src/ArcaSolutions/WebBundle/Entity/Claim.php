<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Claim
 *
 * @ORM\Table(name="Claim")
 * @ORM\Entity
 */
class Claim
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
     * @var integer
     *
     * @ORM\Column(name="listing_id", type="integer", nullable=false)
     */
    private $listingId;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_title", type="string", length=255, nullable=false)
     */
    private $listingTitle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_time", type="datetime", nullable=false)
     */
    private $dateTime;

    /**
     * @var string
     *
     * @ORM\Column(name="step", type="string", length=1, nullable=false)
     */
    private $step;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="old_location_1", type="integer", nullable=false)
     */
    private $oldLocation1;

    /**
     * @var integer
     *
     * @ORM\Column(name="new_location_1", type="integer", nullable=false)
     */
    private $newLocation1;

    /**
     * @var integer
     *
     * @ORM\Column(name="old_location_2", type="integer", nullable=false)
     */
    private $oldLocation2;

    /**
     * @var integer
     *
     * @ORM\Column(name="new_location_2", type="integer", nullable=false)
     */
    private $newLocation2;

    /**
     * @var integer
     *
     * @ORM\Column(name="old_location_3", type="integer", nullable=false)
     */
    private $oldLocation3;

    /**
     * @var integer
     *
     * @ORM\Column(name="new_location_3", type="integer", nullable=false)
     */
    private $newLocation3;

    /**
     * @var integer
     *
     * @ORM\Column(name="old_location_4", type="integer", nullable=false)
     */
    private $oldLocation4;

    /**
     * @var integer
     *
     * @ORM\Column(name="new_location_4", type="integer", nullable=false)
     */
    private $newLocation4;

    /**
     * @var integer
     *
     * @ORM\Column(name="old_location_5", type="integer", nullable=false)
     */
    private $oldLocation5;

    /**
     * @var integer
     *
     * @ORM\Column(name="new_location_5", type="integer", nullable=false)
     */
    private $newLocation5;

    /**
     * @var string
     *
     * @ORM\Column(name="old_title", type="string", length=255, nullable=false)
     */
    private $oldTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="new_title", type="string", length=255, nullable=false)
     */
    private $newTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="old_friendly_url", type="string", length=255, nullable=false)
     */
    private $oldFriendlyUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="new_friendly_url", type="string", length=255, nullable=false)
     */
    private $newFriendlyUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="old_email", type="string", length=255, nullable=false)
     */
    private $oldEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="new_email", type="string", length=255, nullable=false)
     */
    private $newEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="old_url", type="string", length=255, nullable=false)
     */
    private $oldUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="new_url", type="string", length=255, nullable=false)
     */
    private $newUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="old_phone", type="string", length=255, nullable=false)
     */
    private $oldPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="new_phone", type="string", length=255, nullable=false)
     */
    private $newPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="old_fax", type="string", length=255, nullable=false)
     */
    private $oldFax;

    /**
     * @var string
     *
     * @ORM\Column(name="new_fax", type="string", length=255, nullable=false)
     */
    private $newFax;

    /**
     * @var string
     *
     * @ORM\Column(name="old_address", type="string", length=255, nullable=false)
     */
    private $oldAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="new_address", type="string", length=255, nullable=false)
     */
    private $newAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="old_address2", type="string", length=255, nullable=false)
     */
    private $oldAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="new_address2", type="string", length=255, nullable=false)
     */
    private $newAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="old_zip_code", type="string", length=10, nullable=false)
     */
    private $oldZipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="new_zip_code", type="string", length=10, nullable=false)
     */
    private $newZipCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="old_level", type="integer", nullable=false)
     */
    private $oldLevel;

    /**
     * @var integer
     *
     * @ORM\Column(name="new_level", type="integer", nullable=false)
     */
    private $newLevel;

    /**
     * @var integer
     *
     * @ORM\Column(name="old_listingtemplate_id", type="integer", nullable=false)
     */
    private $oldListingtemplateId;

    /**
     * @var integer
     *
     * @ORM\Column(name="new_listingtemplate_id", type="integer", nullable=false)
     */
    private $newListingtemplateId;



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
     * @return Claim
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
     * @return Claim
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
     * Set listingId
     *
     * @param integer $listingId
     * @return Claim
     */
    public function setListingId($listingId)
    {
        $this->listingId = $listingId;

        return $this;
    }

    /**
     * Get listingId
     *
     * @return integer
     */
    public function getListingId()
    {
        return $this->listingId;
    }

    /**
     * Set listingTitle
     *
     * @param string $listingTitle
     * @return Claim
     */
    public function setListingTitle($listingTitle)
    {
        $this->listingTitle = $listingTitle;

        return $this;
    }

    /**
     * Get listingTitle
     *
     * @return string
     */
    public function getListingTitle()
    {
        return $this->listingTitle;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     * @return Claim
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set step
     *
     * @param string $step
     * @return Claim
     */
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return string
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Claim
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set oldLocation1
     *
     * @param integer $oldLocation1
     * @return Claim
     */
    public function setOldLocation1($oldLocation1)
    {
        $this->oldLocation1 = $oldLocation1;

        return $this;
    }

    /**
     * Get oldLocation1
     *
     * @return integer
     */
    public function getOldLocation1()
    {
        return $this->oldLocation1;
    }

    /**
     * Set newLocation1
     *
     * @param integer $newLocation1
     * @return Claim
     */
    public function setNewLocation1($newLocation1)
    {
        $this->newLocation1 = $newLocation1;

        return $this;
    }

    /**
     * Get newLocation1
     *
     * @return integer
     */
    public function getNewLocation1()
    {
        return $this->newLocation1;
    }

    /**
     * Set oldLocation2
     *
     * @param integer $oldLocation2
     * @return Claim
     */
    public function setOldLocation2($oldLocation2)
    {
        $this->oldLocation2 = $oldLocation2;

        return $this;
    }

    /**
     * Get oldLocation2
     *
     * @return integer
     */
    public function getOldLocation2()
    {
        return $this->oldLocation2;
    }

    /**
     * Set newLocation2
     *
     * @param integer $newLocation2
     * @return Claim
     */
    public function setNewLocation2($newLocation2)
    {
        $this->newLocation2 = $newLocation2;

        return $this;
    }

    /**
     * Get newLocation2
     *
     * @return integer
     */
    public function getNewLocation2()
    {
        return $this->newLocation2;
    }

    /**
     * Set oldLocation3
     *
     * @param integer $oldLocation3
     * @return Claim
     */
    public function setOldLocation3($oldLocation3)
    {
        $this->oldLocation3 = $oldLocation3;

        return $this;
    }

    /**
     * Get oldLocation3
     *
     * @return integer
     */
    public function getOldLocation3()
    {
        return $this->oldLocation3;
    }

    /**
     * Set newLocation3
     *
     * @param integer $newLocation3
     * @return Claim
     */
    public function setNewLocation3($newLocation3)
    {
        $this->newLocation3 = $newLocation3;

        return $this;
    }

    /**
     * Get newLocation3
     *
     * @return integer
     */
    public function getNewLocation3()
    {
        return $this->newLocation3;
    }

    /**
     * Set oldLocation4
     *
     * @param integer $oldLocation4
     * @return Claim
     */
    public function setOldLocation4($oldLocation4)
    {
        $this->oldLocation4 = $oldLocation4;

        return $this;
    }

    /**
     * Get oldLocation4
     *
     * @return integer
     */
    public function getOldLocation4()
    {
        return $this->oldLocation4;
    }

    /**
     * Set newLocation4
     *
     * @param integer $newLocation4
     * @return Claim
     */
    public function setNewLocation4($newLocation4)
    {
        $this->newLocation4 = $newLocation4;

        return $this;
    }

    /**
     * Get newLocation4
     *
     * @return integer
     */
    public function getNewLocation4()
    {
        return $this->newLocation4;
    }

    /**
     * Set oldLocation5
     *
     * @param integer $oldLocation5
     * @return Claim
     */
    public function setOldLocation5($oldLocation5)
    {
        $this->oldLocation5 = $oldLocation5;

        return $this;
    }

    /**
     * Get oldLocation5
     *
     * @return integer
     */
    public function getOldLocation5()
    {
        return $this->oldLocation5;
    }

    /**
     * Set newLocation5
     *
     * @param integer $newLocation5
     * @return Claim
     */
    public function setNewLocation5($newLocation5)
    {
        $this->newLocation5 = $newLocation5;

        return $this;
    }

    /**
     * Get newLocation5
     *
     * @return integer
     */
    public function getNewLocation5()
    {
        return $this->newLocation5;
    }

    /**
     * Set oldTitle
     *
     * @param string $oldTitle
     * @return Claim
     */
    public function setOldTitle($oldTitle)
    {
        $this->oldTitle = $oldTitle;

        return $this;
    }

    /**
     * Get oldTitle
     *
     * @return string
     */
    public function getOldTitle()
    {
        return $this->oldTitle;
    }

    /**
     * Set newTitle
     *
     * @param string $newTitle
     * @return Claim
     */
    public function setNewTitle($newTitle)
    {
        $this->newTitle = $newTitle;

        return $this;
    }

    /**
     * Get newTitle
     *
     * @return string
     */
    public function getNewTitle()
    {
        return $this->newTitle;
    }

    /**
     * Set oldFriendlyUrl
     *
     * @param string $oldFriendlyUrl
     * @return Claim
     */
    public function setOldFriendlyUrl($oldFriendlyUrl)
    {
        $this->oldFriendlyUrl = $oldFriendlyUrl;

        return $this;
    }

    /**
     * Get oldFriendlyUrl
     *
     * @return string
     */
    public function getOldFriendlyUrl()
    {
        return $this->oldFriendlyUrl;
    }

    /**
     * Set newFriendlyUrl
     *
     * @param string $newFriendlyUrl
     * @return Claim
     */
    public function setNewFriendlyUrl($newFriendlyUrl)
    {
        $this->newFriendlyUrl = $newFriendlyUrl;

        return $this;
    }

    /**
     * Get newFriendlyUrl
     *
     * @return string
     */
    public function getNewFriendlyUrl()
    {
        return $this->newFriendlyUrl;
    }

    /**
     * Set oldEmail
     *
     * @param string $oldEmail
     * @return Claim
     */
    public function setOldEmail($oldEmail)
    {
        $this->oldEmail = $oldEmail;

        return $this;
    }

    /**
     * Get oldEmail
     *
     * @return string
     */
    public function getOldEmail()
    {
        return $this->oldEmail;
    }

    /**
     * Set newEmail
     *
     * @param string $newEmail
     * @return Claim
     */
    public function setNewEmail($newEmail)
    {
        $this->newEmail = $newEmail;

        return $this;
    }

    /**
     * Get newEmail
     *
     * @return string
     */
    public function getNewEmail()
    {
        return $this->newEmail;
    }

    /**
     * Set oldUrl
     *
     * @param string $oldUrl
     * @return Claim
     */
    public function setOldUrl($oldUrl)
    {
        $this->oldUrl = $oldUrl;

        return $this;
    }

    /**
     * Get oldUrl
     *
     * @return string
     */
    public function getOldUrl()
    {
        return $this->oldUrl;
    }

    /**
     * Set newUrl
     *
     * @param string $newUrl
     * @return Claim
     */
    public function setNewUrl($newUrl)
    {
        $this->newUrl = $newUrl;

        return $this;
    }

    /**
     * Get newUrl
     *
     * @return string
     */
    public function getNewUrl()
    {
        return $this->newUrl;
    }

    /**
     * Set oldPhone
     *
     * @param string $oldPhone
     * @return Claim
     */
    public function setOldPhone($oldPhone)
    {
        $this->oldPhone = $oldPhone;

        return $this;
    }

    /**
     * Get oldPhone
     *
     * @return string
     */
    public function getOldPhone()
    {
        return $this->oldPhone;
    }

    /**
     * Set newPhone
     *
     * @param string $newPhone
     * @return Claim
     */
    public function setNewPhone($newPhone)
    {
        $this->newPhone = $newPhone;

        return $this;
    }

    /**
     * Get newPhone
     *
     * @return string
     */
    public function getNewPhone()
    {
        return $this->newPhone;
    }

    /**
     * Set oldFax
     *
     * @param string $oldFax
     * @return Claim
     */
    public function setOldFax($oldFax)
    {
        $this->oldFax = $oldFax;

        return $this;
    }

    /**
     * Get oldFax
     *
     * @return string
     */
    public function getOldFax()
    {
        return $this->oldFax;
    }

    /**
     * Set newFax
     *
     * @param string $newFax
     * @return Claim
     */
    public function setNewFax($newFax)
    {
        $this->newFax = $newFax;

        return $this;
    }

    /**
     * Get newFax
     *
     * @return string
     */
    public function getNewFax()
    {
        return $this->newFax;
    }

    /**
     * Set oldAddress
     *
     * @param string $oldAddress
     * @return Claim
     */
    public function setOldAddress($oldAddress)
    {
        $this->oldAddress = $oldAddress;

        return $this;
    }

    /**
     * Get oldAddress
     *
     * @return string
     */
    public function getOldAddress()
    {
        return $this->oldAddress;
    }

    /**
     * Set newAddress
     *
     * @param string $newAddress
     * @return Claim
     */
    public function setNewAddress($newAddress)
    {
        $this->newAddress = $newAddress;

        return $this;
    }

    /**
     * Get newAddress
     *
     * @return string
     */
    public function getNewAddress()
    {
        return $this->newAddress;
    }

    /**
     * Set oldAddress2
     *
     * @param string $oldAddress2
     * @return Claim
     */
    public function setOldAddress2($oldAddress2)
    {
        $this->oldAddress2 = $oldAddress2;

        return $this;
    }

    /**
     * Get oldAddress2
     *
     * @return string
     */
    public function getOldAddress2()
    {
        return $this->oldAddress2;
    }

    /**
     * Set newAddress2
     *
     * @param string $newAddress2
     * @return Claim
     */
    public function setNewAddress2($newAddress2)
    {
        $this->newAddress2 = $newAddress2;

        return $this;
    }

    /**
     * Get newAddress2
     *
     * @return string
     */
    public function getNewAddress2()
    {
        return $this->newAddress2;
    }

    /**
     * Set oldZipCode
     *
     * @param string $oldZipCode
     * @return Claim
     */
    public function setOldZipCode($oldZipCode)
    {
        $this->oldZipCode = $oldZipCode;

        return $this;
    }

    /**
     * Get oldZipCode
     *
     * @return string
     */
    public function getOldZipCode()
    {
        return $this->oldZipCode;
    }

    /**
     * Set newZipCode
     *
     * @param string $newZipCode
     * @return Claim
     */
    public function setNewZipCode($newZipCode)
    {
        $this->newZipCode = $newZipCode;

        return $this;
    }

    /**
     * Get newZipCode
     *
     * @return string
     */
    public function getNewZipCode()
    {
        return $this->newZipCode;
    }

    /**
     * Set oldLevel
     *
     * @param integer $oldLevel
     * @return Claim
     */
    public function setOldLevel($oldLevel)
    {
        $this->oldLevel = $oldLevel;

        return $this;
    }

    /**
     * Get oldLevel
     *
     * @return integer
     */
    public function getOldLevel()
    {
        return $this->oldLevel;
    }

    /**
     * Set newLevel
     *
     * @param integer $newLevel
     * @return Claim
     */
    public function setNewLevel($newLevel)
    {
        $this->newLevel = $newLevel;

        return $this;
    }

    /**
     * Get newLevel
     *
     * @return integer
     */
    public function getNewLevel()
    {
        return $this->newLevel;
    }

    /**
     * Set oldListingtemplateId
     *
     * @param integer $oldListingtemplateId
     * @return Claim
     */
    public function setOldListingtemplateId($oldListingtemplateId)
    {
        $this->oldListingtemplateId = $oldListingtemplateId;

        return $this;
    }

    /**
     * Get oldListingtemplateId
     *
     * @return integer
     */
    public function getOldListingtemplateId()
    {
        return $this->oldListingtemplateId;
    }

    /**
     * Set newListingtemplateId
     *
     * @param integer $newListingtemplateId
     * @return Claim
     */
    public function setNewListingtemplateId($newListingtemplateId)
    {
        $this->newListingtemplateId = $newListingtemplateId;

        return $this;
    }

    /**
     * Get newListingtemplateId
     *
     * @return integer
     */
    public function getNewListingtemplateId()
    {
        return $this->newListingtemplateId;
    }
}
