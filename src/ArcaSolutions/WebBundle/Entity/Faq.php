<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faq
 *
 * @ORM\Table(name="FAQ", indexes={@ORM\Index(name="keyword", columns={"keyword"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\WebBundle\Repository\FaqRepository")
 */
class Faq
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
     * @var string
     *
     * @ORM\Column(name="member", type="string", length=1, nullable=false)
     */
    private $member = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="frontend", type="string", length=1, nullable=false)
     */
    private $frontend = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="text", nullable=false)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="text", nullable=false)
     */
    private $answer;

    /**
     * @var string
     *
     * @ORM\Column(name="editable", type="string", length=1, nullable=false)
     */
    private $editable = 'y';

    /**
     * @var string
     *
     * @ORM\Column(name="keyword", type="text", nullable=false)
     */
    private $keyword;



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
     * Set member
     *
     * @param string $member
     * @return Faq
     */
    public function setMember($member)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return string
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set frontend
     *
     * @param string $frontend
     * @return Faq
     */
    public function setFrontend($frontend)
    {
        $this->frontend = $frontend;

        return $this;
    }

    /**
     * Get frontend
     *
     * @return string
     */
    public function getFrontend()
    {
        return $this->frontend;
    }

    /**
     * Set question
     *
     * @param string $question
     * @return Faq
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return Faq
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set editable
     *
     * @param string $editable
     * @return Faq
     */
    public function setEditable($editable)
    {
        $this->editable = $editable;

        return $this;
    }

    /**
     * Get editable
     *
     * @return string
     */
    public function getEditable()
    {
        return $this->editable;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     * @return Faq
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
}
