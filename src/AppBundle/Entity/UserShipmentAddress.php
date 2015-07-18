<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserShipmentAddress
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserShipmentAddressRepository")
 */
class UserShipmentAddress
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
     * @ORM\Column(name="addressLine", type="array")
     */
    private $addressLine;

    /**
     * @var string
     *
     * @ORM\Column(name="postCode", type="string", length=255)
     */
    private $postCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

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
     * @ORM\Column(name="idNo", type="string", length=255)
     */
    private $idNo;


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
     * Set country
     *
     * @param string $country
     * @return UserShipmentAddress
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
     * @return UserShipmentAddress
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
     * @return UserShipmentAddress
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
     * Set addressLine
     *
     * @param array $addressLine
     * @return UserShipmentAddress
     */
    public function setAddressLine($addressLine)
    {
        $this->addressLine = $addressLine;

        return $this;
    }

    /**
     * Get addressLine
     *
     * @return array 
     */
    public function getAddressLine()
    {
        return $this->addressLine;
    }

    /**
     * Set postCode
     *
     * @param string $postCode
     * @return UserShipmentAddress
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
     * Set name
     *
     * @param string $name
     * @return UserShipmentAddress
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set contactNo
     *
     * @param string $contactNo
     * @return UserShipmentAddress
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
     * @return UserShipmentAddress
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
     * @return UserShipmentAddress
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
     * Set idNo
     *
     * @param string $idNo
     * @return UserShipmentAddress
     */
    public function setIdNo($idNo)
    {
        $this->idNo = $idNo;

        return $this;
    }

    /**
     * Get idNo
     *
     * @return string 
     */
    public function getIdNo()
    {
        return $this->idNo;
    }
}
