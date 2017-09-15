<?php

namespace ArcaSolutions\WebBundle\Twig\Extension;

use ArcaSolutions\MultiDomainBundle\Doctrine\DoctrineRegistry;
use ArcaSolutions\SearchBundle\Services\SearchEngine;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class BrowseByLocationExtension extends \Twig_Extension
{
    /** @var DoctrineRegistry Domain entity manager */
    private $domainEm;

    /** @var EntityManagerInterface Main entity manager */
    private $mainEm;

    /** @var SearchEngine */
    private $searchEngine;

    public function __construct(DoctrineRegistry $em, SearchEngine $searchEngine, EntityManager $mainEm)
    {
        $this->domainEm = $em;
        $this->searchEngine = $searchEngine;
        $this->mainEm = $mainEm;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('browseByLocation', [$this, 'browseByLocation'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('browseByLocationListing', [$this, 'browseByLocationListing'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('browseByLocationEvent', [$this, 'browseByLocationEvent'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('browseByLocationClassified', [$this, 'browseByLocationClassified'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('browseByLocationDeal', [$this, 'browseByLocationDeal'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('getLocationByModule', [$this, 'getLocationByModule']),
        ];
    }

    /**
     * Alias function of browseByLocation for Listing module
     *
     * Twig:
     * <code>
     * browseByLocationListing()
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     *
     * @param null $limit
     * @return string
     */
    public function browseByLocationListing(\Twig_Environment $twig_Environment, $limit = null, $content = null)
    {
        return $this->browseByLocation($twig_Environment, 'listing', $limit, $content);
    }

    /**
     * Render BrowseByLocation's block used in many pages, like homepage
     *
     * Twig:
     * <code>
     * browseByLocation('listing')
     * browseByLocation('event')
     * browseByLocation('classified')
     * browseByLocation('deal')
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     * @param null $module
     * @param null $content
     *
     * @param int $limit
     * @return string
     * @throws \Exception
     */
    public function browseByLocation(
        \Twig_Environment $twig_Environment,
        $module = null,
        $limit = 65,
        $content = null
    ) {
        $locations = $this->getLocationByModule($module, $limit);

        if (count($locations) == 0) {
            return '';
        }

        return $twig_Environment->render('::blocks/browse-by-location.html.twig',
            [
                'locations' => $locations,
                'module'    => $module,
                'route'     => $module.'_alllocations',
                'content'   => $content,
            ]);
    }

    /**
     * Get parents module's categories
     *
     * @param string $module Can be: 'listing', 'event', 'classified', 'deal'
     *
     * @param int $limit
     * @return array
     * @throws \Exception
     */
    public function getLocationByModule($module, $limit)
    {
        if (is_null($module)) {
            throw new \Exception('Module cannot be null');
        }

        $level = $this->domainEm->getRepository('WebBundle:Setting')
            ->getSetting('explorelocations_level');

        if (!$level) {
            // getting last level saved in domain.configs.yml
            $level = $this->domainEm->getRepository('WebBundle:SettingLocation')
                ->getLastLocationEnabledID();
        }

        $bucket = $this->searchEngine->getLocationByModule($module, $level, $limit);

        $counter = [];

        array_walk($bucket['buckets'], function ($value) use (&$counter) {
            $id = $level = null;
            sscanf($value['key'], 'L%d:%d', $level, $id);
            $counter[$id] = $value['doc_count'];
        });

        $repo = $this->mainEm->getRepository('CoreBundle:Location' . $level);
        $locations = $repo->findBy(['id' => array_keys($counter)]);

        array_walk($locations, function($location) use($counter){
            $location->setCount($counter[$location->getId()]);
        });

        usort($locations, function ($a, $b) {
            return strcmp($a->getName(), $b->getName());
        });

        return $locations;
    }

    /**
     * Alias function of browseByLocation for Event module
     *
     * Twig:
     * <code>
     * browseByLocationEvent()
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     *
     * @param null $limit
     * @return string
     */
    public function browseByLocationEvent(\Twig_Environment $twig_Environment, $limit = null)
    {
        return $this->browseByLocation($twig_Environment, 'event', $limit);
    }

    /**
     * Alias function of browseByLocation for Classified module
     *
     * Twig:
     * <code>
     * browseByLocationClassified()
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     *
     * @param null $limit
     * @return string
     */
    public function browseByLocationClassified(\Twig_Environment $twig_Environment, $limit = null)
    {
        return $this->browseByLocation($twig_Environment, 'classified', $limit);
    }

    /**
     * Alias function of browseByLocation for Deal module
     *
     * Twig:
     * <code>
     * browseByLocationDeal()
     * </code>
     *
     * @param \Twig_Environment $twig_Environment
     *
     * @param null $limit
     * @return string
     */
    public function browseByLocationDeal(\Twig_Environment $twig_Environment, $limit = null)
    {
        return $this->browseByLocation($twig_Environment, 'deal', $limit);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'browse_by_location';
    }
}
