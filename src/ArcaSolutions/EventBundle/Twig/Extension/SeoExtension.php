<?php
namespace ArcaSolutions\EventBundle\Twig\Extension;

use ArcaSolutions\CoreBundle\Entity\Location2;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\EventBundle\Entity\EventCategory;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SeoExtension extends \Twig_Extension
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
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'seo.event';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'generateEventSEO',
                [$this, 'generateEventSEO'],
                ['is_safe' => ['all']]
            ),
        ];
    }

    public function generateEventSEO(Event $item, array $titlePart = null)
    {
        $keywords[] = $item->getSeoKeywords();
        $description = $item->getSeoDescription();

        if ($titlePart == null) {
            $titlePart[] = $item->getSeoTitle() ? $item->getSeoTitle() : $item->getTitle();
        }

        $locations = $this->container->get('location.service')->getLocations($item);
        $doctrine = $this->container->get("doctrine");

        $countryName = $locations['country'] ? $locations['country']->getName() : null;
        $region = $locations['state'] ? $locations['state']->getName() : null;
        $locality = $locations['city'] ? $locations['city']->getName() : null;

        while ($locations) {
            /* @var $location Location2 */
            if ($location = array_pop($locations)) {
                $titlePart[] = $location->getName();
                $keywords[] = $location->getSeoKeywords();
            }
        }

        $categories = $item->getCategories();

        while ($categories) {
            /* @var $category EventCategory */
            if ($category = array_pop($categories)) {
                $keywords[] = $category->getSeoKeywords();
            }
        }

        $title = $this->container->get("translator")->trans(
            "%pageTitle% | %directoryTitle%",
            [
                "%pageTitle%"      => implode(", ", $titlePart),
                "%directoryTitle%" => $this->container->get("multi_domain.information")->getTitle(),
            ]
        );

        if ($item->getImageId()) {
            $img = $doctrine->getRepository("ImageBundle:Image")->find($item->getImageId());
            $image = $this->container->get("request_stack")->getCurrentRequest()->getSchemeAndHttpHost().
                $this->container->get("templating.helper.assets")->getUrl(
                    $this->container->get("imagehandler")->getPath($img),
                    "domain_images"
                );
        } else {
            $image = $this->container->get('utility')->getLogoImage(true);
        }

        $url = $this->container->get("router")->generate(
            "event_detail",
            [
                "friendlyUrl" => $item->getFriendlyUrl(),
                "_format"     => "html",
            ],
            true
        );

        $schema = [
            "@context" => "http://schema.org",
            "@type"    => "Event",
            "name"     => $item->getTitle(),
        ];

        $item->getDescription() and $schema["description"] = $item->getDescription();
        $item->getStartDate() and $schema["startDate"] = $item->getStartDate()->format("c");
        $item->getEndDate() and $schema["endDate"] = $item->getEndDate()->format("c");
        $image and $schema["image"] = $image;

        $organizer = [];

        $item->getEmail() and $organizer["email"] = $item->getEmail();
        $item->getContactName() and $organizer["name"] = $item->getContactName();
        $item->getPhone() and $organizer["telephone"] = $item->getPhone();

        if ($organizer) {
            $organizer["@type"] = "Person";
            $schema["organizer"] = $organizer;
        }

        $location = [
            "name"  => $item->getLocation() ? $item->getLocation() : $item->getTitle(),
            "url"   => $url,
            "@type" => "Place",
        ];

        if ($item->getLatitude() or $item->getLongitude()) {
            $location["geo"] = [
                "@type"     => "GeoCoordinates",
                "latitude"  => $item->getLatitude(),
                "longitude" => $item->getLongitude(),
            ];
        }

        $address = [];

        $locality and $address["addressLocality"] = $locality;
        $region and $address["addressRegion"] = $region;
        $countryName and $address["addressCountry"] = $countryName;
        $item->getZipCode() and $address["postalCode"] = $item->getZipCode();
        $item->getAddress() and $address["streetAddress"] = $item->getAddress();

        if ($address) {
            $address["@type"] = "PostalAddress";
            $location["address"] = $address;
        }

        $schema["location"] = $location;

        return $this->container->get("twig")->render(
            "::blocks/seo/place.og.html.twig",
            [
                "title"       => $title,
                "description" => $description,
                "keywords"    => preg_replace("/,+/", ",", implode(', ', $keywords)),
                "author"      => $this->container->get('customtexthandler')->get('header_author'),
                "schema"      => json_encode($schema),
                "og"          => [
                    "url"         => $url,
                    "type"        => "place",
                    "title"       => $title,
                    "description" => $description,
                    "image"       => $image,
                    "place"       => [
                        "locationLatitude"  => $item->getLatitude(),
                        "locationLongitude" => $item->getLongitude(),
                    ],
                ],
            ]
        );
    }
}
