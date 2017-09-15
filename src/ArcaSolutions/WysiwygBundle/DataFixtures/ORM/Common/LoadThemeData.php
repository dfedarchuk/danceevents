<?php


namespace ArcaSolutions\WysiwygBundle\DataFixtures\ORM\Common;


use ArcaSolutions\WysiwygBundle\Entity\Theme;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadThemeData
 *
 * This class is responsible for inserting at the Database the standard Themes of the system
 *
 */
class LoadThemeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /* Theme title is used as reference in LoadPageWidgetData,
         *  so if you change here don't forget to change there
         **/
        $standardThemes = [
            Theme::DEFAULT_THEME,
            Theme::DOCTOR_THEME,
            Theme::RESTAURANT_THEME,
            Theme::WEDDING_THEME,
            /**
             * CUSTOM ADDTHEME
             * here are an example of how you add the theme 'Test'
             *
             * Theme::TEST_THEME,  */
        ];

        $repository = $manager->getRepository('WysiwygBundle:Theme');

        foreach ($standardThemes as $standardTheme) {
            $query = $repository->findOneBy(['title' => $standardTheme]);

            $theme = new Theme();
            /* checks if the theme already exist so they can be updated or added */
            if (count($query) != 0) {
                $theme = $query;
            }

            $theme->setTitle($standardTheme);

            $manager->persist($theme);
            $manager->flush();

            $this->addReference($theme->getTitle(), $theme);
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
