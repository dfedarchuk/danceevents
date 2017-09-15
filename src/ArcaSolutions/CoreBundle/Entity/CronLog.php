<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CronLog
 *
 * @ORM\Table(name="Cron_Log")
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\CronLogRepository")
 */
class CronLog
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
     * @ORM\Column(name="domain_id", type="integer", nullable=false)
     */
    private $domainId;

    /**
     * @var string
     *
     * @ORM\Column(name="cron", type="string", length=50, nullable=false)
     */
    private $cron;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="history", type="text", nullable=false)
     */
    private $history;

    /**
     * @var string
     *
     * @ORM\Column(name="finished", type="string", length=1, nullable=false)
     */
    private $finished = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="string", length=100, nullable=false)
     */
    private $time;



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
     * Set domainId
     *
     * @param integer $domainId
     * @return CronLog
     */
    public function setDomainId($domainId)
    {
        $this->domainId = $domainId;

        return $this;
    }

    /**
     * Get domainId
     *
     * @return integer 
     */
    public function getDomainId()
    {
        return $this->domainId;
    }

    /**
     * Set cron
     *
     * @param string $cron
     * @return CronLog
     */
    public function setCron($cron)
    {
        $this->cron = $cron;

        return $this;
    }

    /**
     * Get cron
     *
     * @return string 
     */
    public function getCron()
    {
        return $this->cron;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return CronLog
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

    /**
     * Set history
     *
     * @param string $history
     * @return CronLog
     */
    public function setHistory($history)
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get history
     *
     * @return string 
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Set finished
     *
     * @param string $finished
     * @return CronLog
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return string 
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * Set time
     *
     * @param string $time
     * @return CronLog
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string 
     */
    public function getTime()
    {
        return $this->time;
    }
}
