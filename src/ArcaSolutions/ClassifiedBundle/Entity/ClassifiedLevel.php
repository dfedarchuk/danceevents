<?php

namespace ArcaSolutions\ClassifiedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClassifiedLevel
 *
 * @ORM\Table(name="ClassifiedLevel")
 * @ORM\Entity(repositoryClass="ArcaSolutions\ClassifiedBundle\Repository\ClassifiedLevelRepository")
 */
class ClassifiedLevel
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
    private $detail = 'y';

    /**
     * @var integer
     *
     * @ORM\Column(name="images", type="integer", nullable=false)
     */
    private $images = '0';

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
     * @var string
     * @ORM\Column(name="video", type="string", length=1, nullable=false, options={"default"="n"})
     */
    private $video;

    /**
     * @var string
     * @ORM\Column(name="additional_files", type="string", length=1, nullable=false, options={"default"="n"})
     */
    private $AdditionalFiles;


    /**
     * Set value
     *
     * @param integer $value
     * @return ClassifiedLevel
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
     * @return ClassifiedLevel
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
     * @return ClassifiedLevel
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
     * @return ClassifiedLevel
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
     * @return ClassifiedLevel
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
     * Set price
     *
     * @param string $price
     * @return ClassifiedLevel
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
     * Set active
     *
     * @param string $active
     * @return ClassifiedLevel
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
     * @return ClassifiedLevel
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
     * @return ClassifiedLevel
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
     * Set trial
     *
     * @param integer $trial
     * @return Classifiedlevel
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

    /**
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param string $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return string
     */
    public function getAdditionalFiles()
    {
        return $this->AdditionalFiles;
    }

    /**
     * @param string $AdditionalFiles
     */
    public function setAdditionalFiles($AdditionalFiles)
    {
        $this->AdditionalFiles = $AdditionalFiles;
    }

}
