<?php
namespace ArcaSolutions\DealBundle\Twig\Extension;

use ArcaSolutions\CoreBundle\Entity\Location2;
use ArcaSolutions\CoreBundle\Services\Settings;
use ArcaSolutions\CoreBundle\Services\Utility;
use ArcaSolutions\DealBundle\Entity\Promotion;
use ArcaSolutions\ListingBundle\Entity\Listing;
use ArcaSolutions\ListingBundle\Entity\ListingCategory;
use ArcaSolutions\ListingBundle\Entity\ListingCategory1;
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
        return 'seo.deal';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'generateDealSEO',
                [$this, 'generateDealSEO'],
                ['is_safe' => ['all']]
            ),
        ];
    }

    public function generateDealSEO(Promotion $item)
    {
        $translator = $this->container->get("translator");

        $keywords[] = $item->getSeoKeywords();
        $description = $item->getSeoDescription();

        $titlePart[] = $item->getSeoName() ? $item->getSeoName() : $item->getName();
        $categoryNames = [];

        /* @var $listing Listing */
        if ($listing = $item->getListing()) {
            $titlePart[] = $translator->trans("offered by \"%name%\"", ["%name%" => $listing->getTitle()]);

            $locations = $this->container->get('location.service')->getLocations($listing);

            while ($locations) {
                /* @var $location Location2 */
                if ($location = array_pop($locations)) {
                    $keywords[] = $location->getSeoKeywords();
                }
            }

            $categories = array_map(function ($item) {
                /* @var $item ListingCategory1 */
                return $item->getCategory();
            }, $listing->getCategories()->toArray());

            while ($categories) {
                /* @var $category ListingCategory */
                if ($category = array_pop($categories)) {
                    $categoryNames[] = $category->getTitle();
                    $keywords[] = $category->getSeoKeywords();
                }
            }
        }

        $title = $translator->trans(
            "%pageTitle% | %directoryTitle%",
            [
                "%pageTitle%"      => implode(", ", $titlePart),
                "%directoryTitle%" => $this->container->get("multi_domain.information")->getTitle(),
            ]
        );

        $url = $this->container->get("router")->generate(
            "deal_detail",
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
            "price"           => $item->getDealvalue(),
            "priceCurrency"   => $currency,
            "priceValidUntil" => $item->getEndDate()->format("c"),
            "availability"    => "http://schema.org/InStock",
            "seller"          => [
                "@type" => "Organization",
                "name"  => $listing->getTitle(),
                "url"   => $this->container->get("router")->generate(
                    "listing_detail",
                    [
                        "friendlyUrl" => $listing->getFriendlyUrl(),
                        "_format"     => "html",
                    ],
                    true
                ),
            ],
            "itemOffered"     => [
                "@type" => "Product",
                "name"  => $item->getName(),
                "image" => $image,
            ],
        ];

        $item->getDescription() and $schema["description"] = $item->getDescription();

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
                        "priceAmount"   => $item->getRealvalue(),
                        "priceCurrency" => $currency,
                        "productLink"   => $url,
                        "deal"          => [
                            "brand"                 => $listing->getTitle(),
                            "originalPriceAmount"   => $item->getRealvalue(),
                            "originalPriceCurrency" => $currency,
                            "salePriceAmount"       => $item->getDealvalue(),
                            "salePriceCurrency"     => $currency,
                            "salePriceDatesStart"   => $item->getStartDate()->format("c"),
                            "salePriceDatesEnd"     => $item->getEndDate()->format("c"),
                        ],
                    ],
                ],
            ]
        );
    }
}
