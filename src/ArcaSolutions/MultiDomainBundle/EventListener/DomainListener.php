<?php

namespace ArcaSolutions\MultiDomainBundle\EventListener;

use ArcaSolutions\MultiDomainBundle\Services\Settings;
use Liip\ThemeBundle\ActiveTheme;

/**
 * Class DomainListener
 *
 * @package ArcaSolutions\MultiDomainBundle\EventListener
 */
class DomainListener
{
    /**
     * @var Settings
     */
    private $multidomain;

    /**
     * @var ActiveTheme
     */
    private $activeTheme;

    /**
     * DomainListener constructor.
     *
     * @param Settings $multidomain
     * @param ActiveTheme $activeTheme
     */
    public function __construct(Settings $multidomain, ActiveTheme $activeTheme)
    {
        $this->multidomain = $multidomain;
        $this->activeTheme = $activeTheme;
    }

    public function onKernelController()
    {
        $this->activeTheme->setName($this->multidomain->getTemplate());

    }
}
