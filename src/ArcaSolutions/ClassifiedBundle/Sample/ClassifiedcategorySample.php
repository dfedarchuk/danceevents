<?php
namespace ArcaSolutions\ClassifiedBundle\Sample;

use ArcaSolutions\ClassifiedBundle\Entity\Classifiedcategory;

class ClassifiedcategorySample extends Classifiedcategory
{
    /**
     * ClassifiedcategorySample constructor.
     *
     * @param misc $translator
     * @param int $counter
     */
    public function __construct($translator, $counter)
    {
        $this->setTitle($translator->trans('Category ').++$counter)
            ->setFriendlyUrl('category-sample')
            ->setEnabled('y');
    }
}
