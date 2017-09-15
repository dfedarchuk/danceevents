<?php

namespace ArcaSolutions\CoreBundle\Mailer;

use ArcaSolutions\CoreBundle\Services\Settings;
use Swift_Message;

/**
 * Class Mailer
 * @package ArcaSolutions\CoreBundle\Mailer
 *
 * This class is used as an interface for Swift_Message and Swift_Mailer.
 * The main goal of it is send the message with the 'To' of sitemgr, in a transparently way.
 * We do not extended the Swift_Message with this class, because it will throw an error in serialization
 * because of the dependencies classes
 */
class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * @var string
     */
    protected $sendMailParameter = 'sitemgr_send_email';

    /**
     * @var string
     */
    protected $generalMailParameter = 'sitemgr_email';

    /**
     * @var Swift_Message
     */
    private $messageObj;

    /**
     * Create a new Message.
     *
     * Details may be optionally passed into the constructor.
     *
     * @param \Swift_Mailer $mailer
     * @param Settings $settings
     * @param string $subject
     * @param string $body
     * @param string $contentType
     * @param string $charset
     */
    public function __construct(
        \Swift_Mailer $mailer,
        Settings $settings,
        $subject = null,
        $body = null,
        $contentType = null,
        $charset = 'utf-8'
    ) {
        $this->mailer = $mailer;
        $this->settings = $settings;
        $this->messageObj = \Swift_Message::newInstance($subject, $body, $contentType, $charset);
    }

    /**
     * Create a new Message.
     *
     * @param \Swift_Mailer $mailer
     * @param Settings $settings
     * @param string $subject
     * @param string $body
     * @param string $contentType
     * @param string $charset
     * @return Mailer
     */
    public static function newMail(
        \Swift_Mailer $mailer,
        Settings $settings,
        $subject = null,
        $body = null,
        $contentType = null,
        $charset = 'utf-8'
    ) {
        return new self($mailer, $settings, $subject, $body, $contentType, $charset);
    }

    /**
     * @inheritdoc
     */
    public function setTo($addresses, $name = null, $sitemgrNotif= true)
    {
        if ($addresses && !is_array($addresses)) {
            $addresses = array($addresses => $name ?: $addresses);
        }

        $generalMail = $this->settings->getDomainSetting($this->sendMailParameter);

        if ($sitemgrNotif && $generalMail === 'on') {
            $generalTo = $this->settings->getDomainSetting($this->generalMailParameter);
            $generalTo = array_flip(explode(',', $generalTo));
            foreach ($generalTo as $key => $value)
                $generalTo[$key] = $key;
            /* It was used the cast to solve an error when the addresses is empty */
            $addresses = array_filter(array_merge_recursive((array)$addresses, $generalTo));
        }

        $this->messageObj->setTo((array)$addresses);

        return $this;
    }

    /**
     * Set the subject of this message.
     *
     * @param string $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->messageObj->setSubject($subject);

        return $this;
    }

    /**
     * Set the from address of this message.
     *
     * You may pass an array of addresses if this message is from multiple people.
     *
     * If $name is passed and the first parameter is a string, this name will be
     * associated with the address.
     *
     * @param string|array $addresses
     * @param string $name optional
     *
     * @return $this
     */
    public function setFrom($addresses, $name = null)
    {
        $this->messageObj->setFrom($addresses, $name);

        return $this;
    }

    /**
     * Set the reply-to address of this message.
     *
     * You may pass an array of addresses if replies will go to multiple people.
     *
     * If $name is passed and the first parameter is a string, this name will be
     * associated with the address.
     *
     * @param mixed $addresses
     * @param string $name optional
     *
     * @return $this
     */
    public function setReplyTo($addresses, $name = null)
    {
        $this->messageObj->setReplyTo($addresses, $name);

        return $this;
    }

    /**
     * Set the bcc address of this message.
     *
     * You may pass an array of addresses if bcc will go to multiple people.
     *
     * If $name is passed and the first parameter is a string, this name will be
     * associated with the address.
     *
     * @param mixed $addresses
     * @param string $name optional
     *
     * @return $this
     */
    public function setBcc($addresses, $name = null)
    {
        $this->messageObj->setBcc($addresses, $name);

        return $this;
    }

    /**
     * Set the body of this entity, either as a string, or as an instance of
     * {@link Swift_OutputByteStream}.
     *
     * @param mixed $body
     * @param string $contentType optional
     * @param string $charset optional
     *
     * @return $this
     */
    public function setBody($body, $contentType = null, $charset = null)
    {
        $this->messageObj->setBody($body, $contentType, $charset);

        return $this;
    }

    /**
     * Send the given Message like it would be sent in a mail client.
     *
     * All recipients (with the exception of Bcc) will be able to see the other
     * recipients this message was sent to.
     *
     * Recipient/sender data will be retrieved from the Message object.
     *
     * The return value is the number of recipients who were accepted for
     * delivery.
     *
     * @param array $failedRecipients An array of failures by-reference
     *
     * @return int
     */
    public function send(&$failedRecipients = null)
    {
        return $this->mailer->send($this->messageObj, $failedRecipients);
    }

    /**
     * @return Swift_Message
     */
    public function getMessageObj()
    {
        return $this->messageObj;
    }

    /** Returns the HTML body for Sitemgr Messages
     * @return String
     */
    public function getSitemgrHtmlBody($content)
    {
        $body = "
                    <html>
                        <head>
                            <style>
                                .email_style_settings{
                                    font-size:12px;
                                    font-family:Verdana, Arial, Sans-Serif;
                                    color:#000;
                                }
                            </style>
                        </head>
                        <body>
                            <div class=\"email_style_settings\">
                            $content
                            </div>
                        </body>
                    </html>";

        return $body;
    }

}
