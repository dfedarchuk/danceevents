<?php

namespace ArcaSolutions\CoreBundle\Sample;

use ArcaSolutions\CoreBundle\Entity\Location1;

class Location1Sample extends Location1
{

    /**
     * Location1Sample constructor.
     *
     * @param misc $translator
     */
    public function __construct($translator)
    {
        $this->setName($translator->trans('Country'))
            ->setFriendlyUrl('country-sample')
            ->setAbbreviation('cy');
    }
}
