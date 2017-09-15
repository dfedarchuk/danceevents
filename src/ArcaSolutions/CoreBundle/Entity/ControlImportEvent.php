<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControlImportEvent
 *
 * @ORM\Table(name="Control_Import_Event")
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\ControlImportEventRepository")
 */
class ControlImportEvent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="domain_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $domainId;

    /**
     * @var string
     *
     * @ORM\Column(name="scheduled", type="string", length=1, nullable=false)
     */
    private $scheduled = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="running", type="string", length=1, nullable=false)
     */
    private $running = 'N';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=2, nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_run_date", type="datetime", nullable=false)
     */
    private $lastRunDate = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="last_importlog", type="integer", nullable=false)
     */
    private $lastImportlog;



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
     * Set scheduled
     *
     * @param string $scheduled
     * @return ControlImportEvent
     */
    public function setScheduled($scheduled)
    {
        $this->scheduled = $scheduled;

        return $this;
    }

    /**
     * Get scheduled
     *
     * @return string 
     */
    public function getScheduled()
    {
        return $this->scheduled;
    }

    /**
     * Set running
     *
     * @param string $running
     * @return ControlImportEvent
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
     * Set status
     *
     * @param string $status
     * @return ControlImportEvent
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set lastRunDate
     *
     * @param \DateTime $lastRunDate
     * @return ControlImportEvent
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
     * Set lastImportlog
     *
     * @param integer $lastImportlog
     * @return ControlImportEvent
     */
    public function setLastImportlog($lastImportlog)
    {
        $this->lastImportlog = $lastImportlog;

        return $this;
    }

    /**
     * Get lastImportlog
     *
     * @return integer 
     */
    public function getLastImportlog()
    {
        return $this->lastImportlog;
    }
}
