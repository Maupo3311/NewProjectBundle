<?php

namespace EntityBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Basket
 *
 * @ORM\Table(name="basket")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\BasketRepository")
 */
class Basket
{
    /**
     * @var int
     *
     *
     * @Groups({"listing"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @Groups({"listing"})
     * @ORM\ManyToOne(targetEntity="User", inversedBy="basketItems")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @var Product
     *
     * @Groups({"listing"})
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="basketItems")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     */
    private $basketProduct;

    /**
     * @var integer
     *
     * @Groups({"listing"})
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
