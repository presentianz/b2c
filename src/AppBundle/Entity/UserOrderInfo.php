<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserOrderInfo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserOrderInfoRepository")
 */
class UserOrderInfo
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
     * @var integer
     *
     * @ORM\Column(name="originalCoins", type="integer")
     */
    private $originalCoins;

    /**
     * @var integer
     *
     * @ORM\Column(name="coins", type="integer")
     */
    private $coins;

    /**
     * @var string
     *
     * @ORM\Column(name="shipmentId", type="string", length=255)
     */
    private $shipmentId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createAt", type="datetime")
     */
    private $createAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="state", type="smallint")
     */
    private $state;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="paidAt", type="datetime")
     */
    private $paidAt;


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
     * Set originalCoins
     *
     * @param integer $originalCoins
     * @return UserOrderInfo
     */
    public function setOriginalCoins($originalCoins)
    {
        $this->originalCoins = $originalCoins;

        return $this;
    }

    /**
     * Get originalCoins
     *
     * @return integer 
     */
    public function getOriginalCoins()
    {
        return $this->originalCoins;
    }

    /**
     * Set coins
     *
     * @param integer $coins
     * @return UserOrderInfo
     */
    public function setCoins($coins)
    {
        $this->coins = $coins;

        return $this;
    }

    /**
     * Get coins
     *
     * @return integer 
     */
    public function getCoins()
    {
        return $this->coins;
    }

    /**
     * Set shipmentId
     *
     * @param string $shipmentId
     * @return UserOrderInfo
     */
    public function setShipmentId($shipmentId)
    {
        $this->shipmentId = $shipmentId;

        return $this;
    }

    /**
     * Get shipmentId
     *
     * @return string 
     */
    public function getShipmentId()
    {
        return $this->shipmentId;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @return UserOrderInfo
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
     * Set state
     *
     * @param integer $state
     * @return UserOrderInfo
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set paidAt
     *
     * @param \DateTime $paidAt
     * @return UserOrderInfo
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
}
