<?php

namespace ArcaSolutions\ApiBundle\Helper;
use ArcaSolutions\ArticleBundle\Entity\Articlecategory;
use ArcaSolutions\BlogBundle\Entity\BlogCategory1;
use ArcaSolutions\ClassifiedBundle\Entity\Classifiedcategory;
use ArcaSolutions\EventBundle\Entity\Eventcategory;
use ArcaSolutions\ListingBundle\Entity\ListingCategory;
use ArcaSolutions\MultiDomainBundle\Doctrine\DoctrineRegistry;

/**
 * Class CategoryHelper
 *
 * @package \ArcaSolutions\ApiBundle\Helper
 */
class CategoryHelper
{
    /**
     * @var DoctrineRegistry
     */
    private $doctrine;

    /**
     * CategoryHelper constructor.
     * @param $doctrine
     */
    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param string classified|event|listing|blog|deal|article $module
     * @return string
     * @throws \Exception
     */
    public static function getRepositoryNameByModule($module)
    {
        $repository = '';

        switch ($module) {
            /* deal's categories are from listing */
            case 'deal':
            case 'listing':
                $repository = 'ListingBundle:ListingCategory';
                break;
            case 'article':
                $repository = 'ArticleBundle:Articlecategory';
                break;
            case 'post':
            case 'blog':
                $repository = 'BlogBundle:Blogcategory';
                break;
            case 'classified':
                $repository = 'ClassifiedBundle:Classifiedcategory';
                break;
            case 'event':
                $repository = 'EventBundle:Eventcategory';
                break;
            default:
                throw new \Exception(sprintf('Module passed is not a valid module. It was giver: %s', ucfirst($module)));
                break;
        }

        return $repository;
    }

    /**
     * Get all featured categories from a repository
     *
     * @param string ListingCategory|Classifiedcategory|Articlecategory|BlogCategory1|Eventcategory $repository
     * @return ListingCategory[]|Classifiedcategory[]|Articlecategory[]|BlogCategory1[]|Eventcategory[]
     * @throws \Exception
     */
    public function getFeaturedCategories($repository)
    {
        if (empty($repository)) {
            throw new \Exception('You should pass a repository name in the parameter');
        }

        return $this->doctrine->getRepository($repository)->getParentCategories();
    }

    /**
     * Get all categories from a repository
     *
     * @param string ListingCategory|Classifiedcategory|Articlecategory|BlogCategory1|Eventcategory $repository
     * @return ListingCategory[]|Classifiedcategory[]|Articlecategory[]|BlogCategory1[]|Eventcategory[]
     * @throws \Exception
     */
    public function getCategories($repository)
    {
        if (empty($repository)) {
            throw new \Exception('You should pass a repository name in the parameter');
        }

        return $this->doctrine->getRepository($repository)->findBy([
            'enabled' => 'y',
        ]);
    }
}
