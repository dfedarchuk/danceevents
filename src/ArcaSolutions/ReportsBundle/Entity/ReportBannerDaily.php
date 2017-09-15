<?php

namespace ArcaSolutions\ReportsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportBannerDaily
 *
 * @ORM\Table(name="Report_Banner_Daily")
 * @ORM\Entity(repositoryClass="ArcaSolutions\ReportsBundle\Repository\ReportBannerDailyRepository")
 */
class ReportBannerDaily
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
    private $day = '0000-00-00';

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
     * @return ReportBannerDaily
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
     * @return ReportBannerDaily
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
     * @return ReportBannerDaily
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
     * @return ReportBannerDaily
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
