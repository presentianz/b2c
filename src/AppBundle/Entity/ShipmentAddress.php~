<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShipmentAddress
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ShipmentAddress
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
     * @var string
     *
     * @ORM\Column(name="address", type="text")
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="post_code", type="string", length=255)
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
     * @ORM\Column(name="contact_no", type="string", length=255)
     */
    private $contactNo;

    /**
     * @var string
     *
     * @ORM\Column(name="id_no", type="string", length=255)
     */
    private $idNo;

    /**
     * @var array
     *
     * @ORM\Column(name="id_scans", type="array")
     */
    private $idScans;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="shipmentAddresses")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;

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
     * @return ShipmentAddress
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
     * @return ShipmentAddress
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
     * @return ShipmentAddress
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
     * @param string $address
     * @return ShipmentAddress
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postCode
     *
     * @param string $postCode
     * @return ShipmentAddress
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
     * @return ShipmentAddress
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
     * @return ShipmentAddress
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
     * Set idNo
     *
     * @param string $idNo
     * @return ShipmentAddress
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

    /**
     * Set idScans
     *
     * @param array $idScans
     * @return ShipmentAddress
     */
    public function setIdScans($idScans)
    {
        $this->idScans = $idScans;

        return $this;
    }

    /**
     * Get idScans
     *
     * @return array 
     */
    public function getIdScans()
    {
        return $this->idScans;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return ShipmentAddress
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
}
