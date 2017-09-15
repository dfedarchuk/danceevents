<?php

namespace ArcaSolutions\WysiwygBundle\DataFixtures\ORM\ThemeRestaurant;

use ArcaSolutions\WysiwygBundle\Entity\PageWidget;
use ArcaSolutions\WysiwygBundle\Entity\Theme;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadPageWidgetData
 *
 * This class is responsible for inserting at the DataBase the standard PageWidgets of the system
 * The table PageWidgets has the information of which widgets a page has and in which order they are allocated.
 *
 * @package ArcaSolutions\WysiwygBundle\DataFixtures\ORM
 */
class LoadPageWidgetData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $repository = $manager->getRepository('WysiwygBundle:PageWidget');
        $wysiwyg = $this->container->get('wysiwyg.service');
        $wysiwyg->setTheme(Theme::RESTAURANT_THEME);
        $pagesDefault = $wysiwyg->getAllPageDefaultWidgets();

        // Get specific contents
        $contents = $this->container->get('wysiwyg.service')->getDefaultSpecificWidgetContents();

        foreach ($pagesDefault as $pageType => $pageDefaults) {
            $count = 1;
            foreach ($pageDefaults as $pageDefault) {
                $pageWidget = new PageWidget();

                $query = $repository->findOneBy([
                    'pageId'   => $this->getReference($pageType.'_REFERENCE')->getId(),
                    'widgetId' => $this->getReference($pageDefault)->getId(),
                    'order'    => $count,
                    'themeId'  => $this->getReference(Theme::RESTAURANT_THEME)->getId(),
                ]);

                if (count($query) != 0) {
                    $pageWidget = $query;
                }

                $pageWidget->setPage($this->getReference($pageType.'_REFERENCE'));
                $pageWidget->setWidget($this->getReference($pageDefault));
                $pageWidget->setOrder($count);
                $pageWidget->setContent(isset($contents[$pageType][$pageDefault]) ? $contents[$pageType][$pageDefault] : $this->getReference($pageDefault)->getContent());
                $pageWidget->setTheme($this->getReference(Theme::RESTAURANT_THEME));

                $manager->persist($pageWidget);
                $manager->flush();
                $count++;
                unset($pageWidget);
            }
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
        return 3;
    }
}
