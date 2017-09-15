<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiscountCode
 *
 * @ORM\Table(name="Discount_Code", indexes={@ORM\Index(name="type", columns={"type"}), @ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity
 */
class DiscountCode
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=15, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_date", type="date", nullable=false)
     */
    private $expireDate;

    /**
     * @var string
     *
     * @ORM\Column(name="recurring", type="string", length=3, nullable=false)
     */
    private $recurring;

    /**
     * @var string
     *
     * @ORM\Column(name="listing", type="string", length=3, nullable=false)
     */
    private $listing;

    /**
     * @var string
     *
     * @ORM\Column(name="event", type="string", length=3, nullable=false)
     */
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="banner", type="string", length=3, nullable=false)
     */
    private $banner;

    /**
     * @var string
     *
     * @ORM\Column(name="classified", type="string", length=3, nullable=false)
     */
    private $classified;

    /**
     * @var string
     *
     * @ORM\Column(name="article", type="string", length=3, nullable=false)
     */
    private $article;



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
     * Set amount
     *
     * @param string $amount
     * @return DiscountCode
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return DiscountCode
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return DiscountCode
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set expireDate
     *
     * @param \DateTime $expireDate
     * @return DiscountCode
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;

        return $this;
    }

    /**
     * Get expireDate
     *
     * @return \DateTime
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * Set recurring
     *
     * @param string $recurring
     * @return DiscountCode
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;

        return $this;
    }

    /**
     * Get recurring
     *
     * @return string
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * Set listing
     *
     * @param string $listing
     * @return DiscountCode
     */
    public function setListing($listing)
    {
        $this->listing = $listing;

        return $this;
    }

    /**
     * Get listing
     *
     * @return string
     */
    public function getListing()
    {
        return $this->listing;
    }

    /**
     * Set event
     *
     * @param string $event
     * @return DiscountCode
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set banner
     *
     * @param string $banner
     * @return DiscountCode
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get banner
     *
     * @return string
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Set classified
     *
     * @param string $classified
     * @return DiscountCode
     */
    public function setClassified($classified)
    {
        $this->classified = $classified;

        return $this;
    }

    /**
     * Get classified
     *
     * @return string
     */
    public function getClassified()
    {
        return $this->classified;
    }

    /**
     * Set article
     *
     * @param string $article
     * @return DiscountCode
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return string
     */
    public function getArticle()
    {
        return $this->article;
    }
}
