<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\Container;

class CustomTextExtension extends \Twig_Extension
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     *{@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'getCustomText',
                [$this, 'getCustomText'],
                ['is_safe' => ['all']]
            ),
            new \Twig_SimpleFunction(
                'getClaimCustomText',
                [$this, 'getClaimCustomText'],
                ['is_safe' => ['all']]
            )
        ];
    }

    public function getCustomText($identifier)
    {
        return $this->container->get("customtexthandler")->get($identifier);
    }

    public function getClaimCustomText()
    {
        return $this->container->get("customtexthandler")->get("claim_textlink");
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'edirectoryCustomText';
    }
}
