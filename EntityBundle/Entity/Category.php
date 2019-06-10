<?php

namespace EntityBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Category
 *
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=128, unique=true)
     */
    private $name;

    /**
     * @var bool
     *
     * @Serializer\Expose()
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $active = true;

    /**
     * @var ArrayCollection
     *
     * @Serializer\Groups({"details"})
     * @Serializer\Expose()
     * @ORM\OneToMany(
     *     targetEntity="Product",
     *     mappedBy="category",
     *     cascade={"persist","remove"},
     *     orphanRemoval=true
     *     )
     */
    private $products;

    /**
     * @var Shop
     *
     * @Serializer\Expose()
     * @ORM\ManyToOne(targetEntity="Shop", inversedBy="categories")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id")
     */
    private $shop;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return Shop
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param Shop $shop
     * @return $this
     */
    public function setShop(Shop $shop)
    {
        $this->shop = $shop;

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
     * Set name.
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product $product
     */
    public function deleteProduct(Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * @return int|void
     */
    public function getQuantityProducts()
    {
        return count($this->products);
    }
}
