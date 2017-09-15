<?php

namespace ArcaSolutions\ImageBundle\Twig\Extension;

use ArcaSolutions\CoreBundle\Entity\Account;
use ArcaSolutions\ImageBundle\Entity\Image;
use ArcaSolutions\WebBundle\Entity\Accountprofilecontact;
use Symfony\Component\DependencyInjection\ContainerInterface;


class ImageExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
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
            new \Twig_SimpleFunction(
                'imagePath',
                [$this, 'getPath'],
                ['is_safe' => ['all']]
            ),
            new \Twig_SimpleFunction(
                'imageProfile',
                [$this, 'getProfileImage'],
                ['is_safe' => ['all']]
            ),
            new \Twig_SimpleFunction(
                'imageProfileByAccountId',
                [$this, 'getProfileImageByAccountId'],
                ['is_safe' => ['all']]
            ),
        ];
    }

    /**
     * Alias for create the image name
     *
     * @param Image $image
     * @return string
     */
    public function getPath($image)
    {
        return $this->container->get('imagehandler')->getPath($image);
    }

    /**
     * Alias for create the image name
     *
     * @param $accountId
     * @return string
     */
    public function getProfileImageByAccountId($accountId)
    {
        $return = null;

        if ($accountId) {
            $repository = $this->container->get("doctrine")->getRepository("CoreBundle:Account", "main");

            /* @var Account $account */
            if ($account = $repository->find($accountId)) {
                $return = $this->getProfileImage($account->getProfile());
            }
        }

        return $return;
    }

    /**
     * Alias for create the image name
     *
     * @param Accountprofilecontact $profile
     * @return string
     */
    public function getProfileImage($profile)
    {
        $return = null;

        if ($profile) {
            $repository = $this->container->get("doctrine")->getRepository("CoreBundle:Image", "main");

            if ($profile->getImageId() && $image = $repository->find($profile->getImageId())) {
                $prefix = $profile->getAccountId();
                $id = $image->getId();
                $type = strtolower($image->getType());

                $return = sprintf("%d_photo_%d.%s", $prefix, $id, $type);
            }
        }

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'image_extension';
    }
}
