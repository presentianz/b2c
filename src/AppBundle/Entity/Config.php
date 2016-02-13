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

    /**
     * Set commentAt
     *
     * @param \DateTime $commentAt
     * @return Comment
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get commentAt
     *
     * @return \DateTime 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set star
     *
     * @param integer $star
     * @return Comment
     */
    public function setCfgvalue($cfgvalue)
    {
        $this->cfgvalue = $cfgvalue;

        return $this;
    }

    /**
     * Get star
     *
     * @return integer 
     */
    public function getCfgvalue()
    {
        return $this->cfgvalue;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Comment
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getRemark()
    {
        return $this->remark;
    }

    
}
