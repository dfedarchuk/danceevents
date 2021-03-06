<?php

namespace ArcaSolutions\ClassifiedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportClassifiedMonthly
 *
 * @ORM\Table(name="Report_Classified_Monthly")
 * @ORM\Entity
 */
class ReportClassifiedMonthly
{
    /**
     * @var integer
     *
     * @ORM\Column(name="classified_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $classifiedId = '0';

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
     * Set classifiedId
     *
     * @param integer $classifiedId
     * @return ReportClassifiedMonthly
     */
    public function setClassifiedId($classifiedId)
    {
        $this->classifiedId = $classifiedId;

        return $this;
    }

    /**
     * Get classifiedId
     *
     * @return integer 
     */
    public function getClassifiedId()
    {
        return $this->classifiedId;
    }

    /**
     * Set day
     *
     * @param \DateTime $day
     * @return ReportClassifiedMonthly
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
     * @return ReportClassifiedMonthly
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
     * @return ReportClassifiedMonthly
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
