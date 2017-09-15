<?php

namespace ArcaSolutions\ReportsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportBannerMonthly
 *
 * @ORM\Table(name="Report_Banner_Monthly")
 * @ORM\Entity(repositoryClass="ArcaSolutions\ReportsBundle\Repository\ReportBannerMonthlyRepository")
 */
class ReportBannerMonthly
{
    /**
     * @var integer
     *
     * @ORM\Column(name="banner_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bannerId = '0';

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
     * @ORM\Column(name="view", type="integer", nullable=false)
     */
    private $view = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="click_thru", type="integer", nullable=false)
     */
    private $clickThru = '0';



    /**
     * Set bannerId
     *
     * @param integer $bannerId
     * @return ReportBannerMonthly
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
     * Set day
     *
     * @param \DateTime $day
     * @return ReportBannerMonthly
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
     * Set view
     *
     * @param integer $view
     * @return ReportBannerMonthly
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get view
     *
     * @return integer 
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set clickThru
     *
     * @param integer $clickThru
     * @return ReportBannerMonthly
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
}
