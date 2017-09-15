<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustominvoiceItems
 *
 * @ORM\Table(name="CustomInvoice_Items", indexes={@ORM\Index(name="custominvoice_id", columns={"custominvoice_id"})})
 * @ORM\Entity
 */
class CustominvoiceItems
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
     * @ORM\Column(name="custominvoice_id", type="integer", nullable=false)
     */
    private $custominvoiceId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $price;



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
     * Set custominvoiceId
     *
     * @param integer $custominvoiceId
     * @return CustominvoiceItems
     */
    public function setCustominvoiceId($custominvoiceId)
    {
        $this->custominvoiceId = $custominvoiceId;

        return $this;
    }

    /**
     * Get custominvoiceId
     *
     * @return integer 
     */
    public function getCustominvoiceId()
    {
        return $this->custominvoiceId;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return CustominvoiceItems
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return CustominvoiceItems
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }
}
