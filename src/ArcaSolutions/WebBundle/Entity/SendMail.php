<?php
namespace ArcaSolutions\WebBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SendMail
{
    /**
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;

    /**
     * @Assert\NotBlank()
     */
    public $subject;

    /**
     * @Assert\NotBlank()
     */
    public $text;

    /**
     *
     */
    public $captcha;
}
