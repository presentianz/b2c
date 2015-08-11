<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderProduct
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OrderProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

    /**
     * @ORM\ManyToOne(targetEntity="UserOrder", inversedBy="orderProducts")
     * @ORM\JoinColumn(name="user_order_id", referencedColumnName="id")
     **/
    private $userOrder;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     **/
    private $product;


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
     * Set price
     *
     * @param string $price
     * @return OrderProduct
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return OrderProduct
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set userOrder
     *
     * @param \AppBundle\Entity\UserOrder $userOrder
     * @return OrderProduct
     */
    public function setUserOrder(\AppBundle\Entity\UserOrder $userOrder = null)
    {
        $this->userOrder = $userOrder;

        return $this;
    }

    /**
     * Get userOrder
     *
     * @return \AppBundle\Entity\UserOrder 
     */
    public function getUserOrder()
    {
        return $this->userOrder;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return OrderProduct
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
