<?php


namespace ArcaSolutions\ApiBundle\Entity;


use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

class Sort
{
    /**
     * @var
     * @Groups({"Result"})
     */
    private $label;
    /**
     * @var
     * @Groups({"Result"})
     */
    private $value;
    /**
     * @var
     * @Groups({"Result"})
     */
    private $type;
    /**
     * @var
     * @Groups({"Result"})
     */
    private $isSelected;

    /**
     * Sort constructor.
     * @param $label
     * @param $value
     */
    public function __construct($label, $value, $type, $isSelected)
    {
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;
        $this->isSelected = $isSelected;
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

    /**
     * @return mixed
     */
    public function getIsSelected()
    {
        return $this->isSelected;
    }

    /**
     * @param mixed $isSelected
     */
    public function setIsSelected($isSelected)
    {
        $this->isSelected = $isSelected;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


}
