<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForgotPassword
 *
 * @ORM\Table(name="Forgot_Password", indexes={@ORM\Index(name="account_id", columns={"account_id"}), @ORM\Index(name="unique_key", columns={"unique_key"}), @ORM\Index(name="entered", columns={"entered"}), @ORM\Index(name="section", columns={"section"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\ForgotPasswordRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ForgotPassword
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
     * @var string
     *
     * @ORM\Column(name="section", type="string", length=255, nullable=false)
     */
    private $section;



    /**
     * Set accountId
     *
     * @param integer $accountId
     * @return ForgotPassword
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
     * @return ForgotPassword
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
     * @return ForgotPassword
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

    /**
     * Set section
     *
     * @param string $section
     * @return ForgotPassword
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return string 
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Gets triggered insert
     *
     * @ORM\PrePersist()
     */
    public function insertTimestamps()
    {
        if ($this->getEntered() == null) {
            $this->entered = new \DateTime("now");
        }
    }
}
