<?php

namespace ArcaSolutions\MultiDomainBundle\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Registry;

class DoctrineRegistry extends Registry
{
    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    public function getManager($name = null)
    {
        if (null === $name) {
            $name = $this->getDataBase();
        }

        return parent::getManager($name);
    }

    private function getDataBase()
    {
        return 'domain';
    }
}

