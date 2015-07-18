<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserInfo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserInfoRepository")
 */
class UserInfo
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
     * @ORM\Column(name="exp", type="integer")
     */
    private $exp;

    /**
     * @var integer
     *
     * @ORM\Column(name="coins", type="integer")
     */
    private $coins;

    /**
     * @var integer
     *
     * @ORM\Column(name="lockedCoins", type="integer")
     */
    private $lockedCoins;

    /**
     * @var string
     *
     * @ORM\Column(name="contactNo", type="string", length=255)
     */
    private $contactNo;

    /**
     * @var string
     *
     * @ORM\Column(name="wechatNo", type="string", length=255)
     */
    private $wechatNo;

    /**
     * @var string
     *
     * @ORM\Column(name="qqNo", type="string", length=255)
     */
    private $qqNo;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var array
     *
     * @ORM\Column(name="address", type="array")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postCode", type="string", length=255)
     */
    private $postCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateAt", type="datetime")
     */
    private $updateAt;


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
     * Set exp
     *
     * @param integer $exp
     * @return UserInfo
     */
    public function setExp($exp)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Get exp
     *
     * @return integer 
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * Set coins
     *
     * @param integer $coins
     * @return UserInfo
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
     * Set lockedCoins
     *
     * @param integer $lockedCoins
     * @return UserInfo
     */
    public function setLockedCoins($lockedCoins)
    {
        $this->lockedCoins = $lockedCoins;

        return $this;
    }

    /**
     * Get lockedCoins
     *
     * @return integer 
     */
    public function getLockedCoins()
    {
        return $this->lockedCoins;
    }

    /**
     * Set contactNo
     *
     * @param string $contactNo
     * @return UserInfo
     */
    public function setContactNo($contactNo)
    {
        $this->contactNo = $contactNo;

        return $this;
    }

    /**
     * Get contactNo
     *
     * @return string 
     */
    public function getContactNo()
    {
        return $this->contactNo;
    }

    /**
     * Set wechatNo
     *
     * @param string $wechatNo
     * @return UserInfo
     */
    public function setWechatNo($wechatNo)
    {
        $this->wechatNo = $wechatNo;

        return $this;
    }

    /**
     * Get wechatNo
     *
     * @return string 
     */
    public function getWechatNo()
    {
        return $this->wechatNo;
    }

    /**
     * Set qqNo
     *
     * @param string $qqNo
     * @return UserInfo
     */
    public function setQqNo($qqNo)
    {
        $this->qqNo = $qqNo;

        return $this;
    }

    /**
     * Get qqNo
     *
     * @return string 
     */
    public function getQqNo()
    {
        return $this->qqNo;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return UserInfo
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return UserInfo
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return UserInfo
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set address
     *
     * @param array $address
     * @return UserInfo
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return array 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postCode
     *
     * @param string $postCode
     * @return UserInfo
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return string 
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return UserInfo
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }
}
