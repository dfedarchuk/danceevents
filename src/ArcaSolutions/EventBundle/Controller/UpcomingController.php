<?php

namespace ArcaSolutions\EventBundle\Controller;

use ArcaSolutions\CoreBundle\Twig\Extension\LocalizedDateExtension;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\EventBundle\Entity\Eventcategory;
use ArcaSolutions\ImageBundle\Twig\Extension\ImageExtension;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Class UpcomingController
 *
 * @package ArcaSolutions\EventBundle\Controller
 */
class UpcomingController extends Controller
{
    /**
     * @param null $day
     * @param null $month
     * @param null $year
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function upcomingAction($day = null, $month = null, $year = null)
    {
        if (!checkdate($month, $day, $year)) {
            throw new \Exception('You must pass a valid date');
        }

        /* creates date */
        $date = \DateTime::createFromFormat('Y-m-d', sprintf('%s-%s-%s', $year, $month, $day));
        $nullDate = new \DateTime(date('Y-m-d', strtotime('0000-00-00')));

        $events = $this->get('event.recurring.service')->getRecurringEventsUsingES($date);

        /* Vars used to get the image's URL */
        $twigEnvironment = $this->get('twig');
        /* @var $imageExtension ImageExtension */
        $imageExtension = $twigEnvironment->getExtension('image_extension');
        /* @var $localizedDate LocalizedDateExtension */
        $localizedDate = $twigEnvironment->getExtension('localized_date');

        $json = [
            'day'      => $date->format('j'),
            'month'    => $localizedDate->localized_date($twigEnvironment, $date, 'MMMM'),
            'day_name' => $localizedDate->localized_date($twigEnvironment, $date, 'EEE'),
            'events'   => [],
        ];

        if (empty($events)) {
            return JsonResponse::create($json);
        }

        foreach ($events as $event) {
            /* @var $event Event */
            if (($event->getStartDate() <= $date || $event->getRecurring() == "Y") &&
                ($event->getEndDate() == null || $event->getEndDate() == $nullDate || $event->getEndDate() >= $date) &&
                ($event->getUntilDate() == null || $event->getUntilDate() == $nullDate || $event->getUntilDate() >= $date)
            ) {
                $image = '';
                /* get image path, if it has */
                if ($event->getImageId() > 0) {
                    $image = $this->container->get('assets.packages')
                            ->getPackage('domain_images')
                            ->getUrl('').$imageExtension->getPath($event->getImage());
                    $image = $this->container->get('liip_imagine.cache.manager')
                        ->getBrowserPath($image, 'small');
                }

                /* creates categories's array with title and link */
                $cat_array = [];
                foreach ($event->getCategories() as $cat) {
                    /* @var $cat Eventcategory */
                    $cat_array[] = [
                        'title' => $cat->getTitle(),
                        'link'  => $this->generateUrl('event_homepage').$cat->getFriendlyUrl(),
                    ];
                }

                $json['events'][] = [
                    'id'          => $event->getId(),
                    'link'        => $this->generateUrl(
                        'event_detail',
                        ['friendlyUrl' => $event->getFriendlyUrl(), '_format' => 'html']
                    ),
                    'image'       => $image,
                    'title'       => $event->getTitle(),
                    'description' => $event->getDescription(),
                    'location'    => $event->getLocation(),
                    'categories'  => $cat_array,
                    'day'         => $json['day'],
                    'month'       => $json['month'],
                ];
            }
        }

        return JsonResponse::create($json);
    }

}
