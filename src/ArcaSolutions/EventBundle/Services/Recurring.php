<?php
namespace ArcaSolutions\EventBundle\Services;

use ArcaSolutions\CoreBundle\Services\ApcCache;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\MultiDomainBundle\Doctrine\DoctrineRegistry;
use ArcaSolutions\SearchBundle\Entity\Filters\DateFilter;
use ArcaSolutions\SearchBundle\Exceptions\NotFoundException;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\SearchBundle\Services\SearchEngine;
use DateInterval;
use DateTime;
use Symfony\Component\DependencyInjection\ContainerInterface;
use When\When;

class Recurring
{
    /**
     * It is the minimum quantity of events for API endpoint
     */
    const MINIMUM_EVENTS_FOR_API = 10;

    /**
     * @var DoctrineRegistry
     */
    private $doctrine;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Array of week name days
     *
     * @var array
     */
    protected static $weekdays = [
            1 => 'SU',
            2 => 'MO',
            3 => 'TU',
            4 => 'WE',
            5 => 'TH',
            6 => 'FR',
            7 => 'SA',
        ];

    /**
     * Recurring constructor.
     * @param DoctrineRegistry $doctrine
     * @param ContainerInterface $container
     */
    public function __construct(DoctrineRegistry $doctrine, ContainerInterface $container)
    {
        $this->doctrine = $doctrine;
        $this->container = $container;
    }

    public function getRecurringEventsUsingES(\DateTime $date)
    {
        /* @var $searchEngine SearchEngine */
        $searchEngine = $this->container->get("search.engine");

        /* @var $parameterHandler ParameterHandler */
        $parameterHandler = $this->container->get("search.parameters");
        $parameterHandler->setStartDate($date);
        $parameterHandler->setEndDate($date);
        $parameterHandler->addModule(ParameterHandler::MODULE_EVENT);

        /* @var $dateFilter DateFilter */
        $dateFilter = $this->container->get("filter.date");

        $searchEvent = $searchEngine->globalSearch(null, null);
        $searchEvent->addFilter($dateFilter, DateFilter::getName());

        $search = $searchEngine->search($searchEvent);
        $result = $search->search();

        $eventRepo = $this->doctrine->getRepository('EventBundle:Event');
        $events = [];

        $documents = $result->getDocuments();
        foreach ($documents as $doc) {
            $events[] = $eventRepo->find($doc->getId());
        }

        return $events;
    }

    public static function getRRule_rfc2445(Event $event)
    {

        $dayOfMonth = $event->getDay();
        $month = $event->getMonth();
        $until = $event->getUntilDate();

        $daysOfWeek = null;
        // prepare days of week
        if (!empty($event->getDayofweek())) {
            $dayOfWeekMap = ["1" => "SU", "2" => "MO", "3" => "TU", "4" => "WE", "5" => "TH", "6" => "FR", "7" => "SA"];
            $data = explode(",", $event->getDayofweek());
            // Convert days numbers to string format
            $daysOfWeekList = array_values(array_intersect_key($dayOfWeekMap, array_flip($data)));

            if (!empty($event->getWeek())) {
                $weekMap = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => -1];
                $data = explode(",", $event->getWeek());

                $weeksList = array_values(array_intersect_key($weekMap, array_flip($data)));
                $aux = [];
                foreach ($weeksList as $w) {
                    foreach ($daysOfWeekList as $d) {
                        $aux[] = $w.$d;
                    }
                }
                $daysOfWeekList = $aux;
            }

            $daysOfWeek = implode(",", $daysOfWeekList);
        }

        $rrule = [];


        if (self::isYearly($event)) {
            $rrule[] = "FREQ=YEARLY";
        } else {
            if (self::isMonthly($event)) {
                $rrule[] = "FREQ=MONTHLY";
            } else {
                if (self::isWeekly($event)) {
                    $rrule[] = "FREQ=WEEKLY";
                } else {
                    if (self::isDaily($event)) {
                        $rrule[] = "FREQ=DAILY";
                    }
                }
            }
        }

        if ($month > 0) {
            $rrule[] = "BYMONTH=".$month;
        }

        if ($dayOfMonth > 0) {
            $rrule[] = "BYMONTHDAY=".$dayOfMonth;
        }

        if ($daysOfWeek != null) {
            $rrule[] = "BYDAY=".$daysOfWeek;
        }


        if (!empty($until) && $until->getTimestamp() > 0) {
            $rrule[] = "UNTIL=".$until->format("Ymd\\THis\\Z");
        }

        $rrule[] = "WKST=SU";

        return "RRULE:".implode(";", $rrule);
    }

    /**
     * Checks if a event is yearly
     *
     * @param Event $event
     *
     * @return bool
     */
    public static function isYearly(Event $event)
    {
        return 0 != $event->getMonth();
    }

    /**
     * Checks if a event is monthly
     *
     * Note:
     * It is used to cover the possibility of a monthly recurrence in a certain day
     * The flags used in DB is different of a normal monthly recurrence,
     * so it is needed verify other things
     *
     * @param Event $event
     *
     * @return bool
     */
    public static function isMonthly(Event $event)
    {
        return (0 == $event->getMonth() && '' != $event->getWeek())
            || (!self::isDaily($event)
                && !self::isWeekly($event)
                && !self::isYearly($event));
    }

    /**
     * Checks if a event is daily
     *
     * @param Event $event
     *
     * @return bool
     */
    public static function isDaily(Event $event)
    {
        return 0 == $event->getMonth() && '' == $event->getWeek() && '' == $event->getDayofweek()
            && 0 == $event->getDay();
    }

    /**
     * Checks if a event is weekly
     *
     * @param Event $event
     *
     * @return bool
     */
    public static function isWeekly(Event $event)
    {
        return 0 == $event->getMonth() && '' == $event->getWeek() && '' != $event->getDayofweek();
    }

    /**
     * Returns the next occurrence of the event recurring rule from today
     *
     * @param null DateTime $startDate
     * @param null string $rrule
     * @return DateTime
     */
    public static function getNextOccurrence($startDate = null ,$rrule = null) {
        $r = new When();

        $r = $r->rrule($rrule);

        $date = new DateTime();

        while (true) {

            if ($r->occursOn($date) && $date >= $startDate)
                return $date;

            $date->add(new DateInterval("P1D"));
        }
    }

}
