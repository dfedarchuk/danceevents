<?php

namespace ArcaSolutions\ListingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Listingtemplate
 *
 * @ORM\Table(name="ListingTemplate")
 * @ORM\Entity(repositoryClass="ArcaSolutions\TestBundle\Entity\ListingtemplateRepository")
 */
class Listingtemplate
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
     * @ORM\Column(name="layout_id", type="integer", nullable=false, options={"default"="0"} )
     */
    private $layoutId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entered", type="datetime", nullable=false)
     */
    private $entered;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false, options={"default"="enabled"})
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_id", type="string", length=255, nullable=true)
     */
    private $catId;

    /**
     * @var string
     *
     * @ORM\Column(name="editable", type="string", length=1, nullable=false, options={"default"="y"})
     */
    private $editable;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\ListingBundle\Entity\Listing", mappedBy="template")
     * @ORM\JoinColumn(name="id", referencedColumnName="listingtemplate_id")
     */
    private $listings;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\ListingBundle\Entity\ListingtemplateField", mappedBy="template", fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="listingtemplate_id")
     */
    private $fields;

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
     * Set layoutId
     *
     * @param integer $layoutId
     * @return Listingtemplate
     */
    public function setLayoutId($layoutId)
    {
        $this->layoutId = $layoutId;

        return $this;
    }

    /**
     * Get layoutId
     *
     * @return integer
     */
    public function getLayoutId()
    {
        return $this->layoutId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Listingtemplate
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Listingtemplate
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

    /**
     * Set entered
     *
     * @param \DateTime $entered
     * @return Listingtemplate
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
     * Set status
     *
     * @param string $status
     * @return Listingtemplate
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
     * Set price
     *
     * @param string $price
     * @return Listingtemplate
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set catId
     *
     * @param string $catId
     * @return Listingtemplate
     */
    public function setCatId($catId)
    {
        $this->catId = $catId;

        return $this;
    }

    /**
     * Get catId
     *
     * @return string
     */
    public function getCatId()
    {
        return $this->catId;
    }

    /**
     * Set editable
     *
     * @param string $editable
     * @return Listingtemplate
     */
    public function setEditable($editable)
    {
        $this->editable = $editable;

        return $this;
    }

    /**
     * Get editable
     *
     * @return string
     */
    public function getEditable()
    {
        return $this->editable;
    }

    /**
     * @return mixed
     */
    public function getListings()
    {
        return $this->listings;
    }

    /**
     * @param mixed $listings
     */
    public function setListings($listings)
    {
        $this->listings = $listings;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }
}
