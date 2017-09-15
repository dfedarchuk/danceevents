<?php

namespace ArcaSolutions\CoreBundle\Sample;

use ArcaSolutions\CoreBundle\Entity\Location4;

class Location4Sample extends Location4
{

    /**
     * Location4Sample constructor.
     *
     * @param misc $translator
     */
    public function __construct($translator)
    {
        $this->setName($translator->trans('City'))
            ->setFriendlyUrl('city-sample')
            ->setAbbreviation('ct');
    }
}
