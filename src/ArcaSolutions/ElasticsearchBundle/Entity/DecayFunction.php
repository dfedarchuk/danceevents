<?php
namespace ArcaSolutions\ElasticsearchBundle\Entity;


use Elastica\Filter\AbstractFilter;

class DecayFunction
{
    /**
     * @var string
     */
    private $function;
    /**
     * @var string
     */
    private $field;
    /**
     * @var string
     */
    private $origin;
    /**
     * @var string
     */
    private $scale;
    /**
     * @var string
     */
    private $offset;
    /**
     * @var float
     */
    private $decay;
    /**
     * @var float
     */
    private $weight;
    /**
     * @var AbstractFilter
     */
    private $filter;

    /**
     * DecayFunction constructor.
     * @param string $function
     * @param string $field
     * @param string $origin
     * @param string $scale
     * @param string $offset
     * @param float $decay
     * @param float $weight
     * @param AbstractFilter $filter
     */
    public function __construct(
        $function,
        $field,
        $origin,
        $scale,
        $offset = null,
        $decay = null,
        $weight = null,
        AbstractFilter $filter = null
    ) {
        $this->function = $function;
        $this->field = $field;
        $this->origin = $origin;
        $this->scale = $scale;
        $this->offset = $offset;
        $this->decay = $decay;
        $this->weight = $weight;
        $this->filter = $filter;
    }

    /**
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @param string $function
     */
    public function setFunction($function)
    {
        $this->function = $function;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param string $origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    /**
     * @return string
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * @param string $scale
     */
    public function setScale($scale)
    {
        $this->scale = $scale;
    }

    /**
     * @return string
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param string $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return float
     */
    public function getDecay()
    {
        return $this->decay;
    }

    /**
     * @param float $decay
     */
    public function setDecay($decay)
    {
        $this->decay = $decay;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return AbstractFilter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param AbstractFilter $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }
}
