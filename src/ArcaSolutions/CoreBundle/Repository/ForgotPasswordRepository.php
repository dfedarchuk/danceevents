<?php


namespace ArcaSolutions\CoreBundle\Repository;


use ArcaSolutions\CoreBundle\Entity\ForgotPassword;
use Doctrine\ORM\EntityRepository;

class ForgotPasswordRepository extends EntityRepository
{
    /**
     * @param integer $accountId
     * @param string $uniqueKey
     * @param string $section
     *
     * @return ForgotPassword
     */
    public function addForgotPassword($accountId, $uniqueKey, $section)
    {
        $forgotPassword = new ForgotPassword();

        $forgotPassword->setAccountId($accountId);
        $forgotPassword->setUniqueKey($uniqueKey);
        $forgotPassword->setSection($section);

        $this->getEntityManager()->persist($forgotPassword);
        $this->getEntityManager()->flush($forgotPassword);

        return $forgotPassword;
    }
}