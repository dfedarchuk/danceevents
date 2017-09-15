<?php

namespace ArcaSolutions\WebBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Accountprofilecontact
 *
 * @ORM\Table(name="AccountProfileContact")
 * @ORM\Entity
 */
class Accountprofilecontact
{
    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=100, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=100, nullable=true)
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="friendly_url", type="string", length=255, nullable=true)
     */
    private $friendlyUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="image_id", type="integer", nullable=true)
     */
    private $imageId;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_image", type="string", length=255, nullable=true)
     */
    private $facebookImage;

    /**
     * @var string
     *
     * @ORM\Column(name="has_profile", type="string", length=1, nullable=false, options={"default" = "y"})
     */
    private $hasProfile = 'y';

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\BlogBundle\Entity\Comments", mappedBy="profile")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="member_id")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\WebBundle\Entity\Review", mappedBy="profile")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="member_id")
     */
    private $reviews;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\ListingBundle\Entity\Listing", mappedBy="account")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="account_id")
     * @Serializer\Exclude()
     */
    private $listings;

    /**
     * @ORM\OneToMany(targetEntity="ArcaSolutions\ArticleBundle\Entity\Article", mappedBy="account")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="account_id")
     */
    private $articles;

    /**
     * @param int $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
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
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Accountprofilecontact
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Accountprofilecontact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Accountprofilecontact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     *
     * @return Accountprofilecontact
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get friendlyUrl
     *
     * @return string
     */
    public function getFriendlyUrl()
    {
        return $this->friendlyUrl;
    }

    /**
     * Set friendlyUrl
     *
     * @param string $friendlyUrl
     *
     * @return Accountprofilecontact
     */
    public function setFriendlyUrl($friendlyUrl)
    {
        $this->friendlyUrl = $friendlyUrl;

        return $this;
    }

    /**
     * Get imageId
     *
     * @return integer
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * Set imageId
     *
     * @param integer $imageId
     *
     * @return Accountprofilecontact
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;

        return $this;
    }

    /**
     * Get facebookImage
     *
     * @return string
     */
    public function getFacebookImage()
    {
        return $this->facebookImage;
    }

    /**
     * Set facebookImage
     *
     * @param string $facebookImage
     *
     * @return Accountprofilecontact
     */
    public function setFacebookImage($facebookImage)
    {
        $this->facebookImage = $facebookImage;

        return $this;
    }

    /**
     * Get hasProfile
     *
     * @return string
     */
    public function getHasProfile()
    {
        return $this->hasProfile;
    }

    /**
     * Set hasProfile
     *
     * @param string $hasProfile
     *
     * @return Accountprofilecontact
     */
    public function setHasProfile($hasProfile)
    {
        $this->hasProfile = $hasProfile;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @return mixed
     */
    public function getListings()
    {
        return $this->listings;
    }

    /**
     * @param mixed $listings
     */
    public function setListings($listings)
    {
        $this->listings = $listings;
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * Add comments
     *
     * @param \ArcaSolutions\BlogBundle\Entity\Comments $comments
     * @return Accountprofilecontact
     */
    public function addComment(\ArcaSolutions\BlogBundle\Entity\Comments $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \ArcaSolutions\BlogBundle\Entity\Comments $comments
     */
    public function removeComment(\ArcaSolutions\BlogBundle\Entity\Comments $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Add reviews
     *
     * @param \ArcaSolutions\WebBundle\Entity\Review $reviews
     * @return Accountprofilecontact
     */
    public function addReview(\ArcaSolutions\WebBundle\Entity\Review $reviews)
    {
        $this->reviews[] = $reviews;

        return $this;
    }

    /**
     * Remove reviews
     *
     * @param \ArcaSolutions\WebBundle\Entity\Review $reviews
     */
    public function removeReview(\ArcaSolutions\WebBundle\Entity\Review $reviews)
    {
        $this->reviews->removeElement($reviews);
    }

    /**
     * Add listings
     *
     * @param \ArcaSolutions\ListingBundle\Entity\Listing $listings
     * @return Accountprofilecontact
     */
    public function addListing(\ArcaSolutions\ListingBundle\Entity\Listing $listings)
    {
        $this->listings[] = $listings;

        return $this;
    }

    /**
     * Remove listings
     *
     * @param \ArcaSolutions\ListingBundle\Entity\Listing $listings
     */
    public function removeListing(\ArcaSolutions\ListingBundle\Entity\Listing $listings)
    {
        $this->listings->removeElement($listings);
    }

    /**
     * Add articles
     *
     * @param \ArcaSolutions\ArticleBundle\Entity\Article $articles
     * @return Accountprofilecontact
     */
    public function addArticle(\ArcaSolutions\ArticleBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \ArcaSolutions\ArticleBundle\Entity\Article $articles
     */
    public function removeArticle(\ArcaSolutions\ArticleBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }
}
