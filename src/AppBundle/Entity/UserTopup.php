<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserTopup
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserTopupRepository")
 */
class UserTopup
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
     * @ORM\Column(name="tradeId", type="string", length=255)
     */
    private $tradeId;

    /**
     * @var string
     *
     * @ORM\Column(name="dollar", type="decimal")
     */
    private $dollar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tradeAt", type="datetime")
     */
    private $tradeAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="state", type="smallint")
     */
    private $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="coins", type="integer")
     */
    private $coins;

    /**
     * @var boolean
     *
     * @ORM\Column(name="locked", type="boolean")
     */
    private $locked;


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
     * Set tradeId
     *
     * @param string $tradeId
     * @return UserTopup
     */
    public function setTradeId($tradeId)
    {
        $this->tradeId = $tradeId;

        return $this;
    }

    /**
     * Get tradeId
     *
     * @return string 
     */
    public function getTradeId()
    {
        return $this->tradeId;
    }

    /**
     * Set dollar
     *
     * @param string $dollar
     * @return UserTopup
     */
    public function setDollar($dollar)
    {
        $this->dollar = $dollar;

        return $this;
    }

    /**
     * Get dollar
     *
     * @return string 
     */
    public function getDollar()
    {
        return $this->dollar;
    }

    /**
     * Set tradeAt
     *
     * @param \DateTime $tradeAt
     * @return UserTopup
     */
    public function setTradeAt($tradeAt)
    {
        $this->tradeAt = $tradeAt;

        return $this;
    }

    /**
     * Get tradeAt
     *
     * @return \DateTime 
     */
    public function getTradeAt()
    {
        return $this->tradeAt;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return UserTopup
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
     * Set coins
     *
     * @param integer $coins
     * @return UserTopup
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
     * Set locked
     *
     * @param boolean $locked
     * @return UserTopup
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean 
     */
    public function getLocked()
    {
        return $this->locked;
    }
}
