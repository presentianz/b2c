<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * ShipmentAddress
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(name="phone_no", type="string", length=255)
     */
    private $phoneNo;

    /**
     * @var string
     *
     * @ORM\Column(name="id_no", type="string", length=255)
     */
    private $idNo;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
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
     * @Assert\File(maxSize="6000000")
     */
    private $img1;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $img2;


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="shipmentAddresses")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="UserOrder", mappedBy="shipmentAddress")
     **/
    private $userOrders;

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
     * Set commet
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


    private $temp1;

    private $temp2;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setImg1(UploadedFile $img1 = null)
    {
        $this->img1 = $img1;
        // check if we have an old image path
        if (isset($this->idFront)) {
            // store the old name to delete after the update
            $this->temp1 = $this->idFront;
            $this->idFront = null;
        } else {
            $this->idFront = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getImg1()
    {
        return $this->img1;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setImg2(UploadedFile $img2 = null)
    {
        $this->img2 = $img2;
        // check if we have an old image path
        if (isset($this->idFront)) {
            // store the old name to delete after the update
            $this->temp2 = $this->idBack;
            $this->idBack = null;
        } else {
            $this->idBack = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getImg2()
    {
        return $this->img2;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getImg1()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->idFront = $filename.'.'.$this->getImg1()->guessExtension();
        }

        if (null !== $this->getImg2()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->idBack = $filename.'.'.$this->getImg2()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null != $this->getImg1()) {
            // if there is an error when moving the file, an exception will
            // be automatically thrown by move(). This will properly prevent
            // the entity from being persisted to the database on error
            $this->getImg1()->move($this->getUploadRootDir(), $this->idFront);

            // check if we have an old image
            if (isset($this->temp1)) {
                // delete the old image
                unlink($this->getUploadRootDir().'/'.$this->temp1);
                // clear the temp image path
                $this->temp1 = null;
            }
            $this->img1 = null;
        }

        if (null != $this->getImg2()) {
            // if there is an error when moving the file, an exception will
            // be automatically thrown by move(). This will properly prevent
            // the entity from being persisted to the database on error
            $this->getImg2()->move($this->getUploadRootDir(), $this->idBack);

            // check if we have an old image
            if (isset($this->temp2)) {
                // delete the old image
                unlink($this->getUploadRootDir().'/'.$this->temp2);
                // clear the temp image path
                $this->temp2 = null;
            }
            $this->img2 = null;
        }
    }


    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->temp1 = $this->getAbsolutePath()[0];
        $this->temp2 = $this->getAbsolutePath()[1];
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (isset($this->temp1)) {
            unlink($this->temp1);
        }
        if (isset($this->temp2)) {
            unlink($this->temp2);
        }
    }

    public function getAbsolutePath()
    {
        $path = array();
        if (null === $this->idFront)
            $path[0] = null;
        else
            $path[0] = $this->getUploadRootDir().'/'.$this->idFront;

        if (null === $this->idBack)
            $path[1] = null;
        else
            $path[1] = $this->getUploadRootDir().'/'.$this->idBack;

        return $path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'img/idScan';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userOrders = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add userOrders
     *
     * @param \AppBundle\Entity\UserOrder $userOrders
     * @return ShipmentAddress
     */
    public function addUserOrder(\AppBundle\Entity\UserOrder $userOrders)
    {
        $this->userOrders[] = $userOrders;

        return $this;
    }

    /**
     * Remove userOrders
     *
     * @param \AppBundle\Entity\UserOrder $userOrders
     */
    public function removeUserOrder(\AppBundle\Entity\UserOrder $userOrders)
    {
        $this->userOrders->removeElement($userOrders);
    }

    /**
     * Get userOrders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserOrders()
    {
        return $this->userOrders;
    }
}
