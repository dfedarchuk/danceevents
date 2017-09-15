<?php

namespace ArcaSolutions\ApiBundle\Entity;


use JMS\Serializer\Annotation as Serializer;

class Suggest
{
    /**
     * @var integer
     * @Serializer\Groups({"Suggest"})
     */
    private $id;

    /**
     * @var string
     * @Serializer\Groups({"Suggest"})
     */
    private $title;

    /**
     * @var string
     * @Serializer\Groups({"Suggest"})
     */
    private $friendlyUrl;

    /**
     * @var string
     * @Serializer\Groups({"Suggest"})
     */
    private $type;

    function __construct($data)
    {
        $this->title = $data['text'];

        $this->id = isset($data['payload']['id']) ? (int)$data['payload']['id'] : null;
        $this->friendlyUrl = isset($data['payload']['friendlyUrl']) ? $data['payload']['friendlyUrl'] : null;
        $this->type = isset($data['payload']['type']) ? $data['payload']['type'] : null;
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }


}