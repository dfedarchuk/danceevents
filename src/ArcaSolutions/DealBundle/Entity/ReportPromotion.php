<?php

namespace ArcaSolutions\DealBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportPromotion
 *
 * @ORM\Table(name="Report_Promotion", uniqueConstraints={@ORM\UniqueConstraint(name="report_info", columns={"promotion_id", "report_type", "date"})}, indexes={@ORM\Index(name="promotion_id", columns={"promotion_id"}), @ORM\Index(name="report_type", columns={"report_type"}), @ORM\Index(name="date", columns={"date"})})
 * @ORM\Entity
 */
class ReportPromotion
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
     * @ORM\Column(name="promotion_id", type="integer", nullable=false)
     */
    private $promotionId = '0';

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
     * Set promotionId
     *
     * @param integer $promotionId
     * @return ReportPromotion
     */
    public function setPromotionId($promotionId)
    {
        $this->promotionId = $promotionId;

        return $this;
    }

    /**
     * Get promotionId
     *
     * @return integer 
     */
    public function getPromotionId()
    {
        return $this->promotionId;
    }

    /**
     * Set reportType
     *
     * @param integer $reportType
     * @return ReportPromotion
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
     * @return ReportPromotion
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
     * @return ReportPromotion
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
