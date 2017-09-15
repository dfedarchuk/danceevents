<?php
namespace ArcaSolutions\EventBundle\Sample;

use ArcaSolutions\CoreBundle\Sample\Location1Sample;
use ArcaSolutions\CoreBundle\Sample\Location2Sample;
use ArcaSolutions\CoreBundle\Sample\Location3Sample;
use ArcaSolutions\CoreBundle\Sample\Location4Sample;
use ArcaSolutions\CoreBundle\Sample\Location5Sample;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\ImageBundle\Sample\GalleryImageSample;
use ArcaSolutions\ImageBundle\Sample\ImageSample;
use Doctrine\Bundle\DoctrineBundle\Registry;

class EventSample extends Event
{
    /**
     * Quantity of category in this sample
     *
     * @var int
     */
    private $categoriesCount = 2;

    /*
     * @var misc
     */
    private $translator;

    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * EventSample constructor.
     *
     * @param int $level
     * @param     $translator
     * @param     $doctrine
     */
    public function __construct($level = 0, $translator, $doctrine)
    {
        $this->translator = $translator;
        $this->doctrine = $doctrine;

        $this->setTitle($this->translator->trans('Event Title'))
            ->setFriendlyUrl('event-sample')
            ->setZipCode($this->translator->trans('Zipcode'))
            ->setLocation($this->translator->trans('Location Name'))
            ->setAddress($this->translator->trans('Address'))
            ->setContactName($this->translator->trans('Contact Name'))
            ->setLongDescription(
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.'
            )
            ->setLatitude($this->translator->trans('-22.3344628'))
            ->setLongitude($this->translator->trans('-49.068844'))
            ->setLevel($level)
            ->setLevelObj($this->doctrine->getRepository('EventBundle:EventLevel')->find($level))
            ->setEmail($this->translator->trans('youremail@yoursite.com'))
            ->setUrl($this->translator->trans('www.yoursite.com'))
            ->setPhone($this->translator->trans('000.000.0000'))
            ->setStatus('A')
            ->setStartDate($startDate = new \DateTime('now'))
            ->setStartTime(new \DateTime($startDate->format('Y-m-d').'08:00:00'))
            ->setEndDate($endDate = new \DateTime('+1 week'))
            ->setEndTime(new \DateTime($startDate->format('Y-m-d').'12:00:00'))
            ->setRecurring('N')
            ->setRepeatEvent('N')
            ->setVideoSnippet('sample')
            ->setImage(new ImageSample(640, 480, $this->translator->trans('Placeholder')));

    }

    /**
     * Gets gallery images sample
     *
     * @param int $qtde_level
     *
     * @return array
     */
    public function getGallery($qtde_level = 0)
    {
        $array = [];
        for ($i = 0; $i < $qtde_level; $i++) {
            $galleryImage = new GalleryImageSample(640, 480, $this->translator->trans('Placeholder'));
            if (0 == $i) {
                $galleryImage->setImageDefault('y');
            }
            $array[] = $galleryImage;
        }

        return $array;
    }

    /**
     * Gets categories sample
     *
     * @return array
     */
    public function getCategories()
    {
        $array = [];
        for ($i = 0; $i < $this->categoriesCount; $i++) {
            $array[] = new EventcategorySample($this->translator, $i);
        }

        return $array;
    }

    /**
     * Gets location samples
     *
     * @return array
     */
    public function getLocationObjects()
    {
        return [
            1 => new Location5Sample($this->translator),
            2 => new Location4Sample($this->translator),
            3 => new Location3Sample($this->translator),
            4 => new Location2Sample($this->translator),
            5 => new Location1Sample($this->translator),
        ];
    }

    /**
     * Gets ID location following 'getLocationObjects' function
     * It is like this to work with location macro in detail
     *
     * @return array
     */
    public function getFakeLocationsIds()
    {
        return [1, 2, 3, 4, 5];
    }
}
