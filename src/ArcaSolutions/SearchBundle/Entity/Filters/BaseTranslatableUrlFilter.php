<?php

namespace ArcaSolutions\SearchBundle\Entity\Filters;

use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class BaseTranslatableUrlFilter extends BaseFilter
{
    /**
     * @var string
     */
    protected static $filterUrlName = "";
    /**
     * @var string
     */
    protected $translatedName;

    /**
     * {@inheritdoc}
     */
    function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $translator = $this->container->get("translator");
        $this->translatedName = strtolower($translator->trans(/** @Ignore */
            static::$filterUrlName, [], "filters"));
    }

    /**
     * @return string
     */
    public function getTranslatedName()
    {
        return $this->translatedName;
    }
}
