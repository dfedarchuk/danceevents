<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccountActivation
 *
 * @ORM\Table(name="Account_Activation", indexes={@ORM\Index(name="account_id", columns={"account_id"}), @ORM\Index(name="unique_key", columns={"unique_key"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class AccountActivation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="unique_key", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $uniqueKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entered", type="date", nullable=false)
     */
    private $entered;

    /**
     * Gets triggered on update and insert
     *
     * @ORM\PrePersist()
     */
    public function updatedTimestamps()
    {
        $this->entered = new \DateTime("now");
    }

    /**
     * Set accountId
     *
     * @param integer $accountId
     * @return AccountActivation
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
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
     * Set uniqueKey
     *
     * @param string $uniqueKey
     * @return AccountActivation
     */
    public function setUniqueKey($uniqueKey)
    {
        $this->uniqueKey = $uniqueKey;

        return $this;
    }

    /**
     * Get uniqueKey
     *
     * @return string
     */
    public function getUniqueKey()
    {
        return $this->uniqueKey;
    }

    /**
     * Set entered
     *
     * @param \DateTime $entered
     * @return AccountActivation
     */
    public function setEntered($entered)
    {
        $this->entered = $entered;

        return $this;
    }

    /**
     * Get entered
     *
     * @return \DateTime
     */
    public function getEntered()
    {
        return $this->entered;
    }
}
