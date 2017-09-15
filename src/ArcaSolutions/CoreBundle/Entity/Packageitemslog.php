<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Packageitemslog
 *
 * @ORM\Table(name="PackageItemsLOG", indexes={@ORM\Index(name="package_id", columns={"package_id"})})
 * @ORM\Entity
 */
class Packageitemslog
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
     * @ORM\Column(name="package_id", type="integer", nullable=false)
     */
    private $packageId;

    /**
     * @var string
     *
     * @ORM\Column(name="old_items", type="text", nullable=false)
     */
    private $oldItems;

    /**
     * @var string
     *
     * @ORM\Column(name="new_items", type="text", nullable=false)
     */
    private $newItems;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="smaccount", type="string", length=255, nullable=false)
     */
    private $smaccount;



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
     * Set packageId
     *
     * @param integer $packageId
     * @return Packageitemslog
     */
    public function setPackageId($packageId)
    {
        $this->packageId = $packageId;

        return $this;
    }

    /**
     * Get packageId
     *
     * @return integer 
     */
    public function getPackageId()
    {
        return $this->packageId;
    }

    /**
     * Set oldItems
     *
     * @param string $oldItems
     * @return Packageitemslog
     */
    public function setOldItems($oldItems)
    {
        $this->oldItems = $oldItems;

        return $this;
    }

    /**
     * Get oldItems
     *
     * @return string 
     */
    public function getOldItems()
    {
        return $this->oldItems;
    }

    /**
     * Set newItems
     *
     * @param string $newItems
     * @return Packageitemslog
     */
    public function setNewItems($newItems)
    {
        $this->newItems = $newItems;

        return $this;
    }

    /**
     * Get newItems
     *
     * @return string 
     */
    public function getNewItems()
    {
        return $this->newItems;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Packageitemslog
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set smaccount
     *
     * @param string $smaccount
     * @return Packageitemslog
     */
    public function setSmaccount($smaccount)
    {
        $this->smaccount = $smaccount;

        return $this;
    }

    /**
     * Get smaccount
     *
     * @return string 
     */
    public function getSmaccount()
    {
        return $this->smaccount;
    }
}
