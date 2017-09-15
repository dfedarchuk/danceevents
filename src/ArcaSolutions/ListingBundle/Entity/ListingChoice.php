<?php

namespace ArcaSolutions\ListingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * ListingChoice
 *
 * @ORM\Table(name="Listing_Choice", indexes={@ORM\Index(name="EditorChoice_has_Listing_FKIndex1", columns={"editor_choice_id"}), @ORM\Index(name="EditorChoice_has_Listing_FKIndex2", columns={"listing_id"})})
 * @ORM\Entity(repositoryClass="ListingChoiceRepository")
 */
class ListingChoice
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
     * @ORM\Column(name="editor_choice_id", type="integer", nullable=false)
     */
    private $editorChoiceId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="listing_id", type="integer", nullable=false)
     */
    private $listingId = '0';

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ListingBundle\Entity\Listing", inversedBy="choices")
     * @ORM\JoinColumn(name="listing_id", referencedColumnName="id")
     */
    private $listing;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ListingBundle\Entity\EditorChoice", inversedBy="listingChoice")
     * @ORM\JoinColumn(name="editor_choice_id", referencedColumnName="id")
     * @Serializer\Groups({"listingDetail"})
     * @Serializer\SerializedName("badge")
     */
    private $editorChoice;

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
     * Set editorChoiceId
     *
     * @param integer $editorChoiceId
     * @return ListingChoice
     */
    public function setEditorChoiceId($editorChoiceId)
    {
        $this->editorChoiceId = $editorChoiceId;

        return $this;
    }

    /**
     * Get editorChoiceId
     *
     * @return integer
     */
    public function getEditorChoiceId()
    {
        return $this->editorChoiceId;
    }

    /**
     * Set listingId
     *
     * @param integer $listingId
     * @return ListingChoice
     */
    public function setListingId($listingId)
    {
        $this->listingId = $listingId;

        return $this;
    }

    /**
     * Get listingId
     *
     * @return integer
     */
    public function getListingId()
    {
        return $this->listingId;
    }

    /**
     * @param mixed $listing
     * @return ListingChoice
     */
    public function setListing($listing)
    {
        $this->listing = $listing;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getListing()
    {
        return $this->listing;
    }

    /**
     * @param mixed $editorChoice
     * @return ListingChoice
     */
    public function setEditorChoice($editorChoice)
    {
        $this->editorChoice = $editorChoice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEditorChoice()
    {
        return $this->editorChoice;
    }
}
