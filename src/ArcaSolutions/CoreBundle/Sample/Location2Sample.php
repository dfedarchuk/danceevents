<?php

namespace ArcaSolutions\CoreBundle\Sample;

use ArcaSolutions\CoreBundle\Entity\Location2;

class Location2Sample extends Location2
{

    /**
     * Location2Sample constructor.
     *
     * @param misc $translator
     */
    public function __construct($translator)
    {
        $this->setName($translator->trans('Region'))
            ->setFriendlyUrl('region-sample')
            ->setAbbreviation('re');
    }
}
