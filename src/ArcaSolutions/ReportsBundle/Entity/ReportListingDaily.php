<?php

namespace ArcaSolutions\ReportsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportListingDaily
 *
 * @ORM\Table(name="Report_Listing_Daily")
 * @ORM\Entity(repositoryClass="ArcaSolutions\ReportsBundle\Repository\ReportListingDailyRepository")
 */
class ReportListingDaily
{
    /**
     * @var integer
     *
     * @ORM\Column(name="listing_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $listingId = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="day", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $day = '0000-00-00';

    /**
     * @var integer
     *
     * @ORM\Column(name="summary_view", type="integer", nullable=false)
     */
    private $summaryView = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="detail_view", type="integer", nullable=false)
     */
    private $detailView = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="click_thru", type="integer", nullable=false)
     */
    private $clickThru = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="email_sent", type="integer", nullable=false)
     */
    private $emailSent = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="phone_view", type="integer", nullable=false)
     */
    private $phoneView = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fax_view", type="integer", nullable=false)
     */
    private $faxView = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="send_phone", type="integer", nullable=false)
     */
    private $sendPhone = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="click_call", type="integer", nullable=false)
     */
    private $clickCall = '0';



    /**
     * Set listingId
     *
     * @param integer $listingId
     * @return ReportListingDaily
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
     * Set day
     *
     * @param \DateTime $day
     * @return ReportListingDaily
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return \DateTime 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set summaryView
     *
     * @param integer $summaryView
     * @return ReportListingDaily
     */
    public function setSummaryView($summaryView)
    {
        $this->summaryView = $summaryView;

        return $this;
    }

    /**
     * Get summaryView
     *
     * @return integer 
     */
    public function getSummaryView()
    {
        return $this->summaryView;
    }

    /**
     * Set detailView
     *
     * @param integer $detailView
     * @return ReportListingDaily
     */
    public function setDetailView($detailView)
    {
        $this->detailView = $detailView;

        return $this;
    }

    /**
     * Get detailView
     *
     * @return integer 
     */
    public function getDetailView()
    {
        return $this->detailView;
    }

    /**
     * Set clickThru
     *
     * @param integer $clickThru
     * @return ReportListingDaily
     */
    public function setClickThru($clickThru)
    {
        $this->clickThru = $clickThru;

        return $this;
    }

    /**
     * Get clickThru
     *
     * @return integer 
     */
    public function getClickThru()
    {
        return $this->clickThru;
    }

    /**
     * Set emailSent
     *
     * @param integer $emailSent
     * @return ReportListingDaily
     */
    public function setEmailSent($emailSent)
    {
        $this->emailSent = $emailSent;

        return $this;
    }

    /**
     * Get emailSent
     *
     * @return integer 
     */
    public function getEmailSent()
    {
        return $this->emailSent;
    }

    /**
     * Set phoneView
     *
     * @param integer $phoneView
     * @return ReportListingDaily
     */
    public function setPhoneView($phoneView)
    {
        $this->phoneView = $phoneView;

        return $this;
    }

    /**
     * Get phoneView
     *
     * @return integer 
     */
    public function getPhoneView()
    {
        return $this->phoneView;
    }

    /**
     * Set faxView
     *
     * @param integer $faxView
     * @return ReportListingDaily
     */
    public function setFaxView($faxView)
    {
        $this->faxView = $faxView;

        return $this;
    }

    /**
     * Get faxView
     *
     * @return integer 
     */
    public function getFaxView()
    {
        return $this->faxView;
    }

    /**
     * Set sendPhone
     *
     * @param integer $sendPhone
     * @return ReportListingDaily
     */
    public function setSendPhone($sendPhone)
    {
        $this->sendPhone = $sendPhone;

        return $this;
    }

    /**
     * Get sendPhone
     *
     * @return integer 
     */
    public function getSendPhone()
    {
        return $this->sendPhone;
    }

    /**
     * Set clickCall
     *
     * @param integer $clickCall
     * @return ReportListingDaily
     */
    public function setClickCall($clickCall)
    {
        $this->clickCall = $clickCall;

        return $this;
    }

    /**
     * Get clickCall
     *
     * @return integer 
     */
    public function getClickCall()
    {
        return $this->clickCall;
    }
}
