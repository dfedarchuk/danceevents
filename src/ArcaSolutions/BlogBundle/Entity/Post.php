<?php

namespace ArcaSolutions\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use JMS\Serializer\Annotation as Serializer;

/**
 * Post
 *
 * @ORM\Table(name="Post", indexes={@ORM\Index(name="title", columns={"title"}), @ORM\Index(name="status", columns={"status"}), @ORM\Index(name="friendly_url", columns={"friendly_url"}), @ORM\Index(name="entered", columns={"entered"}), @ORM\Index(name="updated", columns={"updated"}), @ORM\Index(name="fulltextsearch_keyword", columns={"fulltextsearch_keyword"}), @ORM\Index(name="fulltextsearch_where", columns={"fulltextsearch_where"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\BlogBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"Result", "blogDetail"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="image_id", type="integer", nullable=true)
     */
    private $imageId;

    /**
     * @var integer
     *
     * @ORM\Column(name="thumb_id", type="integer", nullable=true)
     */
    private $thumbId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cover_id", type="integer", nullable=true)
     */
    private $coverId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entered", type="datetime", nullable=false)
     * @Serializer\Groups({"Result", "blogDetail"})
     */
    private $entered = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Serializer\Groups({"Result", "blogDetail"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=255, nullable=false)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="friendly_url", type="string", length=255, nullable=false)
     */
    private $friendlyUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="image_caption", type="string", length=255, nullable=false)
     */
    private $imageCaption;

    /**
     * @var string
     *
     * @ORM\Column(name="thumb_caption", type="string", length=255, nullable=false)
     */
    private $thumbCaption;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="text", nullable=false)
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
     * @ORM\Column(name="seo_abstract", type="string", length=255, nullable=false)
     */
    private $seoAbstract;

    /**
     * @var string
     *
     * @ORM\Column(name="fulltextsearch_keyword", type="text", nullable=false)
     */
    private $fulltextsearchKeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="fulltextsearch_where", type="text", nullable=false)
     */
    private $fulltextsearchWhere;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     * @Serializer\Groups({"Result", "blogDetail"})
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_views", type="integer", nullable=false)
     */
    private $numberViews = '0';

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\BlogBundle\Entity\BlogCategory1", mappedBy="post")
     * @Serializer\Groups({"blogDetail"})
     * @Serializer\Type("array")
     */
    private $categories;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\BlogBundle\Entity\Comments", mappedBy="post")
     * @ORM\JoinColumn(name="id", referencedColumnName="post_id")
     */
    private $comments;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="cover_id", referencedColumnName="id")
     */
    private $coverImage;

    /**
     * @Serializer\Groups({"Result", "blogDetail"})
     * @var string
     */
    private $imageUrl;

    /**
     * @var string
     * @Serializer\Groups({"Result"})
     */
    private $type;

    /**
     * @var string
     * @Serializer\Groups({"blogDetail"})
     */
    private $detailUrl;

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
     * Set imageId
     *
     * @param integer $imageId
     * @return Post
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
     * @return Post
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Post
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
     * @return Post
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
     * Set title
     *
     * @param string $title
     * @return Post
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
     * Set seoTitle
     *
     * @param string $seoTitle
     * @return Post
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    /**
     * Get seoTitle
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * Set friendlyUrl
     *
     * @param string $friendlyUrl
     * @return Post
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
     * Set imageCaption
     *
     * @param string $imageCaption
     * @return Post
     */
    public function setImageCaption($imageCaption)
    {
        $this->imageCaption = $imageCaption;

        return $this;
    }

    /**
     * Get imageCaption
     *
     * @return string
     */
    public function getImageCaption()
    {
        return $this->imageCaption;
    }

    /**
     * Set thumbCaption
     *
     * @param string $thumbCaption
     * @return Post
     */
    public function setThumbCaption($thumbCaption)
    {
        $this->thumbCaption = $thumbCaption;

        return $this;
    }

    /**
     * Get thumbCaption
     *
     * @return string
     */
    public function getThumbCaption()
    {
        return $this->thumbCaption;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return Post
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
     * @return Post
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
     * Set seoAbstract
     *
     * @param string $seoAbstract
     * @return Post
     */
    public function setSeoAbstract($seoAbstract)
    {
        $this->seoAbstract = $seoAbstract;

        return $this;
    }

    /**
     * Get seoAbstract
     *
     * @return string
     */
    public function getSeoAbstract()
    {
        return $this->seoAbstract;
    }

    /**
     * Set fulltextsearchKeyword
     *
     * @param string $fulltextsearchKeyword
     * @return Post
     */
    public function setFulltextsearchKeyword($fulltextsearchKeyword)
    {
        $this->fulltextsearchKeyword = $fulltextsearchKeyword;

        return $this;
    }

    /**
     * Get fulltextsearchKeyword
     *
     * @return string
     */
    public function getFulltextsearchKeyword()
    {
        return $this->fulltextsearchKeyword;
    }

    /**
     * Set fulltextsearchWhere
     *
     * @param string $fulltextsearchWhere
     * @return Post
     */
    public function setFulltextsearchWhere($fulltextsearchWhere)
    {
        $this->fulltextsearchWhere = $fulltextsearchWhere;

        return $this;
    }

    /**
     * Get fulltextsearchWhere
     *
     * @return string
     */
    public function getFulltextsearchWhere()
    {
        return $this->fulltextsearchWhere;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
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
     * Set status
     *
     * @param string $status
     * @return Post
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
     * Set numberViews
     *
     * @param integer $numberViews
     * @return Post
     */
    public function setNumberViews($numberViews)
    {
        $this->numberViews = $numberViews;

        return $this;
    }

    /**
     * Get numberViews
     *
     * @return integer
     */
    public function getNumberViews()
    {
        return $this->numberViews;
    }

    /**
     * Set legacyId
     *
     * @param string $legacyId
     * @return Post
     */
    public function setLegacyId($legacyId)
    {
        $this->legacyId = $legacyId;

        return $this;
    }

    /**
     * Get legacyId
     *
     * @return string
     */
    public function getLegacyId()
    {
        return $this->legacyId;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
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
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add categories
     *
     * @param \ArcaSolutions\BlogBundle\Entity\Blogcategory $categories
     * @return Post
     */
    public function addCategory(\ArcaSolutions\BlogBundle\Entity\Blogcategory $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \ArcaSolutions\BlogBundle\Entity\Blogcategory $categories
     */
    public function removeCategory(\ArcaSolutions\BlogBundle\Entity\Blogcategory $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @param int $coverId
     *
     * @return Post
     */
    public function setCoverId($coverId)
    {
        $this->coverId = $coverId;

        return $this;
    }

    /**
     * @return int
     */
    public function getCoverId()
    {
        return $this->coverId;
    }

    /**
     * @param mixed $coverImage
     *
     * @return Post
     */
    public function setCoverImage($coverImage)
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoverImage()
    {
        return $this->coverImage;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getDetailUrl()
    {
        return $this->detailUrl;
    }

    /**
     * @param string $detailUrl
     */
    public function setDetailUrl($detailUrl)
    {
        $this->detailUrl = $detailUrl;
    }

}
