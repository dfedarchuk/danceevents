<?php

namespace ArcaSolutions\CoreBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class JavaScriptHandler
{
    private static $scriptTemplate = "::blocks/utility/javascripthandler.html.twig";

    /**
     * Contains the path of js files to be included
     * example: "js/filters.js"
     * @var string[]
     */
    private $externalFiles = [];

    /**
     * Contains the path of JS TWIG files
     * example: "::js/filters.js.twig"
     * @var string[]
     */
    private $blocks = [];

    /**
     * Contains the list of parameters to be used within the rendering of the $blocks twigs
     * @var string[]
     */
    private $parameters = [];

    /**
     * @var ContainerInterface
     */
    private $container;

    function __construct($container)
    {
        $this->container = $container;
    }

    //region External Files
    /**
     * @return array
     */
    public function getExternalFiles()
    {
        return $this->externalFiles;
    }

    /**
     * @param $id
     * @return $this JavaScriptHandler
     */
    public function removeJSExternalFile($id)
    {
        unset($this->externalFiles[$id]);
        return $this;
    }

    /**
     * @param $id
     * @return string
     */
    public function getJSExternalFile($id)
    {
        return isset($this->externalFiles[$id]) ? $this->externalFiles[$id] : null;
    }

    /**
     * @param $file
     * @return $this JavaScriptHandler
     */
    public function addJSExternalFile($file)
    {
        $this->externalFiles[$file] = $file;
        return $this;
    }
    //endregion

    //region Blocks
    /**
     * @return array
     */
    public function getBlocks()
    {
        return $this->blocks;
    }
    /**
     * @param $id
     * @return $this JavaScriptHandler
     */
    public function removeJSBlock($id)
    {
        unset($this->blocks[$id]);
        return $this;
    }

    /**
     * @param $id
     * @return string
     */
    public function getJSBlock($id)
    {
        return isset($this->blocks[$id]) ? $this->blocks[$id] : null;
    }

    /**
     * @param $code
     * @return $this JavaScriptHandler
     */
    public function addJSBlock($code)
    {
        $this->blocks[$code] = $code;
        return $this;
    }
    //endregion

    //region Parameters
    /**
     * @return array
     */
    public function getTwigParameters()
    {
        return $this->parameters;
    }

    /**
     * @param $id
     * @return $this JavaScriptHandler
     */
    public function removeTwigParameter($id)
    {
        unset($this->parameters[$id]);
        return $this;
    }

    /**
     * @param $id
     * @return string
     */
    public function getTwigParameter($id)
    {
        return isset($this->parameters[$id]) ? $this->parameters[$id] : null;
    }

    /**
     * @param $id
     * @param $code
     * @return $this JavaScriptHandler
     */
    public function addTwigParameter($id, $code)
    {
        $input = null;

        if( strpos($id,".") !== false ){
            Utility::assignArrayByPath($input, $id, $code);

            $id = key($input);
            $code = $input[$id];
        }

        if( isset($this->parameters[$id]) ){
            $this->parameters[$id] = array_merge_recursive( (array)$this->parameters[$id], (array)$code );
        } else {
            $this->parameters[$id] = $code;
        }

        return $this;
    }
    //endregion

    /**
     * @return string
     */
    public function render()
    {
        $twig = $this->container->get("twig");

        $this->addTwigParameter( "handler", $this );

        return $twig->render( self::$scriptTemplate, $this->getTwigParameters() );
    }

}
