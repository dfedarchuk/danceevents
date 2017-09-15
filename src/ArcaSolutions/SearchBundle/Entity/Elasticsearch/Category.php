<?php

namespace ArcaSolutions\SearchBundle\Entity\Elasticsearch;

use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\ImageBundle\Entity\Image;
use Elastica\Result;

class Category
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $friendlyUrl;
    /**
     * @var string
     */
    private $module;
    /**
     * @var string
     */
    private $parentId;
    /**
     * @var array
     */
    private $subCategoryId;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $content;
    /**
     * @var array
     */
    private $seo;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $thumbnail;

    /**
     * @var Image
     */
    private $image;

    /**
     * @var boolean
     */
    private $enabled;

    /**
     * @var boolean
     */
    private $featured;

    /**
     * @var int
     */
    private $count = 0;

    /**
     * @var Category[]
     */
    private $children = [];

    /**
     * @param $result Result
     * @return Category
     */
    public static function buildFromElasticResult($result)
    {
        /* @var $id string */
        /* @var $content string */
        /* @var $title string */
        /* @var $module string */
        /* @var $friendlyUrl string */
        /* @var $parentId string */
        /* @var $subCategoryId array */
        /* @var $description string */
        /* @var $seo array */
        /* @var $thumbnail string */
        /* @var $enabled boolean */
        /* @var $featured boolean */
        extract($result->getData());

        if ($id = $result->getId()) {
            return Category::create()
                ->setId($id)
                ->setContent($content)
                ->setFriendlyUrl($friendlyUrl)
                ->setModule($module)
                ->setParentId($parentId)
                ->setSubCategoryId(Utility::convertStringToArray($subCategoryId, ' '))
                ->setTitle($title)
                ->setSeo($seo)
                ->setDescription($description)
                ->setThumbnail($thumbnail)
                ->setEnabled($enabled)
                ->setFeatured($featured);
        }

        return null;
    }

    /**
     * Create a category object
     * @return Category
     */
    public static function create()
    {
        return new self;
    }

    /**
     * @return string
     */
    public function getFriendlyUrl()
    {
        return $this->friendlyUrl;
    }

    /**
     * @param string $friendlyUrl
     * @return Category
     */
    public function setFriendlyUrl($friendlyUrl)
    {
        $this->friendlyUrl = $friendlyUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param string $module
     * @return Category
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return string
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param string $parentId
     * @return Category
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * @return array
     */
    public function getSubCategoryId()
    {
        return $this->subCategoryId;
    }

    /**
     * @param array $subCategoryId
     * @return Category
     */
    public function setSubCategoryId($subCategoryId)
    {
        $this->subCategoryId = $subCategoryId;

        return $this;
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
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Category
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return array
     */
    public function getSeo()
    {
        return $this->seo;
    }

    /**
     * @param array $seo
     * @return Category
     */
    public function setSeo($seo)
    {
        $this->seo = $seo;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param string $thumbnail
     * @return Category
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return Category
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Count this category and the children
     * @return int
     */
    public function getTotalCount()
    {
        $total = $this->count;

        foreach ($this->children as $child) {
            $total += $child->getTotalCount();
        }

        return $total;
    }

    /**
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param Image $image
     * @return Category
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Category[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Category $child
     * @return $this
     */
    public function addChild(Category $child)
    {
        if (!isset($this->children[$child->getId()])) {
            $this->children[$child->getId()] = $child;
        }

        return $this;
    }

    /**
     * @param Category $child
     * @return $this
     */
    public function removeChild(Category $child)
    {
        if(isset($this->children[$child->getId()])){
            unset($this->children[$child->getId()]);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return count($this->children) > 0;
    }

    public function setChildren($chilren)
    {
        $this->children = $chilren;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Category
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFeatured()
    {
        return $this->featured;
    }

    /**
     * @param bool $featured
     * @return Category
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }
}
