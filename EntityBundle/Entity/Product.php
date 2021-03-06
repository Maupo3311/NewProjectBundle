<?php

namespace EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

/**
 * Product
 *
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Product
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
     * @var string
     *
     * @Serializer\Expose()
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var integer
     *
     * @Serializer\Expose()
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var string
     *
     * @Serializer\Expose()
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Category
     *
     * @Serializer\Expose()
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var boolean
     *
     * @Serializer\Expose()
     * @ORM\Column(type="boolean"), options{"default": true}
     */
    private $active = true;

    /**
     * @var ArrayCollection $images
     *
     * @Serializer\Expose()
     * @ORM\OneToMany(
     *     targetEntity="EntityBundle\Entity\Image\ProductImage",
     *      cascade={"persist","remove"},
     *      orphanRemoval=true,
     *      mappedBy="product"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="images_id", referencedColumnName="id", nullable=true)
     * })
     */
    public $images;

    /**
     * @var ArrayCollection
     *
     * @Serializer\Groups({"details"})
     * @Serializer\Expose()
     * @ORM\OneToMany(
     *     targetEntity="Basket",
     *     mappedBy="basketProduct",
     *     )
     */
    private $basketItems;

    /**
     * @var integer
     *
     * @Serializer\Expose()
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var ArrayCollection
     *
     * @Serializer\Groups({"details"})
     * @Serializer\Expose()
     * @ORM\OneToMany(
     *     targetEntity="Comment",
     *     mappedBy="product",
     *     cascade={"persist","remove"},
     *     orphanRemoval=true,
     * )
     */
    private $comments;

    /**
     * @var string
     *
     * @Serializer\Expose()
     * @ORM\Column(name="rating", type="decimal", precision=4, scale=2)
     */
    private $rating;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->images      = new ArrayCollection();
        $this->basketItems = new ArrayCollection();
        $this->comments    = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return $this
     */
    public function setNumber(int $number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param $comments
     * @return $this
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * @param Comment $comment
     * @return $this
     */
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getBasketItems()
    {
        return $this->basketItems;
    }

    /**
     * @param  $basketItems
     * @return Product
     */
    public function setBasketItems($basketItems)
    {
        $this->basketItems = $basketItems;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param $rating
     * @return $this
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     * @return boolean
     */
    public function setActive($active)
    {
        return $this->active = $active;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set category
     *
     * @param Category $category
     *
     * @return Product
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param  $images
     * @return $this
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @param ArrayCollection $images
     * @return $this
     */
    public function addImages($images)
    {
        $this->images[] = $images;

        return $this;
    }
}

