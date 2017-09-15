<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lang
 *
 * @ORM\Table(name="Lang", indexes={@ORM\Index(name="name", columns={"name"}), @ORM\Index(name="enabled", columns={"lang_enabled"}), @ORM\Index(name="default", columns={"lang_default"})})
 * @ORM\Entity
 */
class Lang
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_number", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=5, nullable=false)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lang_enabled", type="string", length=1, nullable=false)
     */
    private $langEnabled;

    /**
     * @var string
     *
     * @ORM\Column(name="lang_default", type="string", length=1, nullable=false)
     */
    private $langDefault;

    /**
     * @var integer
     *
     * @ORM\Column(name="lang_order", type="integer", nullable=false)
     */
    private $langOrder;



    /**
     * Get idNumber
     *
     * @return integer 
     */
    public function getIdNumber()
    {
        return $this->idNumber;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Lang
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Lang
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
     * Set langEnabled
     *
     * @param string $langEnabled
     * @return Lang
     */
    public function setLangEnabled($langEnabled)
    {
        $this->langEnabled = $langEnabled;

        return $this;
    }

    /**
     * Get langEnabled
     *
     * @return string 
     */
    public function getLangEnabled()
    {
        return $this->langEnabled;
    }

    /**
     * Set langDefault
     *
     * @param string $langDefault
     * @return Lang
     */
    public function setLangDefault($langDefault)
    {
        $this->langDefault = $langDefault;

        return $this;
    }

    /**
     * Get langDefault
     *
     * @return string 
     */
    public function getLangDefault()
    {
        return $this->langDefault;
    }

    /**
     * Set langOrder
     *
     * @param integer $langOrder
     * @return Lang
     */
    public function setLangOrder($langOrder)
    {
        $this->langOrder = $langOrder;

        return $this;
    }

    /**
     * Get langOrder
     *
     * @return integer 
     */
    public function getLangOrder()
    {
        return $this->langOrder;
    }
}
