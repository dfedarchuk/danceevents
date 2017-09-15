<?php

namespace ArcaSolutions\WysiwygBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="Page")
 * @ORM\Entity(repositoryClass="ArcaSolutions\WysiwygBundle\Repository\PageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Page
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
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", nullable=true)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_key", type="string", nullable=true)
     */
    private $metaKey;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\WysiwygBundle\Entity\PageWidget", mappedBy="page", cascade={"remove"})
     * @ORM\JoinColumn(name="id", referencedColumnName="page_id")
     * @ORM\OrderBy({"order" = "ASC"})
     */
    private $pageWidgets;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sitemap", type="boolean", nullable=false, options={"default" = false})
     */
    private $sitemap = false;

    /**
     * @var string
     *
     * @ORM\Column(name="custom_tag", type="string", nullable=true)
     */
    private $customTag;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagetype_id", type="integer", nullable=false)
     */
    private $pageTypeId;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\WysiwygBundle\Entity\PageType", inversedBy="pages")
     * @ORM\JoinColumn(name="pagetype_id", referencedColumnName="id")
     */
    private $pageType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * Gets triggered on update
     *
     * @ORM\PreUpdate()
     */
    public function updatedTimestamps()
    {
        $this->updated = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return string
     */
    public function getMetaKey()
    {
        return $this->metaKey;
    }

    /**
     * @param string $metaKey
     */
    public function setMetaKey($metaKey)
    {
        $this->metaKey = $metaKey;
    }

    /**
     * @return mixed
     */
    public function getPageWidgets()
    {
        return $this->pageWidgets;
    }

    /**
     * @param mixed $pageWidgets
     */
    public function setPageWidgets($pageWidgets)
    {
        $this->pageWidgets = $pageWidgets;
    }

    /**
     * @return boolean
     */
    public function isSitemap()
    {
        return $this->sitemap;
    }

    /**
     * @param boolean $sitemap
     */
    public function setSitemap($sitemap)
    {
        $this->sitemap = $sitemap;
    }

    /**
     * @return string
     */
    public function getCustomTag()
    {
        return $this->customTag;
    }

    /**
     * @param string $customTag
     */
    public function setCustomTag($customTag)
    {
        $this->customTag = $customTag;
    }

    /**
     * @return int
     */
    public function getPageTypeId()
    {
        return $this->pageTypeId;
    }

    /**
     * @param int $pageTypeId
     */
    public function setPageTypeId($pageTypeId)
    {
        $this->pageTypeId = $pageTypeId;
    }

    /**
     * @return PageType
     */
    public function getPageType()
    {
        return $this->pageType;
    }

    /**
     * @param PageType $pageType
     */
    public function setPageType(PageType $pageType)
    {
        $this->pageType = $pageType;
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
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Page
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }


}
