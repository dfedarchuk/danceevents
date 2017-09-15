<?php
namespace ArcaSolutions\WebBundle\Services;

use ArcaSolutions\WebBundle\Entity\Accountprofilecontact;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class ProfileImage
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ProfileImage constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param Accountprofilecontact $accountprofilecontact
     *
     * @return object
     */
    public function getProfileImage(Accountprofilecontact $accountprofilecontact)
    {
        return $this->container->get('doctrine')->getRepository('CoreBundle:Image', 'main')->findOneBy([
            'id' => $accountprofilecontact->getImageId()
        ]);
    }
}
