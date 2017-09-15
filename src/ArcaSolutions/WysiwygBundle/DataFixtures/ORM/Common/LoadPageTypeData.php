<?php

namespace ArcaSolutions\WysiwygBundle\DataFixtures\ORM\Common;

use ArcaSolutions\WysiwygBundle\Entity\PageType;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadPageTypeData
 * @package ArcaSolutions\WysiwygBundle\DataFixtures\ORM\Common
 */
class LoadPageTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $standardPageTypes = [
            [
                'title' => Wysiwyg::HOME_PAGE,
            ],
            [
                'title' => Wysiwyg::LISTING_HOME_PAGE,
            ],
            [
                'title' => Wysiwyg::EVENT_HOME_PAGE,
            ],
            [
                'title' => Wysiwyg::CLASSIFIED_HOME_PAGE,
            ],
            [
                'title' => Wysiwyg::ARTICLE_HOME_PAGE,
            ],
            [
                'title' => Wysiwyg::DEAL_HOME_PAGE,
            ],
            [
                'title' => Wysiwyg::BLOG_HOME_PAGE,
            ],
            [
                'title' => Wysiwyg::RESULTS_PAGE,
            ],
            [
                'title' => Wysiwyg::LISTING_DETAIL_PAGE,
            ],
            [
                'title' => Wysiwyg::EVENT_DETAIL_PAGE,
            ],
            [
                'title' => Wysiwyg::CLASSIFIED_DETAIL_PAGE,
            ],
            [
                'title' => Wysiwyg::ARTICLE_DETAIL_PAGE,
            ],
            [
                'title' => Wysiwyg::DEAL_DETAIL_PAGE,
            ],
            [
                'title' => Wysiwyg::BLOG_DETAIL_PAGE,
            ],
            [
                'title' => Wysiwyg::CONTACT_US_PAGE,
            ],
            [
                'title' => Wysiwyg::FAQ_PAGE,
            ],
            [
                'title' => Wysiwyg::TERMS_OF_SERVICE_PAGE,
            ],
            [
                'title' => Wysiwyg::PRIVACY_POLICY_PAGE,
            ],
            [
                'title' => Wysiwyg::SITEMAP_PAGE,
            ],
            [
                'title' => Wysiwyg::MAINTENANCE_PAGE,
            ],
            [
                'title' => Wysiwyg::ERROR404_PAGE,
            ],
            [
                'title' => Wysiwyg::ADVERTISE_PAGE,
            ],
            [
                'title' => Wysiwyg::CUSTOM_PAGE,
            ],
            [
                'title' => Wysiwyg::LISTING_CATEGORIES_PAGE,
            ],
            [
                'title' => Wysiwyg::EVENT_CATEGORIES_PAGE,
            ],
            [
                'title' => Wysiwyg::CLASSIFIED_CATEGORIES_PAGE,
            ],
            [
                'title' => Wysiwyg::ARTICLE_CATEGORIES_PAGE,
            ],
            [
                'title' => Wysiwyg::DEAL_CATEGORIES_PAGE,
            ],
            [
                'title' => Wysiwyg::BLOG_CATEGORIES_PAGE,
            ],
            [
                'title' => Wysiwyg::LISTING_ALL_LOCATIONS,
            ],
            [
                'title' => Wysiwyg::EVENT_ALL_LOCATIONS,
            ],
            [
                'title' => Wysiwyg::CLASSIFIED_ALL_LOCATIONS,
            ],
            [
                'title' => Wysiwyg::DEAL_ALL_LOCATIONS,
            ],
            [
                'title' => Wysiwyg::LISTING_REVIEWS,
            ],
            [
                'title' => Wysiwyg::ARTICLE_REVIEWS,
            ],
            [
                'title' => Wysiwyg::ITEM_UNAVAILABLE_PAGE,
            ],
            /*
             * CUSTOM ADDPAGETYPE
             * here are an example of how you add a PageType to be used in LoadPageData
             */
            /* [
               'title' => Wysiwyg::TEST_PAGE,
           ],*/
        ];

        $repository = $manager->getRepository('WysiwygBundle:PageType');
        foreach ($standardPageTypes as $standardPageType) {
            $pageType = new PageType();

            $query = $repository->findOneBy(['title' => $standardPageType['title']]);
            if (count($query) != 0) {
                $pageType = $query;
            }

            $pageType->setTitle($standardPageType['title']);

            $manager->persist($pageType);
            $manager->flush();

            $this->addReference("TYPE_".$pageType->getTitle(), $pageType);
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
        return 1;
    }
}
