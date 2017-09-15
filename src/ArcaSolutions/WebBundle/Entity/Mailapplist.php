<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mailapplist
 *
 * @ORM\Table(name="MailAppList")
 * @ORM\Entity
 */
class Mailapplist
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=100, nullable=false)
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=100, nullable=true)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="categories", type="text", nullable=true)
     */
    private $categories;

    /**
     * @var integer
     *
     * @ORM\Column(name="progress", type="integer", nullable=true)
     */
    private $progress;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_item_exported", type="integer", nullable=false)
     */
    private $totalItemExported;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_account_exported", type="integer", nullable=false)
     */
    private $lastAccountExported;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;



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
     * Set title
     *
     * @param string $title
     * @return Mailapplist
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set module
     *
     * @param string $module
     * @return Mailapplist
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
     * Set status
     *
     * @param string $status
     * @return Mailapplist
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
     * Set filename
     *
     * @param string $filename
     * @return Mailapplist
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
     * Set categories
     *
     * @param string $categories
     * @return Mailapplist
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return string 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set progress
     *
     * @param integer $progress
     * @return Mailapplist
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return integer 
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set totalItemExported
     *
     * @param integer $totalItemExported
     * @return Mailapplist
     */
    public function setTotalItemExported($totalItemExported)
    {
        $this->totalItemExported = $totalItemExported;

        return $this;
    }

    /**
     * Get totalItemExported
     *
     * @return integer 
     */
    public function getTotalItemExported()
    {
        return $this->totalItemExported;
    }

    /**
     * Set lastAccountExported
     *
     * @param integer $lastAccountExported
     * @return Mailapplist
     */
    public function setLastAccountExported($lastAccountExported)
    {
        $this->lastAccountExported = $lastAccountExported;

        return $this;
    }

    /**
     * Get lastAccountExported
     *
     * @return integer 
     */
    public function getLastAccountExported()
    {
        return $this->lastAccountExported;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Mailapplist
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
