<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="config")
 * @ORM\Entity
 */
class Config
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")    
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="cfgvalue", type="text")
     */
    private $cfgvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="remark", type="text")
     */
    private $remark;

    


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
<<<<<<< HEAD
    
        /**
     * Set id
     *
     * @param \string $id
     * @return string
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set title
     *
     * @param \string $title
     * @return string
=======

    /**
     * Set commentAt
     *
     * @param \DateTime $commentAt
     * @return Comment
>>>>>>> remotes/b2c/master
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
<<<<<<< HEAD
     * Get title
     *
     * @return string 
=======
     * Get commentAt
     *
     * @return \DateTime 
>>>>>>> remotes/b2c/master
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
<<<<<<< HEAD
     * Set cfgvalue
     *
     * @param string $cfgvalue
     * @return string
=======
     * Set star
     *
     * @param integer $star
     * @return Comment
>>>>>>> remotes/b2c/master
     */
    public function setCfgvalue($cfgvalue)
    {
        $this->cfgvalue = $cfgvalue;

        return $this;
    }

    /**
<<<<<<< HEAD
     * Get cfgvalue
     *
     * @return string 
=======
     * Get star
     *
     * @return integer 
>>>>>>> remotes/b2c/master
     */
    public function getCfgvalue()
    {
        return $this->cfgvalue;
    }

    /**
<<<<<<< HEAD
     * Set remark
     *
     * @param string $remark
     * @return string
=======
     * Set text
     *
     * @param string $text
     * @return Comment
>>>>>>> remotes/b2c/master
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
<<<<<<< HEAD
     * Get remark
=======
     * Get text
>>>>>>> remotes/b2c/master
     *
     * @return string 
     */
    public function getRemark()
    {
        return $this->remark;
    }

    
}
