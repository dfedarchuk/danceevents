<?php

namespace ArcaSolutions\ImageBundle\Services;

use ArcaSolutions\ImageBundle\Entity\Image;
use ArcaSolutions\MultiDomainBundle\Services\Settings;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ImageHandler
{
    /**
     * Standard format for image name
     */
    const IMAGE_NAME = '%sphoto_%d.%s';
    const IMAGE_PATH = '/../web/custom/domain_%d/';

    /**
     * @var Settings
     */
    private $multiDomain;

    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var string
     */
    protected $imagePath;

    /**
     * ImageHandler constructor.
     *
     * @param Settings $multiDomain The MultiDomain class
     * @param Registry $doctrine The Doctrine class
     * @param string $kernelRootDir The root path from project
     */
    function __construct(Settings $multiDomain, Registry $doctrine, $kernelRootDir)
    {
        $this->multiDomain = $multiDomain;
        $this->doctrine = $doctrine;

        /* Setting the edirectory image path */
        $this->imagePath = $kernelRootDir.sprintf(self::IMAGE_PATH, $multiDomain->getId());
    }

    /**
     * Alias for create the image name
     * @param Image $image
     * @return string
     */
    public function getPath($image)
    {
        $return = null;

        if ($image) {
            $prefix = $image->getPrefix();
            $id = $image->getId();
            $type = strtolower($image->getType());

            $return = sprintf(self::IMAGE_NAME, $prefix, $id, $type);
        }

        return $return;
    }

    public function deleteImageFile($imagePath)
    {
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    public function deleteSliderImage(Image $image, $onlyDeleteFile = true)
    {
        $filename = $this->getPath($image);
        $completePath = $this->imagePath.'/image_files/'.$filename;

        if ($onlyDeleteFile) {
            try {
                $em = $this->doctrine->getManager();
                $em->remove($image);
                $em->flush($image);
                $em->clear($image);
            } catch (Exception $e) {
                echo "Exception Found - ".$e->getMessage()."<br/>";
                exit;
            }
        }
        $this->deleteImageFile($completePath);
    }
}
