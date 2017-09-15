<?php

namespace ArcaSolutions\CoreBundle\Twig\Extension;

use ArcaSolutions\CoreBundle\Inflector;

/**
 * Class InflectorExtension
 *
 * Gives the possibility of the use Inflector class in view
 *
 * @package ArcaSolutions\CoreBundle\Twig\Extension
 */
class InflectorExtension extends \Twig_Extension
{

    /**
     * @var Inflector
     */
    private $inflector;

    /**
     * Initiate inflector class
     */
    public function __construct()
    {
        $this->inflector = new Inflector;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        $functions = [];

        $methods = get_class_methods($this->inflector);
        foreach ($methods as $method) {
            $functions[] = new \Twig_SimpleFunction($method, [$this, $method], []);
        }

        return $functions;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'inflector';
    }

    /**
     * It's where the magic happens.
     * It pretend to twig that the functions of the Inflector class exist inside the extension
     *
     * @param $name
     * @param $args
     *
     * @return mixed
     */
    function __call($name, $args)
    {
        return call_user_func_array([$this->inflector, $name], $args);
    }
}
