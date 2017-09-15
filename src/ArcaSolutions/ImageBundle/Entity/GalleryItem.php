<?php

namespace ArcaSolutions\ImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GalleryItem
 *
 * @ORM\Table(name="Gallery_Item", indexes={@ORM\Index(name="item_type", columns={"item_type"}), @ORM\Index(name="item_id", columns={"item_id"}), @ORM\Index(name="gallery_id", columns={"gallery_id"})})
 * @ORM\Entity
 */
class GalleryItem
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
     * @ORM\Column(name="item_type", type="string", length=20, nullable=false)
     */
    private $itemType;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer", nullable=false)
     */
    private $itemId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="gallery_id", type="integer", nullable=false)
     */
    private $galleryId = '0';



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
     * Set itemType
     *
     * @param string $itemType
     * @return GalleryItem
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;

        return $this;
    }

    /**
     * Get itemType
     *
     * @return string
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * Set itemId
     *
     * @param integer $itemId
     * @return GalleryItem
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set galleryId
     *
     * @param integer $galleryId
     * @return GalleryItem
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
}
