<?php

namespace ArcaSolutions\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogCategory
 *
 * @ORM\Table(name="Blog_Category", indexes={@ORM\Index(name="post_id", columns={"post_id"}), @ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="status", columns={"status"}), @ORM\Index(name="category_status", columns={"category_id", "status"})})
 * @ORM\Entity
 */
class BlogCategory1
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
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_id", type="integer", nullable=false)
     */
    private $postId;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_root_id", type="integer", nullable=false)
     */
    private $categoryRootId;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_node_left", type="integer", nullable=false)
     */
    private $categoryNodeLeft;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_node_right", type="integer", nullable=false)
     */
    private $categoryNodeRight;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1, nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\BlogBundle\Entity\Post", inversedBy="categories")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity="ArcaSolutions\BlogBundle\Entity\Blogcategory", inversedBy="blogCategory", fetch="EAGER")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

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
     * Set categoryId
     *
     * @param integer $categoryId
     * @return BlogCategory
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set postId
     *
     * @param integer $postId
     * @return BlogCategory
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get postId
     *
     * @return integer
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set categoryRootId
     *
     * @param integer $categoryRootId
     * @return BlogCategory
     */
    public function setCategoryRootId($categoryRootId)
    {
        $this->categoryRootId = $categoryRootId;

        return $this;
    }

    /**
     * Get categoryRootId
     *
     * @return integer
     */
    public function getCategoryRootId()
    {
        return $this->categoryRootId;
    }

    /**
     * Set categoryNodeLeft
     *
     * @param integer $categoryNodeLeft
     * @return BlogCategory
     */
    public function setCategoryNodeLeft($categoryNodeLeft)
    {
        $this->categoryNodeLeft = $categoryNodeLeft;

        return $this;
    }

    /**
     * Get categoryNodeLeft
     *
     * @return integer
     */
    public function getCategoryNodeLeft()
    {
        return $this->categoryNodeLeft;
    }

    /**
     * Set categoryNodeRight
     *
     * @param integer $categoryNodeRight
     * @return BlogCategory
     */
    public function setCategoryNodeRight($categoryNodeRight)
    {
        $this->categoryNodeRight = $categoryNodeRight;

        return $this;
    }

    /**
     * Get categoryNodeRight
     *
     * @return integer
     */
    public function getCategoryNodeRight()
    {
        return $this->categoryNodeRight;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return BlogCategory
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
     * @param mixed $post
     * @return BlogCategory1
     */
    public function setPost($post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $category
     * @return BlogCategory1
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }
}
