<?php

namespace EntityBundle\Entity\Image;

use EntityBundle\Enum\ImageType;
use Doctrine\ORM\Mapping as ORM;
use EntityBundle\Entity\Product;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductImage
 *
 * @ORM\Table(name="product_image")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\ProductImageRepository")
 */
class ProductImage extends AbstractImage
{
    /**
     * @var Product
     *
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="EntityBundle\Entity\Product", inversedBy="images")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     * })
     */
    protected $product;

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
        return $this->getProduct()->getId();
    }

    /***********************************************/

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return ImageType::PRODUCT;
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
     * @return ProductImage
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }
}
