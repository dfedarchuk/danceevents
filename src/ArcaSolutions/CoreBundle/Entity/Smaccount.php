<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Smaccount
 *
 * @ORM\Table(name="SMAccount", indexes={@ORM\Index(name="username", columns={"username"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\SmaccountRepository")
 */
class Smaccount
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
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entered", type="datetime", nullable=false)
     */
    private $entered = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="permission", type="string", length=255, nullable=false)
     */
    private $permission;

    /**
     * @var string
     *
     * @ORM\Column(name="iprestriction", type="text", nullable=false)
     */
    private $iprestriction;

    /**
     * @var integer
     *
     * @ORM\Column(name="faillogin_count", type="integer", nullable=false)
     */
    private $failloginCount = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="faillogin_datetime", type="datetime", nullable=false)
     */
    private $failloginDatetime = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="complementary_info", type="string", length=255, nullable=false)
     */
    private $complementaryInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=1, nullable=false)
     */
    private $active = 'y';



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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Smaccount
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
     * Set entered
     *
     * @param \DateTime $entered
     * @return Smaccount
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
     * Set username
     *
     * @param string $username
     * @return Smaccount
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Smaccount
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set permission
     *
     * @param string $permission
     * @return Smaccount
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return string 
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set iprestriction
     *
     * @param string $iprestriction
     * @return Smaccount
     */
    public function setIprestriction($iprestriction)
    {
        $this->iprestriction = $iprestriction;

        return $this;
    }

    /**
     * Get iprestriction
     *
     * @return string 
     */
    public function getIprestriction()
    {
        return $this->iprestriction;
    }

    /**
     * Set failloginCount
     *
     * @param integer $failloginCount
     * @return Smaccount
     */
    public function setFailloginCount($failloginCount)
    {
        $this->failloginCount = $failloginCount;

        return $this;
    }

    /**
     * Get failloginCount
     *
     * @return integer 
     */
    public function getFailloginCount()
    {
        return $this->failloginCount;
    }

    /**
     * Set failloginDatetime
     *
     * @param \DateTime $failloginDatetime
     * @return Smaccount
     */
    public function setFailloginDatetime($failloginDatetime)
    {
        $this->failloginDatetime = $failloginDatetime;

        return $this;
    }

    /**
     * Get failloginDatetime
     *
     * @return \DateTime 
     */
    public function getFailloginDatetime()
    {
        return $this->failloginDatetime;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Smaccount
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
     * Set phone
     *
     * @param string $phone
     * @return Smaccount
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Smaccount
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set complementaryInfo
     *
     * @param string $complementaryInfo
     * @return Smaccount
     */
    public function setComplementaryInfo($complementaryInfo)
    {
        $this->complementaryInfo = $complementaryInfo;

        return $this;
    }

    /**
     * Get complementaryInfo
     *
     * @return string 
     */
    public function getComplementaryInfo()
    {
        return $this->complementaryInfo;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return Smaccount
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string 
     */
    public function getActive()
    {
        return $this->active;
    }
}
