<?php

namespace ArcaSolutions\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Packagemodules
 *
 * @ORM\Table(name="PackageModules", indexes={@ORM\Index(name="domain_id", columns={"domain_id"}), @ORM\Index(name="fk_PackageModules_Package1", columns={"package_id"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\CoreBundle\Repository\PackagemodulesRepository")
 */
class Packagemodules
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
     * @ORM\Column(name="account_id", type="integer", nullable=false)
     */
    private $accountId;

    /**
     * @var integer
     *
     * @ORM\Column(name="package_id", type="integer", nullable=false)
     */
    private $packageId;

    /**
     * @var integer
     *
     * @ORM\Column(name="domain_id", type="integer", nullable=true)
     */
    private $domainId;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_domain_id", type="integer", nullable=false)
     */
    private $parentDomainId;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=50, nullable=true)
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="module_name", type="string", length=255, nullable=false)
     */
    private $moduleName;

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="integer", nullable=true)
     */
    private $moduleId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;



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
     * Set accountId
     *
     * @param integer $accountId
     * @return Packagemodules
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer 
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set packageId
     *
     * @param integer $packageId
     * @return Packagemodules
     */
    public function setPackageId($packageId)
    {
        $this->packageId = $packageId;

        return $this;
    }

    /**
     * Get packageId
     *
     * @return integer 
     */
    public function getPackageId()
    {
        return $this->packageId;
    }

    /**
     * Set domainId
     *
     * @param integer $domainId
     * @return Packagemodules
     */
    public function setDomainId($domainId)
    {
        $this->domainId = $domainId;

        return $this;
    }

    /**
     * Get domainId
     *
     * @return integer 
     */
    public function getDomainId()
    {
        return $this->domainId;
    }

    /**
     * Set parentDomainId
     *
     * @param integer $parentDomainId
     * @return Packagemodules
     */
    public function setParentDomainId($parentDomainId)
    {
        $this->parentDomainId = $parentDomainId;

        return $this;
    }

    /**
     * Get parentDomainId
     *
     * @return integer 
     */
    public function getParentDomainId()
    {
        return $this->parentDomainId;
    }

    /**
     * Set module
     *
     * @param string $module
     * @return Packagemodules
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set moduleName
     *
     * @param string $moduleName
     * @return Packagemodules
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;

        return $this;
    }

    /**
     * Get moduleName
     *
     * @return string 
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     * @return Packagemodules
     */
    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    /**
     * Get moduleId
     *
     * @return integer 
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Packagemodules
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
