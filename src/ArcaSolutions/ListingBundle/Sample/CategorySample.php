<?php
namespace ArcaSolutions\ListingBundle\Sample;

use ArcaSolutions\ListingBundle\Entity\ListingCategory;

class CategorySample extends ListingCategory
{

    /**
     * CategorySample constructor.
     *
     * @param misc $translator
     * @param int $counter
     */
    public function __construct($translator, $counter)
    {
        $this->setTitle($translator->trans('Category ').++$counter)
            ->setFriendlyUrl('category-sample')
            ->setFullFriendlyUrl('category-sample')
            ->setEnabled('y');
    }
}
