<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class SliderExtension extends \Twig_Extension
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
            new \Twig_SimpleFunction('slider', [$this, 'slider'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ])
        ];
    }

    /**
     * Slider function
     *
     * @param \Twig_Environment $twig_Environment
     *
     * @return string
     */
    public function slider(\Twig_Environment $twig_Environment)
    {
        $sliders = $this->container->get('doctrine')->getRepository('WebBundle:Slider')->getSliders();

        if (!$sliders) {
            return '';
        }

        return $twig_Environment->render('::blocks/slider.html.twig', array(
            'sliders' => $sliders
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'slider';
    }
}
