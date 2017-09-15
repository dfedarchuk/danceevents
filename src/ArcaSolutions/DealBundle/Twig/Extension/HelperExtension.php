<?php

namespace ArcaSolutions\DealBundle\Twig\Extension;


use ArcaSolutions\CoreBundle\Services\Modules;
use ArcaSolutions\DealBundle\Entity\Promotion;
use ArcaSolutions\DealBundle\Services\DealHandler;
use Doctrine\ORM\EntityManager;

class HelperExtension extends \Twig_Extension
{

    /**
     * @var Modules
     *
     */
    private $modules;

    /**
     * @var EntityManager
     */
    private $domainManager;

    /**
     * @var DealHandler
     */
    private $dealHandler;

    /**
     * HelperExtension constructor.
     *
     * @param Modules $modules
     * @param EntityManager $domainManager
     * @param DealHandler $dealHandler
     */
    public function __construct(Modules $modules, EntityManager $domainManager, DealHandler $dealHandler)
    {
        $this->modules = $modules;
        $this->domainManager = $domainManager;
        $this->dealHandler = $dealHandler;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('hasDeal', [$this, 'hasDeal'], ['is_safe' => ['html']]),
        ];
    }

    /**
     *
     *
     * @param integer $listingId Listing id
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \Exception
     */
    public function hasDeal($listingId)
    {
        if (!$this->modules->isModuleAvailable('deal')) {
            return '';
        }

        $hasDeal = false;

        if ($listing = $this->domainManager->find('ListingBundle:Listing', $listingId)) {
            /** @var Promotion $deal */
            foreach ($listing->getDeals() as $deal) {
                if ($this->dealHandler->isValid($deal)) {
                    $hasDeal = true;
                    break;
                }
            }
        }

        return $hasDeal;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "helperDeals";
    }
}
