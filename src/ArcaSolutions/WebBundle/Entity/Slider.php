<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Slider
 *
 * @ORM\Table(name="Slider", indexes={@ORM\Index(name="order", columns={"slide_order"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\WebBundle\Repository\SliderRepository")
 */
class Slider
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
     * @ORM\Column(name="image_id", type="integer", nullable=true)
     */
    private $imageId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Serializer\Groups({"Slider"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="string", length=255, nullable=false)
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=false)
     * @Serializer\Groups({"Slider"})
     */
    private $link;

    /**
     * @var integer
     *
     * @ORM\Column(name="slide_order", type="integer", nullable=false)
     */
    private $slideOrder;

    /**
     * @var string
     *
     * @ORM\Column(name="target", type="string", length=10, nullable=false)
     */
    private $target = 'self';

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EXTRA_LAZY", cascade={"remove"}, fetch="EAGER")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="area", type="string", length=15, nullable=false, options={"default" = "web"})
     */
    private $area = 'web';

    /**
     * @var string
     * @Serializer\Groups({"Slider"})
     * @Serializer\SerializedName("image_url")
     * @Serializer\Type("string")
     */
    private $imagePath;

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
     * @return Slider
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
     * Set title
     *
     * @param string $title
     * @return Slider
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
     * Set summary
     *
     * @param string $summary
     * @return Slider
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set alternativeText
     *
     * @param string $alternativeText
     * @return Slider
     */
    public function setAlternativeText($alternativeText)
    {
        $this->alternativeText = $alternativeText;

        return $this;
    }

    /**
     * Get alternativeText
     *
     * @return string
     */
    public function getAlternativeText()
    {
        return $this->alternativeText;
    }

    /**
     * Set titleText
     *
     * @param string $titleText
     * @return Slider
     */
    public function setTitleText($titleText)
    {
        $this->titleText = $titleText;

        return $this;
    }

    /**
     * Get titleText
     *
     * @return string
     */
    public function getTitleText()
    {
        return $this->titleText;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Slider
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set slideOrder
     *
     * @param integer $slideOrder
     * @return Slider
     */
    public function setSlideOrder($slideOrder)
    {
        $this->slideOrder = $slideOrder;

        return $this;
    }

    /**
     * Get slideOrder
     *
     * @return integer
     */
    public function getSlideOrder()
    {
        return $this->slideOrder;
    }

    /**
     * Set target
     *
     * @param string $target
     * @return Slider
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Get image
     *
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param \ArcaSolutions\ImageBundle\Entity\Image $image
     * @return Slider
     */
    public function setImage(\ArcaSolutions\ImageBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Set area
     *
     * @param string $area
     * @return Slider
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }
}
