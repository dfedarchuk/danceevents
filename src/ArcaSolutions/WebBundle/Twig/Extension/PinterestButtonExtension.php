<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use ArcaSolutions\CoreBundle\Services\Settings;

class PinterestButtonExtension extends \Twig_Extension
{
    /**
     * @var Settings
     */
    private $settings;

    /**
     * PinterestButtonExtension constructor.
     *
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('pinterestButton', [$this, 'pinterestButton'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ])
        ];
    }

    /**
     * @param \Twig_Environment $twig
     *
     * @return string
     */
    public function pinterestButton(\Twig_Environment $twig)
    {
        if ($this->settings->getDomainSetting('button_share_pinterest') == 'on') {
            return $twig->render('::blocks/pinterest-button.html.twig');
        }

        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pinterest_button';
    }
}
