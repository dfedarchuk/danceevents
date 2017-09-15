<?php

namespace ArcaSolutions\WysiwygBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WidgetPageType
 *
 * @ORM\Table(name="Widget_PageType", indexes={@ORM\Index(name="widget_id", columns={"widget_id"}), @ORM\Index(name="pagetype_id", columns={"pagetype_id"})})
 * @ORM\Entity
 */
class WidgetPageType
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
     * @ORM\Column(name="widget_id", type="integer", nullable=false)
     */
    private $widgetId;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagetype_id", type="integer", nullable=true)
     */
    private $pageTypeId;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\WysiwygBundle\Entity\Widget", inversedBy="pageTypes")
     * @ORM\JoinColumn(name="widget_id", referencedColumnName="id")
     */
    private $widget;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\WysiwygBundle\Entity\PageType", inversedBy="widgets")
     * @ORM\JoinColumn(name="pagetype_id", referencedColumnName="id", nullable=true)
     */
    private $pageType;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getWidgetId()
    {
        return $this->widgetId;
    }

    /**
     * @param int $widgetId
     */
    public function setWidgetId($widgetId)
    {
        $this->widgetId = $widgetId;
    }

    /**
     * @return mixed
     */
    public function getWidget()
    {
        return $this->widget;
    }

    /**
     * @param mixed $widget
     */
    public function setWidget($widget)
    {
        $this->widget = $widget;
    }

    /**
     * @return int
     */
    public function getPageTypeId()
    {
        return $this->pageTypeId;
    }

    /**
     * @param int $pageTypeId
     */
    public function setPageTypeId($pageTypeId)
    {
        $this->pageTypeId = $pageTypeId;
    }

    /**
     * @return mixed
     */
    public function getPageType()
    {
        return $this->pageType;
    }

    /**
     * @param mixed $pageType
     */
    public function setPageType($pageType)
    {
        $this->pageType = $pageType;
    }

}
