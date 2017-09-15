<?php
namespace ArcaSolutions\ImageBundle\Sample;

use ArcaSolutions\ImageBundle\Entity\GalleryImage;

class GalleryImageSample extends GalleryImage
{
    /**
     * @param int    $width
     * @param int    $height
     * @param string $placeholder
     */
    public function __construct($width = 0, $height = 0, $placeholder = '')
    {
        $this->setImageDefault('n')
            ->setImage(new ImageSample($width, $height, $placeholder));
    }
}
