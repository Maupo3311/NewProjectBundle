<?php

namespace EntityBundle\Entity\Image;

use EntityBundle\Entity\Shop;
use EntityBundle\Enum\ImageType;
use Doctrine\ORM\Mapping as ORM;
use EntityBundle\Entity\Product;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductImage
 *
 * @ORM\Table(name="shop_image")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\ProductImageRepository")
 */
class ShopImage extends AbstractImage
{
    /**
     * @var Shop
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="EntityBundle\Entity\Shop", inversedBy="images")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shop_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $shop;

    /***********************************************
     *                Virtual fields
     ***********************************************/

    /**
     * Product Id
     *
     * @return null|int
     */
    public function getProductId()
    {
        return $this->getShop()->getId();
    }

    /***********************************************/

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return ImageType::SHOP;
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
}
