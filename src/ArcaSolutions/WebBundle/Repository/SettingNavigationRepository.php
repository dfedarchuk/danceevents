<?php
namespace ArcaSolutions\WebBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SettingNavigationRepository extends EntityRepository
{
    /**
     * @param string $area
     *
     * @return array
     * @throws \Exception
     */
    public function getMenuByArea($area = '')
    {
        if (empty($area)) {
            throw new \Exception('You must pass a theme to get the menu.');
        }

        return $this->findBy(['area' => $area], ['order' => 'ASC']);
    }
}
