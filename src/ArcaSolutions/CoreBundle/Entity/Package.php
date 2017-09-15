<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Package
 *
 * @ORM\Table(name="Package", indexes={@ORM\Index(name="parent_domain", columns={"parent_domain"}), @ORM\Index(name="module", columns={"module"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\PackageRepository")
 */
class Package
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_domain", type="integer", nullable=true)
     */
    private $parentDomain;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=50, nullable=true)
     */
    private $module;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=true)
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="image_id", type="integer", nullable=false)
     */
    private $imageId;

    /**
     * @var integer
     *
     * @ORM\Column(name="thumb_id", type="integer", nullable=false)
     */
    private $thumbId;

    /**
     * @var string
     *
     * @ORM\Column(name="show_info", type="string", length=1, nullable=false)
     */
    private $showInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entered", type="datetime", nullable=false)
     */
    private $entered;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;



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
     * @return Package
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
     * Set parentDomain
     *
     * @param integer $parentDomain
     * @return Package
     */
    public function setParentDomain($parentDomain)
    {
        $this->parentDomain = $parentDomain;

        return $this;
    }

    /**
     * Get parentDomain
     *
     * @return integer 
     */
    public function getParentDomain()
    {
        return $this->parentDomain;
    }

    /**
     * Set module
     *
     * @param string $module
     * @return Package
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
     * Set level
     *
     * @param integer $level
     * @return Package
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Package
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
     * Set imageId
     *
     * @param integer $imageId
     * @return Package
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;

        return $this;
    }

    /**
     * Get imageId
     *
     * @return integer 
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * Set thumbId
     *
     * @param integer $thumbId
     * @return Package
     */
    public function setThumbId($thumbId)
    {
        $this->thumbId = $thumbId;

        return $this;
    }

    /**
     * Get thumbId
     *
     * @return integer 
     */
    public function getThumbId()
    {
        return $this->thumbId;
    }

    /**
     * Set showInfo
     *
     * @param string $showInfo
     * @return Package
     */
    public function setShowInfo($showInfo)
    {
        $this->showInfo = $showInfo;

        return $this;
    }

    /**
     * Get showInfo
     *
     * @return string 
     */
    public function getShowInfo()
    {
        return $this->showInfo;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Package
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set entered
     *
     * @param \DateTime $entered
     * @return Package
     */
    public function setEntered($entered)
    {
        $this->entered = $entered;

        return $this;
    }

    /**
     * Get entered
     *
     * @return \DateTime 
     */
    public function getEntered()
    {
        return $this->entered;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Package
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
