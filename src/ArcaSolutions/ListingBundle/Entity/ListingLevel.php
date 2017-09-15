<?php

namespace ArcaSolutions\ListingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListingLevel
 *
 * @ORM\Table(name="ListingLevel", indexes={@ORM\Index(name="active_value", columns={"active", "value"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\ListingBundle\Repository\ListingLevelRepository")
 */
class ListingLevel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $value = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="defaultlevel", type="string", length=1, nullable=false)
     */
    private $defaultlevel = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="string", length=1, nullable=false)
     */
    private $detail = 'n';

    /**
     * @var integer
     *
     * @ORM\Column(name="images", type="integer", nullable=false)
     */
    private $images = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="has_review", type="string", length=1, nullable=false)
     */
    private $hasReview = 'y';

    /**
     * @var string
     *
     * @ORM\Column(name="has_sms", type="string", length=1, nullable=false)
     */
    private $hasSms = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="has_call", type="string", length=1, nullable=false)
     */
    private $hasCall = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true, options={"comment":"monthly"})
     */
    private $price = '';

    /**
     * @var string
     *
     * @ORM\Column(name="price_yearly", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $priceYearly = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="free_category", type="integer", nullable=false)
     */
    private $freeCategory = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="category_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $categoryPrice = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=1, nullable=false)
     */
    private $active = 'y';

    /**
     * @var string
     *
     * @ORM\Column(name="popular", type="string", length=1, nullable=false, options={"default"="n"})
     */
    private $popular = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="featured", type="string", length=1, nullable=false, options={"default"="n"})
     */
    private $featured = 'n';

    /**
     * @var integer
     *
     * @ORM\Column(name="trial", type="integer", nullable=true)
     */
    private $trial;

    /**
     * @var integer
     *
     * @ORM\Column(name="deals", type="integer", nullable=false, options={"default" = 0})
     */
    private $deals;
    /**
     * @var number
     * @ORM\Column(name="classified_quantity_association", type="integer", nullable=false, options={"default"=0})
     */
    private $classifiedQuantityAssociation;

    /**
     * Set value
     *
     * @param integer $value
     * @return ListingLevel
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ListingLevel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set defaultlevel
     *
     * @param string $defaultlevel
     * @return ListingLevel
     */
    public function setDefaultlevel($defaultlevel)
    {
        $this->defaultlevel = $defaultlevel;

        return $this;
    }

    /**
     * Get defaultlevel
     *
     * @return string
     */
    public function getDefaultlevel()
    {
        return $this->defaultlevel;
    }

    /**
     * Set detail
     *
     * @param string $detail
     * @return ListingLevel
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set images
     *
     * @param integer $images
     * @return ListingLevel
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return integer
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set hasPromotion
     *
     * @param string $hasPromotion
     * @return ListingLevel
     */
    public function setHasPromotion($hasPromotion)
    {
        $this->hasPromotion = $hasPromotion;

        return $this;
    }

    /**
     * Get hasPromotion
     *
     * @return string
     */
    public function getHasPromotion()
    {
        return $this->hasPromotion;
    }

    /**
     * Set hasReview
     *
     * @param string $hasReview
     * @return ListingLevel
     */
    public function setHasReview($hasReview)
    {
        $this->hasReview = $hasReview;

        return $this;
    }

    /**
     * Get hasReview
     *
     * @return string
     */
    public function getHasReview()
    {
        return $this->hasReview;
    }

    /**
     * Set hasSms
     *
     * @param string $hasSms
     * @return ListingLevel
     */
    public function setHasSms($hasSms)
    {
        $this->hasSms = $hasSms;

        return $this;
    }

    /**
     * Get hasSms
     *
     * @return string
     */
    public function getHasSms()
    {
        return $this->hasSms;
    }

    /**
     * Set hasCall
     *
     * @param string $hasCall
     * @return ListingLevel
     */
    public function setHasCall($hasCall)
    {
        $this->hasCall = $hasCall;

        return $this;
    }

    /**
     * Get hasCall
     *
     * @return string
     */
    public function getHasCall()
    {
        return $this->hasCall;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return ListingLevel
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceYearly
     *
     * @param string $priceYearly
     * @return Articlelevel
     */
    public function setPriceYearly($priceYearly)
    {
        $this->priceYearly = $priceYearly;

        return $this;
    }

    /**
     * Get priceYearly
     *
     * @return string
     */
    public function getPriceYearly()
    {
        return $this->priceYearly;
    }

    /**
     * Set freeCategory
     *
     * @param integer $freeCategory
     * @return ListingLevel
     */
    public function setFreeCategory($freeCategory)
    {
        $this->freeCategory = $freeCategory;

        return $this;
    }

    /**
     * Get freeCategory
     *
     * @return integer
     */
    public function getFreeCategory()
    {
        return $this->freeCategory;
    }

    /**
     * Set categoryPrice
     *
     * @param string $categoryPrice
     * @return ListingLevel
     */
    public function setCategoryPrice($categoryPrice)
    {
        $this->categoryPrice = $categoryPrice;

        return $this;
    }

    /**
     * Get categoryPrice
     *
     * @return string
     */
    public function getCategoryPrice()
    {
        return $this->categoryPrice;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return ListingLevel
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set popular
     *
     * @param string $popular
     * @return ListingLevel
     */
    public function setPopular($popular)
    {
        $this->popular = $popular;

        return $this;
    }

    /**
     * Get popular
     *
     * @return string
     */
    public function getPopular()
    {
        return $this->popular;
    }

    /**
     * Set featured
     *
     * @param string $featured
     * @return ListingLevel
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return string
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * @return int
     */
    public function getDeals()
    {
        return $this->deals;
    }

    /**
     * @param int $deals
     */
    public function setDeals($deals)
    {
        $this->deals = $deals;
    }

    /**
     * @return number
     */
    public function getClassifiedQuantityAssociation()
    {
        return $this->classifiedQuantityAssociation;
    }

    /**
     * @param number $classifiedQuantityAssociation
     */
    public function setClassifiedQuantityAssociation(
        $classifiedQuantityAssociation
    ) {
        $this->classifiedQuantityAssociation = $classifiedQuantityAssociation;
    }

    /**
     * Set trial
     *
     * @param integer $trial
     * @return Listinglevel
     */
    public function setTrial($trial)
    {
        $this->trial = $trial;

        return $this;
    }

    /**
     * Get trial
     *
     * @return integer
     */
    public function getTrial()
    {
        return $this->trial;
    }
}
