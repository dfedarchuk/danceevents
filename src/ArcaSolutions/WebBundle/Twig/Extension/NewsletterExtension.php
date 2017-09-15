<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class NewsletterExtension extends \Twig_Extension
{
    /**
     * ContainerInterface
     *
     * @var object
     */
    private $container;

    /**
     * @param ContainerInterface $container
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
            new \Twig_SimpleFunction('newsletter', [$this, 'newsletter'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ]),
        ];
    }

    /**
     * @param \Twig_Environment $twig
     *
     * @return string
     */
    public function newsletter(\Twig_Environment $twig)
    {
        if (!$this->container->get('settings')->getDomainSetting('arcamailer_enable_list')) {
            return '';
        }

        $this->container->get('javascripthandler')->addJSExternalFile('assets/js/newsletter/newsletter.js');

        return $twig->render('::blocks/newsletter.html.twig', array(
            'title' => $this->container->get('settings')->getDomainSetting('arcamailer_list_label'),
            'description' => $this->container->get('settings')->getDomainSetting('arcamailer_list_label_sub'),
            'facebook' => $this->container->get('settings')->getDomainSetting('setting_facebook_link')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'newsletter';
    }
}
