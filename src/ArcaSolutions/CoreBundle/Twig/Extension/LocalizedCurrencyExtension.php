<?php

namespace ArcaSolutions\CoreBundle\Twig\Extension;

use ArcaSolutions\CoreBundle\Services\CurrencyHandler;
use ArcaSolutions\CoreBundle\Services\Settings;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class LocalizedCurrencyExtension
 *
 * Adds a filter as a shortcut to twig's localized function
 *
 * @package ArcaSolutions\CoreBundle\Twig\Extension
 */
class LocalizedCurrencyExtension extends \Twig_Extension
{
    /**
     * @var CurrencyHandler
     */
    private $currencyHandler;

    /**
     * LocalizedCurrencyExtension constructor.
     *
     * @param CurrencyHandler $currencyHandler
     */
    public function __construct(CurrencyHandler $currencyHandler)
    {
        $this->currencyHandler = $currencyHandler;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter(
                'localized_currency',
                [$this, 'localized_currency'],
                ['is_safe' => ['html']]
            )
        ];
    }

    /**
     * Shortcut to the twig's localized function
     *
     * @param $number
     * @param bool $withHTML
     *
     * @return string
     */
    public function localized_currency($number, $withHTML = true)
    {
        return $this->currencyHandler->formatCurrency($number, $withHTML);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'localized_currency';
    }
}
