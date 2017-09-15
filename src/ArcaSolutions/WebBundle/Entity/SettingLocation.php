<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SettingLocation
 *
 * @ORM\Table(name="Setting_Location")
 * @ORM\Entity(repositoryClass="ArcaSolutions\WebBundle\Repository\SettingLocationRepository")
 */
class SettingLocation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="default_id", type="integer", nullable=false)
     */
    private $defaultId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_plural", type="string", length=255, nullable=false)
     */
    private $namePlural;

    /**
     * @var string
     *
     * @ORM\Column(name="enabled", type="string", length=1, nullable=false)
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="show", type="string", length=1, nullable=false)
     */
    private $show;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set defaultId
     *
     * @param integer $defaultId
     * @return SettingLocation
     */
    public function setDefaultId($defaultId)
    {
        $this->defaultId = $defaultId;

        return $this;
    }

    /**
     * Get defaultId
     *
     * @return integer
     */
    public function getDefaultId()
    {
        return $this->defaultId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return SettingLocation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set namePlural
     *
     * @param string $namePlural
     * @return SettingLocation
     */
    public function setNamePlural($namePlural)
    {
        $this->namePlural = $namePlural;

        return $this;
    }

    /**
     * Get namePlural
     *
     * @return string
     */
    public function getNamePlural()
    {
        return $this->namePlural;
    }

    /**
     * Set enabled
     *
     * @param string $enabled
     * @return SettingLocation
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return string
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set show
     *
     * @param string $show
     * @return SettingLocation
     */
    public function setShow($show)
    {
        $this->show = $show;

        return $this;
    }

    /**
     * Get show
     *
     * @return string
     */
    public function getShow()
    {
        return $this->show;
    }
}
