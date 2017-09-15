<?php
namespace ArcaSolutions\ArticleBundle\Twig\Extension;

use ArcaSolutions\ArticleBundle\Entity\Article;
use ArcaSolutions\ArticleBundle\Entity\ArticleCategory;
use ArcaSolutions\CoreBundle\Services\Utility;
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
        return 'seo.article';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'generateArticleSEO',
                [$this, 'generateArticleSEO'],
                ['is_safe' => ['all']]
            ),
            new \Twig_SimpleFunction(
                'generateArticleReviewsSEO',
                [$this, 'generateArticleReviewsSEO'],
                ['is_safe' => ['all']]
            ),
        ];
    }

    public function generateArticleReviewsSEO(Article $item)
    {
        return $this->generateGenericArticleSEO(
            $item,
            $this->container->get("translator")->trans("Reviews of \"%title%\"", ["%title%" => $item->getTitle()])
        );
    }

    public function generateArticleSEO(Article $item)
    {
        return $this->generateGenericArticleSEO($item, $item->getSeoTitle() ? $item->getSeoTitle() : $item->getTitle());
    }

    public function generateGenericArticleSEO(Article $item, $titlePart)
    {
        $translator = $this->container->get("translator");
        $doctrine = $this->container->get("doctrine");

        $keywords[] = $item->getSeoKeywords();
        $description = $item->getSeoAbstract();

        $categories = $item->getCategories();
        $categoryNames = [];

        while ($categories) {
            /* @var $category ArticleCategory */
            if ($category = array_pop($categories)) {
                $categoryNames[] = $category->getTitle();
                $keywords[] = $category->getSeoKeywords();
            }
        }

        $title = $translator->trans(
            "%pageTitle% | %directoryTitle%",
            [
                "%pageTitle%"      => $titlePart,
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
            "article_detail",
            [
                "friendlyUrl" => $item->getFriendlyUrl(),
                "_format"     => "html",
            ],
            true
        );


        $section = $this->container->get("utility")->convertArrayToHumanReadableString($categoryNames);

        $totalByItemId = (array)$doctrine->getRepository('WebBundle:Review')
            ->getTotalByItemId(
                $item->getId(),
                'article'
            );

        $schema = [
            "@context"       => "http://schema.org",
            "@type"          => "NewsArticle",
            "headline"       => $item->getTitle(),
            "datePublished"  => $item->getPublicationDate()->format("c"),
            "articleSection" => $section,
        ];

        $image and $schema["image"] = $image;
        $item->getAbstract() and $schema["description"] = $item->getAbstract();
        $item->getKeywords() and $schema["keywords"] = $item->getKeywords();


        if ($item->getAvgReview() && $totalByItemId) {
            $schema["aggregateRating"] = [
                "@type"       => "AggregateRating",
                "ratingValue" => $item->getAvgReview(),
                "reviewCount" => array_pop($totalByItemId) ?: 0,
            ];
        }

        $author = [];

        $item->getAuthor() and $author["name"] = $item->getAuthor();
        $item->getAuthorUrl() and $author["url"] = $item->getAuthorUrl();

        if ($author) {
            $author["@type"] = "Person";
            $schema["author"] = $author;
        }

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
                        "author"         => $item->getAuthor(),
                        "expirationTime" => $item->getRenewalDate()->format("c"),
                        "modifiedTime"   => $item->getUpdated()->format("c"),
                        "publishedTime"  => $item->getPublicationDate()->format("c"),
                        "section"        => $section,
                        "tag"            => preg_replace("/,+/", ",", implode(', ', $keywords)),
                    ],
                ],
            ]
        );
    }
}
