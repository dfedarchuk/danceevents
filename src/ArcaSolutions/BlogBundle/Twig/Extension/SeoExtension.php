<?php
namespace ArcaSolutions\BlogBundle\Twig\Extension;

use ArcaSolutions\BlogBundle\Entity\BlogCategory;
use ArcaSolutions\BlogBundle\Entity\BlogCategory1;
use ArcaSolutions\BlogBundle\Entity\Post;
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
        return 'seo.blog';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'generateBlogSEO',
                [$this, 'generateBlogSEO'],
                ['is_safe' => ['all']]
            ),
        ];
    }

    public function generateBlogSEO(Post $item)
    {
        $translator = $this->container->get("translator");

        $keywords[] = $item->getSeoKeywords();
        $description = $item->getSeoAbstract();

        $titlePart = $item->getSeoTitle() ? $item->getSeoTitle() : $item->getTitle();

        $categories = array_map(function ($item) {
            /* @var $item BlogCategory1 */
            return $item->getCategory();
        }, $item->getCategories()->toArray());

        if (!is_array($categories)) {
            $categories = $categories->getValues();
        }

        $categoryNames = [];

        while ($categories) {
            /* @var $category BlogCategory */
            if ($category = array_pop($categories)) {
                $categoryNames[] = $category->getTitle();
                $keywords[] = $category->getSeoKeywords();
            }
        }

        $title = $this->container->get("translator")->trans(
            "%pageTitle% | %directoryTitle%",
            [
                "%pageTitle%"      => $titlePart,
                "%directoryTitle%" => $this->container->get("multi_domain.information")->getTitle(),
            ]
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

        $url = $this->container->get("router")->generate(
            "blog_detail",
            [
                "friendlyUrl" => $item->getFriendlyUrl(),
                "_format"     => "html",
            ],
            true
        );

        $section = $this->container->get("utility")->convertArrayToHumanReadableString($categoryNames);

        $schema = [
            "@context"       => "http://schema.org",
            "@type"          => "BlogPosting",
            "headline"       => $item->getTitle(),
            "datePublished"  => $item->getEntered()->format("c"),
            "articleSection" => $section,
        ];

        $image and $schema["image"] = $image;
        $item->getSeoAbstract() and $schema["description"] = $item->getSeoAbstract();
        $item->getKeywords() and $schema["keywords"] = $item->getKeywords();

        return $this->container->get("twig")->render(
            "::blocks/seo/article.og.html.twig",
            [
                "title"       => $title,
                "description" => $description,
                "keywords"    => preg_replace("/,+/", ",", implode(', ', $keywords)),
                "author"      => $this->container->get('customtexthandler')->get('header_author'),
                "schema"      => json_encode($schema),
                "og"          => [
                    "url"         => $url,
                    "type"        => "article",
                    "title"       => $title,
                    "description" => $description,
                    "image"       => $image,
                    "article"     => [
                        "author"          => $this->container->get('customtexthandler')->get('header_author'),
                        "expiration_time" => null,
                        "modified_time"   => $item->getUpdated()->format("c"),
                        "published_time"  => $item->getEntered()->format("c"),
                        "section"         => $section,
                        "tag"             => preg_replace("/,+/", ",", implode(', ', $keywords)),
                    ],
                ],
            ]
        );
    }
}
