<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShipmentAddress
 *
 * @ORM\Table(name="shipment_address", indexes={@ORM\Index(name="IDX_E6E66924A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class ShipmentAddress
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
     * @ORM\Column(name="country", type="string", length=255, nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=false)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="post_code", type="string", length=255, nullable=false)
     */
    private $postCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_no", type="string", length=255, nullable=true)
     */
    private $contactNo;

    /**
     * @var string
     *
     * @ORM\Column(name="id_no", type="string", length=255, nullable=true)
     */
    private $idNo;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_no", type="string", length=255, nullable=true)
     */
    private $phoneNo;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="id_front", type="string", length=255, nullable=true)
     */
    private $idFront;

    /**
     * @var string
     *
     * @ORM\Column(name="id_back", type="string", length=255, nullable=true)
     */
    private $idBack;

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
     * Set phoneNo
     *
     * @param string $phoneNo
     * @return ShipmentAddress
     */
    public function setPhoneNo($phoneNo)
    {
        $this->phoneNo = $phoneNo;

        return $this;
    }

    /**
     * Get phoneNo
     *
     * @return string 
     */
    public function getPhoneNo()
    {
        return $this->phoneNo;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return ShipmentAddress
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set idFront
     *
     * @param string $idFront
     * @return ShipmentAddress
     */
    public function setIdFront($idFront)
    {
        $this->idFront = $idFront;

        return $this;
    }

    /**
     * Get idFront
     *
     * @return string 
     */
    public function getIdFront()
    {
        return $this->idFront;
    }

    /**
     * Set idBack
     *
     * @param string $idBack
     * @return ShipmentAddress
     */
    public function setIdBack($idBack)
    {
        $this->idBack = $idBack;

        return $this;
    }

    /**
     * Get idBack
     *
     * @return string 
     */
    public function getIdBack()
    {
        return $this->idBack;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\FosUser $user
     * @return ShipmentAddress
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
}
