<?php
namespace ArcaSolutions\ArticleBundle\Sample;

use ArcaSolutions\ArticleBundle\Entity\Article;
use ArcaSolutions\ImageBundle\Sample\GalleryImageSample;
use ArcaSolutions\WebBundle\Sample\ReviewSample;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ArticleSample extends Article
{
    /**
     * Quantity of reviews in this sample
     *
     * @var int
     */
    private $reviewCount = 4;

    /**
     * Quantity of category in this sample
     *
     * @var int
     */
    private $categoriesCount = 2;

    /*
     * @var misc
     */
    private $translator;

    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * ArticleSample constructor.
     *
     * @param int $level
     */
    public function __construct($level = 0, $translator, $doctrine)
    {
        $this->translator = $translator;
        $this->doctrine = $doctrine;

        $this->setTitle($this->translator->trans('Article Title'))
            ->setFriendlyUrl('article-sample')
            ->setContent(
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.</p>'
            )
            ->setAvgReview(rand() % 5 + 1)
            ->setLevel($level)
            ->setLevelObj($this->doctrine->getRepository('ArticleBundle:Articlelevel')->find($level))
            ->setPublicationDate($startDate = new \DateTime('now'))
            ->setRenewalDate($startDate)
            ->setUpdated($startDate)
            ->setAuthor($this->translator->trans('Article Author'))
            ->setAuthorUrl($this->translator->trans('www.yoursite.com'))
            ->setStatus('A');
    }

    /**
     * Gets categories sample
     *
     * @return array
     */
    public function getCategories()
    {
        $array = [];
        for ($i = 0; $i < $this->categoriesCount; $i++) {
            $array[] = new ArticlecategorySample($this->translator, $i);
        }

        return $array;
    }

    /**
     * Gets gallery images sample
     *
     * @param int $qtde_level
     *
     * @return array
     */
    public function getGallery($qtde_level = 0)
    {
        $array = [];
        for ($i = 0; $i < $qtde_level; $i++) {
            $galleryImage = new GalleryImageSample(640, 480, $this->translator->trans('Placeholder'));
            if (0 == $i) {
                $galleryImage->setImageDefault('y');
            }
            $array[] = $galleryImage;
        }

        return $array;
    }

    /**
     * Gets reviews for sample
     *
     * @return array
     */
    public function getReviews()
    {
        $array = [];
        for ($i = 0; $i < $this->reviewCount; $i++) {
            $array[] = new ReviewSample($this->translator, 'article');
        }

        return $array;
    }

    /**
     * Get quantity of reviews in sample
     *
     * @return int
     */
    public function getReviewCount()
    {
        $reviewCount = array ();
        $reviewCount[ 1 ] = $this->reviewCount;

        return $reviewCount;
    }

}
