<?php
namespace ArcaSolutions\ClassifiedBundle\Sample;

use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use ArcaSolutions\CoreBundle\Sample\Location1Sample;
use ArcaSolutions\CoreBundle\Sample\Location2Sample;
use ArcaSolutions\CoreBundle\Sample\Location3Sample;
use ArcaSolutions\CoreBundle\Sample\Location4Sample;
use ArcaSolutions\CoreBundle\Sample\Location5Sample;
use ArcaSolutions\ImageBundle\Sample\GalleryImageSample;
use ArcaSolutions\ListingBundle\Sample\ListingSample;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ClassifiedSample extends Classified
{
    /*
     * @var misc
     */
    private $translator;

    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * ClassifiedSample constructor.
     *
     * @param misc $translator
     * @param int $level
     */
    public function __construct($level = 0, $translator, $doctrine)
    {
        $this->translator = $translator;
        $this->doctrine = $doctrine;

        $this->setTitle($this->translator->trans('Classified Title'))
            ->setDetaildesc('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque luctus enim ac diam malesuada vestibulum vitae at tortor. Nullam nec porttitor arcu. Pellentesque laoreet lorem egestas felis lobortis eu tincidunt nulla tempor. Phasellus adipiscing fringilla tempus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sed sapien ut eros porta volutpat et quis leo. Aenean tincidunt ipsum quis nisl blandit nec placerat eros consectetur. Morbi convallis, est quis venenatis fermentum, sapien nibh auctor arcu, auctor mattis justo nisi tincidunt neque. Quisque cursus luctus congue. Quisque vel nulla vitae arcu faucibus placerat. Curabitur iaculis molestie sagittis.')
            ->setPhone($this->translator->trans('000.000.0000'))
            ->setFax($this->translator->trans('000.000.0000'))
            ->setLatitude($this->translator->trans('-22.3344628'))
            ->setLongitude($this->translator->trans('-49.068844'))
            ->setZipCode($this->translator->trans('Zipcode'))
            ->setLevel($level)
            ->setLevelObj($this->doctrine->getRepository('ClassifiedBundle:ClassifiedLevel')->find($level))
            ->setAddress($this->translator->trans('Address'))
            ->setContactname($this->translator->trans('Contact Name'))
            ->setStatus('A')
            ->setEmail($this->translator->trans('youremail@yoursite.com'))
            ->setUrl($this->translator->trans('www.yoursite.com'))
            ->setRenewalDate(new \DateTime('now'))
            ->setCategory1(new ClassifiedcategorySample($this->translator, 0))->setCat1Id(1)
            ->setCategory2(new ClassifiedcategorySample($this->translator, 1))->setCat2Id(1)
            ->setClassifiedPrice(rand() % 500 + 1)
            ->setListing(new ListingSample($level, $translator, $doctrine))
            ->setFriendlyUrl('classified-sample-title')
            ->setVideoSnippet('sample')
            ->setAttachmentFile('sample')
            ->setAttachmentCaption($this->translator->trans('Click here to see more info!'));
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
