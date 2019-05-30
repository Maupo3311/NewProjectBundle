<?php

namespace NewProjectBundle\Entity\Image;

use NewProjectBundle\Entity\Shop;
use NewProjectBundle\Enum\ImageType;
use Doctrine\ORM\Mapping as ORM;
use NewProjectBundle\Entity\Product;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductImage
 *
 * @ORM\Table(name="shop_image")
 * @ORM\Entity(repositoryClass="NewProjectBundle\Repository\ProductImageRepository")
 */
class ShopImage extends AbstractImage
{
    /**
     * @var Shop
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="NewProjectBundle\Entity\Shop", inversedBy="images")
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
