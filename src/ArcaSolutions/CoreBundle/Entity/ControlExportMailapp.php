<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControlExportMailapp
 *
 * @ORM\Table(name="Control_Export_MailApp")
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\ControlExportMailappRepository")
 */
class ControlExportMailapp
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
     * @var \DateTime
     *
     * @ORM\Column(name="last_run_date", type="datetime", nullable=false)
     */
    private $lastRunDate = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="last_exportlog", type="integer", nullable=false)
     */
    private $lastExportlog;



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
     * @return ControlExportMailapp
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
     * @return ControlExportMailapp
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
     * @return ControlExportMailapp
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
     * Set lastExportlog
     *
     * @param integer $lastExportlog
     * @return ControlExportMailapp
     */
    public function setLastExportlog($lastExportlog)
    {
        $this->lastExportlog = $lastExportlog;

        return $this;
    }

    /**
     * Get lastExportlog
     *
     * @return integer 
     */
    public function getLastExportlog()
    {
        return $this->lastExportlog;
    }
}
