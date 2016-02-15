<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserInfo
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
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
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=true)
     */
    private $full_name;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="exp", type="integer", options={"unsigned":true})
     */
    private $exp = "0";

    /**
     * @var string
     *
     * @ORM\Column(name="balance", type="decimal", precision=8, scale=2)
     */
    private $balance = "0";

    /**
     * @var string
     *
     * @ORM\Column(name="locked_balance", type="decimal", precision=8, scale=2)
     */
    private $lockedBalance = "0";

    /**
     * @var string
     *
     * @ORM\Column(name="contact_no", type="string", length=255, nullable=true)
     */
    private $contactNo;

    /**
     * @var string
     *
     * @ORM\Column(name="wechat_no", type="string", length=255, nullable=true)
     */
    private $wechatNo;

    /**
     * @var string
     *
     * @ORM\Column(name="qq_no", type="string", length=255, nullable=true)
     */
    private $qqNo;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="points", type="string", length=255, nullable=true)
     */
    private $points = "0";

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime")
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime")
     */
    private $updateAt;   

    
    /**
     * @var string
     *
     * @ORM\Column(name="brithday", type="string", length=255, nullable=true)
     */
    private $brithday;
    
    

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
     * Set fullName
     *
     * @param string $full_name
     * @return string
     */
    public function setFullName($full_name)
    {
    	$this->full_name = $full_name;
    
    	return $this;
    }
    
    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
    	return $this->full_name;
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
     * Set balance
     *
     * @param string $balance
     * @return UserInfo
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string 
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set lockedBalance
     *
     * @param string $lockedBalance
     * @return UserInfo
     */
    public function setLockedBalance($lockedBalance)
    {
        $this->lockedBalance = $lockedBalance;

        return $this;
    }

    /**
     * Get lockedBalance
     *
     * @return string 
     */
    public function getLockedBalance()
    {
        return $this->lockedBalance;
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

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return UserInfo
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /** 
     * @ORM\PrePersist
     */
    public function createAtPrePersist()
    {
        $this->createAt =  new \DateTime();
    }

    /** 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function UpdatePreUpdate()
    {
        $this->updateAt =  new \DateTime();
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @return UserInfo
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
     * Set points
     *
     * @param \string $points
     * @return UserInfo
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return \string 
     */
    public function getPoints()
    {
        return $this->points;
    }
    
        /**
     * Set birthday
     *
     * @param \string $points
     * @return UserInfo
     */
    public function setBrithday($brithday)
    {
        $this->brithday = $brithday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \string 
     */
    public function getBrithday()
    {
        return $this->brithday;
    }


}
