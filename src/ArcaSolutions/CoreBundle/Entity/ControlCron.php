<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControlCron
 *
 * @ORM\Table(name="Control_Cron", indexes={@ORM\Index(name="domain_id", columns={"domain_id"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\ControlCronRepository")
 */
class ControlCron
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(name="domain_id", type="integer", nullable=false)
     */
    private $domainId;

    /**
     * @var string
     *
     * @ORM\Column(name="running", type="string", length=1, nullable=false)
     */
    private $running = 'N';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_run_date", type="datetime", nullable=false)
     */
    private $lastRunDate = '0000-00-00 00:00:00';

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;



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
     * @return ControlCron
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
     * Set running
     *
     * @param string $running
     * @return ControlCron
     */
    public function setRunning($running)
    {
        $this->running = $running;

        return $this;
    }

    /**
     * Get running
     *
     * @return string
     */
    public function getRunning()
    {
        return $this->running;
    }

    /**
     * Set lastRunDate
     *
     * @param \DateTime $lastRunDate
     * @return ControlCron
     */
    public function setLastRunDate($lastRunDate)
    {
        $this->lastRunDate = $lastRunDate;

        return $this;
    }

    /**
     * Get lastRunDate
     *
     * @return \DateTime
     */
    public function getLastRunDate()
    {
        return $this->lastRunDate;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return ControlCron
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
