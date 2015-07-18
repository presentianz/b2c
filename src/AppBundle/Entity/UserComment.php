<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserComment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserCommentRepository")
 */
class UserComment
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
     * @var \DateTime
     *
     * @ORM\Column(name="commentAt", type="datetime")
     */
    private $commentAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="star", type="smallint")
     */
    private $star;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;


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
     * @return UserComment
     */
    public function setCommentAt($commentAt)
    {
        $this->commentAt = $commentAt;

        return $this;
    }

    /**
     * Get commentAt
     *
     * @return \DateTime 
     */
    public function getCommentAt()
    {
        return $this->commentAt;
    }

    /**
     * Set star
     *
     * @param integer $star
     * @return UserComment
     */
    public function setStar($star)
    {
        $this->star = $star;

        return $this;
    }

    /**
     * Get star
     *
     * @return integer 
     */
    public function getStar()
    {
        return $this->star;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return UserComment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }
}
