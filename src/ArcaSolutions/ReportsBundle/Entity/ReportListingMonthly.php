<?php

namespace ArcaSolutions\ReportsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportListingMonthly
 *
 * @ORM\Table(name="Report_Listing_Monthly")
 * @ORM\Entity(repositoryClass="ArcaSolutions\ReportsBundle\Repository\ReportListingMonthlyRepository")
 */
class ReportListingMonthly
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
    private $day;

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
     * @return ReportListingMonthly
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
     * @return ReportListingMonthly
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
     * @return ReportListingMonthly
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
     * @return ReportListingMonthly
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
     * @return ReportListingMonthly
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
     * @return ReportListingMonthly
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
     * @return ReportListingMonthly
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
     * @return ReportListingMonthly
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
     * @return ReportListingMonthly
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
     * @return ReportListingMonthly
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
