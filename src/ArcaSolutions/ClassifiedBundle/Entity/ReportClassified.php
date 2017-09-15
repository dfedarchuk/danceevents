<?php

namespace ArcaSolutions\ClassifiedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportClassified
 *
 * @ORM\Table(name="Report_Classified", uniqueConstraints={@ORM\UniqueConstraint(name="report_info", columns={"classified_id", "report_type", "date"})}, indexes={@ORM\Index(name="classified_id", columns={"classified_id"}), @ORM\Index(name="report_type", columns={"report_type"}), @ORM\Index(name="date", columns={"date"})})
 * @ORM\Entity
 */
class ReportClassified
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
     * @ORM\Column(name="classified_id", type="integer", nullable=false)
     */
    private $classifiedId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="report_type", type="integer", nullable=false)
     */
    private $reportType = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="report_amount", type="integer", nullable=false)
     */
    private $reportAmount = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date = '0000-00-00';



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
     * Set classifiedId
     *
     * @param integer $classifiedId
     * @return ReportClassified
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
     * Set reportType
     *
     * @param integer $reportType
     * @return ReportClassified
     */
    public function setReportType($reportType)
    {
        $this->reportType = $reportType;

        return $this;
    }

    /**
     * Get reportType
     *
     * @return integer 
     */
    public function getReportType()
    {
        return $this->reportType;
    }

    /**
     * Set reportAmount
     *
     * @param integer $reportAmount
     * @return ReportClassified
     */
    public function setReportAmount($reportAmount)
    {
        $this->reportAmount = $reportAmount;

        return $this;
    }

    /**
     * Get reportAmount
     *
     * @return integer 
     */
    public function getReportAmount()
    {
        return $this->reportAmount;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return ReportClassified
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
}
