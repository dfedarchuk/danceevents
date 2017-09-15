<?php
namespace ArcaSolutions\WebBundle\Twig\Extension;

use ArcaSolutions\ArticleBundle\Entity\Internal\ArticleLevelFeatures;
use ArcaSolutions\BannersBundle\Entity\Internal\BannerLevelFeatures;
use ArcaSolutions\ClassifiedBundle\Entity\Internal\ClassifiedLevelFeatures;
use ArcaSolutions\CoreBundle\Services\CurrencyHandler;
use ArcaSolutions\EventBundle\Entity\Internal\EventLevelFeatures;
use ArcaSolutions\ListingBundle\Entity\Internal\ListingLevelFeatures;
use ArcaSolutions\WebBundle\Services\AdvertiseHandler;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;

final class AdvertiseExtension extends \Twig_Extension
{
    /**
     * @var AdvertiseHandler
     */
    private $advertiseHandler;

    /**
     * @var CurrencyHandler
     */
    private $currencyHandler;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param AdvertiseHandler $advertiseHandler
     * @param CurrencyHandler $currencyHandler
     * @param Translator|TranslatorInterface $translator
     */
    public function __construct(
        AdvertiseHandler $advertiseHandler,
        CurrencyHandler $currencyHandler,
        TranslatorInterface $translator
    ) {
        $this->advertiseHandler = $advertiseHandler;
        $this->currencyHandler = $currencyHandler;
        $this->translator = $translator;
    }

    /**
     * Returns extension function's names
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('advertisePlans', [$this, 'getAdvertisePlans'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
            new \Twig_SimpleFunction('advertisePrice', [$this, 'getAdvertisePrice'], [
                'needs_environment' => true,
                'is_safe'           => ['html'],
            ]),
        ];
    }

    /**
     * Returns filters function's names
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('cast_to_array', [$this, 'objectFilter']),
        ];
    }

    /**
     * @param \Twig_Environment $twig_Environment
     * @param $module string Module Name
     * @return bool
     */
    public function getAdvertisePlans(\Twig_Environment $twig_Environment, $module)
    {
        $plans = $this->advertiseHandler->getLevels($module);

        return $twig_Environment->render('::blocks/advertise/plans.html.twig', [
            'plans'       => $plans,
            'module'      => $module,
            'nonFeatures' => $this->advertiseHandler->getNonFeatures(),
        ]);
    }

    /**
     * @param \Twig_Environment $twig_Environment
     * @param ListingLevelFeatures|EventLevelFeatures|ClassifiedLevelFeatures|ArticleLevelFeatures|BannerLevelFeatures $plan
     * @return array
     */
    public function getAdvertisePrice(\Twig_Environment $twig_Environment, $plan)
    {
        $pricing = [];

        /* Monthly Price */
        $pricingMonthly = $plan->price;
        $pricing['monthly'] = $this->currencyHandler->formatCurrency($pricingMonthly, false,
            CurrencyHandler::RETURN_CURRENCY_ARRAY);

        /* Yearly Price */
        $pricingYearly = $plan->price_yearly;
        $pricing['yearly'] = $this->currencyHandler->formatCurrency($pricingYearly, false,
            CurrencyHandler::RETURN_CURRENCY_ARRAY);

        /* Impression Price for Banners Level*/
        if ($plan instanceof BannerLevelFeatures) {
            $pricing['impression'] = $this->currencyHandler->formatCurrency($plan->block_price, false,
                CurrencyHandler::RETURN_CURRENCY_ARRAY);;
        }

        /* Main Price */
        $pricing['main'] = ['value' => $this->translator->trans('Free')];
        $pricing['main_renewal'] = '';
        $pricing['renewal'] = false;
        if ($pricingMonthly > 0 || $pricingYearly > 0) {
            $pricing['main'] = $pricingMonthly > 0 ? $pricing['monthly'] : $pricing['yearly'];
            $pricing['main_renewal'] = $pricingMonthly > 0 ?
                $this->translator->trans('Month') :
                $this->translator->trans('Year');
            $pricing['renewal'] = $pricingMonthly > 0 && $pricingYearly > 0 ? true : false;
            $pricing['renewal_label'] = $this->translator->trans('Year');
        }


        return $pricing;
    }

    /**
     * Change the typecast to an array
     *
     * @param object $stdClassObject
     * @return array
     */
    public function objectFilter($stdClassObject)
    {
        return (array)$stdClassObject;
    }

    /**
     * Returns extension name
     */
    public function getName()
    {
        return 'edirectory_advertise_extension';
    }
}
