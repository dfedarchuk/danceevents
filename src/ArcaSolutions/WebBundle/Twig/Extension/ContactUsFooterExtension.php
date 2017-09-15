<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ContactUsFooterExtension extends \Twig_Extension
{
    /**
     * ContainerInterface
     *
     * @var object
     */
    protected $container;

    /**
     * @param $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'contactUs',
                [$this, 'contactUs'],
                ['needs_environment' => true, 'is_safe' => ['html']]
            ),
        ];
    }

    /**
     * @param \Twig_Environment $twig_Environment
     *
     * @param bool $notSocial
     * @param string $content
     * @return string
     */
    public function contactUs(\Twig_Environment $twig_Environment, $notSocial = true, $content = null, $widget = null)
    {
        $socialMediaContent = [
            'twitter'    => $this->container->get('settings')->getDomainSetting('twitter_account'),
            'facebook'   => $this->container->get('settings')->getDomainSetting('setting_facebook_link'),
            'linkedin'   => $this->container->get('settings')->getDomainSetting('setting_linkedin_link'),
            'instagram'  => $this->container->get('settings')->getDomainSetting('setting_instagram_link'),
            'googleplus' => $this->container->get('settings')->getDomainSetting('setting_googleplus_link'),
            'pinterest'  => $this->container->get('settings')->getDomainSetting('setting_pinterest_link'),
            'content'    => $content,
        ];

        $twigFile = '::blocks/contactus-social';

        if ($notSocial) {
            $twigFile = '::blocks/contactus';
        }

        $twigFile .= $widget? $widget.'.html.twig' : '.html.twig';

        return $twig_Environment->render($twigFile, $socialMediaContent);
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'contactus';
    }
}
