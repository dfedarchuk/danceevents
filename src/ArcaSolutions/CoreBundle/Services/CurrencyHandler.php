<?php

namespace ArcaSolutions\CoreBundle\Services;


use Symfony\Component\Translation\TranslatorInterface;

class CurrencyHandler
{
    const RETURN_CURRENCY_STRING = 1;
    const RETURN_CURRENCY_ARRAY = 2;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var Settings
     */
    private $settings;

    public function __construct(TranslatorInterface $translator, Settings $settings)
    {
        $this->translator = $translator;
        $this->settings = $settings;
    }

    /**
     * Format the value to the defined currency
     *
     * @param $number
     * @param bool $withHTML Default: true
     * @param int $format (CurrencyHandler::RETURN_CURRENCY_STRING|CurrencyHandler::RETURN_CURRENCY_ARRAY) Default: RETURN_CURRENCY_STRING
     *
     * @return array|string
     */
    public function formatCurrency($number, $withHTML = true, $format = self::RETURN_CURRENCY_STRING)
    {
        $thousandSeparator = $this->translator->trans("thousands.separator", [], "units");
        $decimalSeparator = $this->translator->trans("decimal.separator", [], "units");
        $symbol = $this->settings->getSettingPayment(Settings::PAYMENT_CURRENCY_SYMBOL);

        $wholePart = floor($number);
        $decimalPart = $number - $wholePart;

        if ($withHTML) {
            $wholePart = number_format($wholePart, 0, $decimalSeparator, $thousandSeparator);
            $decimalPart = round($decimalPart * 100);

            $arguments = [
                "{symbol}" => "<em>{$symbol}</em>",
                "{value}"  => "{$wholePart}".($decimalPart ? "{$decimalSeparator}<small>{$decimalPart}</small>" : ""),
            ];

            $return = "<mark>".$this->translator->trans("monetary.format", $arguments, "units")."</mark>";
        } else {
            switch ($format) {
                case self::RETURN_CURRENCY_ARRAY:
                    $return = [
                        'symbol'  => $symbol,
                        'value'   => $number,
                        'decimal' => $decimalPart,
                    ];
                    break;
                case self::RETURN_CURRENCY_STRING:
                default:
                    if ($decimalPart) {
                        $number = number_format($number, 2, $decimalSeparator, $thousandSeparator);
                    }

                    $arguments = [
                        "{symbol}" => $symbol,
                        "{value}"  => $number,
                    ];

                    $return = $this->translator->trans("monetary.format", $arguments, "units");
                    break;
            }
        }

        return $return;
    }
}
