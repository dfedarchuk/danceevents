<?php
namespace ArcaSolutions\ImageBundle\Sample;

use ArcaSolutions\ImageBundle\Entity\Image;

class ImageSample extends Image
{
    /**
     * Used internally
     *
     * @var string
     */
    private $placeholder = '';

    /**
     * Url for sample
     *
     * @var string
     */
    private $url = '//placehold.it/';

    /**
     * @param int    $width
     * @param int    $height
     * @param string $placeholder
     */
    public function __construct($width = 0, $height = 0, $placeholder = '')
    {
        $width and $this->setWidth($width);
        $height and $this->setHeight($height);
        $placeholder && $this->placeholder = $placeholder;
        $this->setPrefix('1')->setType('jpg');
    }

    /**
     * Gets URL for use in <img>
     * Url just exist in imageSample
     *
     * @return string
     */
    public function getUrl()
    {
        $url = $this->url;

        if ($this->getWidth()) {
            $url .= $this->getWidth();
        }

        if ($this->getHeight()) {
            $url .= 'x' . $this->getHeight();
        }

        if ($this->placeholder) {
            $url .= '&text=' . $this->placeholder;
        }

        return $url;
    }
}
