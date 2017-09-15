<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use ArcaSolutions\ApiBundle\Helper\CategoryHelper;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BrowseByCategoryExtension extends \Twig_Extension
{
    /**
     * ContainerInterface
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('browseByCategory', [$this, 'browseByCategory'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('browseByCategoryListing', [$this, 'browseByCategoryListing'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('browseByCategoryDeal', [$this, 'browseByCategoryDeal'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('browseByCategoryEvent', [$this, 'browseByCategoryEvent'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('browseByCategoryArticle', [$this, 'browseByCategoryArticle'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('browseByCategoryClassified', [$this, 'browseByCategoryClassified'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('browseByCategoryBlog', [$this, 'browseByCategoryBlog'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('getCategoriesByModule', [$this, 'getCategoriesByModule']),
        ];
    }

    /**
     * Alias function of browseByCategory for Listing module
     *
     * Twig:
     * <code>
     * browseByCategoryListing()
     * browseByCategoryListing(null, 'all', content)
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     * @param null $limit
     * @param string $type [all,feature,regular]
     * @param string $content labels of the widget
     *
     * @return string
     */
    public function browseByCategoryListing(
        \Twig_Environment $twig_Environment,
        $limit = null,
        $type = 'all',
        $content = null
    ) {
        return $this->browseByCategory($twig_Environment, 'listing', $limit, $type, $content);
    }

    /**
     * Render BrowseByCategory's block used in many pages, like homepage
     *
     * Twig:
     * <code>
     * browseByCategory('listing')
     * browseByCategory('deal')
     * browseByCategory('event')
     * browseByCategory('classified')
     * browseByCategory('blog')
     * browseByCategory('article')
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     * @param null $module
     * @param null $limit
     * @param string $type [all,feature,regular]
     * @param string $content
     *
     * @return string
     * @throws \Exception
     */
    public function browseByCategory(
        \Twig_Environment $twig_Environment,
        $module = null,
        $limit = null,
        $type = 'all',
        $content = null
    ) {
        $return = "";
        $categories = $this->getCategoriesByModule(in_array($module, ['listing', 'deal']) ? 'listing' : $module,
            $limit, $type);

        $view = '::blocks/browse-by-category.html.twig';

        if ($type == 'featured') {
            $view = '::blocks/browse-by-category-featured.html.twig';
        }

        if (isset($categories["featured"]) && $categories["featured"]
            or isset($categories["regular"]) && $categories["regular"]
        ) {
            $return = $twig_Environment->render($view, [
                'module' => $module,
                'all' => $module.'_allcategories',
                'categories' => $categories,
                'content' => $content,
            ]);
        }

        return $return;
    }

    /**
     * Get parents module's categories
     *
     * @param string $module
     * @param null $limit
     * @param string $type
     *
     * @return array
     * @throws \Exception
     */
    public function getCategoriesByModule($module, $limit = null, $type = 'all')
    {
        if (is_null($module)) {
            throw new \Exception('Module cannot be null');
        }

        $categories = [
            'featured' => [],
            'regular' => []
        ];

        $repository = $this->container->get('search.repository.category');

        if ($type == 'featured' || $type == 'all') {
            $categories['featured'] = $repository->findCategoriesWithItens($module, true);
        }

        if ($type == 'regular' || $type == 'all') {
            $categories['regular'] = $repository->findCategoriesWithItens($module, false);
        }

        return $categories;
    }

    /**
     * Alias function of browseByCategory for Deal module
     *
     * Twig:
     * <code>
     * browseByCategoryDeal()
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     * @param null $limit
     * @param string $type [all,feature,regular]
     *
     * @return string
     */
    public function browseByCategoryDeal(\Twig_Environment $twig_Environment, $limit = null, $type = 'all')
    {
        return $this->browseByCategory($twig_Environment, 'deal', $limit, $type);
    }

    /**
     * Alias function of browseByCategory for Event module
     *
     * Twig:
     * <code>
     * browseByCategoryEvent()
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     * @param null $limit
     * @param string $type [all,feature,regular]
     *
     * @return string
     */
    public function browseByCategoryEvent(\Twig_Environment $twig_Environment, $limit = null, $type = 'all')
    {
        return $this->browseByCategory($twig_Environment, 'event', $limit, $type);
    }

    /**
     * Alias function of browseByCategory for Classified module
     *
     * Twig:
     * <code>
     * browseByCategoryClassified()
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     * @param null $limit
     * @param string $type [all,feature,regular]
     *
     * @return string
     */
    public function browseByCategoryClassified(\Twig_Environment $twig_Environment, $limit = null, $type = 'all')
    {
        return $this->browseByCategory($twig_Environment, 'classified', $limit, $type);
    }

    /**
     * Alias function of browseByCategory for Article module
     *
     * Twig:
     * <code>
     * browseByCategoryArticle()
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     * @param null $limit
     * @param string $type [all,feature,regular]
     *
     * @return string
     */
    public function browseByCategoryArticle(\Twig_Environment $twig_Environment, $limit = null, $type = 'all')
    {
        return $this->browseByCategory($twig_Environment, 'article', $limit, $type);
    }

    /**
     * Alias function of browseByCategory for Blog module
     *
     * Twig:
     * <code>
     * browseByCategoryBlog()
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     * @param null $limit
     * @param string $type [all,feature,regular]
     *
     * @return string
     */
    public function browseByCategoryBlog(\Twig_Environment $twig_Environment, $limit = null, $type = 'all')
    {
        return $this->browseByCategory($twig_Environment, 'blog', $limit, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'browse_by_category';
    }
}
