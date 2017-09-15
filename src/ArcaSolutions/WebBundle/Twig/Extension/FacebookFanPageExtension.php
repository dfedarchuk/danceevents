<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class FacebookFanPageExtension extends \Twig_Extension
{
    /**
     * ContainerInterface
     *
     * @var object
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
            new \Twig_SimpleFunction('facebookFanPage',[$this,'facebookFanPage'],[
                'needs_environment' => true,
                'is_safe' => ['html']
            ]),
        ];
    }

    /**
     * Twig extension that show a warning message about IE version
     *
     * @param \Twig_Environment $twig
     *
     * @param string            $fanpage
     *
     * @return string
     */
    public function facebookFanPage(\Twig_Environment $twig, $fanpage = '')
    {
        if (empty($fanpage)) {
            return '';
        }

        return $twig->render('::blocks/facebook_fanpage.js.twig', [
            'width'    => $this->container->getParameter('facebook.comments.width'),
            'fan_page' => $fanpage
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'facebook_fanpage';
    }
}
