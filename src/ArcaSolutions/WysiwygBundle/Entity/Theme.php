<?php


namespace ArcaSolutions\WysiwygBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table(name="Theme")
 * @ORM\Entity
 */
class Theme
{
    /**
     * Existing themes titles of eDirectory
     */
    const DEFAULT_THEME = 'Default';
    const DOCTOR_THEME = 'Doctor';
    const RESTAURANT_THEME = 'Restaurant';
    const WEDDING_THEME = 'Wedding';

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
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\WysiwygBundle\Entity\WidgetTheme", mappedBy="theme")
     */
    private $widgets;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\WysiwygBundle\Entity\PageWidget", mappedBy="theme")
     * @ORM\JoinColumn(name="id", referencedColumnName="theme_id")
     */
    private $pageWidgets;

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
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * @param mixed $widgets
     */
    public function setWidgets($widgets)
    {
        $this->widgets = $widgets;
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

}
