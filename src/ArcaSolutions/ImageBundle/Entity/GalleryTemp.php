<?php

namespace ArcaSolutions\ImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GalleryTemp
 *
 * @ORM\Table(name="Gallery_Temp")
 * @ORM\Entity
 */
class GalleryTemp
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
     * @ORM\Column(name="image_id", type="integer", nullable=false)
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
     * @ORM\Column(name="thumb_id", type="integer", nullable=false)
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
     * @var string
     *
     * @ORM\Column(name="sess_id", type="string", length=255, nullable=false)
     */
    private $sessId;



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
     * @return GalleryTemp
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
     * @return GalleryTemp
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
     * @return GalleryTemp
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
     * @return GalleryTemp
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
     * @return GalleryTemp
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
     * Set sessId
     *
     * @param string $sessId
     * @return GalleryTemp
     */
    public function setSessId($sessId)
    {
        $this->sessId = $sessId;

        return $this;
    }

    /**
     * Get sessId
     *
     * @return string 
     */
    public function getSessId()
    {
        return $this->sessId;
    }
}
