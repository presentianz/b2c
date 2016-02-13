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
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set cfgvalue
     *
     * @param string $cfgvalue
     * @return string
     */
    public function setCfgvalue($cfgvalue)
    {
        $this->cfgvalue = $cfgvalue;

        return $this;
    }

    /**
     * Get cfgvalue
     *
     * @return string 
     */
    public function getCfgvalue()
    {
        return $this->cfgvalue;
    }

    /**
     * Set remark
     *
     * @param string $remark
     * @return string
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get remark
     *
     * @return string 
     */
    public function getRemark()
    {
        return $this->remark;
    }

    
}
