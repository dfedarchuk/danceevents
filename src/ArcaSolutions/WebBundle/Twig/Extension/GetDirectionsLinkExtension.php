<?php
namespace ArcaSolutions\WebBundle\Twig\Extension;

use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use ArcaSolutions\DealBundle\Entity\Promotion;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\ListingBundle\Entity\Listing;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class GetDirectionsLinkExtension
 *
 * Returns Get Directions tag linked to google maps
 *
 * @package ArcaSolutions\WebBundle\Twig\Extension
 */
final class GetDirectionsLinkExtension extends \Twig_Extension
{
    /**
     * Url from google to get the direction of latitude and longitude
     * string order: latitude,longitude
     */
    const GOOGLE_MAPS_URL = '//maps.google.com/maps?q=%s,%s';

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $containerInterface
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        $this->container = $containerInterface;
    }

    /**
     * Returns extension function's names
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('getDirectionsLink', [$this, 'getDirectionsLink'], [
                'needs_environment' => true,
                'is_safe'           => ['html']
            ])
        ];
    }

    /**
     * @param \Twig_Environment                  $twig_Environment
     * @param Listing|Classified|Event|Promotion $item
     *
     * @return string
     */
    public function getDirectionsLink(\Twig_Environment $twig_Environment, $item = null)
    {
        if (!$item || !$item->getLatitude() || !$item->getLongitude()) {
            return '';
        }

        $link = sprintf(self::GOOGLE_MAPS_URL, $item->getLatitude(), $item->getLongitude());

        return $twig_Environment->render('::blocks/get-directions.html.twig', [
            'link' => $link
        ]);
    }

    /**
     * Returns extension name
     */
    public function getName()
    {
        return 'get_directions_link_extension';
    }
}
