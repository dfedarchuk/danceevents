<?php

namespace ArcaSolutions\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImporttemporaryEvent
 *
 * @ORM\Table(name="ImportTemporary_Event")
 * @ORM\Entity
 */
class ImporttemporaryEvent
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
    private $importLogId = '0';

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
     * @ORM\Column(name="event_id", type="integer", nullable=true)
     */
    private $eventId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="event_title", type="string", length=255, nullable=true)
     */
    private $eventTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="event_seo_title", type="string", length=255, nullable=true)
     */
    private $eventSeoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="event_email", type="string", length=255, nullable=true)
     */
    private $eventEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="event_url", type="string", length=255, nullable=true)
     */
    private $eventUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="event_address", type="string", length=255, nullable=true)
     */
    private $eventAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="event_locationname", type="string", length=255, nullable=true)
     */
    private $eventLocationname;

    /**
     * @var string
     *
     * @ORM\Column(name="event_contactname", type="string", length=255, nullable=true)
     */
    private $eventContactname;

    /**
     * @var string
     *
     * @ORM\Column(name="event_startdate", type="string", length=255, nullable=true)
     */
    private $eventStartdate;

    /**
     * @var string
     *
     * @ORM\Column(name="event_enddate", type="string", length=255, nullable=true)
     */
    private $eventEnddate;

    /**
     * @var string
     *
     * @ORM\Column(name="event_starttime", type="string", length=255, nullable=true)
     */
    private $eventStarttime;

    /**
     * @var string
     *
     * @ORM\Column(name="event_starttime_mode", type="string", length=255, nullable=true)
     */
    private $eventStarttimeMode;

    /**
     * @var string
     *
     * @ORM\Column(name="event_endtime", type="string", length=255, nullable=true)
     */
    private $eventEndtime;

    /**
     * @var string
     *
     * @ORM\Column(name="event_endtime_mode", type="string", length=255, nullable=true)
     */
    private $eventEndtimeMode;

    /**
     * @var string
     *
     * @ORM\Column(name="event_location1", type="string", length=255, nullable=true)
     */
    private $eventLocation1;

    /**
     * @var string
     *
     * @ORM\Column(name="event_location1_abbreviation", type="string", length=5, nullable=true)
     */
    private $eventLocation1Abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="event_location2", type="string", length=255, nullable=true)
     */
    private $eventLocation2;

    /**
     * @var string
     *
     * @ORM\Column(name="event_location2_abbreviation", type="string", length=5, nullable=true)
     */
    private $eventLocation2Abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="event_location3", type="string", length=255, nullable=true)
     */
    private $eventLocation3;

    /**
     * @var string
     *
     * @ORM\Column(name="event_location3_abbreviation", type="string", length=5, nullable=true)
     */
    private $eventLocation3Abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="event_location4", type="string", length=255, nullable=true)
     */
    private $eventLocation4;

    /**
     * @var string
     *
     * @ORM\Column(name="event_location4_abbreviation", type="string", length=5, nullable=true)
     */
    private $eventLocation4Abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="event_location5", type="string", length=255, nullable=true)
     */
    private $eventLocation5;

    /**
     * @var string
     *
     * @ORM\Column(name="event_location5_abbreviation", type="string", length=5, nullable=true)
     */
    private $eventLocation5Abbreviation;

    /**
     * @var string
     *
     * @ORM\Column(name="event_zip", type="string", length=255, nullable=true)
     */
    private $eventZip;

    /**
     * @var string
     *
     * @ORM\Column(name="event_latitude", type="string", length=50, nullable=true)
     */
    private $eventLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="event_longitude", type="string", length=50, nullable=true)
     */
    private $eventLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="event_phone", type="string", length=255, nullable=true)
     */
    private $eventPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="event_description", type="text", nullable=true)
     */
    private $eventDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="event_long_description", type="text", nullable=true)
     */
    private $eventLongDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="event_seo_description", type="string", length=255, nullable=true)
     */
    private $eventSeoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="event_keyword", type="string", length=255, nullable=true)
     */
    private $eventKeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="event_renewal_date", type="string", length=255, nullable=true)
     */
    private $eventRenewalDate;

    /**
     * @var string
     *
     * @ORM\Column(name="event_status", type="string", length=255, nullable=true)
     */
    private $eventStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="event_level", type="string", length=255, nullable=true)
     */
    private $eventLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="event_category_1", type="text", nullable=true)
     */
    private $eventCategory1;

    /**
     * @var string
     *
     * @ORM\Column(name="event_category_2", type="text", nullable=true)
     */
    private $eventCategory2;

    /**
     * @var string
     *
     * @ORM\Column(name="event_category_3", type="text", nullable=true)
     */
    private $eventCategory3;

    /**
     * @var string
     *
     * @ORM\Column(name="event_category_4", type="text", nullable=true)
     */
    private $eventCategory4;

    /**
     * @var string
     *
     * @ORM\Column(name="event_category_5", type="text", nullable=true)
     */
    private $eventCategory5;

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
    private $fileLineNumber = '0';

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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * Set eventId
     *
     * @param integer $eventId
     * @return ImporttemporaryEvent
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set eventTitle
     *
     * @param string $eventTitle
     * @return ImporttemporaryEvent
     */
    public function setEventTitle($eventTitle)
    {
        $this->eventTitle = $eventTitle;

        return $this;
    }

    /**
     * Get eventTitle
     *
     * @return string
     */
    public function getEventTitle()
    {
        return $this->eventTitle;
    }

    /**
     * Set eventSeoTitle
     *
     * @param string $eventSeoTitle
     * @return ImporttemporaryEvent
     */
    public function setEventSeoTitle($eventSeoTitle)
    {
        $this->eventSeoTitle = $eventSeoTitle;

        return $this;
    }

    /**
     * Get eventSeoTitle
     *
     * @return string
     */
    public function getEventSeoTitle()
    {
        return $this->eventSeoTitle;
    }

    /**
     * Set eventEmail
     *
     * @param string $eventEmail
     * @return ImporttemporaryEvent
     */
    public function setEventEmail($eventEmail)
    {
        $this->eventEmail = $eventEmail;

        return $this;
    }

    /**
     * Get eventEmail
     *
     * @return string
     */
    public function getEventEmail()
    {
        return $this->eventEmail;
    }

    /**
     * Set eventUrl
     *
     * @param string $eventUrl
     * @return ImporttemporaryEvent
     */
    public function setEventUrl($eventUrl)
    {
        $this->eventUrl = $eventUrl;

        return $this;
    }

    /**
     * Get eventUrl
     *
     * @return string
     */
    public function getEventUrl()
    {
        return $this->eventUrl;
    }

    /**
     * Set eventAddress
     *
     * @param string $eventAddress
     * @return ImporttemporaryEvent
     */
    public function setEventAddress($eventAddress)
    {
        $this->eventAddress = $eventAddress;

        return $this;
    }

    /**
     * Get eventAddress
     *
     * @return string
     */
    public function getEventAddress()
    {
        return $this->eventAddress;
    }

    /**
     * Set eventLocationname
     *
     * @param string $eventLocationname
     * @return ImporttemporaryEvent
     */
    public function setEventLocationname($eventLocationname)
    {
        $this->eventLocationname = $eventLocationname;

        return $this;
    }

    /**
     * Get eventLocationname
     *
     * @return string
     */
    public function getEventLocationname()
    {
        return $this->eventLocationname;
    }

    /**
     * Set eventContactname
     *
     * @param string $eventContactname
     * @return ImporttemporaryEvent
     */
    public function setEventContactname($eventContactname)
    {
        $this->eventContactname = $eventContactname;

        return $this;
    }

    /**
     * Get eventContactname
     *
     * @return string
     */
    public function getEventContactname()
    {
        return $this->eventContactname;
    }

    /**
     * Set eventStartdate
     *
     * @param string $eventStartdate
     * @return ImporttemporaryEvent
     */
    public function setEventStartdate($eventStartdate)
    {
        $this->eventStartdate = $eventStartdate;

        return $this;
    }

    /**
     * Get eventStartdate
     *
     * @return string
     */
    public function getEventStartdate()
    {
        return $this->eventStartdate;
    }

    /**
     * Set eventEnddate
     *
     * @param string $eventEnddate
     * @return ImporttemporaryEvent
     */
    public function setEventEnddate($eventEnddate)
    {
        $this->eventEnddate = $eventEnddate;

        return $this;
    }

    /**
     * Get eventEnddate
     *
     * @return string
     */
    public function getEventEnddate()
    {
        return $this->eventEnddate;
    }

    /**
     * Set eventStarttime
     *
     * @param string $eventStarttime
     * @return ImporttemporaryEvent
     */
    public function setEventStarttime($eventStarttime)
    {
        $this->eventStarttime = $eventStarttime;

        return $this;
    }

    /**
     * Get eventStarttime
     *
     * @return string
     */
    public function getEventStarttime()
    {
        return $this->eventStarttime;
    }

    /**
     * Set eventStarttimeMode
     *
     * @param string $eventStarttimeMode
     * @return ImporttemporaryEvent
     */
    public function setEventStarttimeMode($eventStarttimeMode)
    {
        $this->eventStarttimeMode = $eventStarttimeMode;

        return $this;
    }

    /**
     * Get eventStarttimeMode
     *
     * @return string
     */
    public function getEventStarttimeMode()
    {
        return $this->eventStarttimeMode;
    }

    /**
     * Set eventEndtime
     *
     * @param string $eventEndtime
     * @return ImporttemporaryEvent
     */
    public function setEventEndtime($eventEndtime)
    {
        $this->eventEndtime = $eventEndtime;

        return $this;
    }

    /**
     * Get eventEndtime
     *
     * @return string
     */
    public function getEventEndtime()
    {
        return $this->eventEndtime;
    }

    /**
     * Set eventEndtimeMode
     *
     * @param string $eventEndtimeMode
     * @return ImporttemporaryEvent
     */
    public function setEventEndtimeMode($eventEndtimeMode)
    {
        $this->eventEndtimeMode = $eventEndtimeMode;

        return $this;
    }

    /**
     * Get eventEndtimeMode
     *
     * @return string
     */
    public function getEventEndtimeMode()
    {
        return $this->eventEndtimeMode;
    }

    /**
     * Set eventLocation1
     *
     * @param string $eventLocation1
     * @return ImporttemporaryEvent
     */
    public function setEventLocation1($eventLocation1)
    {
        $this->eventLocation1 = $eventLocation1;

        return $this;
    }

    /**
     * Get eventLocation1
     *
     * @return string
     */
    public function getEventLocation1()
    {
        return $this->eventLocation1;
    }

    /**
     * Set eventLocation1Abbreviation
     *
     * @param string $eventLocation1Abbreviation
     * @return ImporttemporaryEvent
     */
    public function setEventLocation1Abbreviation($eventLocation1Abbreviation)
    {
        $this->eventLocation1Abbreviation = $eventLocation1Abbreviation;

        return $this;
    }

    /**
     * Get eventLocation1Abbreviation
     *
     * @return string
     */
    public function getEventLocation1Abbreviation()
    {
        return $this->eventLocation1Abbreviation;
    }

    /**
     * Set eventLocation2
     *
     * @param string $eventLocation2
     * @return ImporttemporaryEvent
     */
    public function setEventLocation2($eventLocation2)
    {
        $this->eventLocation2 = $eventLocation2;

        return $this;
    }

    /**
     * Get eventLocation2
     *
     * @return string
     */
    public function getEventLocation2()
    {
        return $this->eventLocation2;
    }

    /**
     * Set eventLocation2Abbreviation
     *
     * @param string $eventLocation2Abbreviation
     * @return ImporttemporaryEvent
     */
    public function setEventLocation2Abbreviation($eventLocation2Abbreviation)
    {
        $this->eventLocation2Abbreviation = $eventLocation2Abbreviation;

        return $this;
    }

    /**
     * Get eventLocation2Abbreviation
     *
     * @return string
     */
    public function getEventLocation2Abbreviation()
    {
        return $this->eventLocation2Abbreviation;
    }

    /**
     * Set eventLocation3
     *
     * @param string $eventLocation3
     * @return ImporttemporaryEvent
     */
    public function setEventLocation3($eventLocation3)
    {
        $this->eventLocation3 = $eventLocation3;

        return $this;
    }

    /**
     * Get eventLocation3
     *
     * @return string
     */
    public function getEventLocation3()
    {
        return $this->eventLocation3;
    }

    /**
     * Set eventLocation3Abbreviation
     *
     * @param string $eventLocation3Abbreviation
     * @return ImporttemporaryEvent
     */
    public function setEventLocation3Abbreviation($eventLocation3Abbreviation)
    {
        $this->eventLocation3Abbreviation = $eventLocation3Abbreviation;

        return $this;
    }

    /**
     * Get eventLocation3Abbreviation
     *
     * @return string
     */
    public function getEventLocation3Abbreviation()
    {
        return $this->eventLocation3Abbreviation;
    }

    /**
     * Set eventLocation4
     *
     * @param string $eventLocation4
     * @return ImporttemporaryEvent
     */
    public function setEventLocation4($eventLocation4)
    {
        $this->eventLocation4 = $eventLocation4;

        return $this;
    }

    /**
     * Get eventLocation4
     *
     * @return string
     */
    public function getEventLocation4()
    {
        return $this->eventLocation4;
    }

    /**
     * Set eventLocation4Abbreviation
     *
     * @param string $eventLocation4Abbreviation
     * @return ImporttemporaryEvent
     */
    public function setEventLocation4Abbreviation($eventLocation4Abbreviation)
    {
        $this->eventLocation4Abbreviation = $eventLocation4Abbreviation;

        return $this;
    }

    /**
     * Get eventLocation4Abbreviation
     *
     * @return string
     */
    public function getEventLocation4Abbreviation()
    {
        return $this->eventLocation4Abbreviation;
    }

    /**
     * Set eventLocation5
     *
     * @param string $eventLocation5
     * @return ImporttemporaryEvent
     */
    public function setEventLocation5($eventLocation5)
    {
        $this->eventLocation5 = $eventLocation5;

        return $this;
    }

    /**
     * Get eventLocation5
     *
     * @return string
     */
    public function getEventLocation5()
    {
        return $this->eventLocation5;
    }

    /**
     * Set eventLocation5Abbreviation
     *
     * @param string $eventLocation5Abbreviation
     * @return ImporttemporaryEvent
     */
    public function setEventLocation5Abbreviation($eventLocation5Abbreviation)
    {
        $this->eventLocation5Abbreviation = $eventLocation5Abbreviation;

        return $this;
    }

    /**
     * Get eventLocation5Abbreviation
     *
     * @return string
     */
    public function getEventLocation5Abbreviation()
    {
        return $this->eventLocation5Abbreviation;
    }

    /**
     * Set eventZip
     *
     * @param string $eventZip
     * @return ImporttemporaryEvent
     */
    public function setEventZip($eventZip)
    {
        $this->eventZip = $eventZip;

        return $this;
    }

    /**
     * Get eventZip
     *
     * @return string
     */
    public function getEventZip()
    {
        return $this->eventZip;
    }

    /**
     * Set eventLatitude
     *
     * @param string $eventLatitude
     * @return ImporttemporaryEvent
     */
    public function setEventLatitude($eventLatitude)
    {
        $this->eventLatitude = $eventLatitude;

        return $this;
    }

    /**
     * Get eventLatitude
     *
     * @return string
     */
    public function getEventLatitude()
    {
        return $this->eventLatitude;
    }

    /**
     * Set eventLongitude
     *
     * @param string $eventLongitude
     * @return ImporttemporaryEvent
     */
    public function setEventLongitude($eventLongitude)
    {
        $this->eventLongitude = $eventLongitude;

        return $this;
    }

    /**
     * Get eventLongitude
     *
     * @return string
     */
    public function getEventLongitude()
    {
        return $this->eventLongitude;
    }

    /**
     * Set eventPhone
     *
     * @param string $eventPhone
     * @return ImporttemporaryEvent
     */
    public function setEventPhone($eventPhone)
    {
        $this->eventPhone = $eventPhone;

        return $this;
    }

    /**
     * Get eventPhone
     *
     * @return string
     */
    public function getEventPhone()
    {
        return $this->eventPhone;
    }

    /**
     * Set eventDescription
     *
     * @param string $eventDescription
     * @return ImporttemporaryEvent
     */
    public function setEventDescription($eventDescription)
    {
        $this->eventDescription = $eventDescription;

        return $this;
    }

    /**
     * Get eventDescription
     *
     * @return string
     */
    public function getEventDescription()
    {
        return $this->eventDescription;
    }

    /**
     * Set eventLongDescription
     *
     * @param string $eventLongDescription
     * @return ImporttemporaryEvent
     */
    public function setEventLongDescription($eventLongDescription)
    {
        $this->eventLongDescription = $eventLongDescription;

        return $this;
    }

    /**
     * Get eventLongDescription
     *
     * @return string
     */
    public function getEventLongDescription()
    {
        return $this->eventLongDescription;
    }

    /**
     * Set eventSeoDescription
     *
     * @param string $eventSeoDescription
     * @return ImporttemporaryEvent
     */
    public function setEventSeoDescription($eventSeoDescription)
    {
        $this->eventSeoDescription = $eventSeoDescription;

        return $this;
    }

    /**
     * Get eventSeoDescription
     *
     * @return string
     */
    public function getEventSeoDescription()
    {
        return $this->eventSeoDescription;
    }

    /**
     * Set eventKeyword
     *
     * @param string $eventKeyword
     * @return ImporttemporaryEvent
     */
    public function setEventKeyword($eventKeyword)
    {
        $this->eventKeyword = $eventKeyword;

        return $this;
    }

    /**
     * Get eventKeyword
     *
     * @return string
     */
    public function getEventKeyword()
    {
        return $this->eventKeyword;
    }

    /**
     * Set eventRenewalDate
     *
     * @param string $eventRenewalDate
     * @return ImporttemporaryEvent
     */
    public function setEventRenewalDate($eventRenewalDate)
    {
        $this->eventRenewalDate = $eventRenewalDate;

        return $this;
    }

    /**
     * Get eventRenewalDate
     *
     * @return string
     */
    public function getEventRenewalDate()
    {
        return $this->eventRenewalDate;
    }

    /**
     * Set eventStatus
     *
     * @param string $eventStatus
     * @return ImporttemporaryEvent
     */
    public function setEventStatus($eventStatus)
    {
        $this->eventStatus = $eventStatus;

        return $this;
    }

    /**
     * Get eventStatus
     *
     * @return string
     */
    public function getEventStatus()
    {
        return $this->eventStatus;
    }

    /**
     * Set eventLevel
     *
     * @param string $eventLevel
     * @return ImporttemporaryEvent
     */
    public function setEventLevel($eventLevel)
    {
        $this->eventLevel = $eventLevel;

        return $this;
    }

    /**
     * Get eventLevel
     *
     * @return string
     */
    public function getEventLevel()
    {
        return $this->eventLevel;
    }

    /**
     * Set eventCategory1
     *
     * @param string $eventCategory1
     * @return ImporttemporaryEvent
     */
    public function setEventCategory1($eventCategory1)
    {
        $this->eventCategory1 = $eventCategory1;

        return $this;
    }

    /**
     * Get eventCategory1
     *
     * @return string
     */
    public function getEventCategory1()
    {
        return $this->eventCategory1;
    }

    /**
     * Set eventCategory2
     *
     * @param string $eventCategory2
     * @return ImporttemporaryEvent
     */
    public function setEventCategory2($eventCategory2)
    {
        $this->eventCategory2 = $eventCategory2;

        return $this;
    }

    /**
     * Get eventCategory2
     *
     * @return string
     */
    public function getEventCategory2()
    {
        return $this->eventCategory2;
    }

    /**
     * Set eventCategory3
     *
     * @param string $eventCategory3
     * @return ImporttemporaryEvent
     */
    public function setEventCategory3($eventCategory3)
    {
        $this->eventCategory3 = $eventCategory3;

        return $this;
    }

    /**
     * Get eventCategory3
     *
     * @return string
     */
    public function getEventCategory3()
    {
        return $this->eventCategory3;
    }

    /**
     * Set eventCategory4
     *
     * @param string $eventCategory4
     * @return ImporttemporaryEvent
     */
    public function setEventCategory4($eventCategory4)
    {
        $this->eventCategory4 = $eventCategory4;

        return $this;
    }

    /**
     * Get eventCategory4
     *
     * @return string
     */
    public function getEventCategory4()
    {
        return $this->eventCategory4;
    }

    /**
     * Set eventCategory5
     *
     * @param string $eventCategory5
     * @return ImporttemporaryEvent
     */
    public function setEventCategory5($eventCategory5)
    {
        $this->eventCategory5 = $eventCategory5;

        return $this;
    }

    /**
     * Get eventCategory5
     *
     * @return string
     */
    public function getEventCategory5()
    {
        return $this->eventCategory5;
    }

    /**
     * Set customId
     *
     * @param string $customId
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
     * @return ImporttemporaryEvent
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
