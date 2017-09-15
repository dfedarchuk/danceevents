<?php
namespace ArcaSolutions\ClassifiedBundle\Twig\Extension;

use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use ArcaSolutions\ClassifiedBundle\Entity\ClassifiedCategory;
use ArcaSolutions\CoreBundle\Entity\Location2;
use ArcaSolutions\CoreBundle\Services\Settings;
use ArcaSolutions\CoreBundle\Services\Utility;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SeoExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * SeoExtension constructor.
     *
     * @param ContainerInterface $container
     * @param Settings $settings
     */
    public function __construct(ContainerInterface $container, Settings $settings)
    {
        $this->container = $container;
        $this->settings = $settings;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'seo.classified';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'generateClassifiedSEO',
                [$this, 'generateClassifiedSEO'],
                ['is_safe' => ['all']]
            ),
        ];
    }

    public function generateClassifiedSEO(Classified $item)
    {
        $translator = $this->container->get("translator");

        $keywords[] = $item->getSeoKeywords();
        $description = $item->getSeoSummarydesc();

        $titlePart[] = $item->getSeoTitle() ? $item->getSeoTitle() : $item->getTitle();

        $locations = $this->container->get('location.service')->getLocations($item);

        while ($locations) {
            /* @var $location Location2 */
            if ($location = array_pop($locations)) {
                $titlePart[] = $location->getName();
                $keywords[] = $location->getSeoKeywords();
            }
        }

        $categories = $item->getCategories();
        $categoryNames = [];

        while ($categories) {
            /* @var $category ClassifiedCategory */
            if ($category = array_pop($categories)) {
                $categoryNames[] = $category->getTitle();
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


        $url = $this->container->get("router")->generate(
            "classified_detail",
            [
                "friendlyUrl" => $item->getFriendlyUrl(),
                "_format"     => "html",
            ],
            true
        );

        if ($item->getImageId()) {
            $img = $this->container->get("doctrine")->getRepository("ImageBundle:Image")->find($item->getImageId());
            $image = $this->container->get("request_stack")->getCurrentRequest()->getSchemeAndHttpHost().
                $this->container->get("templating.helper.assets")->getUrl(
                    $this->container->get("imagehandler")->getPath($img),
                    "domain_images"
                );
        } else {
            $image = $this->container->get('utility')->getLogoImage(true);
        }

        $currency = $this->settings->getSettingPayment('PAYMENT_CURRENCY');
        $schema = [
            "@context"        => "http://schema.org",
            "@type"           => "Offer",
            "url"             => $url,
            "price"           => $item->getClassifiedPrice(),
            "priceCurrency"   => $currency,
            "priceValidUntil" => $item->getRenewalDate()->format("c"),
            "availability"    => "http://schema.org/InStock",
            "itemOffered"     => [
                "@type" => "Product",
                "name"  => $item->getTitle(),
                "image" => $image,
            ],
        ];

        $item->getSummarydesc() and $schema["description"] = $item->getSummarydesc();

        return $this->container->get("twig")->render(
            "::blocks/seo/product.og.html.twig",
            [
                "title"       => $title,
                "description" => $description,
                "keywords"    => preg_replace("/,+/", ",", implode(', ', $keywords)),
                "author"      => $this->container->get('customtexthandler')->get('header_author'),
                "schema"      => json_encode($schema),
                "og"          => [
                    "url"         => $url,
                    "type"        => "product",
                    "title"       => $title,
                    "description" => $description,
                    "image"       => $image,
                    "product"     => [
                        "category"      => $this->container->get("utility")->convertArrayToHumanReadableString($categoryNames),
                        "priceAmount"   => $item->getClassifiedPrice(),
                        "priceCurrency" => $currency,
                        "productLink"   => $url,
                    ],
                ],
            ]
        );
    }
}
