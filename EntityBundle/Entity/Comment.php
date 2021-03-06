<?php

namespace EntityBundle\Entity;

use EntityBundle\Entity\Image\CommentImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Exception;
use JMS\Serializer\Annotation as Serializer;

/**
 * Comment
 *
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var int
     *
     * @Serializer\Expose()
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @Serializer\Expose()
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @var Product
     *
     * @Serializer\Expose()
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="comments")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     */
    private $product;

    /**
     * @var string
     *
     * @Serializer\Expose()
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var DateTime
     *
     * @Serializer\Expose()
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var ArrayCollection $images
     *
     * @Serializer\Expose()
     * @ORM\OneToMany(
     *     targetEntity="EntityBundle\Entity\Image\CommentImage",
     *      cascade={"persist","remove"},
     *      orphanRemoval=true,
     *      mappedBy="comment"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="images_id", referencedColumnName="id", nullable=true)
     * })
     */
    public $images;

    /**
     * Comment constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->images    = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array $images
     * @return $this
     */
    public function setImages(array $images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @param CommentImage $image
     * @return $this
     */
    public function addImage(CommentImage $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set message.
     *
     * @param string $message
     *
     * @return Comment
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
