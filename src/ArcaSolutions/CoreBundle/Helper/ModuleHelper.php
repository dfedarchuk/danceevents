<?php

namespace ArcaSolutions\CoreBundle\Helper;

use Symfony\Component\DependencyInjection\Container;

class ModuleHelper
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param $module
     * @return string
     * @throws \Exception
     */
    public function getModuleRepositoryName($module)
    {
        switch ($module) {
            case 'article':
                $repository = 'ArticleBundle:Article';
                break;
            case 'classified':
                $repository = 'ClassifiedBundle:Classified';
                break;
            case 'event':
                $repository = 'EventBundle:Event';
                break;
            case 'listing':
                $repository = 'ListingBundle:Listing';
                break;
            case 'deal':
            case 'promotion':
                $repository = 'DealBundle:Promotion';
                break;
            case 'post':
            case 'blog':
                $repository = 'BlogBundle:Post';
                break;
            default:
                throw new \Exception(sprintf('Module not found (%s given).', $module));
                break;
        }

        return $repository;
    }

    /**
     * @param $module
     * @return string
     * @throws \Exception
     */
    public function getModuleLevelRepositoryName($module)
    {
        switch ($module) {
            case 'article':
                $repository = 'ArticleBundle:ArticleLevel';
                break;
            case 'classified':
                $repository = 'ClassifiedBundle:ClassifiedLevel';
                break;
            case 'event':
                $repository = 'EventBundle:EventLevel';
                break;
            case 'banner':
                $repository = 'BannersBundle:Bannerlevel';
                break;
            case 'listing':
                $repository = 'ListingBundle:ListingLevel';
                break;
            default:
                throw new \Exception(sprintf('Module not found (%s given).', $module));
                break;
        }

        return $repository;
    }

    /**
     * Returns the canonical name of this helper.
     *
     * @return string The canonical name
     *
     * @api
     */
    public function getName()
    {
        return 'ModuleHelper';
    }
}
