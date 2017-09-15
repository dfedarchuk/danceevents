<?php

namespace ArcaSolutions\WysiwygBundle\DataFixtures\ORM\Common;


use ArcaSolutions\WysiwygBundle\Entity\Theme;
use ArcaSolutions\WysiwygBundle\Entity\WidgetTheme;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class LoadWidgetThemeData
 * @package ArcaSolutions\WysiwygBundle\DataFixtures\ORM
 */
class LoadWidgetThemeData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
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

        $wysiwyg = $this->container->get('wysiwyg.service');

        $widgetRepository = $manager->getRepository('WysiwygBundle:WidgetTheme');
        $themeRepository = $manager->getRepository('WysiwygBundle:Theme');
        $themes = $themeRepository->findAll();

        foreach ($themes as $theme) {
            $methodThemeWidgets = 'get' . $theme->getTitle() . 'ThemeWidgets';
            $standardWidgetThemes = $wysiwyg->$methodThemeWidgets();

            foreach ($standardWidgetThemes as $standardWidgetTheme) {
                $query = $widgetRepository->findOneBy([
                    'widgetId' => $this->getReference($standardWidgetTheme)->getId(),
                    'themeId'  => $theme->getId(),
                ]);

                $widgetTheme = new WidgetTheme();
                /* checks if the widgetTheme relationship already exist so they can be updated or added */
                if (count($query) != 0) {
                    $widgetTheme = $query;
                }

                $widgetTheme->setWidget($this->getReference($standardWidgetTheme));
                $widgetTheme->setTheme($theme);

                $manager->persist($widgetTheme);
                $manager->flush();

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
        return 2;
    }
}
