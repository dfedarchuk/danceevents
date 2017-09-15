<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class FacebookCommentsExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    protected $container;

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
            new \Twig_SimpleFunction('facebookComments', [$this, 'facebookComments'], [
                'needs_environment' => true,
                'is_safe'           => ['html']
            ]),
        ];
    }

    /**
     * Twig extension that show a warning message about IE version
     *
     * @param \Twig_Environment $twig
     *
     * @param null $width
     *
     * @return string
     */
    public function facebookComments(\Twig_Environment $twig, $width = null)
    {
        $settingsModel = $this->container->get('doctrine')->getRepository('WebBundle:Setting');
        if ('on' != $settingsModel->getSetting('commenting_fb')) {
            return '';
        }

        return $twig->render('::blocks/facebook_comments.js.twig', [
            'width'          => $width ?: $this->container->getParameter('facebook.comments.width'),
            'quantity_posts' => 5
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'facebook_comments';
    }
}
