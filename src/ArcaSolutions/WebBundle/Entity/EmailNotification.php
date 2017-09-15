<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailNotification
 *
 * @ORM\Table(name="Email_Notification", indexes={@ORM\Index(name="deactivate", columns={"deactivate"})})
 * @ORM\Entity
 */
class EmailNotification
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
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="days", type="integer", nullable=false)
     */
    private $days = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="deactivate", type="string", length=1, nullable=false)
     */
    private $deactivate = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="bcc", type="string", length=255, nullable=true)
     */
    private $bcc;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=true)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="content_type", type="string", length=15, nullable=true)
     */
    private $contentType;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="use_variables", type="string", length=255, nullable=false)
     */
    private $useVariables;



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
     * Set email
     *
     * @param string $email
     * @return EmailNotification
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
     * Set days
     *
     * @param integer $days
     * @return EmailNotification
     */
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return integer 
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Set deactivate
     *
     * @param string $deactivate
     * @return EmailNotification
     */
    public function setDeactivate($deactivate)
    {
        $this->deactivate = $deactivate;

        return $this;
    }

    /**
     * Get deactivate
     *
     * @return string 
     */
    public function getDeactivate()
    {
        return $this->deactivate;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return EmailNotification
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
     * Set bcc
     *
     * @param string $bcc
     * @return EmailNotification
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;

        return $this;
    }

    /**
     * Get bcc
     *
     * @return string 
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return EmailNotification
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set contentType
     *
     * @param string $contentType
     * @return EmailNotification
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get contentType
     *
     * @return string 
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return EmailNotification
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set useVariables
     *
     * @param string $useVariables
     * @return EmailNotification
     */
    public function setUseVariables($useVariables)
    {
        $this->useVariables = $useVariables;

        return $this;
    }

    /**
     * Get useVariables
     *
     * @return string 
     */
    public function getUseVariables()
    {
        return $this->useVariables;
    }
}
