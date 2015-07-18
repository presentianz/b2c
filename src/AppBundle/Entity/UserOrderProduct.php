<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserOrderProduct
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserOrderProductRepository")
 */
class UserOrderProduct
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
     * @var integer
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;


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
     * @return UserOrderProduct
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
     * @return UserOrderProduct
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
     * Set count
     *
     * @param integer $count
     * @return UserOrderProduct
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
}
