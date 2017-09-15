<?php

namespace ArcaSolutions\EventBundle\Twig\Extension;

use ArcaSolutions\EventBundle\Entity\Event;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RecurringExtension
 *
 * @package ArcaSolutions\EventBundle\Twig\Extension
 */
class RecurringExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $containerInterface
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        $this->container = $containerInterface;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('recurringPhrase', [$this, 'recurringPhrase'], [
                'is_safe' => ['html']
            ]),
            new \Twig_SimpleFunction('recurringPhraseByFriendlyUrl', [$this, 'recurringPhraseByFriendlyUrl'], [
                'is_safe' => ['html']
            ]),
        ];
    }

    /**
     * Returns the phrase of each recurring kind
     *
     * @param Event $event
     *
     * @return string
     * @throws \Exception
     */
    public function recurringPhrase(Event $event)
    {
        $type = $this->checksTypeOfRecurring($event);

        switch ($type) {
            case 'yearly':
                return $this->yearlyPhrase($event);
                break;
            case 'monthly':
                return $this->monthlyPhrase($event);
                break;
            case 'weekly':
                return $this->weeklyPhrase($event);
                break;
            case 'daily':
                return $this->dailyPhrase();
                break;
        }

        throw new \Exception('type of Recurring not found.');
    }

    /**
     * Returns the phrase of each recurring kind by a friendly url
     *
     * @param string $friendyUrl
     *
     * @return string
     */
    public function recurringPhraseByFriendlyUrl($friendyUrl)
    {
        $event = $this->container->get("doctrine")->getRepository("EventBundle:Event")
            ->findOneBy(['friendlyUrl' => $friendyUrl]);

        return $this->recurringPhrase($event);
    }

    /**
     * Returns the kind of recurring of a event
     *
     * @param Event $event
     *
     * @return string daily|weekly|monthly|yearly
     * @throws \Exception When kind of recurrence is not found
     */
    private function checksTypeOfRecurring(Event $event)
    {
        $eventRecurringService = $this->container->get('event.recurring.service');

        if ($eventRecurringService->isYearly($event)) {
            return 'yearly';
        }

        if ($eventRecurringService->isMonthly($event)) {
            return 'monthly';
        }

        if ($eventRecurringService->isWeekly($event)) {
            return 'weekly';
        }

        if ($eventRecurringService->isDaily($event)) {
            return 'daily';
        }

        throw new \Exception('type of Recurring not found.');
    }

    /**
     * Builds yearly recurring phrase
     *
     * @param Event $event
     *
     * @return string
     */
    private function yearlyPhrase(Event $event)
    {
        $return = null;

        $translator = $this->container->get("translator");

        if ($day = $event->getDay()) {
            /* Events ocurring in a certain day and month of every year */

            $monthString = $translator->transChoice("months", $event->getMonth(), [], "units");
            $dayString = $translator->transChoice(
                "numbers.ordinal.simplified.male",
                $day,
                ["%count%" => $day],
                "units"
            );

            $parameters = [
                "%month%" => $monthString,
                "%day%"   => $dayString
            ];

            $return = $translator->trans("year.month.days", $parameters, "recurring");
        } else {
            /* Events ocurring on multiple days and weeks of a certain month of every year */

            $days = explode(',', $event->getDayofweek());
            $weekOrder = explode(',', $event->getWeek());

            $dayPart = null;
            $weekPart = null;

            if (7 == count($days)) {
                $dayPart = $translator->transChoice("week", 1, [], "recurring");
            } elseif (2 == count($days) && !array_diff([1, 7], $days)) {
                $dayPart = $translator->trans("weekend", [], "recurring");
            } else {
                $dayNameArray = [];

                foreach ($days as $day) {
                    $dayNameArray[] = $translator->transChoice("week.days", $day, [], "units");
                }

                $dayPart = $this->container->get("utility")->convertArrayToHumanReadableString($dayNameArray);
            }

            $weekNameArray = [];

            foreach ($weekOrder as $week) {
                $weekNameArray[] = $translator->transChoice(
                    "numbers.ordinal.simplified.female",
                    $week,
                    ["%count%" => $week],
                    "units"
                );
            }

            $weekPart = $this->container->get("utility")->convertArrayToHumanReadableString($weekNameArray);
            $monthPart = $translator->transChoice("months", $event->getMonth(), [], "units");

            $parameters = [
                "%week%"  => $weekPart,
                "%day%"   => $dayPart,
                "%month%" => $monthPart
            ];

            $return = $translator->trans("year.month.week.days", $parameters, "recurring");
        }

        return $return;
    }

    /**
     * Builds monthly recurring phrase
     *
     * @param Event $event
     *
     * @return string
     */
    private function monthlyPhrase(Event $event)
    {
        $return = null;
        $translator = $this->container->get("translator");

        /* It is a monthly event but just happens in a specific day  */
        if ($day = (int)$event->getDay()) {
            $ordinal = $translator->transChoice("numbers.ordinal.simplified.male", $day, ["%count%" => $day], "units");
            $return = $translator->trans("month.days", ["%day%" => $ordinal], "recurring");
        } else {
            /*
             * It's a monthly event but can vary in days of week and weeks inside a month
             */
            $days = explode(',', $event->getDayofweek());
            $weekOrder = explode(',', $event->getWeek());

            $dayPart = null;
            $weekPart = null;

            if (7 == count($days)) {
                $dayPart = $translator->transChoice("week", 1, [], "recurring");
            } elseif (2 == count($days) && !array_diff([1, 7], $days)) {
                $dayPart = $translator->trans("weekend", [], "recurring");
            } else {
                $dayNameArray = [];

                foreach ($days as $day) {
                    $dayNameArray[] = $translator->transChoice("week.days", $day, [], "units");
                }

                $dayPart = $this->container->get("utility")->convertArrayToHumanReadableString($dayNameArray);
            }

            $weekNameArray = [];

            foreach ($weekOrder as $week) {
                $weekNameArray[] = $translator->transChoice(
                    "numbers.ordinal.simplified.female",
                    $week,
                    ["%count%" => $week],
                    "units"
                );
            }

            $weekPart = $this->container->get("utility")->convertArrayToHumanReadableString($weekNameArray);

            $parameters = [
                "%day%"  => $dayPart,
                "%week%" => $weekPart,
            ];

            $return = $translator->trans("month.week.days", $parameters, "recurring");
        }

        return $return;
    }

    /**
     * Builds weekly recurring phrase
     *
     * @param Event $event
     *
     * @return string
     */
    private function weeklyPhrase(Event $event)
    {
        $return = null;

        $days = explode(',', $event->getDayofweek());
        $translator = $this->container->get("translator");

        if (7 == count($days)) {
            $return = $translator->transChoice("day",1, [], "recurring");
        } elseif (2 == count($days) && !array_diff([1, 7], $days)) {
            $return = $translator->trans("weekend", [], "recurring");
        } elseif (5 == count($days) && !array_diff([2, 3, 4, 5, 6], $days)) {
            $return = $translator->trans("businessday", [], "recurring");
        } else {
            $dayNameArray = [];

            foreach ($days as $day) {
                $dayNameArray[] = ucfirst($translator->transChoice("week.days", $day, [], "units"));
            }

            $return = $this->container->get("utility")->convertArrayToHumanReadableString($dayNameArray);
        }

        return $translator->trans("every", ["%s" => $return], "recurring");
    }

    /**
     * Builds daily recurring phrase
     * @return string
     */
    private function dailyPhrase()
    {
        $translator = $this->container->get("translator");

        return $translator->trans("every day", [], "recurring");
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'event_recurring';
    }
}
