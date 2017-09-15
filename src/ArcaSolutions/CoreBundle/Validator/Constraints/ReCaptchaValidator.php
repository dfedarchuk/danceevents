<?php

namespace ArcaSolutions\CoreBundle\Validator\Constraints;

use ArcaSolutions\CoreBundle\Services\Settings;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrueValidator;
use Symfony\Component\HttpFoundation\RequestStack;

class ReCaptchaValidator extends IsTrueValidator
{
    public function __construct(
        $enabled,
        $privateKey,
        RequestStack $requestStack,
        array $httpProxy = [],
        Settings $settings
    ) {
        parent::__construct($enabled, $privateKey, $requestStack, $httpProxy);

        $this->privateKey = $settings->getSettingGoogle('recaptcha_secretkey');
    }
}
