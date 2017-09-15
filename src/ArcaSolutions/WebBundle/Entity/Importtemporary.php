<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Importtemporary
 *
 * @ORM\Table(name="ImportTemporary")
 * @ORM\Entity
 */
class Importtemporary
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="import_log_id", type="integer", nullable=false)
     */
    private $importLogId;

    /**
     * @var string
     *
     * @ORM\Column(name="account_username", type="string", length=255, nullable=true)
     */
    private $accountUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="account_password", type="string", length=255, nullable=true)
     */
    private $accountPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="account_first_name", type="string", length=255, nullable=true)
     */
    private $accountFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="account_last_name", type="string", length=255, nullable=true)
     */
    private $accountLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="account_company", type="string", length=255, nullable=true)
     */
    private $accountCompany;

    /**
     * @var string
     *
     * @ORM\Column(name="account_address", type="string", length=255, nullable=true)
     */
    private $accountAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="account_address2", type="string", length=255, nullable=true)
     */
    private $accountAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="account_country", type="string", length=255, nullable=true)
     */
    private $accountCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="account_state", type="string", length=255, nullable=true)
     */
    private $accountState;

    /**
     * @var string
     *
     * @ORM\Column(name="account_city", type="string", length=255, nullable=true)
     */
    private $accountCity;

    /**
     * @var string
     *
     * @ORM\Column(name="account_zip", type="string", length=255, nullable=true)
     */
    private $accountZip;

    /**
     * @var string
     *
     * @ORM\Column(name="account_phone", type="string", length=255, nullable=true)
     */
    private $accountPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="account_fax", type="string", length=255, nullable=true)
     */
    private $accountFax;

    /**
     * @var string
     *
     * @ORM\Column(name="account_email", type="string", length=255, nullable=true)
     */
    private $accountEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="account_url", type="string", length=255, nullable=true)
     */
    private $accountUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="listing_id", type="integer", nullable=true)
     */
    private $listingId;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_title", type="string", length=255, nullable=true)
     */
    private $listingTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_seo_title", type="string", length=255, nullable=true)
     */
    private $listingSeoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_email", type="string", length=255, nullable=true)
     */
    private $listingEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_url", type="string", length=255, nullable=true)
     */
    private $listingUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_address", type="string", length=255, nullable=true)
     */
    private $listingAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_address2", type="string", length=255, nullable=true)
     */
    private $listingAddress2;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_location1", type="string", length=255, nullable=true)
     */
    private $listingLocation1;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_location1_abbreviation", type="string", length=5, nullable=true)
     */
    private $listingLocation1Abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_location2", type="string", length=255, nullable=true)
     */
    private $listingLocation2;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_location2_abbreviation", type="string", length=5, nullable=true)
     */
    private $listingLocation2Abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_location3", type="string", length=255, nullable=true)
     */
    private $listingLocation3;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_location3_abbreviation", type="string", length=5, nullable=true)
     */
    private $listingLocation3Abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_location4", type="string", length=255, nullable=true)
     */
    private $listingLocation4;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_location4_abbreviation", type="string", length=5, nullable=true)
     */
    private $listingLocation4Abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_location5", type="string", length=255, nullable=true)
     */
    private $listingLocation5;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_location5_abbreviation", type="string", length=5, nullable=true)
     */
    private $listingLocation5Abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_zip", type="string", length=255, nullable=true)
     */
    private $listingZip;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_latitude", type="string", length=50, nullable=true)
     */
    private $listingLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_longitude", type="string", length=50, nullable=true)
     */
    private $listingLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_phone", type="string", length=255, nullable=true)
     */
    private $listingPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_fax", type="string", length=255, nullable=true)
     */
    private $listingFax;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_description", type="text", nullable=true)
     */
    private $listingDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_long_description", type="text", nullable=true)
     */
    private $listingLongDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_seo_description", type="string", length=255, nullable=true)
     */
    private $listingSeoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_keyword", type="string", length=255, nullable=true)
     */
    private $listingKeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_renewal_date", type="string", length=255, nullable=true)
     */
    private $listingRenewalDate;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_status", type="string", length=255, nullable=true)
     */
    private $listingStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_level", type="string", length=255, nullable=true)
     */
    private $listingLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_category_1", type="text", nullable=true)
     */
    private $listingCategory1;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_category_2", type="text", nullable=true)
     */
    private $listingCategory2;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_category_3", type="text", nullable=true)
     */
    private $listingCategory3;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_category_4", type="text", nullable=true)
     */
    private $listingCategory4;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_category_5", type="text", nullable=true)
     */
    private $listingCategory5;

    /**
     * @var string
     *
     * @ORM\Column(name="listing_template", type="string", length=255, nullable=true)
     */
    private $listingTemplate;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_id", type="string", length=255, nullable=true)
     */
    private $customId;

    /**
     * @var integer
     *
     * @ORM\Column(name="file_line_number", type="integer", nullable=false)
     */
    private $fileLineNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="inserted", type="string", length=1, nullable=false, options={"default"="n"})
     */
    private $inserted;

    /**
     * @var string
     *
     * @ORM\Column(name="error", type="string", length=1, nullable=false, options={"default"="n"})
     */
    private $error;



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
     * Set importLogId
     *
     * @param integer $importLogId
     * @return Importtemporary
     */
    public function setImportLogId($importLogId)
    {
        $this->importLogId = $importLogId;

        return $this;
    }

    /**
     * Get importLogId
     *
     * @return integer
     */
    public function getImportLogId()
    {
        return $this->importLogId;
    }

    /**
     * Set accountUsername
     *
     * @param string $accountUsername
     * @return Importtemporary
     */
    public function setAccountUsername($accountUsername)
    {
        $this->accountUsername = $accountUsername;

        return $this;
    }

    /**
     * Get accountUsername
     *
     * @return string
     */
    public function getAccountUsername()
    {
        return $this->accountUsername;
    }

    /**
     * Set accountPassword
     *
     * @param string $accountPassword
     * @return Importtemporary
     */
    public function setAccountPassword($accountPassword)
    {
        $this->accountPassword = $accountPassword;

        return $this;
    }

    /**
     * Get accountPassword
     *
     * @return string
     */
    public function getAccountPassword()
    {
        return $this->accountPassword;
    }

    /**
     * Set accountFirstName
     *
     * @param string $accountFirstName
     * @return Importtemporary
     */
    public function setAccountFirstName($accountFirstName)
    {
        $this->accountFirstName = $accountFirstName;

        return $this;
    }

    /**
     * Get accountFirstName
     *
     * @return string
     */
    public function getAccountFirstName()
    {
        return $this->accountFirstName;
    }

    /**
     * Set accountLastName
     *
     * @param string $accountLastName
     * @return Importtemporary
     */
    public function setAccountLastName($accountLastName)
    {
        $this->accountLastName = $accountLastName;

        return $this;
    }

    /**
     * Get accountLastName
     *
     * @return string
     */
    public function getAccountLastName()
    {
        return $this->accountLastName;
    }

    /**
     * Set accountCompany
     *
     * @param string $accountCompany
     * @return Importtemporary
     */
    public function setAccountCompany($accountCompany)
    {
        $this->accountCompany = $accountCompany;

        return $this;
    }

    /**
     * Get accountCompany
     *
     * @return string
     */
    public function getAccountCompany()
    {
        return $this->accountCompany;
    }

    /**
     * Set accountAddress
     *
     * @param string $accountAddress
     * @return Importtemporary
     */
    public function setAccountAddress($accountAddress)
    {
        $this->accountAddress = $accountAddress;

        return $this;
    }

    /**
     * Get accountAddress
     *
     * @return string
     */
    public function getAccountAddress()
    {
        return $this->accountAddress;
    }

    /**
     * Set accountAddress2
     *
     * @param string $accountAddress2
     * @return Importtemporary
     */
    public function setAccountAddress2($accountAddress2)
    {
        $this->accountAddress2 = $accountAddress2;

        return $this;
    }

    /**
     * Get accountAddress2
     *
     * @return string
     */
    public function getAccountAddress2()
    {
        return $this->accountAddress2;
    }

    /**
     * Set accountCountry
     *
     * @param string $accountCountry
     * @return Importtemporary
     */
    public function setAccountCountry($accountCountry)
    {
        $this->accountCountry = $accountCountry;

        return $this;
    }

    /**
     * Get accountCountry
     *
     * @return string
     */
    public function getAccountCountry()
    {
        return $this->accountCountry;
    }

    /**
     * Set accountState
     *
     * @param string $accountState
     * @return Importtemporary
     */
    public function setAccountState($accountState)
    {
        $this->accountState = $accountState;

        return $this;
    }

    /**
     * Get accountState
     *
     * @return string
     */
    public function getAccountState()
    {
        return $this->accountState;
    }

    /**
     * Set accountCity
     *
     * @param string $accountCity
     * @return Importtemporary
     */
    public function setAccountCity($accountCity)
    {
        $this->accountCity = $accountCity;

        return $this;
    }

    /**
     * Get accountCity
     *
     * @return string
     */
    public function getAccountCity()
    {
        return $this->accountCity;
    }

    /**
     * Set accountZip
     *
     * @param string $accountZip
     * @return Importtemporary
     */
    public function setAccountZip($accountZip)
    {
        $this->accountZip = $accountZip;

        return $this;
    }

    /**
     * Get accountZip
     *
     * @return string
     */
    public function getAccountZip()
    {
        return $this->accountZip;
    }

    /**
     * Set accountPhone
     *
     * @param string $accountPhone
     * @return Importtemporary
     */
    public function setAccountPhone($accountPhone)
    {
        $this->accountPhone = $accountPhone;

        return $this;
    }

    /**
     * Get accountPhone
     *
     * @return string
     */
    public function getAccountPhone()
    {
        return $this->accountPhone;
    }

    /**
     * Set accountFax
     *
     * @param string $accountFax
     * @return Importtemporary
     */
    public function setAccountFax($accountFax)
    {
        $this->accountFax = $accountFax;

        return $this;
    }

    /**
     * Get accountFax
     *
     * @return string
     */
    public function getAccountFax()
    {
        return $this->accountFax;
    }

    /**
     * Set accountEmail
     *
     * @param string $accountEmail
     * @return Importtemporary
     */
    public function setAccountEmail($accountEmail)
    {
        $this->accountEmail = $accountEmail;

        return $this;
    }

    /**
     * Get accountEmail
     *
     * @return string
     */
    public function getAccountEmail()
    {
        return $this->accountEmail;
    }

    /**
     * Set accountUrl
     *
     * @param string $accountUrl
     * @return Importtemporary
     */
    public function setAccountUrl($accountUrl)
    {
        $this->accountUrl = $accountUrl;

        return $this;
    }

    /**
     * Get accountUrl
     *
     * @return string
     */
    public function getAccountUrl()
    {
        return $this->accountUrl;
    }

    /**
     * Set listingId
     *
     * @param integer $listingId
     * @return Importtemporary
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
     * @return Importtemporary
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
     * Set listingSeoTitle
     *
     * @param string $listingSeoTitle
     * @return Importtemporary
     */
    public function setListingSeoTitle($listingSeoTitle)
    {
        $this->listingSeoTitle = $listingSeoTitle;

        return $this;
    }

    /**
     * Get listingSeoTitle
     *
     * @return string
     */
    public function getListingSeoTitle()
    {
        return $this->listingSeoTitle;
    }

    /**
     * Set listingEmail
     *
     * @param string $listingEmail
     * @return Importtemporary
     */
    public function setListingEmail($listingEmail)
    {
        $this->listingEmail = $listingEmail;

        return $this;
    }

    /**
     * Get listingEmail
     *
     * @return string
     */
    public function getListingEmail()
    {
        return $this->listingEmail;
    }

    /**
     * Set listingUrl
     *
     * @param string $listingUrl
     * @return Importtemporary
     */
    public function setListingUrl($listingUrl)
    {
        $this->listingUrl = $listingUrl;

        return $this;
    }

    /**
     * Get listingUrl
     *
     * @return string
     */
    public function getListingUrl()
    {
        return $this->listingUrl;
    }

    /**
     * Set listingAddress
     *
     * @param string $listingAddress
     * @return Importtemporary
     */
    public function setListingAddress($listingAddress)
    {
        $this->listingAddress = $listingAddress;

        return $this;
    }

    /**
     * Get listingAddress
     *
     * @return string
     */
    public function getListingAddress()
    {
        return $this->listingAddress;
    }

    /**
     * Set listingAddress2
     *
     * @param string $listingAddress2
     * @return Importtemporary
     */
    public function setListingAddress2($listingAddress2)
    {
        $this->listingAddress2 = $listingAddress2;

        return $this;
    }

    /**
     * Get listingAddress2
     *
     * @return string
     */
    public function getListingAddress2()
    {
        return $this->listingAddress2;
    }

    /**
     * Set listingLocation1
     *
     * @param string $listingLocation1
     * @return Importtemporary
     */
    public function setListingLocation1($listingLocation1)
    {
        $this->listingLocation1 = $listingLocation1;

        return $this;
    }

    /**
     * Get listingLocation1
     *
     * @return string
     */
    public function getListingLocation1()
    {
        return $this->listingLocation1;
    }

    /**
     * Set listingLocation1Abbreviation
     *
     * @param string $listingLocation1Abbreviation
     * @return Importtemporary
     */
    public function setListingLocation1Abbreviation($listingLocation1Abbreviation)
    {
        $this->listingLocation1Abbreviation = $listingLocation1Abbreviation;

        return $this;
    }

    /**
     * Get listingLocation1Abbreviation
     *
     * @return string
     */
    public function getListingLocation1Abbreviation()
    {
        return $this->listingLocation1Abbreviation;
    }

    /**
     * Set listingLocation2
     *
     * @param string $listingLocation2
     * @return Importtemporary
     */
    public function setListingLocation2($listingLocation2)
    {
        $this->listingLocation2 = $listingLocation2;

        return $this;
    }

    /**
     * Get listingLocation2
     *
     * @return string
     */
    public function getListingLocation2()
    {
        return $this->listingLocation2;
    }

    /**
     * Set listingLocation2Abbreviation
     *
     * @param string $listingLocation2Abbreviation
     * @return Importtemporary
     */
    public function setListingLocation2Abbreviation($listingLocation2Abbreviation)
    {
        $this->listingLocation2Abbreviation = $listingLocation2Abbreviation;

        return $this;
    }

    /**
     * Get listingLocation2Abbreviation
     *
     * @return string
     */
    public function getListingLocation2Abbreviation()
    {
        return $this->listingLocation2Abbreviation;
    }

    /**
     * Set listingLocation3
     *
     * @param string $listingLocation3
     * @return Importtemporary
     */
    public function setListingLocation3($listingLocation3)
    {
        $this->listingLocation3 = $listingLocation3;

        return $this;
    }

    /**
     * Get listingLocation3
     *
     * @return string
     */
    public function getListingLocation3()
    {
        return $this->listingLocation3;
    }

    /**
     * Set listingLocation3Abbreviation
     *
     * @param string $listingLocation3Abbreviation
     * @return Importtemporary
     */
    public function setListingLocation3Abbreviation($listingLocation3Abbreviation)
    {
        $this->listingLocation3Abbreviation = $listingLocation3Abbreviation;

        return $this;
    }

    /**
     * Get listingLocation3Abbreviation
     *
     * @return string
     */
    public function getListingLocation3Abbreviation()
    {
        return $this->listingLocation3Abbreviation;
    }

    /**
     * Set listingLocation4
     *
     * @param string $listingLocation4
     * @return Importtemporary
     */
    public function setListingLocation4($listingLocation4)
    {
        $this->listingLocation4 = $listingLocation4;

        return $this;
    }

    /**
     * Get listingLocation4
     *
     * @return string
     */
    public function getListingLocation4()
    {
        return $this->listingLocation4;
    }

    /**
     * Set listingLocation4Abbreviation
     *
     * @param string $listingLocation4Abbreviation
     * @return Importtemporary
     */
    public function setListingLocation4Abbreviation($listingLocation4Abbreviation)
    {
        $this->listingLocation4Abbreviation = $listingLocation4Abbreviation;

        return $this;
    }

    /**
     * Get listingLocation4Abbreviation
     *
     * @return string
     */
    public function getListingLocation4Abbreviation()
    {
        return $this->listingLocation4Abbreviation;
    }

    /**
     * Set listingLocation5
     *
     * @param string $listingLocation5
     * @return Importtemporary
     */
    public function setListingLocation5($listingLocation5)
    {
        $this->listingLocation5 = $listingLocation5;

        return $this;
    }

    /**
     * Get listingLocation5
     *
     * @return string
     */
    public function getListingLocation5()
    {
        return $this->listingLocation5;
    }

    /**
     * Set listingLocation5Abbreviation
     *
     * @param string $listingLocation5Abbreviation
     * @return Importtemporary
     */
    public function setListingLocation5Abbreviation($listingLocation5Abbreviation)
    {
        $this->listingLocation5Abbreviation = $listingLocation5Abbreviation;

        return $this;
    }

    /**
     * Get listingLocation5Abbreviation
     *
     * @return string
     */
    public function getListingLocation5Abbreviation()
    {
        return $this->listingLocation5Abbreviation;
    }

    /**
     * Set listingZip
     *
     * @param string $listingZip
     * @return Importtemporary
     */
    public function setListingZip($listingZip)
    {
        $this->listingZip = $listingZip;

        return $this;
    }

    /**
     * Get listingZip
     *
     * @return string
     */
    public function getListingZip()
    {
        return $this->listingZip;
    }

    /**
     * Set listingLatitude
     *
     * @param string $listingLatitude
     * @return Importtemporary
     */
    public function setListingLatitude($listingLatitude)
    {
        $this->listingLatitude = $listingLatitude;

        return $this;
    }

    /**
     * Get listingLatitude
     *
     * @return string
     */
    public function getListingLatitude()
    {
        return $this->listingLatitude;
    }

    /**
     * Set listingLongitude
     *
     * @param string $listingLongitude
     * @return Importtemporary
     */
    public function setListingLongitude($listingLongitude)
    {
        $this->listingLongitude = $listingLongitude;

        return $this;
    }

    /**
     * Get listingLongitude
     *
     * @return string
     */
    public function getListingLongitude()
    {
        return $this->listingLongitude;
    }

    /**
     * Set listingPhone
     *
     * @param string $listingPhone
     * @return Importtemporary
     */
    public function setListingPhone($listingPhone)
    {
        $this->listingPhone = $listingPhone;

        return $this;
    }

    /**
     * Get listingPhone
     *
     * @return string
     */
    public function getListingPhone()
    {
        return $this->listingPhone;
    }

    /**
     * Set listingFax
     *
     * @param string $listingFax
     * @return Importtemporary
     */
    public function setListingFax($listingFax)
    {
        $this->listingFax = $listingFax;

        return $this;
    }

    /**
     * Get listingFax
     *
     * @return string
     */
    public function getListingFax()
    {
        return $this->listingFax;
    }

    /**
     * Set listingDescription
     *
     * @param string $listingDescription
     * @return Importtemporary
     */
    public function setListingDescription($listingDescription)
    {
        $this->listingDescription = $listingDescription;

        return $this;
    }

    /**
     * Get listingDescription
     *
     * @return string
     */
    public function getListingDescription()
    {
        return $this->listingDescription;
    }

    /**
     * Set listingLongDescription
     *
     * @param string $listingLongDescription
     * @return Importtemporary
     */
    public function setListingLongDescription($listingLongDescription)
    {
        $this->listingLongDescription = $listingLongDescription;

        return $this;
    }

    /**
     * Get listingLongDescription
     *
     * @return string
     */
    public function getListingLongDescription()
    {
        return $this->listingLongDescription;
    }

    /**
     * Set listingSeoDescription
     *
     * @param string $listingSeoDescription
     * @return Importtemporary
     */
    public function setListingSeoDescription($listingSeoDescription)
    {
        $this->listingSeoDescription = $listingSeoDescription;

        return $this;
    }

    /**
     * Get listingSeoDescription
     *
     * @return string
     */
    public function getListingSeoDescription()
    {
        return $this->listingSeoDescription;
    }

    /**
     * Set listingKeyword
     *
     * @param string $listingKeyword
     * @return Importtemporary
     */
    public function setListingKeyword($listingKeyword)
    {
        $this->listingKeyword = $listingKeyword;

        return $this;
    }

    /**
     * Get listingKeyword
     *
     * @return string
     */
    public function getListingKeyword()
    {
        return $this->listingKeyword;
    }

    /**
     * Set listingRenewalDate
     *
     * @param string $listingRenewalDate
     * @return Importtemporary
     */
    public function setListingRenewalDate($listingRenewalDate)
    {
        $this->listingRenewalDate = $listingRenewalDate;

        return $this;
    }

    /**
     * Get listingRenewalDate
     *
     * @return string
     */
    public function getListingRenewalDate()
    {
        return $this->listingRenewalDate;
    }

    /**
     * Set listingStatus
     *
     * @param string $listingStatus
     * @return Importtemporary
     */
    public function setListingStatus($listingStatus)
    {
        $this->listingStatus = $listingStatus;

        return $this;
    }

    /**
     * Get listingStatus
     *
     * @return string
     */
    public function getListingStatus()
    {
        return $this->listingStatus;
    }

    /**
     * Set listingLevel
     *
     * @param string $listingLevel
     * @return Importtemporary
     */
    public function setListingLevel($listingLevel)
    {
        $this->listingLevel = $listingLevel;

        return $this;
    }

    /**
     * Get listingLevel
     *
     * @return string
     */
    public function getListingLevel()
    {
        return $this->listingLevel;
    }

    /**
     * Set listingCategory1
     *
     * @param string $listingCategory1
     * @return Importtemporary
     */
    public function setListingCategory1($listingCategory1)
    {
        $this->listingCategory1 = $listingCategory1;

        return $this;
    }

    /**
     * Get listingCategory1
     *
     * @return string
     */
    public function getListingCategory1()
    {
        return $this->listingCategory1;
    }

    /**
     * Set listingCategory2
     *
     * @param string $listingCategory2
     * @return Importtemporary
     */
    public function setListingCategory2($listingCategory2)
    {
        $this->listingCategory2 = $listingCategory2;

        return $this;
    }

    /**
     * Get listingCategory2
     *
     * @return string
     */
    public function getListingCategory2()
    {
        return $this->listingCategory2;
    }

    /**
     * Set listingCategory3
     *
     * @param string $listingCategory3
     * @return Importtemporary
     */
    public function setListingCategory3($listingCategory3)
    {
        $this->listingCategory3 = $listingCategory3;

        return $this;
    }

    /**
     * Get listingCategory3
     *
     * @return string
     */
    public function getListingCategory3()
    {
        return $this->listingCategory3;
    }

    /**
     * Set listingCategory4
     *
     * @param string $listingCategory4
     * @return Importtemporary
     */
    public function setListingCategory4($listingCategory4)
    {
        $this->listingCategory4 = $listingCategory4;

        return $this;
    }

    /**
     * Get listingCategory4
     *
     * @return string
     */
    public function getListingCategory4()
    {
        return $this->listingCategory4;
    }

    /**
     * Set listingCategory5
     *
     * @param string $listingCategory5
     * @return Importtemporary
     */
    public function setListingCategory5($listingCategory5)
    {
        $this->listingCategory5 = $listingCategory5;

        return $this;
    }

    /**
     * Get listingCategory5
     *
     * @return string
     */
    public function getListingCategory5()
    {
        return $this->listingCategory5;
    }

    /**
     * Set listingTemplate
     *
     * @param string $listingTemplate
     * @return Importtemporary
     */
    public function setListingTemplate($listingTemplate)
    {
        $this->listingTemplate = $listingTemplate;

        return $this;
    }

    /**
     * Get listingTemplate
     *
     * @return string
     */
    public function getListingTemplate()
    {
        return $this->listingTemplate;
    }

    /**
     * Set customId
     *
     * @param string $customId
     * @return Importtemporary
     */
    public function setCustomId($customId)
    {
        $this->customId = $customId;

        return $this;
    }

    /**
     * Get customId
     *
     * @return string
     */
    public function getCustomId()
    {
        return $this->customId;
    }

    /**
     * Set fileLineNumber
     *
     * @param integer $fileLineNumber
     * @return Importtemporary
     */
    public function setFileLineNumber($fileLineNumber)
    {
        $this->fileLineNumber = $fileLineNumber;

        return $this;
    }

    /**
     * Get fileLineNumber
     *
     * @return integer
     */
    public function getFileLineNumber()
    {
        return $this->fileLineNumber;
    }

    /**
     * Set inserted
     *
     * @param string $inserted
     * @return Importtemporary
     */
    public function setInserted($inserted)
    {
        $this->inserted = $inserted;

        return $this;
    }

    /**
     * Get inserted
     *
     * @return string
     */
    public function getInserted()
    {
        return $this->inserted;
    }

    /**
     * Set error
     *
     * @param string $error
     * @return Importtemporary
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Get error
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }
}
