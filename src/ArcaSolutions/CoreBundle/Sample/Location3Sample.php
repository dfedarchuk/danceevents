<?php

namespace ArcaSolutions\CoreBundle\Sample;

use ArcaSolutions\CoreBundle\Entity\Location3;

class Location3Sample extends Location3
{

    /**
     * Location3Sample constructor.
     *
     * @param misc $translator
     */
    public function __construct($translator)
    {
        $this->setName($translator->trans('State'))
            ->setFriendlyUrl('state-sample')
            ->setAbbreviation('st');
    }
}
