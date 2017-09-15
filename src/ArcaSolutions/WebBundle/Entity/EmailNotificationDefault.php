<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailNotificationDefault
 *
 * @ORM\Table(name="Email_Notification_Default")
 * @ORM\Entity
 */
class EmailNotificationDefault
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
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="body_text", type="text", nullable=false)
     */
    private $bodyText;

    /**
     * @var string
     *
     * @ORM\Column(name="body_html", type="text", nullable=false)
     */
    private $bodyHtml;



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
     * Set subject
     *
     * @param string $subject
     * @return EmailNotificationDefault
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
     * Set bodyText
     *
     * @param string $bodyText
     * @return EmailNotificationDefault
     */
    public function setBodyText($bodyText)
    {
        $this->bodyText = $bodyText;

        return $this;
    }

    /**
     * Get bodyText
     *
     * @return string 
     */
    public function getBodyText()
    {
        return $this->bodyText;
    }

    /**
     * Set bodyHtml
     *
     * @param string $bodyHtml
     * @return EmailNotificationDefault
     */
    public function setBodyHtml($bodyHtml)
    {
        $this->bodyHtml = $bodyHtml;

        return $this;
    }

    /**
     * Get bodyHtml
     *
     * @return string 
     */
    public function getBodyHtml()
    {
        return $this->bodyHtml;
    }
}
