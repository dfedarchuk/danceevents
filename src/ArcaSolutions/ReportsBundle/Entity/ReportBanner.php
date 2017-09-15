<?php

namespace ArcaSolutions\ReportsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportBanner
 *
 * @ORM\Table(name="Report_Banner", uniqueConstraints={@ORM\UniqueConstraint(name="report_info", columns={"banner_id", "report_type", "date"})}, indexes={@ORM\Index(name="banner_id", columns={"banner_id"}), @ORM\Index(name="report_type", columns={"report_type"}), @ORM\Index(name="date", columns={"date"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\ReportsBundle\Repository\ReportBannerRepository")
 */
class ReportBanner
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
     * @ORM\Column(name="banner_id", type="integer", nullable=false)
     */
    private $bannerId = '0';

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
     * Set bannerId
     *
     * @param integer $bannerId
     * @return ReportBanner
     */
    public function setBannerId($bannerId)
    {
        $this->bannerId = $bannerId;

        return $this;
    }

    /**
     * Get bannerId
     *
     * @return integer 
     */
    public function getBannerId()
    {
        return $this->bannerId;
    }

    /**
     * Set reportType
     *
     * @param integer $reportType
     * @return ReportBanner
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
     * @return ReportBanner
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
     * @return ReportBanner
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
