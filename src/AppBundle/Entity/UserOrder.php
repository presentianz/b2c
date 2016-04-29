<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserOrder
 *
 * @ORM\Table(name="user_order", indexes={@ORM\Index(name="IDX_17EB68C0A76ED395", columns={"user_id"}), @ORM\Index(name="IDX_17EB68C0F5B7AF75", columns={"address_id"})})
 * @ORM\Entity
 */
class UserOrder
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
     * @var string
     *
     * @ORM\Column(name="order_id", type="string", length=255, nullable=false)
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint", nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="total_price", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $totalPrice;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime", nullable=false)
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="paid_at", type="datetime", nullable=true)
     */
    private $paidAt;

    /**
     * @var string
     *
     * @ORM\Column(name="post_fee", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $postFee;

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer", nullable=false)
     */
    private $points;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \ShipmentAddress
     *
     * @ORM\ManyToOne(targetEntity="ShipmentAddress")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     * })
     */
    private $address;



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
     * Set orderId
     *
     * @param string $orderId
     * @return UserOrder
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return string 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return UserOrder
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set totalPrice
     *
     * @param string $totalPrice
     * @return UserOrder
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return string 
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @return UserOrder
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime 
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set paidAt
     *
     * @param \DateTime $paidAt
     * @return UserOrder
     */
    public function setPaidAt($paidAt)
    {
        $this->paidAt = $paidAt;

        return $this;
    }

    /**
     * Get paidAt
     *
     * @return \DateTime 
     */
    public function getPaidAt()
    {
        return $this->paidAt;
    }

    /**
     * Set postFee
     *
     * @param string $postFee
     * @return UserOrder
     */
    public function setPostFee($postFee)
    {
        $this->postFee = $postFee;

        return $this;
    }

    /**
     * Get postFee
     *
     * @return string 
     */
    public function getPostFee()
    {
        return $this->postFee;
    }

    /**
     * Set points
     *
     * @param integer $points
     * @return UserOrder
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\FosUser $user
     * @return UserOrder
     */
    public function setUser(\AppBundle\Entity\FosUser $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\FosUser 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set address
     *
     * @param \AppBundle\Entity\ShipmentAddress $address
     * @return UserOrder
     */
    public function setAddress(\AppBundle\Entity\ShipmentAddress $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \AppBundle\Entity\ShipmentAddress 
     */
    public function getAddress()
    {
        return $this->address;
    }
}
