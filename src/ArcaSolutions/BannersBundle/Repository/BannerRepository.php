<?php

namespace ArcaSolutions\BannersBundle\Repository;

use ArcaSolutions\BannersBundle\Entity\Banner;
use ArcaSolutions\BannersBundle\Entity\Bannerlevel;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;


/**
 * BannerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @package ArcaSolutions
 * @subpackage BannersBundle
 * @category Repositories
 * @author Diego Acosta Mosela <diego.mosela@arcasolutions.com>
 * @author Lucas Trentim <lucas.trentim@arcasolutions.com>
 * @author Fernando Nascimento <fernando.nascimento@arcasolutions.com>
 * @copyright ArcaSolutions Inc.
 * @version 2.0.0
 * @since File available since Release 11.0.00
 */
class BannerRepository extends EntityRepository
{
    /**
     * Description
     *
     * @param Bannerlevel $level
     * @param array|null $categorizedSections
     * @return Banner|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getBanner($level, $categorizedSections = [])
    {
        static $usedBanners = [];

        $categorizedSections or $categorizedSections["general"] = null;

        $return = null;

        if ($level) {
            $qb = $this->createQueryBuilder('b');

            $mainConditional = $qb->expr()->andX();

            /* Limited impressions expiration conditional */
            $condExpirationImpressions = $qb->expr()->andX()->addMultiple([
                $qb->expr()->eq('b.expirationSetting', 1),
                $qb->expr()->gt('b.impressions', 0),
            ]);

            /* Unlimited impressions expiration conditional */
            $condExpirationUnlimited = $qb->expr()->andX()->addMultiple([
                $qb->expr()->eq('b.expirationSetting', 1),
                $qb->expr()->eq('b.unlimitedImpressions', "'y'"),
            ]);

            /* Time expiration conditional */
            /** @todo Para proxima versão realizar estudo para remover validações por '0000-00-00' */
            $expirationCondition = $qb->expr()->orX()->addMultiple([
                $qb->expr()->gte('b.renewalDate', 'CURRENT_DATE()'),
                $qb->expr()->eq('b.renewalDate', "'0000-00-00 00:00:00'"),
                $qb->expr()->isNull('b.renewalDate'),
            ]);

            $temporalExpirationCondition = $qb->expr()->andX()->addMultiple([
                $qb->expr()->eq('b.expirationSetting', 2),
                $expirationCondition,
            ]);

            /* Combined expiration conditions */
            $mainConditional->add(
                $qb->expr()->orX()->addMultiple([
                    $temporalExpirationCondition,
                    $condExpirationImpressions,
                    $condExpirationUnlimited,
                ])
            );

            /* Section and category conditionals */
            if ($categorizedSections) {
                $condSection = $qb->expr()->orX();
                $condSection->add($qb->expr()->eq('b.section', "'global'"));

                $j = 0;

                foreach ($categorizedSections as $section => $categories) {
                    $section == "deal" and $section = "promotion";

                    if (is_array($categories)) {
                        $categories[] = 0;
                    } else {
                        $categories = [0];
                    }

                    $qb->setParameter("category{$j}", (array)$categories);

                    $condSection->add($qb->expr()->andX()->addMultiple([
                        $qb->expr()->eq('b.section', "'{$section}'"),
                        $qb->expr()->in('b.categoryId', ":category{$j}"),
                    ]));

                    $j++;
                }
            } else {
                $condSection = $qb->expr()->eq('b.section', ':global');
            }

            $mainConditional->add($condSection);

            /* Repeated banner exclusion conditional */
            if ($usedBanners) {
                $mainConditional->add($qb->expr()->notIn('b.id', ":ids"));
                $qb->setParameter('ids', array_keys($usedBanners));
            }

            /* Basic conditionals */
            $mainConditional->addMultiple([
                $qb->expr()->eq('b.status', "'A'"),
                $qb->expr()->eq('b.type', $level->getValue()),
            ]);

            $qb->where($mainConditional);

            $banner = $qb->addSelect('RAND() as HIDDEN rand')->setMaxResults(1)->orderBy('rand')->getQuery();

            if ($return = $banner->getOneOrNullResult()) {
                /* @var $return Banner */
                $usedBanners[$return->getId()] = true;
            }
        }

        return $return;
    }

    /**
     * Subtracts Impressions
     *
     * @param Banner $banner
     * @return bool
     *
     * @deprecated since 11.2.00, to be removed in 12.0.00
     */
    public function setImpression(Banner $banner)
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 11.2.00 and will be removed in 12.0.0.',
            E_USER_DEPRECATED);

        try {
            $banner->setImpressions(max([($banner->getImpressions() - 1), 0]));
        } catch (OptimisticLockException $e) {
        }
    }
}
