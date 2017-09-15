<?php

namespace ArcaSolutions\WebBundle\Services;

use ArcaSolutions\WebBundle\Entity\CustomText;
use Symfony\Component\DependencyInjection\Container;

class CustomTextHandler
{
    /**
     * @var Container
     */
    private $container;

    function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Retrieves the value of the custom text with the $name id
     * @param $name
     * @param bool $entity
     * @return null|string|CustomText
     */
    public function get($name, $entity = false)
    {
        $return = null;

        if ($text = $this->container->get('doctrine')->getRepository("WebBundle:CustomText")->find($name)) {
            $return = $entity ? $text : $text->getValue();
        }

        return $return;
    }

    /**
     * Adds or updates a CustomText entry
     * @param $name
     * @param $value
     */
    public function add($name, $value)
    {
        $customText = $this->get($name, true);

        if (!$customText) {
            $customText = new CustomText();
            $customText->setName($name);
            $customText->setValue($value);
        }

        $em = $this->container->get("doctrine")->getManager();
        $em->persist($customText);
        $em->flush();
    }
}
