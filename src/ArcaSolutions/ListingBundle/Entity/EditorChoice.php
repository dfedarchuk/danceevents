<?php

namespace ArcaSolutions\ListingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * EditorChoice
 *
 * @ORM\Table(name="Editor_Choice", indexes={@ORM\Index(name="available", columns={"available"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\ListingBundle\Repository\EditorChoiceRepository")
 */
class EditorChoice
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
     * @ORM\Column(name="available", type="string", length=1, nullable=false)
     */
    private $available = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="image_id", type="integer", nullable=false)
     */
    private $imageId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Serializer\Groups({"listingDetail"})
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\ImageBundle\Entity\Image", fetch="EAGER")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     * @Serializer\Groups("listingDetail")
     */
    private $image;

    /**
     * @Serializer\SerializedName("icon")
     * @Serializer\Groups({"listingDetail"})
     *
     * @var
     */
    private $imageAPI;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\ListingBundle\Entity\ListingChoice", mappedBy="editorChoice")
     */
    private $listingChoice;

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
     * Set available
     *
     * @param string $available
     * @return EditorChoice
     */
    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available
     *
     * @return string
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set imageId
     *
     * @param integer $imageId
     * @return EditorChoice
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
     * Set name
     *
     * @param string $name
     * @return EditorChoice
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     *
     * @return EditorChoice
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @param mixed $listingChoice
     * @return EditorChoice
     */
    public function setListingChoice($listingChoice)
    {
        $this->listingChoice = $listingChoice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getListingChoice()
    {
        return $this->listingChoice;
    }

    /**
     * @return mixed
     */
    public function getImageAPI()
    {
        return $this->imageAPI;
    }

    /**
     * @param mixed $imageAPI
     */
    public function setImageAPI($imageAPI)
    {
        $this->imageAPI = $imageAPI;
    }
}
