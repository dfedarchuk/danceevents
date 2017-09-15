<?php
namespace ArcaSolutions\EventBundle\Services;

use When\When;

/**
 * Class WhenExtended
 *
 * This class was implemented just to override the function below
 * The code and logic of function is owned by the creator of the Class When
 *
 * @package ArcaSolutions\EventBundle\Services
 */
class WhenExtended extends When
{
    /**
     * Overriding function
     * @throws \When\FrequencyRequired
     */
    public function generateOccurrences()
    {
        self::prepareDateElements();

        $count = 0;

        $dateLooper = clone $this->startDate;

        /* This part was changed of the original function */
        $this->occursOn($dateLooper);
        /* */

        while ($dateLooper <= $this->until && count($this->occurrences) < $this->count)
        {
            if ($this->freq === "yearly")
            {
                if (isset($this->bymonths))
                {
                    foreach ($this->bymonths as $month)
                    {
                        if (isset($this->bydays))
                        {
                            $dateLooper->setDate($dateLooper->format("Y"), $month, 1);

                            // get the number of days
                            $totalDays = $dateLooper->format("t");
                            $today = 0;

                            while ($today < $totalDays)
                            {
                                if ($this->occursOn($dateLooper))
                                {
                                    $this->addOccurrence($this->generateTimeOccurrences($dateLooper));

                                }

                                $dateLooper->add(new \DateInterval('P1D'));
                                $today++;
                            }
                        }
                        else
                        {
                            $dateLooper->setDate($dateLooper->format("Y"), $month, $dateLooper->format("j"));

                            if ($this->occursOn($dateLooper))
                            {
                                $this->addOccurrence($this->generateTimeOccurrences($dateLooper));

                            }
                        }
                    }
                }
                else
                {
                    $dateLooper->setDate($dateLooper->format("Y"), 1, 1);

                    $leapYear = (int)$dateLooper->format("L");
                    if ($leapYear)
                    {
                        $days = 366;
                    }
                    else
                    {
                        $days = 365;
                    }

                    $day = 0;
                    while ($day < $days)
                    {
                        if ($this->occursOn($dateLooper))
                        {
                            $this->addOccurrence($this->generateTimeOccurrences($dateLooper));

                        }
                        $dateLooper->add(new \DateInterval('P1D'));
                        $day++;
                    }
                }

                $dateLooper = clone $this->startDate;
                $dateLooper->add(new \DateInterval('P' . ($this->interval * ++$count) . 'Y'));
            }
            else if ($this->freq === "monthly")
            {
                $days = (int)$dateLooper->format("t");

                $day = (int)$dateLooper->format("j");

                $occurrences = array();
                while ($day <= $days)
                {
                    if ($this->occursOn($dateLooper))
                    {
                        $occurrences = array_merge($occurrences, $this->generateTimeOccurrences($dateLooper));
                    }

                    $dateLooper->add(new \DateInterval('P1D'));
                    $day++;
                }

                // if bysetpos is set we need to limit the
                // number of occurrences to only those which
                // meet the setpos
                if (isset($this->bysetpos))
                {
                    if ($count > 0)
                    {
                        $occurrenceCount = count($occurrences);

                        foreach ($this->bysetpos as $setpos)
                        {
                            if ($setpos > 0)
                            {
                                $this->occurrences[] = $occurrences[$setpos - 1];
                            }
                            else
                            {
                                $this->occurrences[] = $occurrences[$occurrenceCount + $setpos];
                            }
                        }
                    }
                }
                else
                {
                    $this->addOccurrence($occurrences);
                }

                $dateLooper = clone $this->startDate;
                $dateLooper->setDate($dateLooper->format("Y"), $dateLooper->format("n"), 1);
                $dateLooper->add(new \DateInterval('P' . ($this->interval * ++$count) . 'M'));
            }
            else if ($this->freq === "weekly")
            {
                $dateLooper->setDate($dateLooper->format("Y"), $dateLooper->format("n"), $dateLooper->format("j"));

                switch ($this->wkst)
                {
                    case "su":
                        $wkst = "Sunday";
                        break;
                    case "mo":
                        $wkst = "Monday";
                        break;
                    case "tu":
                        $wkst = "Tuesday";
                        break;
                    case "we":
                        $wkst = "Wednesday";
                        break;
                    case "th":
                        $wkst = "Thursday";
                        break;
                    case "fr":
                        $wkst = "Friday";
                        break;
                    case "sa":
                        $wkst = "Saturday";
                        break;
                }

                $daysLeft = 7;

                // not very happy with this
                if ($count === 0)
                {
                    $startWeekDay = clone $this->startDate;
                    $startWeekDay->modify("next " . $wkst);

                    $daysLeft = $dateLooper->diff($startWeekDay)->format("%a") + 1;

                    $startWeekDay->modify("last " . $wkst);
                }

                while ($daysLeft > 0)
                {
                    if ($this->occursOn($dateLooper))
                    {
                        $this->addOccurrence($this->generateTimeOccurrences($dateLooper));
                    }

                    $dateLooper->add(new \DateInterval('P1D'));
                    $daysLeft--;
                }

                $dateLooper = clone $this->startDate;
                $dateLooper->setDate($startWeekDay->format("Y"), $startWeekDay->format("n"), $startWeekDay->format('j'));
                $dateLooper->add(new \DateInterval('P' . ($this->interval * (++$count * 7)) . 'D'));
            }
            else if ($this->freq === "daily")
            {
                if ($this->occursOn($dateLooper))
                {
                    $this->addOccurrence($this->generateTimeOccurrences($dateLooper));
                }

                $dateLooper = clone $this->startDate;
                $dateLooper->setDate($dateLooper->format("Y"), $dateLooper->format("n"), $dateLooper->format('j'));
                $dateLooper->add(new \DateInterval('P' . ($this->interval * ++$count) . 'D'));
            }
            else if ($this->freq === "hourly")
            {
                $occurrence = array();
                if ($this->occursOn($dateLooper))
                {
                    $occurrence[] = $dateLooper;
                    $this->addOccurrence($occurrence);
                }

                $dateLooper = clone $this->startDate;
                $dateLooper->add(new \DateInterval('PT' . ($this->interval * ++$count) . 'H'));
            }
            else if ($this->freq === "minutely")
            {
                $occurrence = array();
                if ($this->occursOn($dateLooper))
                {
                    $occurrence[] = $dateLooper;
                    $this->addOccurrence($occurrence);
                }

                $dateLooper = clone $this->startDate;
                $dateLooper->add(new \DateInterval('PT' . ($this->interval * ++$count) . 'M'));
            }
            else if ($this->freq === "secondly")
            {
                $occurrence = array();
                if ($this->occursOn($dateLooper))
                {
                    $occurrence[] = $dateLooper;
                    $this->addOccurrence($occurrence);
                }

                $dateLooper = clone $this->startDate;
                $dateLooper->add(new \DateInterval('PT' . ($this->interval * ++$count) . 'S'));

            }
        }
    }
}
