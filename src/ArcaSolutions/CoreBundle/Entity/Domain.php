<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Domain
 *
 * @ORM\Table(name="Domain", indexes={@ORM\Index(name="domain_info", columns={"url", "status"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\DomainRepository")
 */
class Domain
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
     * @ORM\Column(name="smaccount_id", type="integer", nullable=false)
     */
    private $smaccountId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="database_host", type="string", length=250, nullable=false)
     */
    private $databaseHost;

    /**
     * @var string
     *
     * @ORM\Column(name="database_port", type="string", length=10, nullable=false)
     */
    private $databasePort;

    /**
     * @var string
     *
     * @ORM\Column(name="database_username", type="string", length=250, nullable=false)
     */
    private $databaseUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="database_password", type="string", length=250, nullable=false)
     */
    private $databasePassword;

    /**
     * @var string
     *
     * @ORM\Column(name="database_name", type="string", length=250, nullable=false)
     */
    private $databaseName;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=250, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status = 'P';

    /**
     * @var string
     *
     * @ORM\Column(name="activation_status", type="string", length=1, nullable=false)
     */
    private $activationStatus = 'P';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="date", nullable=false)
     */
    private $created = '0000-00-00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_date", type="date", nullable=false)
     */
    private $deletedDate = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="article_feature", type="string", length=3, nullable=false)
     */
    private $articleFeature = 'off';

    /**
     * @var string
     *
     * @ORM\Column(name="banner_feature", type="string", length=3, nullable=false)
     */
    private $bannerFeature = 'off';

    /**
     * @var string
     *
     * @ORM\Column(name="classified_feature", type="string", length=3, nullable=false)
     */
    private $classifiedFeature = 'off';

    /**
     * @var string
     *
     * @ORM\Column(name="event_feature", type="string", length=3, nullable=false)
     */
    private $eventFeature = 'off';

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
     * Set smaccountId
     *
     * @param integer $smaccountId
     * @return Domain
     */
    public function setSmaccountId($smaccountId)
    {
        $this->smaccountId = $smaccountId;

        return $this;
    }

    /**
     * Get smaccountId
     *
     * @return integer 
     */
    public function getSmaccountId()
    {
        return $this->smaccountId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Domain
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
     * Set databaseHost
     *
     * @param string $databaseHost
     * @return Domain
     */
    public function setDatabaseHost($databaseHost)
    {
        $this->databaseHost = $databaseHost;

        return $this;
    }

    /**
     * Get databaseHost
     *
     * @return string 
     */
    public function getDatabaseHost()
    {
        return $this->databaseHost;
    }

    /**
     * Set databasePort
     *
     * @param string $databasePort
     * @return Domain
     */
    public function setDatabasePort($databasePort)
    {
        $this->databasePort = $databasePort;

        return $this;
    }

    /**
     * Get databasePort
     *
     * @return string 
     */
    public function getDatabasePort()
    {
        return $this->databasePort;
    }

    /**
     * Set databaseUsername
     *
     * @param string $databaseUsername
     * @return Domain
     */
    public function setDatabaseUsername($databaseUsername)
    {
        $this->databaseUsername = $databaseUsername;

        return $this;
    }

    /**
     * Get databaseUsername
     *
     * @return string 
     */
    public function getDatabaseUsername()
    {
        return $this->databaseUsername;
    }

    /**
     * Set databasePassword
     *
     * @param string $databasePassword
     * @return Domain
     */
    public function setDatabasePassword($databasePassword)
    {
        $this->databasePassword = $databasePassword;

        return $this;
    }

    /**
     * Get databasePassword
     *
     * @return string 
     */
    public function getDatabasePassword()
    {
        return $this->databasePassword;
    }

    /**
     * Set databaseName
     *
     * @param string $databaseName
     * @return Domain
     */
    public function setDatabaseName($databaseName)
    {
        $this->databaseName = $databaseName;

        return $this;
    }

    /**
     * Get databaseName
     *
     * @return string 
     */
    public function getDatabaseName()
    {
        return $this->databaseName;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Domain
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Domain
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
     * Set activationStatus
     *
     * @param string $activationStatus
     * @return Domain
     */
    public function setActivationStatus($activationStatus)
    {
        $this->activationStatus = $activationStatus;

        return $this;
    }

    /**
     * Get activationStatus
     *
     * @return string 
     */
    public function getActivationStatus()
    {
        return $this->activationStatus;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Domain
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set deletedDate
     *
     * @param \DateTime $deletedDate
     * @return Domain
     */
    public function setDeletedDate($deletedDate)
    {
        $this->deletedDate = $deletedDate;

        return $this;
    }

    /**
     * Get deletedDate
     *
     * @return \DateTime 
     */
    public function getDeletedDate()
    {
        return $this->deletedDate;
    }

    /**
     * Set articleFeature
     *
     * @param string $articleFeature
     * @return Domain
     */
    public function setArticleFeature($articleFeature)
    {
        $this->articleFeature = $articleFeature;

        return $this;
    }

    /**
     * Get articleFeature
     *
     * @return string 
     */
    public function getArticleFeature()
    {
        return $this->articleFeature;
    }

    /**
     * Set bannerFeature
     *
     * @param string $bannerFeature
     * @return Domain
     */
    public function setBannerFeature($bannerFeature)
    {
        $this->bannerFeature = $bannerFeature;

        return $this;
    }

    /**
     * Get bannerFeature
     *
     * @return string 
     */
    public function getBannerFeature()
    {
        return $this->bannerFeature;
    }

    /**
     * Set classifiedFeature
     *
     * @param string $classifiedFeature
     * @return Domain
     */
    public function setClassifiedFeature($classifiedFeature)
    {
        $this->classifiedFeature = $classifiedFeature;

        return $this;
    }

    /**
     * Get classifiedFeature
     *
     * @return string 
     */
    public function getClassifiedFeature()
    {
        return $this->classifiedFeature;
    }

    /**
     * Set eventFeature
     *
     * @param string $eventFeature
     * @return Domain
     */
    public function setEventFeature($eventFeature)
    {
        $this->eventFeature = $eventFeature;

        return $this;
    }

    /**
     * Get eventFeature
     *
     * @return string 
     */
    public function getEventFeature()
    {
        return $this->eventFeature;
    }

}
