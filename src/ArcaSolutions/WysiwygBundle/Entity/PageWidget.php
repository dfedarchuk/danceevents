<?php


namespace ArcaSolutions\WysiwygBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageWidget
 *
 * @ORM\Table(name="Page_Widget", indexes={@ORM\Index(name="page_id", columns={"page_id"}), @ORM\Index(name="widget_id", columns={"widget_id"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\WysiwygBundle\Repository\PageWidgetRepository")
 */
class PageWidget
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
     * @ORM\Column(name="page_id", type="integer", nullable=false )
     */
    private $pageId;

    /**
     * @var integer
     *
     * @ORM\Column(name="widget_id", type="integer", nullable=false )
     */
    private $widgetId;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true )
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="`order`", type="integer", nullable=false)
     */
    private $order;

    /**
     * @var integer
     *
     * @ORM\Column(name="theme_id", type="integer", nullable=false)
     */
    private $themeId;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\WysiwygBundle\Entity\Page", inversedBy="pageWidgets")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     */
    private $page;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\WysiwygBundle\Entity\Widget", inversedBy="pageWidgets")
     * @ORM\JoinColumn(name="widget_id", referencedColumnName="id")
     */
    private $widget;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\WysiwygBundle\Entity\Theme", inversedBy="pageWidgets")
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
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @param int $pageId
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;
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
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
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
