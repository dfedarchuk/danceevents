<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControlExportListing
 *
 * @ORM\Table(name="Control_Export_Listing")
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\ControlExportListingRepository")
 */
class ControlExportListing
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="domain_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $domainId = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_run_date", type="datetime", nullable=false)
     */
    private $lastRunDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_listing_exported", type="integer", nullable=false)
     */
    private $totalListingExported;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_listing_id", type="integer", nullable=false)
     */
    private $lastListingId;

    /**
     * @var integer
     *
     * @ORM\Column(name="block", type="integer", nullable=false)
     */
    private $block;

    /**
     * @var string
     *
     * @ORM\Column(name="finished", type="string", length=1, nullable=false)
     */
    private $finished;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=100, nullable=false)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="running_cron", type="string", length=1, nullable=false)
     */
    private $runningCron;

    /**
     * @var string
     *
     * @ORM\Column(name="scheduled", type="string", length=1, nullable=false)
     */
    private $scheduled;



    /**
     * Set id
     *
     * @param integer $id
     * @return ControlExportListing
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * @return ControlExportListing
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
     * Set lastRunDate
     *
     * @param \DateTime $lastRunDate
     * @return ControlExportListing
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
     * Set totalListingExported
     *
     * @param integer $totalListingExported
     * @return ControlExportListing
     */
    public function setTotalListingExported($totalListingExported)
    {
        $this->totalListingExported = $totalListingExported;

        return $this;
    }

    /**
     * Get totalListingExported
     *
     * @return integer 
     */
    public function getTotalListingExported()
    {
        return $this->totalListingExported;
    }

    /**
     * Set lastListingId
     *
     * @param integer $lastListingId
     * @return ControlExportListing
     */
    public function setLastListingId($lastListingId)
    {
        $this->lastListingId = $lastListingId;

        return $this;
    }

    /**
     * Get lastListingId
     *
     * @return integer 
     */
    public function getLastListingId()
    {
        return $this->lastListingId;
    }

    /**
     * Set block
     *
     * @param integer $block
     * @return ControlExportListing
     */
    public function setBlock($block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return integer 
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set finished
     *
     * @param string $finished
     * @return ControlExportListing
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
     * Set filename
     *
     * @param string $filename
     * @return ControlExportListing
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return ControlExportListing
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

    /**
     * Set runningCron
     *
     * @param string $runningCron
     * @return ControlExportListing
     */
    public function setRunningCron($runningCron)
    {
        $this->runningCron = $runningCron;

        return $this;
    }

    /**
     * Get runningCron
     *
     * @return string 
     */
    public function getRunningCron()
    {
        return $this->runningCron;
    }

    /**
     * Set scheduled
     *
     * @param string $scheduled
     * @return ControlExportListing
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
}
