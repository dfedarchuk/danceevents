<?php

namespace ArcaSolutions\ImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GalleryImage
 *
 * @ORM\Table(name="Gallery_Image", indexes={@ORM\Index(name="gallery_id", columns={"gallery_id"})})
 * @ORM\Entity
 */
class GalleryImage
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
     * @ORM\Column(name="gallery_id", type="integer", nullable=false)
     */
    private $galleryId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="image_id", type="integer", nullable=true)
     */
    private $imageId;

    /**
     * @var string
     *
     * @ORM\Column(name="image_caption", type="string", length=255, nullable=true)
     */
    private $imageCaption;

    /**
     * @var integer
     *
     * @ORM\Column(name="thumb_id", type="integer", nullable=true)
     */
    private $thumbId;

    /**
     * @var string
     *
     * @ORM\Column(name="thumb_caption", type="string", length=255, nullable=true)
     */
    private $thumbCaption;

    /**
     * @var string
     *
     * @ORM\Column(name="image_default", type="string", length=1, nullable=false)
     */
    private $imageDefault;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", nullable=true)
     */
    private $order;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

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
     * Set galleryId
     *
     * @param integer $galleryId
     * @return GalleryImage
     */
    public function setGalleryId($galleryId)
    {
        $this->galleryId = $galleryId;

        return $this;
    }

    /**
     * Get galleryId
     *
     * @return integer
     */
    public function getGalleryId()
    {
        return $this->galleryId;
    }

    /**
     * Set imageId
     *
     * @param integer $imageId
     * @return GalleryImage
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
     * Set imageCaption
     *
     * @param string $imageCaption
     * @return GalleryImage
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
     * Set thumbId
     *
     * @param integer $thumbId
     * @return GalleryImage
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
     * Set thumbCaption
     *
     * @param string $thumbCaption
     * @return GalleryImage
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
     * Set imageDefault
     *
     * @param string $imageDefault
     * @return GalleryImage
     */
    public function setImageDefault($imageDefault)
    {
        $this->imageDefault = $imageDefault;

        return $this;
    }

    /**
     * Get imageDefault
     *
     * @return string
     */
    public function getImageDefault()
    {
        return $this->imageDefault;
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return GalleryImage
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
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
}
