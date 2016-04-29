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
     * @ORM\Column(name="title", type="text", nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="cfgvalue", type="text", nullable=false)
     */
    private $cfgvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="remark", type="text", nullable=false)
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
     * Set title
     *
     * @param string $title
     * @return Config
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
     * @return Config
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
     * @return Config
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
