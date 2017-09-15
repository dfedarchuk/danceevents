<?php

namespace ArcaSolutions\EventBundle\Repository;

use ArcaSolutions\CoreBundle\Interfaces\EntityModulesRowInterface;
use ArcaSolutions\CoreBundle\Repository\EntityModulesRowRepository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends EntityModulesRowRepository implements EntityModulesRowInterface
{
    /**
     * Upcoming Event query
     *
     * @param \DateTime $date
     * @return array
     */
    public function upcomingEvents(\DateTime $date)
    {
        $qb = $this->createQueryBuilder('e');

        /*
         * Conditions
         */
        $startDateNotRecurringAndMonthYearWithDate = $qb->expr()->andX();
        $startDateNotRecurringAndMonthYearWithDate->add($qb->expr()->eq('DATE_FORMAT(e.startDate, \'%Y-%m\')', ':year_month'));
        $startDateNotRecurringAndMonthYearWithDate->add($qb->expr()->eq('DATE_FORMAT(e.startDate, \'%d\')', ':day'));
        $startDateNotRecurringAndMonthYearWithDate->add($qb->expr()->eq('e.recurring', ':no'));

        $untilDateMonthYearOrMonthYearDateZero = $qb->expr()->orX();
        $untilDateMonthYearOrMonthYearDateZero->add($qb->expr()->gte('e.untilDate', ':complete_date'));
        $untilDateMonthYearOrMonthYearDateZero->add($qb->expr()->eq('DATE_FORMAT(e.untilDate, \'%Y-%m-%d\')', ':empty_date'));

        $joinUntilJoinRecurring = $qb->expr()->andX();
        $joinUntilJoinRecurring->add($qb->expr()->lte('e.startDate', ':complete_date'));
        $joinUntilJoinRecurring->add($untilDateMonthYearOrMonthYearDateZero);
        $joinUntilJoinRecurring->add($qb->expr()->eq('e.recurring', ':yes'));

        $orJoinStartDateUntilDateFirstAnd = $qb->expr()->orX();
        $orJoinStartDateUntilDateFirstAnd->add($startDateNotRecurringAndMonthYearWithDate);
        $orJoinStartDateUntilDateFirstAnd->add($joinUntilJoinRecurring);

        $orEndDateUntilDate = $qb->expr()->orX();
        $orEndDateUntilDate->add($qb->expr()->gte('e.endDate', ':complete_date'));
        $orEndDateUntilDate->add($qb->expr()->gte('e.untilDate', ':complete_date'));

        $joinRepeatEventEndDateUntilDate = $qb->expr()->andX();
        $joinRepeatEventEndDateUntilDate->add($orEndDateUntilDate);
        $joinRepeatEventEndDateUntilDate->add($qb->expr()->eq('e.repeatEvent', ':no'));

        $repeatEventOrNotRepeatEvent = $qb->expr()->orX();
        $repeatEventOrNotRepeatEvent->add($joinRepeatEventEndDateUntilDate);
        $repeatEventOrNotRepeatEvent->add($qb->expr()->eq('e.repeatEvent', ':yes'));

        $qb->where($qb->expr()->eq('e.status', ':active'));
        $qb->andWhere($orJoinStartDateUntilDateFirstAnd);
        $qb->andWhere($repeatEventOrNotRepeatEvent);

        /*
         * Parameters
         */
        $qb->setParameter('active', 'A');
        $qb->setParameter('year_month', $date->format('Y-m'));
        $qb->setParameter('day', $date->format('d'));
        $qb->setParameter('empty_date', '0000-00-00');
        $qb->setParameter('complete_date', $date->format('Y-m-d'));
        $qb->setParameter('yes', 'Y');
        $qb->setParameter('no', 'N');

        /* order by */
        $qb->orderBy('e.id', 'DESC');

        return $qb->getQuery()->getResult();
    }

    /**
     * This functions is use to get the count of events that are valid.
     * It checks endDate and UntilDate, if the event repeat or not and its status
     *
     * @return mixed|int
     */
    public function existValidEvent()
    {
        $dateNow = new \DateTime('now');

        $qb = $this->createQueryBuilder('e')->select('count(e.id)');

        $noRepeatedEventEndAndUntilDate = $qb->expr()->orX();
        $noRepeatedEventEndAndUntilDate->add($qb->expr()->gte('e.endDate', ':now'));
        $noRepeatedEventEndAndUntilDate->add($qb->expr()->gte('e.untilDate', ':now'));

        $noRepeatedEvent = $qb->expr()->andX();
        $noRepeatedEvent->add($noRepeatedEventEndAndUntilDate);
        $noRepeatedEvent->add($qb->expr()->eq('e.repeatEvent', ':no'));

        $noRepeatEventWithRepeatEvent = $qb->expr()->orX();
        $noRepeatEventWithRepeatEvent->add($noRepeatedEvent);
        $noRepeatEventWithRepeatEvent->add($qb->expr()->eq('e.repeatEvent', ':yes'));

        $qb->where($qb->expr()->eq('e.status', ':active'));
        $qb->andWhere($noRepeatEventWithRepeatEvent);

        $qb->setParameter('active', 'A');
        $qb->setParameter('now', $dateNow->format('Y-m-d'));
        $qb->setParameter('no', 'N');
        $qb->setParameter('yes', 'Y');

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Returns module name in lowercase
     *
     * @return string
     */
    public function getModuleName()
    {
        return 'event';
    }
}
