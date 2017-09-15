<?php

namespace ArcaSolutions\ReportsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportStatistic
 *
 * @ORM\Table(name="Report_Statistic", indexes={@ORM\Index(name="search_date", columns={"search_date"}), @ORM\Index(name="module", columns={"module"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\ReportsBundle\Repository\ReportStatisticRepository")
 */
class ReportStatistic
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
     * @var \DateTime
     *
     * @ORM\Column(name="search_date", type="datetime", nullable=false)
     */
    private $searchDate;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=1, nullable=false)
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="keyword", type="string", length=50, nullable=false)
     */
    private $keyword;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_1", type="integer", nullable=false)
     */
    private $location1 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_2", type="integer", nullable=false)
     */
    private $location2 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_3", type="integer", nullable=false)
     */
    private $location3 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_4", type="integer", nullable=false)
     */
    private $location4 = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="location_5", type="integer", nullable=false)
     */
    private $location5 = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="search_where", type="string", length=255, nullable=true)
     */
    private $searchWhere;



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
     * Set searchDate
     *
     * @param \DateTime $searchDate
     * @return ReportStatistic
     */
    public function setSearchDate($searchDate)
    {
        $this->searchDate = $searchDate;

        return $this;
    }

    /**
     * Get searchDate
     *
     * @return \DateTime 
     */
    public function getSearchDate()
    {
        return $this->searchDate;
    }

    /**
     * Set module
     *
     * @param string $module
     * @return ReportStatistic
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     * @return ReportStatistic
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string 
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return ReportStatistic
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set location1
     *
     * @param integer $location1
     * @return ReportStatistic
     */
    public function setLocation1($location1)
    {
        $this->location1 = $location1;

        return $this;
    }

    /**
     * Get location1
     *
     * @return integer 
     */
    public function getLocation1()
    {
        return $this->location1;
    }

    /**
     * Set location2
     *
     * @param integer $location2
     * @return ReportStatistic
     */
    public function setLocation2($location2)
    {
        $this->location2 = $location2;

        return $this;
    }

    /**
     * Get location2
     *
     * @return integer 
     */
    public function getLocation2()
    {
        return $this->location2;
    }

    /**
     * Set location3
     *
     * @param integer $location3
     * @return ReportStatistic
     */
    public function setLocation3($location3)
    {
        $this->location3 = $location3;

        return $this;
    }

    /**
     * Get location3
     *
     * @return integer 
     */
    public function getLocation3()
    {
        return $this->location3;
    }

    /**
     * Set location4
     *
     * @param integer $location4
     * @return ReportStatistic
     */
    public function setLocation4($location4)
    {
        $this->location4 = $location4;

        return $this;
    }

    /**
     * Get location4
     *
     * @return integer 
     */
    public function getLocation4()
    {
        return $this->location4;
    }

    /**
     * Set location5
     *
     * @param integer $location5
     * @return ReportStatistic
     */
    public function setLocation5($location5)
    {
        $this->location5 = $location5;

        return $this;
    }

    /**
     * Get location5
     *
     * @return integer 
     */
    public function getLocation5()
    {
        return $this->location5;
    }

    /**
     * Set searchWhere
     *
     * @param string $searchWhere
     * @return ReportStatistic
     */
    public function setSearchWhere($searchWhere)
    {
        $this->searchWhere = $searchWhere;

        return $this;
    }

    /**
     * Get searchWhere
     *
     * @return string 
     */
    public function getSearchWhere()
    {
        return $this->searchWhere;
    }
}
