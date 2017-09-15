<?php

namespace ArcaSolutions\ListingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListingtemplateField
 *
 * @ORM\Table(name="ListingTemplate_Field")
 * @ORM\Entity(repositoryClass="ArcaSolutions\TestBundle\Entity\ListingtemplateFieldRepository")
 */
class ListingtemplateField
{
    /**
     * @var integer
     *
     * @ORM\Column(name="listingtemplate_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $listingtemplateId;

    /**
     * @var string
     *
     * @ORM\Column(name="field", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $field;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="fieldvalues", type="text", nullable=false)
     */
    private $fieldvalues;

    /**
     * @var string
     *
     * @ORM\Column(name="instructions", type="string", length=255, nullable=false)
     */
    private $instructions;

    /**
     * @var string
     *
     * @ORM\Column(name="required", type="string", length=1, nullable=false)
     */
    private $required;

    /**
     * @var string
     *
     * @ORM\Column(name="search", type="string", length=1, nullable=false)
     */
    private $search;

    /**
     * @var string
     *
     * @ORM\Column(name="searchbykeyword", type="string", length=1, nullable=false)
     */
    private $searchbykeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="searchbyrange", type="string", length=1, nullable=false)
     */
    private $searchbyrange;

    /**
     * @var integer
     *
     * @ORM\Column(name="show_order", type="integer", nullable=false)
     */
    private $showOrder = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="enabled", type="string", length=1, nullable=false)
     */
    private $enabled = 'y';

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\ListingBundle\Entity\Listingtemplate", inversedBy="fields")
     * @ORM\JoinColumn(name="listingtemplate_id", referencedColumnName="id")
     */
    private $template;

    /**
     * Set listingtemplateId
     *
     * @param integer $listingtemplateId
     * @return ListingtemplateField
     */
    public function setListingtemplateId($listingtemplateId)
    {
        $this->listingtemplateId = $listingtemplateId;

        return $this;
    }

    /**
     * Get listingtemplateId
     *
     * @return integer
     */
    public function getListingtemplateId()
    {
        return $this->listingtemplateId;
    }

    /**
     * Set field
     *
     * @param string $field
     * @return ListingtemplateField
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return ListingtemplateField
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set fieldvalues
     *
     * @param string $fieldvalues
     * @return ListingtemplateField
     */
    public function setFieldvalues($fieldvalues)
    {
        $this->fieldvalues = $fieldvalues;

        return $this;
    }

    /**
     * Get fieldvalues
     *
     * @return string
     */
    public function getFieldvalues()
    {
        return $this->fieldvalues;
    }

    /**
     * Set instructions
     *
     * @param string $instructions
     * @return ListingtemplateField
     */
    public function setInstructions($instructions)
    {
        $this->instructions = $instructions;

        return $this;
    }

    /**
     * Get instructions
     *
     * @return string
     */
    public function getInstructions()
    {
        return $this->instructions;
    }

    /**
     * Set required
     *
     * @param string $required
     * @return ListingtemplateField
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Get required
     *
     * @return string
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Set search
     *
     * @param string $search
     * @return ListingtemplateField
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get search
     *
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set searchbykeyword
     *
     * @param string $searchbykeyword
     * @return ListingtemplateField
     */
    public function setSearchbykeyword($searchbykeyword)
    {
        $this->searchbykeyword = $searchbykeyword;

        return $this;
    }

    /**
     * Get searchbykeyword
     *
     * @return string
     */
    public function getSearchbykeyword()
    {
        return $this->searchbykeyword;
    }

    /**
     * Set searchbyrange
     *
     * @param string $searchbyrange
     * @return ListingtemplateField
     */
    public function setSearchbyrange($searchbyrange)
    {
        $this->searchbyrange = $searchbyrange;

        return $this;
    }

    /**
     * Get searchbyrange
     *
     * @return string
     */
    public function getSearchbyrange()
    {
        return $this->searchbyrange;
    }

    /**
     * Set showOrder
     *
     * @param integer $showOrder
     * @return ListingtemplateField
     */
    public function setShowOrder($showOrder)
    {
        $this->showOrder = $showOrder;

        return $this;
    }

    /**
     * Get showOrder
     *
     * @return integer
     */
    public function getShowOrder()
    {
        return $this->showOrder;
    }

    /**
     * Set enabled
     *
     * @param string $enabled
     * @return ListingtemplateField
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
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }
}
