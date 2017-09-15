<?php

namespace ArcaSolutions\CoreBundle\Sample;

use ArcaSolutions\CoreBundle\Entity\Location5;

class Location5Sample extends Location5
{

    /**
     * Location5Sample constructor.
     *
     * @param misc $translator
     */
    public function __construct($translator)
    {
        $this->setName($translator->trans('Neighborhood'))
            ->setFriendlyUrl('neighborhood-sample')
            ->setAbbreviation('ngh');
    }
}
