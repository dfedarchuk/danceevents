<?php

namespace ArcaSolutions\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use JMS\Serializer\Annotation as Serializer;

/**
 * Article
 *
 * @ORM\Table(name="Article", indexes={@ORM\Index(name="title", columns={"title"}), @ORM\Index(name="publication_date", columns={"publication_date"}), @ORM\Index(name="status", columns={"status"}), @ORM\Index(name="level", columns={"level"}), @ORM\Index(name="account_id", columns={"account_id"}), @ORM\Index(name="friendly_url", columns={"friendly_url"}), @ORM\Index(name="entered", columns={"entered"}), @ORM\Index(name="updated", columns={"updated"}), @ORM\Index(name="cat_1_id", columns={"cat_1_id"}), @ORM\Index(name="parcat_1_level1_id", columns={"parcat_1_level1_id"}), @ORM\Index(name="cat_2_id", columns={"cat_2_id"}), @ORM\Index(name="parcat_2_level1_id", columns={"parcat_2_level1_id"}), @ORM\Index(name="cat_3_id", columns={"cat_3_id"}), @ORM\Index(name="parcat_3_level1_id", columns={"parcat_3_level1_id"}), @ORM\Index(name="cat_4_id", columns={"cat_4_id"}), @ORM\Index(name="parcat_4_level1_id", columns={"parcat_4_level1_id"}), @ORM\Index(name="cat_5_id", columns={"cat_5_id"}), @ORM\Index(name="parcat_5_level1_id", columns={"parcat_5_level1_id"}), @ORM\Index(name="fulltextsearch_keyword", columns={"fulltextsearch_keyword"}), @ORM\Index(name="fulltextsearch_where", columns={"fulltextsearch_where"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\ArticleBundle\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"Result", "articleDetail", "reviewItem"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer", nullable=true)
     */
    private $accountId;

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
     */
    private $entered = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="renewal_date", type="date", nullable=false)
     */
    private $renewalDate = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="discount_id", type="string", length=10, nullable=false)
     */
    private $discountId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Serializer\Groups({"Result", "articleDetail", "reviewItem"})
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
     * @ORM\Column(name="author", type="string", length=100, nullable=false)
     * @Serializer\Groups({"Result", "articleDetail"})
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="author_url", type="string", length=255, nullable=false)
     * @Serializer\Groups({"Result", "articleDetail"})
     */
    private $authorUrl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publication_date", type="date", nullable=false)
     * @Serializer\Groups({"Result", "articleDetail"})
     */
    private $publicationDate = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="string", length=255, nullable=false)
     * @Serializer\Groups({"Result", "articleDetail"})
     */
    private $abstract;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_abstract", type="string", length=255, nullable=false)
     */
    private $seoAbstract;

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
     * @Serializer\Groups("articleDetail")
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
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="number_views", type="integer", nullable=false)
     */
    private $numberViews = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="avg_review", type="integer", nullable=false)
     * @Serializer\Groups({"Result", "articleDetail"})
     * @Serializer\SerializedName("rating")
     */
    private $avgReview = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_1_id", type="integer", nullable=true, unique=false)
     */
    private $cat1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_1_level1_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat1Level1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_1_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat1Level2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_1_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat1Level3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_1_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat1Level4Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_2_id", type="integer", nullable=true, unique=false)
     */
    private $cat2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_2_level1_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat2Level1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_2_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat2Level2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_2_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat2Level3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_2_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat2Level4Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_3_id", type="integer", nullable=true, unique=false)
     */
    private $cat3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_3_level1_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat3Level1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_3_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat3Level2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_3_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat3Level3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_3_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat3Level4Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_4_id", type="integer", nullable=true, unique=false)
     */
    private $cat4Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_4_level1_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat4Level1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_4_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat4Level2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_4_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat4Level3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_4_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat4Level4Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_5_id", type="integer", unique=false, nullable=true)
     */
    private $cat5Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_5_level1_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat5Level1Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_5_level2_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat5Level2Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_5_level3_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat5Level3Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcat_5_level4_id", type="integer", nullable=false, options={"default"="0"})
     */
    private $parcat5Level4Id;

    /**
     * @var integer
     *
     * @ORM\Column(name="package_id", type="integer", nullable=false)
     */
    private $packageId;

    /**
     * @var string
     *
     * @ORM\Column(name="package_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $packagePrice;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ArticleBundle\Entity\Articlelevel")
     * @ORM\JoinColumn(name="level", referencedColumnName="value")
     */
    private $levelObj;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\WebBundle\Entity\Accountprofilecontact", inversedBy="articles", fetch="EAGER")
     * @JoinColumn(name="account_id", referencedColumnName="account_id", onDelete="CASCADE")
     */
    private $account;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ArticleBundle\Entity\Articlecategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_1_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category1;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ArticleBundle\Entity\Articlecategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_2_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category2;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ArticleBundle\Entity\Articlecategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_3_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category3;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ArticleBundle\Entity\Articlecategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_4_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category4;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ArticleBundle\Entity\Articlecategory", fetch="EAGER")
     * @ORM\JoinColumn(name="cat_5_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category5;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="cover_id", referencedColumnName="id")
     */
    private $coverImage;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

    /**
     * @Serializer\Groups({"Result"})
     * @var
     */
    private $imageUrl;

    /**
     * @Serializer\SerializedName("gallery")
     * @Serializer\Groups({"articleDetail"})
     * @var array
     */
    private $galleryAPI;

    /**
     * @var integer
     * @Serializer\Groups({"articleDetail"})
     */
    private $reviewsTotal;

    /**
     * @var string
     * @Serializer\Groups({"Result", "reviewItem"})
     */
    private $type;

    /**
     * @var integer
     * @Serializer\Groups({"articleDetail", "Result"})
     */
    private $favoriteId;

    /**
     * @var string
     * @Serializer\Groups({"articleDetail"})
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
     * Set accountId
     *
     * @param integer $accountId
     * @return Article
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set imageId
     *
     * @param integer $imageId
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * Set renewalDate
     *
     * @param \DateTime $renewalDate
     * @return Article
     */
    public function setRenewalDate($renewalDate)
    {
        $this->renewalDate = $renewalDate;

        return $this;
    }

    /**
     * Get renewalDate
     *
     * @return \DateTime
     */
    public function getRenewalDate()
    {
        return $this->renewalDate;
    }

    /**
     * Set discountId
     *
     * @param string $discountId
     * @return Article
     */
    public function setDiscountId($discountId)
    {
        $this->discountId = $discountId;

        return $this;
    }

    /**
     * Get discountId
     *
     * @return string
     */
    public function getDiscountId()
    {
        return $this->discountId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * Set author
     *
     * @param string $author
     * @return Article
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set authorUrl
     *
     * @param string $authorUrl
     * @return Article
     */
    public function setAuthorUrl($authorUrl)
    {
        $this->authorUrl = $authorUrl;

        return $this;
    }

    /**
     * Get authorUrl
     *
     * @return string
     */
    public function getAuthorUrl()
    {
        return $this->authorUrl;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     * @return Article
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return \DateTime
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     * @return Article
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set seoAbstract
     *
     * @param string $seoAbstract
     * @return Article
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
     * Set keywords
     *
     * @param string $keywords
     * @return Article
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
     * @return Article
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
     * Set fulltextsearchKeyword
     *
     * @param string $fulltextsearchKeyword
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * Set level
     *
     * @param integer $level
     * @return Article
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
     * Set numberViews
     *
     * @param integer $numberViews
     * @return Article
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
     * Set avgReview
     *
     * @param integer $avgReview
     * @return Article
     */
    public function setAvgReview($avgReview)
    {
        $this->avgReview = $avgReview;

        return $this;
    }

    /**
     * Get avgReview
     *
     * @return integer
     */
    public function getAvgReview()
    {
        return $this->avgReview;
    }

    /**
     * Set cat1Id
     *
     * @param integer $cat1Id
     * @return Article
     */
    public function setCat1Id($cat1Id)
    {
        $this->cat1Id = $cat1Id;

        return $this;
    }

    /**
     * Get cat1Id
     *
     * @return integer
     */
    public function getCat1Id()
    {
        return $this->cat1Id;
    }

    /**
     * Set parcat1Level1Id
     *
     * @param integer $parcat1Level1Id
     * @return Article
     */
    public function setParcat1Level1Id($parcat1Level1Id)
    {
        $this->parcat1Level1Id = $parcat1Level1Id;

        return $this;
    }

    /**
     * Get parcat1Level1Id
     *
     * @return integer
     */
    public function getParcat1Level1Id()
    {
        return $this->parcat1Level1Id;
    }

    /**
     * Set parcat1Level2Id
     *
     * @param integer $parcat1Level2Id
     * @return Article
     */
    public function setParcat1Level2Id($parcat1Level2Id)
    {
        $this->parcat1Level2Id = $parcat1Level2Id;

        return $this;
    }

    /**
     * Get parcat1Level2Id
     *
     * @return integer
     */
    public function getParcat1Level2Id()
    {
        return $this->parcat1Level2Id;
    }

    /**
     * Set parcat1Level3Id
     *
     * @param integer $parcat1Level3Id
     * @return Article
     */
    public function setParcat1Level3Id($parcat1Level3Id)
    {
        $this->parcat1Level3Id = $parcat1Level3Id;

        return $this;
    }

    /**
     * Get parcat1Level3Id
     *
     * @return integer
     */
    public function getParcat1Level3Id()
    {
        return $this->parcat1Level3Id;
    }

    /**
     * Set parcat1Level4Id
     *
     * @param integer $parcat1Level4Id
     * @return Article
     */
    public function setParcat1Level4Id($parcat1Level4Id)
    {
        $this->parcat1Level4Id = $parcat1Level4Id;

        return $this;
    }

    /**
     * Get parcat1Level4Id
     *
     * @return integer
     */
    public function getParcat1Level4Id()
    {
        return $this->parcat1Level4Id;
    }

    /**
     * Set cat2Id
     *
     * @param integer $cat2Id
     * @return Article
     */
    public function setCat2Id($cat2Id)
    {
        $this->cat2Id = $cat2Id;

        return $this;
    }

    /**
     * Get cat2Id
     *
     * @return integer
     */
    public function getCat2Id()
    {
        return $this->cat2Id;
    }

    /**
     * Set parcat2Level1Id
     *
     * @param integer $parcat2Level1Id
     * @return Article
     */
    public function setParcat2Level1Id($parcat2Level1Id)
    {
        $this->parcat2Level1Id = $parcat2Level1Id;

        return $this;
    }

    /**
     * Get parcat2Level1Id
     *
     * @return integer
     */
    public function getParcat2Level1Id()
    {
        return $this->parcat2Level1Id;
    }

    /**
     * Set parcat2Level2Id
     *
     * @param integer $parcat2Level2Id
     * @return Article
     */
    public function setParcat2Level2Id($parcat2Level2Id)
    {
        $this->parcat2Level2Id = $parcat2Level2Id;

        return $this;
    }

    /**
     * Get parcat2Level2Id
     *
     * @return integer
     */
    public function getParcat2Level2Id()
    {
        return $this->parcat2Level2Id;
    }

    /**
     * Set parcat2Level3Id
     *
     * @param integer $parcat2Level3Id
     * @return Article
     */
    public function setParcat2Level3Id($parcat2Level3Id)
    {
        $this->parcat2Level3Id = $parcat2Level3Id;

        return $this;
    }

    /**
     * Get parcat2Level3Id
     *
     * @return integer
     */
    public function getParcat2Level3Id()
    {
        return $this->parcat2Level3Id;
    }

    /**
     * Set parcat2Level4Id
     *
     * @param integer $parcat2Level4Id
     * @return Article
     */
    public function setParcat2Level4Id($parcat2Level4Id)
    {
        $this->parcat2Level4Id = $parcat2Level4Id;

        return $this;
    }

    /**
     * Get parcat2Level4Id
     *
     * @return integer
     */
    public function getParcat2Level4Id()
    {
        return $this->parcat2Level4Id;
    }

    /**
     * Set cat3Id
     *
     * @param integer $cat3Id
     * @return Article
     */
    public function setCat3Id($cat3Id)
    {
        $this->cat3Id = $cat3Id;

        return $this;
    }

    /**
     * Get cat3Id
     *
     * @return integer
     */
    public function getCat3Id()
    {
        return $this->cat3Id;
    }

    /**
     * Set parcat3Level1Id
     *
     * @param integer $parcat3Level1Id
     * @return Article
     */
    public function setParcat3Level1Id($parcat3Level1Id)
    {
        $this->parcat3Level1Id = $parcat3Level1Id;

        return $this;
    }

    /**
     * Get parcat3Level1Id
     *
     * @return integer
     */
    public function getParcat3Level1Id()
    {
        return $this->parcat3Level1Id;
    }

    /**
     * Set parcat3Level2Id
     *
     * @param integer $parcat3Level2Id
     * @return Article
     */
    public function setParcat3Level2Id($parcat3Level2Id)
    {
        $this->parcat3Level2Id = $parcat3Level2Id;

        return $this;
    }

    /**
     * Get parcat3Level2Id
     *
     * @return integer
     */
    public function getParcat3Level2Id()
    {
        return $this->parcat3Level2Id;
    }

    /**
     * Set parcat3Level3Id
     *
     * @param integer $parcat3Level3Id
     * @return Article
     */
    public function setParcat3Level3Id($parcat3Level3Id)
    {
        $this->parcat3Level3Id = $parcat3Level3Id;

        return $this;
    }

    /**
     * Get parcat3Level3Id
     *
     * @return integer
     */
    public function getParcat3Level3Id()
    {
        return $this->parcat3Level3Id;
    }

    /**
     * Set parcat3Level4Id
     *
     * @param integer $parcat3Level4Id
     * @return Article
     */
    public function setParcat3Level4Id($parcat3Level4Id)
    {
        $this->parcat3Level4Id = $parcat3Level4Id;

        return $this;
    }

    /**
     * Get parcat3Level4Id
     *
     * @return integer
     */
    public function getParcat3Level4Id()
    {
        return $this->parcat3Level4Id;
    }

    /**
     * Set cat4Id
     *
     * @param integer $cat4Id
     * @return Article
     */
    public function setCat4Id($cat4Id)
    {
        $this->cat4Id = $cat4Id;

        return $this;
    }

    /**
     * Get cat4Id
     *
     * @return integer
     */
    public function getCat4Id()
    {
        return $this->cat4Id;
    }

    /**
     * Set parcat4Level1Id
     *
     * @param integer $parcat4Level1Id
     * @return Article
     */
    public function setParcat4Level1Id($parcat4Level1Id)
    {
        $this->parcat4Level1Id = $parcat4Level1Id;

        return $this;
    }

    /**
     * Get parcat4Level1Id
     *
     * @return integer
     */
    public function getParcat4Level1Id()
    {
        return $this->parcat4Level1Id;
    }

    /**
     * Set parcat4Level2Id
     *
     * @param integer $parcat4Level2Id
     * @return Article
     */
    public function setParcat4Level2Id($parcat4Level2Id)
    {
        $this->parcat4Level2Id = $parcat4Level2Id;

        return $this;
    }

    /**
     * Get parcat4Level2Id
     *
     * @return integer
     */
    public function getParcat4Level2Id()
    {
        return $this->parcat4Level2Id;
    }

    /**
     * Set parcat4Level3Id
     *
     * @param integer $parcat4Level3Id
     * @return Article
     */
    public function setParcat4Level3Id($parcat4Level3Id)
    {
        $this->parcat4Level3Id = $parcat4Level3Id;

        return $this;
    }

    /**
     * Get parcat4Level3Id
     *
     * @return integer
     */
    public function getParcat4Level3Id()
    {
        return $this->parcat4Level3Id;
    }

    /**
     * Set parcat4Level4Id
     *
     * @param integer $parcat4Level4Id
     * @return Article
     */
    public function setParcat4Level4Id($parcat4Level4Id)
    {
        $this->parcat4Level4Id = $parcat4Level4Id;

        return $this;
    }

    /**
     * Get parcat4Level4Id
     *
     * @return integer
     */
    public function getParcat4Level4Id()
    {
        return $this->parcat4Level4Id;
    }

    /**
     * Set cat5Id
     *
     * @param integer $cat5Id
     * @return Article
     */
    public function setCat5Id($cat5Id)
    {
        $this->cat5Id = $cat5Id;

        return $this;
    }

    /**
     * Get cat5Id
     *
     * @return integer
     */
    public function getCat5Id()
    {
        return $this->cat5Id;
    }

    /**
     * Set parcat5Level1Id
     *
     * @param integer $parcat5Level1Id
     * @return Article
     */
    public function setParcat5Level1Id($parcat5Level1Id)
    {
        $this->parcat5Level1Id = $parcat5Level1Id;

        return $this;
    }

    /**
     * Get parcat5Level1Id
     *
     * @return integer
     */
    public function getParcat5Level1Id()
    {
        return $this->parcat5Level1Id;
    }

    /**
     * Set parcat5Level2Id
     *
     * @param integer $parcat5Level2Id
     * @return Article
     */
    public function setParcat5Level2Id($parcat5Level2Id)
    {
        $this->parcat5Level2Id = $parcat5Level2Id;

        return $this;
    }

    /**
     * Get parcat5Level2Id
     *
     * @return integer
     */
    public function getParcat5Level2Id()
    {
        return $this->parcat5Level2Id;
    }

    /**
     * Set parcat5Level3Id
     *
     * @param integer $parcat5Level3Id
     * @return Article
     */
    public function setParcat5Level3Id($parcat5Level3Id)
    {
        $this->parcat5Level3Id = $parcat5Level3Id;

        return $this;
    }

    /**
     * Get parcat5Level3Id
     *
     * @return integer
     */
    public function getParcat5Level3Id()
    {
        return $this->parcat5Level3Id;
    }

    /**
     * Set parcat5Level4Id
     *
     * @param integer $parcat5Level4Id
     * @return Article
     */
    public function setParcat5Level4Id($parcat5Level4Id)
    {
        $this->parcat5Level4Id = $parcat5Level4Id;

        return $this;
    }

    /**
     * Get parcat5Level4Id
     *
     * @return integer
     */
    public function getParcat5Level4Id()
    {
        return $this->parcat5Level4Id;
    }

    /**
     * Set packageId
     *
     * @param integer $packageId
     * @return Article
     */
    public function setPackageId($packageId)
    {
        $this->packageId = $packageId;

        return $this;
    }

    /**
     * Get packageId
     *
     * @return integer
     */
    public function getPackageId()
    {
        return $this->packageId;
    }

    /**
     * Set packagePrice
     *
     * @param string $packagePrice
     * @return Article
     */
    public function setPackagePrice($packagePrice)
    {
        $this->packagePrice = $packagePrice;

        return $this;
    }

    /**
     * Get packagePrice
     *
     * @return string
     */
    public function getPackagePrice()
    {
        return $this->packagePrice;
    }

    /**
     * Get all categories related to an event
     *
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("categories")
     * @Serializer\Groups({"articleDetail"})
     *
     * @return array
     */
    public function getCategories()
    {
        $categories_array = [];

        for ($i = 1; $i <= 5; $i++) {
            if (0 < $this->{'cat' . $i . 'Id'}) {
                $cat = $this->{'category' . $i};
                if ($cat->getEnabled() == 'n')
                    continue;

                $categories_array[] = $cat;
            }
        }

        return $categories_array;
    }

    /**
     * @return mixed
     */
    public function getCategory1()
    {
        return $this->category1;
    }

    /**
     * @param mixed $category1
     */
    public function setCategory1($category1)
    {
        $this->category1 = $category1;
    }

    /**
     * @return mixed
     */
    public function getCategory2()
    {
        return $this->category2;
    }

    /**
     * @param mixed $category2
     */
    public function setCategory2($category2)
    {
        $this->category2 = $category2;
    }

    /**
     * @return mixed
     */
    public function getCategory3()
    {
        return $this->category3;
    }

    /**
     * @param mixed $category3
     */
    public function setCategory3($category3)
    {
        $this->category3 = $category3;
    }

    /**
     * @return mixed
     */
    public function getCategory4()
    {
        return $this->category4;
    }

    /**
     * @param mixed $category4
     */
    public function setCategory4($category4)
    {
        $this->category4 = $category4;
    }

    /**
     * @return mixed
     */
    public function getCategory5()
    {
        return $this->category5;
    }

    /**
     * @param mixed $category5
     */
    public function setCategory5($category5)
    {
        $this->category5 = $category5;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @param int $coverId
     *
     * @return Article
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
     * @return Article
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
    public function getLevelObj()
    {
        return $this->levelObj;
    }

    /**
     * @param mixed $levelObj
     *
     * @return $this
     */
    public function setLevelObj($levelObj)
    {
        $this->levelObj = $levelObj;

        return $this;
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
     * @param array $galleryAPI
     */
    public function setGalleryAPI($galleryAPI)
    {
        $this->galleryAPI = $galleryAPI;
    }

    /**
     * @param $reviewsTotal
     */
    public function setReviewsTotal($reviewsTotal)
    {
        $this->reviewsTotal = $reviewsTotal;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * @return Article
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return int
     */
    public function getFavoriteId()
    {
        return $this->favoriteId;
    }

    /**
     * @param int $favoriteId
     */
    public function setFavoriteId($favoriteId)
    {
        $this->favoriteId = $favoriteId;
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
