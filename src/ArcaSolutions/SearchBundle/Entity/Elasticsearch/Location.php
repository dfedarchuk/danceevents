<?php

namespace ArcaSolutions\SearchBundle\Entity\Elasticsearch;


use Elastica\Result;

class Location
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
     * @var int
     */
    private $level;
    /**
     * @var string
     */
    private $parentId;
    /**
     * @var array
     */
    private $subLocationId;
    /**
     * @var string
     */
    private $title;
    /**
     * @var array
     */
    private $suggest;
    /**
     * @var array
     */
    private $seo;
    /**
     * @var int
     */
    private $count;

    function __construct($id, $friendlyUrl, $level, $parentId, $subLocationId, $title, $suggest, $seo)
    {
        $this->id = $id;
        $this->friendlyUrl = $friendlyUrl;
        $this->level = $level;
        $this->parentId = $parentId;
        $this->subLocationId = $subLocationId;
        $this->title = $title;
        $this->suggest = $suggest;
        $this->seo = $seo;
    }

    /**
     * @param $result Result
     * @return Location
     */
    public static function buildFromElasticResult($result)
    {
        $return = null;

        /* @var $id string */
        /* @var $title string */
        /* @var $level int */
        /* @var $friendlyUrl string */
        /* @var $parentId string */
        /* @var $subLocationId array */
        /* @var $suggest array */
        /* @var $seo array */
        extract($result->getData());

        if ($id = $result->getId()) {
            $return = new Location($id, $friendlyUrl, $level, $parentId, (array)$subLocationId, $title, $suggest, $seo);
        }

        return $return;
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
     */
    public function setId($id)
    {
        $this->id = $id;
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
     */
    public function setFriendlyUrl($friendlyUrl)
    {
        $this->friendlyUrl = $friendlyUrl;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
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
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return array
     */
    public function getSubLocationId()
    {
        return $this->subLocationId;
    }

    /**
     * @param array $subLocationId
     */
    public function setSubLocationId($subLocationId)
    {
        $this->subLocationId = $subLocationId;
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
     * @return array
     */
    public function getSuggest()
    {
        return $this->suggest;
    }

    /**
     * @param array $suggest
     */
    public function setSuggest($suggest)
    {
        $this->suggest = $suggest;
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
     */
    public function setSeo($seo)
    {
        $this->seo = $seo;
    }

    public function toArray()
    {
        return [
            '_id'           => $this->id,
            'title'         => $this->title,
            'friendlyUrl'   => $this->friendlyUrl,
            'parentId'      => $this->parentId,
            'subLocationId' => $this->subLocationId,
            'level'         => $this->level,
            'suggest'       => $this->suggest,
            'seo'           => $this->seo,
        ];
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
     * @return Location
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }
}
