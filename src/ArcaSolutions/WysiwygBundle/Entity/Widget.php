<?php

namespace ArcaSolutions\WysiwygBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Widget
 *
 * @ORM\Table(name="Widget")
 * @ORM\Entity(repositoryClass="ArcaSolutions\WysiwygBundle\Repository\WidgetRepository")
 */
class Widget
{
    /**
     * Possibles values for the `type` column
     */
    const HEADER_TYPE = 'header';
    const COMMON_TYPE = 'common';
    const SEARCH_TYPE = 'search';
    const BANNER_TYPE = 'banners';
    const LISTING_TYPE = 'listings';
    const EVENT_TYPE = 'events';
    const ARTICLE_TYPE = 'articles';
    const DEAL_TYPE = 'deals';
    const BLOG_TYPE = 'blog';
    const CLASSIFIED_TYPE = 'classifieds';
    const FOOTER_TYPE = 'footer';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=true)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\WysiwygBundle\Entity\WidgetTheme", mappedBy="widget")
     */
    private $themes;

    /**
     * @var string
     *
     * @ORM\Column(name="twig_file", type="string", nullable=false)
     */
    private $twigFile;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\WysiwygBundle\Entity\WidgetPageType", mappedBy="widget")
     */
    private $pageTypes;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\WysiwygBundle\Entity\PageWidget", mappedBy="widget")
     * @ORM\JoinColumn(name="id", referencedColumnName="widget_id")
     */
    private $pageWidgets;

    /**
     * @ORM\ManyToMany(targetEntity="ArcaSolutions\WysiwygBundle\Entity\WidgetPageType", mappedBy="widget")
     * @ORM\JoinColumn(name="id", referencedColumnName="widget_id")
     */
    private $widgetPageTypes;
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;
    /**
     * @var string
     *
     * @ORM\Column(name="`type`", type="string", nullable=false)
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(name="`modal`", type="string", nullable=true)
     */
    private $modal;

    /**
     * @return mixed
     */
    public function getWidgetPageTypes()
    {
        return $this->widgetPageTypes;
    }

    /**
     * @param mixed $widgetPageTypes
     */
    public function setWidgetPageTypes($widgetPageTypes)
    {
        $this->widgetPageTypes = $widgetPageTypes;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * @param mixed $themes
     */
    public function setThemes($themes)
    {
        $this->themes = $themes;
    }

    /**
     * @return string
     */
    public function getTwigFile()
    {
        return $this->twigFile;
    }

    /**
     * @param string $twigFile
     */
    public function setTwigFile($twigFile)
    {
        $this->twigFile = $twigFile;
    }

    /**
     * @return mixed
     */
    public function getPageTypes()
    {
        return $this->pageTypes;
    }

    /**
     * @param mixed $pageTypes
     */
    public function setPageTypes($pageTypes)
    {
        $this->pageTypes = $pageTypes;
    }

    /**
     * @return mixed
     */
    public function getPageWidgets()
    {
        return $this->pageWidgets;
    }

    /**
     * @param mixed $pageWidgets
     */
    public function setPageWidgets($pageWidgets)
    {
        $this->pageWidgets = $pageWidgets;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getModal()
    {
        return $this->modal;
    }

    /**
     * @param string $modal
     */
    public function setModal($modal)
    {
        $this->modal = $modal;
    }


}
