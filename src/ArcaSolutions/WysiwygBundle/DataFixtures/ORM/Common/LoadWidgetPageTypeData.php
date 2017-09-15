<?php


namespace ArcaSolutions\WysiwygBundle\DataFixtures\ORM\Common;


use ArcaSolutions\WysiwygBundle\Entity\WidgetPageType;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadWidgetPageTypeData
 *
 * This class is responsible for inserting at the Database the standard Widget_PageType of the system
 *
 */
class LoadWidgetPageTypeData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Get all loaded widgets
        $widgets = $this->container->get('doctrine')->getRepository('WysiwygBundle:Widget')->findAll();
        $standardWidgetPageTypes = [];

        // Widget that have page type exception
        $exceptionsWidgets = [
            'Results Info'                                     => $this->getReference("TYPE_".Wysiwyg::RESULTS_PAGE),
            'Results content with left filters'                => $this->getReference("TYPE_".Wysiwyg::RESULTS_PAGE),
            'Results content with right filters'               => $this->getReference("TYPE_".Wysiwyg::RESULTS_PAGE),
            'Results content with left filters and grid view'  => $this->getReference("TYPE_".Wysiwyg::RESULTS_PAGE),
            'Results content with right filters and grid view' => $this->getReference("TYPE_".Wysiwyg::RESULTS_PAGE),
            'Listing Detail'                                   => $this->getReference("TYPE_".Wysiwyg::LISTING_DETAIL_PAGE),
            'Event Detail'                                     => $this->getReference("TYPE_".Wysiwyg::EVENT_DETAIL_PAGE),
            'Classified Detail'                                => $this->getReference("TYPE_".Wysiwyg::CLASSIFIED_DETAIL_PAGE),
            'Article Detail'                                   => $this->getReference("TYPE_".Wysiwyg::ARTICLE_DETAIL_PAGE),
            'Deal Detail'                                      => $this->getReference("TYPE_".Wysiwyg::DEAL_DETAIL_PAGE),
            'Blog Detail'                                      => $this->getReference("TYPE_".Wysiwyg::BLOG_DETAIL_PAGE),
            'Search box Blog detail'                           => $this->getReference("TYPE_".Wysiwyg::BLOG_DETAIL_PAGE),
            'Search box module detail'                         => [
                $this->getReference("TYPE_".Wysiwyg::LISTING_DETAIL_PAGE),
                $this->getReference("TYPE_".Wysiwyg::EVENT_DETAIL_PAGE),
                $this->getReference("TYPE_".Wysiwyg::CLASSIFIED_DETAIL_PAGE),
                $this->getReference("TYPE_".Wysiwyg::DEAL_DETAIL_PAGE),
                $this->getReference("TYPE_".Wysiwyg::ARTICLE_DETAIL_PAGE),
            ],
            'Contact form'                                     => $this->getReference("TYPE_".Wysiwyg::CONTACT_US_PAGE),
            'Faq box'                                          => $this->getReference("TYPE_".Wysiwyg::FAQ_PAGE),
            'Faq header'                                       => $this->getReference("TYPE_".Wysiwyg::FAQ_PAGE),
            'Sitemap Header'                                   => $this->getReference("TYPE_".Wysiwyg::SITEMAP_PAGE),
            'Sitemap'                                          => $this->getReference("TYPE_".Wysiwyg::SITEMAP_PAGE),
            'Sign Up Text'                                     => $this->getReference("TYPE_".Wysiwyg::ADVERTISE_PAGE),
            'Pricing & Plans'                                  => $this->getReference("TYPE_".Wysiwyg::ADVERTISE_PAGE),
            'Search box for Reviews page'                      => [
                $this->getReference("TYPE_".Wysiwyg::LISTING_REVIEWS),
                $this->getReference("TYPE_".Wysiwyg::ARTICLE_REVIEWS),
            ],
            'Reviews block'                                    => [
                $this->getReference("TYPE_".Wysiwyg::LISTING_REVIEWS),
                $this->getReference("TYPE_".Wysiwyg::ARTICLE_REVIEWS),
            ],
            'All Locations'                                    => [
                $this->getReference("TYPE_".Wysiwyg::LISTING_ALL_LOCATIONS),
                $this->getReference("TYPE_".Wysiwyg::CLASSIFIED_ALL_LOCATIONS),
                $this->getReference("TYPE_".Wysiwyg::DEAL_ALL_LOCATIONS),
                $this->getReference("TYPE_".Wysiwyg::EVENT_ALL_LOCATIONS),
            ],
            'All Categories'                                   => [
                $this->getReference("TYPE_".Wysiwyg::LISTING_CATEGORIES_PAGE),
                $this->getReference("TYPE_".Wysiwyg::CLASSIFIED_CATEGORIES_PAGE),
                $this->getReference("TYPE_".Wysiwyg::EVENT_CATEGORIES_PAGE),
                $this->getReference("TYPE_".Wysiwyg::DEAL_CATEGORIES_PAGE),
                $this->getReference("TYPE_".Wysiwyg::ARTICLE_CATEGORIES_PAGE),
                $this->getReference("TYPE_".Wysiwyg::BLOG_CATEGORIES_PAGE),
            ],
            /* CUSTOM ADDWIDGET
             * here are an example of how you create an exception for the 'Widget test'
             * this way the widget will be available only for the Home Page
             */
            /*  'Widget test'                        => [
               $this->getReference("TYPE_".Wysiwyg::TEST_PAGE),
           ],*/
        ];

        foreach ($widgets as $widget) {
            // add to array widgets that can be used in more than 1 page but not all
            if (isset($exceptionsWidgets[$widget->getTitle()]) and is_array($exceptionsWidgets[$widget->getTitle()])) {
                foreach ($exceptionsWidgets[$widget->getTitle()] as $exceptionsWidget) {
                    $standardWidgetPageTypes[] = [
                        'widget'   => $widget,
                        'pageType' => $exceptionsWidget,
                    ];
                }
            } else {
                // Null pagetype is for universal widgets
                $pageType = null;
                if (isset($exceptionsWidgets[$widget->getTitle()])) {
                    $pageType = $exceptionsWidgets[$widget->getTitle()];
                }
                $standardWidgetPageTypes[] = [
                    'widget'   => $widget,
                    'pageType' => $pageType,
                ];
            }
        }

        $repository = $manager->getRepository('WysiwygBundle:WidgetPageType');

        foreach ($standardWidgetPageTypes as $standardWidgetPageType) {
            $query = $repository->findOneBy([
                'pageType' => $standardWidgetPageType['pageType'],
                'widget'   => $standardWidgetPageType['widget'],
            ]);

            $widgetPageType = new WidgetPageType();
            /* checks if the widget pagetype already exist so they can be   or added */
            if (count($query) == 0) {
                $widgetPageType->setWidget($standardWidgetPageType['widget']);
                $widgetPageType->setPageType($standardWidgetPageType['pageType']);
            } else {
                $widgetPageType = $query;
                $widgetPageType->setPageType($standardWidgetPageType['pageType']);
            }

            $manager->persist($widgetPageType);
            $manager->flush();
        }
    }

    /**
     * the order in which fixtures will be loaded
     * the lower the number, the sooner that this fixture is loaded
     *
     * @return int
     */
    public function getOrder()
    {
        return 4;
    }
}
