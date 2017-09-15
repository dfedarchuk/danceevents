<?php

namespace ArcaSolutions\ImageBundle;

use ArcaSolutions\ImageBundle\Entity\Image;
use Symfony;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{
    private $targetDir;
    private $selectedDomain;
    private $domainUrl;
    private $rootDir;
    private $translator;
    private $sitemgrLanguage;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->selectedDomain = $container->get('multi_domain.information')->getId();
        $this->domainUrl = $container->get('multi_domain.information')->getOriginalActiveHost();
        $this->rootDir = $container->getParameter('kernel.root_dir');
        $this->translator = $container->get('translator');

        setting_get("sitemgr_language", $sitemgr_language);
        $this->sitemgrLanguage = substr($sitemgr_language, 0, 2);
    }

    public function upload(UploadedFile $file, $fileName, $addExtension = true)
    {
        $fileName = $fileName.($addExtension ? '.'.$file->guessExtension() : '');

        $file->move($this->targetDir, $fileName);

        return $fileName;
    }

    public function uploadFavicon(UploadedFile $file, $fileName)
    {
        $return['success'] = false;
        if ($file->isValid()) {
            if (in_array($file->getMimeType(), ['image/x-icon', 'image/vnd.microsoft.icon'])) {
                $fileExtension = $file->guessExtension();
                $rand = rand(1000, 9999999);

                // Set the upload directory
                $this->targetDir = $this->rootDir.'/../web/custom/domain_'.$this->selectedDomain."/content_files/";;

                // Get old favicon file
                $deleteOld = false;
                if ($oldFile = glob($this->targetDir.$fileName.'*')) {
                    $deleteOld = true;
                }

                $fileUploaded = $this->upload($file, $fileName.$rand);

                if ($fileUploaded) {
                    $return['success'] = true;
                    $url = "/custom/domain_".$this->selectedDomain.'/content_files/'.$fileName.$rand.'.'.$fileExtension;
                    $return['url'] = $this->container->get('request')->getSchemeAndHttpHost().$url;
                    if ($deleteOld) {
                        unlink($oldFile[0]);
                    }
                }

                // adds favicon
                $classSymfonyYml = new Symfony('domains/'.$this->domainUrl.'.configs.yml');
                $classSymfonyYml->save('Configs',
                    [
                        'parameters' =>
                            [
                                'domain.favicon' => $url,
                            ],
                    ]);
                unset($classSymfonyYml);
            } else {
                $return['message'] = $this->translator->trans('You must use ".ico" images for favicon', [], 'widgets', $this->sitemgrLanguage);
            }
        } else {
            $return['message'] = $this->translator->trans('Error uploading image. Please try again.', [], 'widgets', $this->sitemgrLanguage);
        }

        return $return;
    }

    public function uploadLogo(UploadedFile $file, $fileName)
    {
        $return['success'] = false;
        if ($file->isValid()) {
            if (in_array($file->getMimeType(), ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'])) {
                $this->targetDir = $this->rootDir.'/../web/custom/domain_'.$this->selectedDomain.'/content_files/';

                $fileUploaded = $this->upload($file, $fileName, false);

                if ($fileUploaded) {
                    $return['success'] = true;
                    $url = "/custom/domain_".$this->selectedDomain."/content_files/".$fileName;
                    $return['url'] = $this->container->get('request')->getSchemeAndHttpHost().$url;

                    // @todo image cte
                    $classSymfonyYml = new Symfony('domains/'.$this->domainUrl.'.configs.yml');
                    $classSymfonyYml->save('Configs',
                        [
                            'parameters' =>
                                [
                                    'domain.header.image' => $url,
                                ],
                        ]
                    );
                    unset($classSymfonyYml);
                }
            } else {
                $return['message'] = $this->translator->trans('Image logo wrong file extension', [], 'widgets', $this->sitemgrLanguage);
            }
        } else {
            $return['message'] = "Logo: ".$this->translator->trans('Error uploading image. Please try again.',
                    [], 'widgets', $this->sitemgrLanguage);
        }

        return $return;
    }

    public function uploadBackgroundImage(UploadedFile $file, $fileName)
    {
        $return['success'] = false;
        if ($file->isValid()) {
            if (in_array($file->getMimeType(), ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'])) {
                $this->targetDir = $this->rootDir.'/../web/custom/domain_'.$this->selectedDomain.'/content_files/';

                $fileUploaded = $this->upload($file, $fileName, false);

                if ($fileUploaded) {
                    $return['success'] = true;
                    $url = "/custom/domain_".$this->selectedDomain."/content_files/".$fileName;
                    $return['url'] = $this->container->get('request')->getSchemeAndHttpHost().$url;
                }
            } else {
                $return['message'] = $this->translator->trans('Backgroud image wrong file extension', [], 'widgets', $this->sitemgrLanguage);
            }
        } else {
            $return['message'] = "Background Image: ".$this->translator->trans('Error uploading image. Please try again.',
                    [], 'widgets', $this->sitemgrLanguage);
        }

        return $return;
    }

    public function uploadSliderImages($file, $width, $height, $domain)
    {
        $file = new UploadedFile($file['tmp_name'], $file['name']);
        $return['success'] = false;

        if ($file->isValid()) {
            if (in_array($file->getMimeType(), ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'])) {
                $this->targetDir = $this->rootDir.'/../web/custom/domain_'.$this->selectedDomain.'/content_files/';

                if ($return = $this->uploadImageAndSaveDatabase($file, $width, $height, $domain)) {
                    $return['success'] = true;
                }
            } else {
                $return['message'] = $this->translator->trans('Slider image wrong file extension', [], 'widgets', $this->sitemgrLanguage);
            }
        } else {
            $return['message'] = "Logo: ".$this->translator->trans('Error uploading image. Please try again.',
                    [], 'widgets', $this->sitemgrLanguage);
        }

        return $return;
    }

    /**
     * @param UploadedFile $file The File uploaded
     * @param string $fileName The File name
     * @param int $domain The Domain id
     *
     * @return array
     */
    public function uploadImageCkeditor(UploadedFile $file, $fileName, $domain)
    {
        $basePath = 'custom/domain_'.$domain.'/image_files/ckeditor/';
        $return = [];

        if ($file->isValid()) {
            if ($file->getSize() > 10485760) {
                $return['message'] = $this->translator->trans('The file is too big', [], 'messages', $this->sitemgrLanguage);
            } elseif (!in_array($file->getMimeType(), ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'])) {
                $return['message'] = $this->translator->trans('File with extension not supported', [], 'messages', $this->sitemgrLanguage);
            }

            if (!isset($return['message'])) {
                $this->targetDir = $this->rootDir.'/../web/'.$basePath;

                $fileUploaded = $this->upload($file, $fileName, false);

                if ($fileUploaded) {
                    $return = [
                        'fileName' => $fileName,
                        'url'      => '/'.$basePath.$fileName,
                        'message'  => '',
                    ];
                }
            }
        }

        return $return;
    }

    private function uploadImageAndSaveDatabase(UploadedFile $file, $width, $height, $domain)
    {
        // set dir
        $basePath = 'custom/domain_'.$domain.'/image_files/';
        $this->targetDir = $this->rootDir.'/../web/'.$basePath;

        // Save Info on Image Table
        $em = $this->container->get('doctrine')->getManager();
        $imageObj = new Image();
        $imageObj->setWidth($width);
        $imageObj->setHeight($height);
        $imageObj->setPrefix('sitemgr_');
        $imageObj->setType(strtoupper($file->guessExtension()));

        $em->persist($imageObj);
        $em->flush($imageObj);

        // save file
        $fileName = 'sitemgr_photo_'.$imageObj->getId().'.'.$file->guessExtension();
        $this->upload($file, $fileName, false);

        return [
            'code' => $imageObj->getId(),
            'url'  => '/'.$basePath.$fileName,
        ];
    }

    /**
     * @return mixed
     */
    public function getTargetDir()
    {
        return $this->targetDir;
    }

    /**
     * @param mixed $targetDir
     */
    public function setTargetDir($targetDir)
    {
        $this->targetDir = $targetDir;
    }

}
