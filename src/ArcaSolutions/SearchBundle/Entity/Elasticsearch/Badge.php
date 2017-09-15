<?php

namespace ArcaSolutions\SearchBundle\Entity\Elasticsearch;

use Elastica\Result;

class Badge
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var boolean
     */
    private $available;
    /**
     * @var string
     */
    private $image;
    /**
     * @var string
     */
    private $name;

    /**
     * Badge constructor.
     * @param string $id
     * @param bool $available
     * @param string $image
     * @param string $name
     */
    public function __construct($id, $available, $image, $name)
    {
        $this->id = $id;
        $this->available = $available;
        $this->image = $image;
        $this->name = $name;
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
     * @return boolean
     */
    public function isAvailable()
    {
        return $this->available;
    }

    /**
     * @param boolean $available
     */
    public function setAvailable($available)
    {
        $this->available = $available;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param $result Result
     * @return Badge
     */
    public static function buildFromElasticResult($result)
    {
        $return = null;

        /* @var $id string */
        /* @var $available boolean */
        /* @var $image string */
        /* @var $name string */
        extract($result->getData());

        if ($id = $result->getId()) {
            $return = new Badge($id, $available, $image, $name);
        }

        return $return;
    }
}
