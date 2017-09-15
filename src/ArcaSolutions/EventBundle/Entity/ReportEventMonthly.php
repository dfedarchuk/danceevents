<?php

namespace ArcaSolutions\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportEventMonthly
 *
 * @ORM\Table(name="Report_Event_Monthly")
 * @ORM\Entity
 */
class ReportEventMonthly
{
    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $eventId = '0';

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
     * Set eventId
     *
     * @param integer $eventId
     * @return ReportEventMonthly
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
     * Set day
     *
     * @param \DateTime $day
     * @return ReportEventMonthly
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
     * @return ReportEventMonthly
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
     * @return ReportEventMonthly
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
}
