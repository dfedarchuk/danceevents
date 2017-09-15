<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Importlog
 *
 * @ORM\Table(name="ImportLog")
 * @ORM\Entity
 */
class Importlog
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time", nullable=false)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, nullable=false)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="linesadded", type="string", length=255, nullable=false)
     */
    private $linesadded;

    /**
     * @var string
     *
     * @ORM\Column(name="phisicalname", type="string", length=255, nullable=false)
     */
    private $phisicalname;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=2, nullable=false)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="progress", type="string", length=5, nullable=false)
     */
    private $progress;

    /**
     * @var string
     *
     * @ORM\Column(name="totallines", type="string", length=255, nullable=false)
     */
    private $totallines;

    /**
     * @var string
     *
     * @ORM\Column(name="errorlines", type="string", length=255, nullable=false)
     */
    private $errorlines;

    /**
     * @var integer
     *
     * @ORM\Column(name="itens_added", type="integer", nullable=false)
     */
    private $itensAdded;

    /**
     * @var integer
     *
     * @ORM\Column(name="accounts_added", type="integer", nullable=false)
     */
    private $accountsAdded;

    /**
     * @var string
     *
     * @ORM\Column(name="history", type="text", nullable=false)
     */
    private $history;

    /**
     * @var string
     *
     * @ORM\Column(name="update_itens", type="string", length=1, nullable=false)
     */
    private $updateItens;

    /**
     * @var string
     *
     * @ORM\Column(name="from_export", type="string", length=1, nullable=false)
     */
    private $fromExport;

    /**
     * @var string
     *
     * @ORM\Column(name="active_item", type="string", length=1, nullable=false)
     */
    private $activeItem;

    /**
     * @var string
     *
     * @ORM\Column(name="update_friendlyurl", type="string", length=1, nullable=false)
     */
    private $updateFriendlyurl;

    /**
     * @var string
     *
     * @ORM\Column(name="featured_categs", type="string", length=1, nullable=false)
     */
    private $featuredCategs;

    /**
     * @var string
     *
     * @ORM\Column(name="default_level", type="string", length=3, nullable=false)
     */
    private $defaultLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="same_account", type="string", length=1, nullable=false)
     */
    private $sameAccount;

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer", nullable=true)
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="delimiter", type="string", length=3, nullable=false)
     */
    private $delimiter;

    /**
     * @var string
     *
     * @ORM\Column(name="mysqlerror", type="string", length=255, nullable=false)
     */
    private $mysqlerror;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;



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
     * Set date
     *
     * @param \DateTime $date
     * @return Importlog
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

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return Importlog
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return Importlog
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set linesadded
     *
     * @param string $linesadded
     * @return Importlog
     */
    public function setLinesadded($linesadded)
    {
        $this->linesadded = $linesadded;

        return $this;
    }

    /**
     * Get linesadded
     *
     * @return string
     */
    public function getLinesadded()
    {
        return $this->linesadded;
    }

    /**
     * Set phisicalname
     *
     * @param string $phisicalname
     * @return Importlog
     */
    public function setPhisicalname($phisicalname)
    {
        $this->phisicalname = $phisicalname;

        return $this;
    }

    /**
     * Get phisicalname
     *
     * @return string
     */
    public function getPhisicalname()
    {
        return $this->phisicalname;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Importlog
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
     * Set action
     *
     * @param string $action
     * @return Importlog
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set progress
     *
     * @param string $progress
     * @return Importlog
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return string
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set totallines
     *
     * @param string $totallines
     * @return Importlog
     */
    public function setTotallines($totallines)
    {
        $this->totallines = $totallines;

        return $this;
    }

    /**
     * Get totallines
     *
     * @return string
     */
    public function getTotallines()
    {
        return $this->totallines;
    }

    /**
     * Set errorlines
     *
     * @param string $errorlines
     * @return Importlog
     */
    public function setErrorlines($errorlines)
    {
        $this->errorlines = $errorlines;

        return $this;
    }

    /**
     * Get errorlines
     *
     * @return string
     */
    public function getErrorlines()
    {
        return $this->errorlines;
    }

    /**
     * Set itensAdded
     *
     * @param integer $itensAdded
     * @return Importlog
     */
    public function setItensAdded($itensAdded)
    {
        $this->itensAdded = $itensAdded;

        return $this;
    }

    /**
     * Get itensAdded
     *
     * @return integer
     */
    public function getItensAdded()
    {
        return $this->itensAdded;
    }

    /**
     * Set accountsAdded
     *
     * @param integer $accountsAdded
     * @return Importlog
     */
    public function setAccountsAdded($accountsAdded)
    {
        $this->accountsAdded = $accountsAdded;

        return $this;
    }

    /**
     * Get accountsAdded
     *
     * @return integer
     */
    public function getAccountsAdded()
    {
        return $this->accountsAdded;
    }

    /**
     * Set history
     *
     * @param string $history
     * @return Importlog
     */
    public function setHistory($history)
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get history
     *
     * @return string
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Set updateItens
     *
     * @param string $updateItens
     * @return Importlog
     */
    public function setUpdateItens($updateItens)
    {
        $this->updateItens = $updateItens;

        return $this;
    }

    /**
     * Get updateItens
     *
     * @return string
     */
    public function getUpdateItens()
    {
        return $this->updateItens;
    }

    /**
     * Set fromExport
     *
     * @param string $fromExport
     * @return Importlog
     */
    public function setFromExport($fromExport)
    {
        $this->fromExport = $fromExport;

        return $this;
    }

    /**
     * Get fromExport
     *
     * @return string
     */
    public function getFromExport()
    {
        return $this->fromExport;
    }

    /**
     * Set activeItem
     *
     * @param string $activeItem
     * @return Importlog
     */
    public function setActiveItem($activeItem)
    {
        $this->activeItem = $activeItem;

        return $this;
    }

    /**
     * Get activeItem
     *
     * @return string
     */
    public function getActiveItem()
    {
        return $this->activeItem;
    }

    /**
     * Set updateFriendlyurl
     *
     * @param string $updateFriendlyurl
     * @return Importlog
     */
    public function setUpdateFriendlyurl($updateFriendlyurl)
    {
        $this->updateFriendlyurl = $updateFriendlyurl;

        return $this;
    }

    /**
     * Get updateFriendlyurl
     *
     * @return string
     */
    public function getUpdateFriendlyurl()
    {
        return $this->updateFriendlyurl;
    }

    /**
     * Set featuredCategs
     *
     * @param string $featuredCategs
     * @return Importlog
     */
    public function setFeaturedCategs($featuredCategs)
    {
        $this->featuredCategs = $featuredCategs;

        return $this;
    }

    /**
     * Get featuredCategs
     *
     * @return string
     */
    public function getFeaturedCategs()
    {
        return $this->featuredCategs;
    }

    /**
     * Set defaultLevel
     *
     * @param string $defaultLevel
     * @return Importlog
     */
    public function setDefaultLevel($defaultLevel)
    {
        $this->defaultLevel = $defaultLevel;

        return $this;
    }

    /**
     * Get defaultLevel
     *
     * @return string
     */
    public function getDefaultLevel()
    {
        return $this->defaultLevel;
    }

    /**
     * Set sameAccount
     *
     * @param string $sameAccount
     * @return Importlog
     */
    public function setSameAccount($sameAccount)
    {
        $this->sameAccount = $sameAccount;

        return $this;
    }

    /**
     * Get sameAccount
     *
     * @return string
     */
    public function getSameAccount()
    {
        return $this->sameAccount;
    }

    /**
     * Set accountId
     *
     * @param integer $accountId
     * @return Importlog
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
     * Set delimiter
     *
     * @param string $delimiter
     * @return Importlog
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    /**
     * Get delimiter
     *
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * Set mysqlerror
     *
     * @param string $mysqlerror
     * @return Importlog
     */
    public function setMysqlerror($mysqlerror)
    {
        $this->mysqlerror = $mysqlerror;

        return $this;
    }

    /**
     * Get mysqlerror
     *
     * @return string
     */
    public function getMysqlerror()
    {
        return $this->mysqlerror;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Importlog
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
}
