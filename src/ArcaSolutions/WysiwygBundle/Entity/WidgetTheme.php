<?php

namespace ArcaSolutions\WysiwygBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WidgetTheme
 *
 * @ORM\Table(name="Widget_Theme", indexes={@ORM\Index(name="widget_id", columns={"widget_id"}), @ORM\Index(name="theme_id", columns={"theme_id"})})
 * @ORM\Entity
 */
class WidgetTheme
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
     * @ORM\Column(name="theme_id", type="integer", nullable=false)
     */
    private $themeId;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\WysiwygBundle\Entity\Widget", inversedBy="themes")
     * @ORM\JoinColumn(name="widget_id", referencedColumnName="id")
     */
    private $widget;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\WysiwygBundle\Entity\Theme", inversedBy="widgets")
     * @ORM\JoinColumn(name="theme_id", referencedColumnName="id")
     */
    private $theme;

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
     * @return int
     */
    public function getThemeId()
    {
        return $this->themeId;
    }

    /**
     * @param int $themeId
     */
    public function setThemeId($themeId)
    {
        $this->themeId = $themeId;
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
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param mixed $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }


}
