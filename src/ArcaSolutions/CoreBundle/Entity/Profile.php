<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 *
 * @ORM\Table(name="Profile")
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\ProfileRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Profile
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
     * @var integer
     *
     * @ORM\Column(name="image_id", type="integer", nullable=true)
     */
    private $imageId;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_image", type="string", length=255, nullable=true)
     */
    private $facebookImage;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=100, nullable=true)
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="friendly_url", type="string", length=255, nullable=false)
     */
    private $friendlyUrl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entered", type="datetime", nullable=true)
     */
    private $entered;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="personal_message", type="string", length=250, nullable=true)
     */
    private $personalMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_uid", type="string", length=250, nullable=true)
     */
    private $facebookUid;

    /**
     * @ORM\OneToOne(targetEntity="ArcaSolutions\CoreBundle\Entity\Account", fetch="EAGER")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    private $account;

    /**
     * Gets triggered on update and insert
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updatedTimestamps()
    {
        $this->updated = new \DateTime("now");

        if ($this->getEntered() == null) {
            $this->entered = new \DateTime("now");
        }
    }

    /**
     * @param int $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
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
     * Set imageId
     *
     * @param integer $imageId
     * @return Profile
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
     * Set facebookImage
     *
     * @param string $facebookImage
     * @return Profile
     */
    public function setFacebookImage($facebookImage)
    {
        $this->facebookImage = $facebookImage;

        return $this;
    }

    /**
     * Get facebookImage
     *
     * @return string
     */
    public function getFacebookImage()
    {
        return $this->facebookImage;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     * @return Profile
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set friendlyUrl
     *
     * @param string $friendlyUrl
     * @return Profile
     */
    public function setFriendlyUrl($friendlyUrl)
    {
        $this->friendlyUrl = $friendlyUrl;

        return $this;
    }

    /**
     * Get friendlyUrl
     *
     * @return string
     */
    public function getFriendlyUrl()
    {
        return $this->friendlyUrl;
    }

    /**
     * Set entered
     *
     * @param \DateTime $entered
     * @return Profile
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Profile
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
     * Set personalMessage
     *
     * @param string $personalMessage
     * @return Profile
     */
    public function setPersonalMessage($personalMessage)
    {
        $this->personalMessage = $personalMessage;

        return $this;
    }

    /**
     * Get personalMessage
     *
     * @return string
     */
    public function getPersonalMessage()
    {
        return $this->personalMessage;
    }

    /**
     * Set facebookUid
     *
     * @param string $facebookUid
     * @return Profile
     */
    public function setFacebookUid($facebookUid)
    {
        $this->facebookUid = $facebookUid;

        return $this;
    }

    /**
     * Get facebookUid
     *
     * @return string
     */
    public function getFacebookUid()
    {
        return $this->facebookUid;
    }

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param Account $account
     *
     * @return $this
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }
}
