<?php

namespace ArcaSolutions\ReportsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportStatisticDaily
 *
 * @ORM\Table(name="Report_Statistic_Daily", indexes={@ORM\Index(name="key", columns={"key"}), @ORM\Index(name="module", columns={"module"}), @ORM\Index(name="day", columns={"day"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\ReportsBundle\Repository\ReportStatisticDailyRepository")
 */
class ReportStatisticDaily
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
     * @ORM\Column(name="day", type="date", nullable=false)
     */
    private $day;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=1, nullable=false)
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=255, nullable=false)
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;



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
     * Set day
     *
     * @param \DateTime $day
     * @return ReportStatisticDaily
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
     * Set module
     *
     * @param string $module
     * @return ReportStatisticDaily
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
     * Set key
     *
     * @param string $key
     * @return ReportStatisticDaily
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return ReportStatisticDaily
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return ReportStatisticDaily
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
