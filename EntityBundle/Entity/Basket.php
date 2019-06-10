<?php

namespace EntityBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Basket
 *
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="basket")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\BasketRepository")
 */
class Basket
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="basketItems")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @var Product
     *
     * @Serializer\Expose()
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="basketItems")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     */
    private $basketProduct;

    /**
     * @var integer
     *
     * @Serializer\Expose()
     * @ORM\Column(name="number_of_products", type="integer", nullable=false)
     */
    private $numberOfProducts;

    /**
     * @return float|int
     */
    public function getTotalPriceAllProducts()
    {
        return $this->getBasketProduct()->getPrice() * $this->getNumberOfProducts();
    }

    /**
     * @return int
     */
    public function getNumberOfProducts()
    {
        return $this->numberOfProducts;
    }

    /**
     * @param int $numberOfProducts
     */
    public function setNumberOfProducts(int $numberOfProducts)
    {
        $this->numberOfProducts = $numberOfProducts;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Basket
     */
    public function setUser(User $user): Basket
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Product
     */
    public function getBasketProduct(): Product
    {
        return $this->basketProduct;
    }

    /**
     * @param Product $basketProduct
     * @return Basket
     */
    public function setBasketProduct(Product $basketProduct): Basket
    {
        $this->basketProduct = $basketProduct;

        return $this;
    }

}
