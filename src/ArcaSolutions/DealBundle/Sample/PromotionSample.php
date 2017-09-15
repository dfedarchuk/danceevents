<?php
namespace ArcaSolutions\DealBundle\Sample;

use ArcaSolutions\DealBundle\Entity\Promotion;
use ArcaSolutions\ImageBundle\Sample\ImageSample;

class PromotionSample extends Promotion
{
    /**
     * PromotionSample constructor.
     *
     * @param misc $translator
     */
    public function __construct($translator)
    {
        $this->setName($translator->trans('10% Off - Deal Title'))
            ->setFriendlyUrl('deal-sample')
            ->setAmount(rand() % 30)
            ->setConditions('Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.')
            ->setDealType('monetary value')
            ->setRealvalue(120.0)
            ->setDealvalue(55.0)
            ->setStartDate(new \DateTime('now'))
            ->setEndDate($this->getStartDate()->modify('1 week'))
            ->setDescription('Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas.')
            ->setMainImage(new ImageSample());
        ;
    }
}
