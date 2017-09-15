<?php

namespace ArcaSolutions\WebBundle\Entity;

use ArcaSolutions\CoreBundle\Entity\Contact;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Review
 *
 * @ORM\Table(name="Review", indexes={@ORM\Index(name="approved", columns={"approved"}), @ORM\Index(name="item_info", columns={"item_type", "item_id"})})
 * @ORM\Entity(repositoryClass="ArcaSolutions\WebBundle\Repository\ReviewRepository")
 */
class Review
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"Review", "ReviewByAccount"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="item_type", type="string", length=20, nullable=false)
     * @Serializer\Groups({"Review"})
     * @Serializer\SerializedName("type")
     */
    private $itemType;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_id", type="integer", nullable=false)
     * @Serializer\Groups({"Review"})
     */
    private $itemId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="member_id", type="integer", nullable=true)
     */
    private $memberId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added", type="datetime", nullable=false)
     * @Serializer\Groups({"Review", "ReviewByAccount"})
     */
    private $added = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=20, nullable=true)
     */
    private $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="review_title", type="string", length=255, nullable=true)
     * @Serializer\Groups({"Review", "ReviewByAccount"})
     * @Serializer\SerializedName("title")
     */
    private $reviewTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="review", type="text", nullable=true)
     * @Serializer\Groups({"Review", "ReviewByAccount"})
     * @Serializer\SerializedName("text")
     */
    private $review;

    /**
     * @var string
     *
     * @ORM\Column(name="reviewer_name", type="string", length=255, nullable=true)
     */
    private $reviewerName;

    /**
     * @var string
     *
     * @ORM\Column(name="reviewer_email", type="string", length=255, nullable=true)
     */
    private $reviewerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="reviewer_location", type="string", length=255, nullable=true)
     */
    private $reviewerLocation;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=false)
     * @Serializer\Groups({"Review", "ReviewByAccount"})
     */
    private $rating = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="approved", type="integer", nullable=false)
     */
    private $approved = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="response", type="text", nullable=true)
     * @Serializer\Groups({"Review", "ReviewByAccount"})
     */
    private $response;

    /**
     * @var integer
     *
     * @ORM\Column(name="responseapproved", type="integer", nullable=false)
     */
    private $responseapproved = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="`like`", type="integer", nullable=false)
     * @Serializer\Groups({"Review", "ReviewByAccount"})
     */
    private $like;

    /**
     * @var integer
     *
     * @ORM\Column(name="dislike", type="integer", nullable=false)
     * @Serializer\Groups({"Review", "ReviewByAccount"})
     */
    private $dislike;

    /**
     * @var string
     *
     * @ORM\Column(name="like_ips", type="text", nullable=true)
     */
    private $likeIps;

    /**
     * @var string
     *
     * @ORM\Column(name="dislike_ips", type="text", nullable=true)
     */
    private $dislikeIps;

    /**
     * @var string
     *
     * @ORM\Column(name="new", type="string", length=1, nullable=false)
     */
    private $new = 'y';

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\WebBundle\Entity\Accountprofilecontact", inversedBy="reviews")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="account_id", onDelete="CASCADE")
     */
    private $profile;

    /**
     * It is for internal use
     * @var array
     * @Serializer\SerializedName("reviewer")
     * @Serializer\Groups({"Review"})
     */
    private $reviewer;

    /**
     * @var
     * @Serializer\Groups({"Review", "ReviewByAccount"})
     */
    private $module;

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
     * Set itemType
     *
     * @param string $itemType
     * @return Review
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;

        return $this;
    }

    /**
     * Get itemType
     *
     * @return string
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * Set itemId
     *
     * @param integer $itemId
     * @return Review
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set memberId
     *
     * @param integer $memberId
     * @return Review
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;

        return $this;
    }

    /**
     * Get memberId
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * Set added
     *
     * @param \DateTime $added
     * @return Review
     */
    public function setAdded($added)
    {
        $this->added = $added;

        return $this;
    }

    /**
     * Get added
     *
     * @return \DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Review
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set reviewTitle
     *
     * @param string $reviewTitle
     * @return Review
     */
    public function setReviewTitle($reviewTitle)
    {
        $this->reviewTitle = $reviewTitle;

        return $this;
    }

    /**
     * Get reviewTitle
     *
     * @return string
     */
    public function getReviewTitle()
    {
        return $this->reviewTitle;
    }

    /**
     * Set review
     *
     * @param string $review
     * @return Review
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set reviewerName
     *
     * @param string $reviewerName
     * @return Review
     */
    public function setReviewerName($reviewerName)
    {
        $this->reviewerName = $reviewerName;

        return $this;
    }

    /**
     * Get reviewerName
     *
     * @return string
     */
    public function getReviewerName()
    {
        return $this->reviewerName;
    }

    /**
     * Set reviewerEmail
     *
     * @param string $reviewerEmail
     * @return Review
     */
    public function setReviewerEmail($reviewerEmail)
    {
        $this->reviewerEmail = $reviewerEmail;

        return $this;
    }

    /**
     * Get reviewerEmail
     *
     * @return string
     */
    public function getReviewerEmail()
    {
        return $this->reviewerEmail;
    }

    /**
     * Set reviewerLocation
     *
     * @param string $reviewerLocation
     * @return Review
     */
    public function setReviewerLocation($reviewerLocation)
    {
        $this->reviewerLocation = $reviewerLocation;

        return $this;
    }

    /**
     * Get reviewerLocation
     *
     * @return string
     */
    public function getReviewerLocation()
    {
        return $this->reviewerLocation;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     * @return Review
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set approved
     *
     * @param integer $approved
     * @return Review
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return integer
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set response
     *
     * @param string $response
     * @return Review
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set responseapproved
     *
     * @param integer $responseapproved
     * @return Review
     */
    public function setResponseapproved($responseapproved)
    {
        $this->responseapproved = $responseapproved;

        return $this;
    }

    /**
     * Get responseapproved
     *
     * @return integer
     */
    public function getResponseapproved()
    {
        return $this->responseapproved;
    }

    /**
     * Set like
     *
     * @param integer $like
     * @return Review
     */
    public function setLike($like)
    {
        $this->like = $like;

        return $this;
    }

    /**
     * Get like
     *
     * @return integer
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * Set dislike
     *
     * @param integer $dislike
     * @return Review
     */
    public function setDislike($dislike)
    {
        $this->dislike = $dislike;

        return $this;
    }

    /**
     * Get dislike
     *
     * @return integer
     */
    public function getDislike()
    {
        return $this->dislike;
    }

    /**
     * Set likeIps
     *
     * @param string $likeIps
     * @return Review
     */
    public function setLikeIps($likeIps)
    {
        $this->likeIps = $likeIps;

        return $this;
    }

    /**
     * Get likeIps
     *
     * @return string
     */
    public function getLikeIps()
    {
        return $this->likeIps;
    }

    /**
     * Set dislikeIps
     *
     * @param string $dislikeIps
     * @return Review
     */
    public function setDislikeIps($dislikeIps)
    {
        $this->dislikeIps = $dislikeIps;

        return $this;
    }

    /**
     * Get dislikeIps
     *
     * @return string
     */
    public function getDislikeIps()
    {
        return $this->dislikeIps;
    }

    /**
     * Set new
     *
     * @param string $new
     * @return Review
     */
    public function setNew($new)
    {
        $this->new = $new;

        return $this;
    }

    /**
     * Get new
     *
     * @return string
     */
    public function getNew()
    {
        return $this->new;
    }

    /**
     * @return Accountprofilecontact
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param Accountprofilecontact $profile
     *
     * @return $this
     */
    public function setProfile(Accountprofilecontact $profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * It is for internal use
     *
     * @param Contact|null $contact
     * @param $image
     * @return $this
     */
    public function setReviewer($contact, $image)
    {
        $profile = $this->getProfile();
        if ($profile && $profile->getAccountId() and $contact instanceof Contact) {
            /* cleans array */
            $location = array_filter([
                $contact->getAddress(),
                $contact->getAddress2(),
                $contact->getCity(),
                $contact->getState(),
            ]);

            $this->reviewer = [
                'id'       => $this->profile->getAccountId(),
                'name'     => sprintf('%s %s', $this->profile->getFirstName(), $this->profile->getLastName()),
                'email'    => $contact->getEmail(),
                'location' => implode(', ', $location),
                'image'   => $image,
            ];
        } else {
            $this->reviewer = [
                'name'     => $this->reviewerName,
                'email'    => $this->reviewerEmail,
                'location' => $this->reviewerLocation,
                'image'   => $image,
            ];
        }

        return $this;
    }

    /**
     * Internal use
     *
     * @return array
     */
    public function getReviewer()
    {
        return $this->reviewer;
    }

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module)
    {
        $this->module = $module;
    }

}
