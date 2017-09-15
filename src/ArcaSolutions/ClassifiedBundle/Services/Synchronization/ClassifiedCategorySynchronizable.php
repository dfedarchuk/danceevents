<?php

namespace ArcaSolutions\ClassifiedBundle\Services\Synchronization;

use ArcaSolutions\CoreBundle\Services\Synchronization\BaseCategorySynchronizable;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ClassifiedCategorySynchronizable extends BaseCategorySynchronizable
{
    function __construct(ContainerInterface $container)
    {
        parent::__construct($container, "C:%d", "ClassifiedBundle:Classifiedcategory", "classified");
    }
}
