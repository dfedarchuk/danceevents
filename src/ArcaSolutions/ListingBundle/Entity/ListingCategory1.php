<?php

namespace ArcaSolutions\ListingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * ListingCategory1
 *
 * @ORM\Table(name="Listing_Category", indexes={@ORM\Index(name="listing_id", columns={"listing_id"}), @ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="status", columns={"status"}), @ORM\Index(name="category_status", columns={"category_id", "status"}), @ORM\Index(name="category_listing_id", columns={"category_id", "category_root_id", "listing_id"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\TestBundle\Entity\ListingCategoryRepository1")
 */
class ListingCategory1
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
     * @ORM\Column(name="listing_id", type="integer", nullable=false)
     */
    private $listingId;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_root_id", type="integer", nullable=false)
     */
    private $categoryRootId;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_node_left", type="integer", nullable=false)
     */
    private $categoryNodeLeft;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_node_right", type="integer", nullable=false)
     */
    private $categoryNodeRight;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ListingBundle\Entity\ListingCategory", inversedBy="listingCategory", fetch="EAGER")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @Serializer\Groups({"listingDetail", "dealDetail"})
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ListingBundle\Entity\ListingCategory")
     * @ORM\JoinColumn(name="category_root_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ListingBundle\Entity\Listing", inversedBy="categories")
     * @ORM\JoinColumn(name="listing_id", referencedColumnName="id")
     */
    private $listing;

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
     * Set listingId
     *
     * @param integer $listingId
     * @return ListingCategory1
     */
    public function setListingId($listingId)
    {
        $this->listingId = $listingId;

        return $this;
    }

    /**
     * Get listingId
     *
     * @return integer
     */
    public function getListingId()
    {
        return $this->listingId;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return ListingCategory1
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
     * Set categoryRootId
     *
     * @param integer $categoryRootId
     * @return ListingCategory1
     */
    public function setCategoryRootId($categoryRootId)
    {
        $this->categoryRootId = $categoryRootId;

        return $this;
    }

    /**
     * Get categoryRootId
     *
     * @return integer
     */
    public function getCategoryRootId()
    {
        return $this->categoryRootId;
    }

    /**
     * Set categoryNodeLeft
     *
     * @param integer $categoryNodeLeft
     * @return ListingCategory1
     */
    public function setCategoryNodeLeft($categoryNodeLeft)
    {
        $this->categoryNodeLeft = $categoryNodeLeft;

        return $this;
    }

    /**
     * Get categoryNodeLeft
     *
     * @return integer
     */
    public function getCategoryNodeLeft()
    {
        return $this->categoryNodeLeft;
    }

    /**
     * Set categoryNodeRight
     *
     * @param integer $categoryNodeRight
     * @return ListingCategory1
     */
    public function setCategoryNodeRight($categoryNodeRight)
    {
        $this->categoryNodeRight = $categoryNodeRight;

        return $this;
    }

    /**
     * Get categoryNodeRight
     *
     * @return integer
     */
    public function getCategoryNodeRight()
    {
        return $this->categoryNodeRight;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return ListingCategory1
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
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getListing()
    {
        return $this->listing;
    }

    /**
     * @param mixed $listing
     */
    public function setListing($listing)
    {
        $this->listing = $listing;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
}
