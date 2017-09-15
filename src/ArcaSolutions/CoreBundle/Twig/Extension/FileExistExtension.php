<?php

namespace ArcaSolutions\CoreBundle\Twig\Extension;

/**
 * Class FileExistExtension
 *
 * Adds php's file_exists in twig
 *
 * @package ArcaSolutions\CoreBundle\Twig\Extension
 */
class FileExistExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return ['file_exists' => new \Twig_SimpleFunction('file_exists', 'file_exists')];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'file_exist';
    }
}
