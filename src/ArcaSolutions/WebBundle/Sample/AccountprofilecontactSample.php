<?php
namespace ArcaSolutions\WebBundle\Sample;

use ArcaSolutions\WebBundle\Entity\Accountprofilecontact;

class AccountprofilecontactSample extends Accountprofilecontact
{

    /**
     * AccountprofilecontactSample constructor.
     * * @param misc $translator
     */
    public function __construct($translator = null)
    {
        $this->setFirstName($translator->trans('Visitor'))
            ->setLastName('')
            ->setFriendlyUrl('account-sample-edir')
            ->setHasProfile(false);
    }
}
