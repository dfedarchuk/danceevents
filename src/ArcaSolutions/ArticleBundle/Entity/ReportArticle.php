<?php

namespace ArcaSolutions\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReportArticle
 *
 * @ORM\Table(name="Report_Article", uniqueConstraints={@ORM\UniqueConstraint(name="report_info", columns={"article_id", "report_type", "date"})}, indexes={@ORM\Index(name="article_id", columns={"article_id"}), @ORM\Index(name="report_type", columns={"report_type"}), @ORM\Index(name="date", columns={"date"})})
 * @ORM\Entity
 */
class ReportArticle
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
     * @ORM\Column(name="article_id", type="integer", nullable=false)
     */
    private $articleId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="report_type", type="integer", nullable=false)
     */
    private $reportType = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="report_amount", type="integer", nullable=false)
     */
    private $reportAmount = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date = '0000-00-00';



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
     * Set articleId
     *
     * @param integer $articleId
     * @return ReportArticle
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;

        return $this;
    }

    /**
     * Get articleId
     *
     * @return integer 
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * Set reportType
     *
     * @param integer $reportType
     * @return ReportArticle
     */
    public function setReportType($reportType)
    {
        $this->reportType = $reportType;

        return $this;
    }

    /**
     * Get reportType
     *
     * @return integer 
     */
    public function getReportType()
    {
        return $this->reportType;
    }

    /**
     * Set reportAmount
     *
     * @param integer $reportAmount
     * @return ReportArticle
     */
    public function setReportAmount($reportAmount)
    {
        $this->reportAmount = $reportAmount;

        return $this;
    }

    /**
     * Get reportAmount
     *
     * @return integer 
     */
    public function getReportAmount()
    {
        return $this->reportAmount;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return ReportArticle
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
}
