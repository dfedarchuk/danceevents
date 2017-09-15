<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * Quicklist
 *
 * @ORM\Table(name="Quicklist", uniqueConstraints={@ORM\UniqueConstraint(name="uc_accountId_itemId_itemType", columns={"account_id", "item_id", "item_type"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\WebBundle\Repository\QuicklistRepository")
 */
class Quicklist
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"listingDetail"})
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer", nullable=false)
     */
    private $accountId;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer", nullable=false)
     */
    private $itemId;

    /**
     * @var string
     *
     * @ORM\Column(name="item_type", type="string", length=30, nullable=false)
     */
    private $itemType;


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
     * Get accountId
     *
     * @return integer
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set accountId
     *
     * @param integer $accountId
     *
     * @return Quicklist
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

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
     * Set itemId
     *
     * @param integer $itemId
     *
     * @return Quicklist
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

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
     * Set itemType
     *
     * @param string $itemType
     *
     * @return Quicklist
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;

        return $this;
    }
}
