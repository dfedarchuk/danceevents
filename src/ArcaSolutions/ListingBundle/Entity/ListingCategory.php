<?php

namespace ArcaSolutions\ListingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Listingcategory
 *
 * @ORM\Table(name="ListingCategory", indexes={@ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="title1", columns={"title"}), @ORM\Index(name="friendly_url1", columns={"friendly_url"}), @ORM\Index(name="right", columns={"right"}), @ORM\Index(name="root_id", columns={"root_id"}), @ORM\Index(name="left", columns={"left"}), @ORM\Index(name="cat_tree", columns={"root_id", "left", "right"}), @ORM\Index(name="keywords", columns={"keywords", "title"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\ListingBundle\Repository\ListingCategoryRepository")
 */
class ListingCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"listingDetail", "API", "dealDetail"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="root_id", type="integer", nullable=true)
     */
    private $rootId;

    /**
     * @var integer
     *
     * @ORM\Column(name="left", type="integer", nullable=true)
     */
    private $left;

    /**
     * @var integer
     *
     * @ORM\Column(name="right", type="integer", nullable=true)
     */
    private $right;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Serializer\Groups({"listingDetail", "API", "dealDetail"})
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=true)
     */
    private $categoryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="thumb_id", type="integer", nullable=true)
     */
    private $thumbId;

    /**
     * @var integer
     *
     * @ORM\Column(name="image_id", type="integer", nullable=true)
     */
    private $imageId;

    /**
     * @var string
     *
     * @ORM\Column(name="featured", type="string", length=1, nullable=false)
     */
    private $featured = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="summary_description", type="string", length=255, nullable=false)
     */
    private $summaryDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=255, nullable=false)
     */
    private $seoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="page_title", type="string", length=255, nullable=false)
     */
    private $pageTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="friendly_url", type="string", length=255, nullable=false)
     * @Serializer\Groups({"listingDetail", "API", "dealDetail"})
     */
    private $friendlyUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="string", length=255, nullable=false)
     */
    private $keywords;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keywords", type="string", length=255, nullable=false)
     */
    private $seoKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="full_friendly_url", type="text", nullable=true)
     */
    private $fullFriendlyUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="enabled", type="string", length=1, nullable=false)
     */
    private $enabled;

    /**
     * @var ListingCategory
     *
     * @ORM\OneToMany(targetEntity="ArcaSolutions\ListingBundle\Entity\ListingCategory", mappedBy="parent")
     * @ORM\OrderBy({"title" = "ASC"})
     */
    private $children = [];

    /**
     * @var ListingCategory
     *
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ListingBundle\Entity\ListingCategory", inversedBy="children")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\ListingBundle\Entity\ListingCategory1", mappedBy="category")
     */
    private $listingCategory;

    /**
     * @var string
     * @Serializer\Groups({"API", "dealDetail"})
     * @Serializer\SerializedName("image_url")
     * @Serializer\Type("string")
     */
    private $imagePath;

    /**
     * Constructor
     *
     * ArrayCollection
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
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
     * Set rootId
     *
     * @param integer $rootId
     * @return ListingCategory
     */
    public function setRootId($rootId)
    {
        $this->rootId = $rootId;

        return $this;
    }

    /**
     * Get rootId
     *
     * @return integer
     */
    public function getRootId()
    {
        return $this->rootId;
    }

    /**
     * Set left
     *
     * @param integer $left
     * @return ListingCategory
     */
    public function setLeft($left)
    {
        $this->left = $left;

        return $this;
    }

    /**
     * Get left
     *
     * @return integer
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Set right
     *
     * @param integer $right
     * @return ListingCategory
     */
    public function setRight($right)
    {
        $this->right = $right;

        return $this;
    }

    /**
     * Get right
     *
     * @return integer
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return ListingCategory
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
     * Set categoryId
     *
     * @param integer $categoryId
     * @return ListingCategory
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
     * Set thumbId
     *
     * @param integer $thumbId
     * @return ListingCategory
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
     * Set imageId
     *
     * @param integer $imageId
     * @return ListingCategory
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
     * Set featured
     *
     * @param string $featured
     * @return ListingCategory
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return string
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set summaryDescription
     *
     * @param string $summaryDescription
     * @return ListingCategory
     */
    public function setSummaryDescription($summaryDescription)
    {
        $this->summaryDescription = $summaryDescription;

        return $this;
    }

    /**
     * Get summaryDescription
     *
     * @return string
     */
    public function getSummaryDescription()
    {
        return $this->summaryDescription;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return ListingCategory
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set pageTitle
     *
     * @param string $pageTitle
     * @return ListingCategory
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    /**
     * Get pageTitle
     *
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set friendlyUrl
     *
     * @param string $friendlyUrl
     * @return ListingCategory
     */
    public function setFriendlyUrl($friendlyUrl)
    {
        $this->friendlyUrl = $friendlyUrl;

        return $this;
    }

    /**
     * Get friendlyUrl
     *
     * @return string
     */
    public function getFriendlyUrl()
    {
        return $this->friendlyUrl;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return ListingCategory
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set seoKeywords
     *
     * @param string $seoKeywords
     * @return ListingCategory
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    /**
     * Get seoKeywords
     *
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return ListingCategory
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
     * Set fullFriendlyUrl
     *
     * @param string $fullFriendlyUrl
     * @return ListingCategory
     */
    public function setFullFriendlyUrl($fullFriendlyUrl)
    {
        $this->fullFriendlyUrl = $fullFriendlyUrl;

        return $this;
    }

    /**
     * Get fullFriendlyUrl
     *
     * @return string
     */
    public function getFullFriendlyUrl()
    {
        return $this->fullFriendlyUrl;
    }

    /**
     * Set enabled
     *
     * @param string $enabled
     * @return ListingCategory
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return string
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set countSub
     *
     * @param integer $countSub
     * @return ListingCategory
     */
    public function setCountSub($countSub)
    {
        $this->countSub = $countSub;

        return $this;
    }

    /**
     * Get countSub
     *
     * @return integer
     */
    public function getCountSub()
    {
        return $this->countSub;
    }

    /**
     * Set parentId
     *
     * @param ListingCategory $parent
     * @return ListingCategory
     */
    public function setParent(ListingCategory $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get Parent
     *
     * @return ListingCategory
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get Children
     *
     * @return ListingCategory
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Get an array of all parent ids
     *
     * @param ListingCategory $category
     * @return array
     */
    public function getParentIds($category = null)
    {
        $category = $category ?: $this;

        if ($parent = $category->getParent()) {
            return array_merge([$parent->getId()], $this->getParentIds($parent));
        }

        return [];
    }

    /**
     * @param ListingCategory $children
     * @return ListingCategory
     */
    public function setChildren($children)
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Add children
     *
     * @param \ArcaSolutions\ListingBundle\Entity\ListingCategory $children
     * @return ListingCategory
     */
    public function addChild(\ArcaSolutions\ListingBundle\Entity\ListingCategory $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \ArcaSolutions\ListingBundle\Entity\ListingCategory $children
     */
    public function removeChild(\ArcaSolutions\ListingBundle\Entity\ListingCategory $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * @return mixed
     */
    public function getListingCategory()
    {
        return $this->listingCategory;
    }

    /**
     * @param mixed $listingCategory
     * @return ListingCategory
     */
    public function setListingCategory($listingCategory)
    {
        $this->listingCategory = $listingCategory;
        return $this;
    }

    /**
     * @return string
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Get all children categories related
     *
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("children")
     * @Serializer\Groups({"API_WITH_CHILDREN"})
     *
     * @return array
     */
    public function getChildCategories()
    {
        $categories_array = [];

        /* @var $child ListingCategory */
        foreach ($this->getChildren() as $child)
        {
            if ($child->getEnabled() == 'n')
                continue;

            $categories_array[] = $child;
        }

        return $categories_array;
    }
}
