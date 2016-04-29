<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="IDX_D34A04AD12469DE2", columns={"category_id"})})
 * @ORM\Entity
 */
class Product
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="price_discounted", type="decimal", precision=8, scale=2, nullable=false)
     */
    private $priceDiscounted;

    /**
     * @var integer
     *
     * @ORM\Column(name="viewed_count", type="integer", nullable=false)
     */
    private $viewedCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="sold_no", type="integer", nullable=false)
     */
    private $soldNo;

    /**
     * @var integer
     *
     * @ORM\Column(name="inventory", type="integer", nullable=false)
     */
    private $inventory;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint", nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateAt", type="datetime", nullable=false)
     */
    private $updateat;

    /**
     * @var string
     *
     * @ORM\Column(name="poster", type="string", length=255, nullable=true)
     */
    private $poster;

    /**
     * @var string
     *
     * @ORM\Column(name="image_link", type="string", length=255, nullable=false)
     */
    private $imageLink;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255, nullable=true)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=255, nullable=true)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="product_key", type="string", length=255, nullable=true)
     */
    private $productKey;

    /**
     * @var integer
     *
     * @ORM\Column(name="click", type="integer", nullable=false)
     */
    private $click;

    /**
     * @var integer
     *
     * @ORM\Column(name="index_widget", type="integer", nullable=true)
     */
    private $indexWidget;

    /**
     * @var integer
     *
     * @ORM\Column(name="widget_weight", type="integer", nullable=true)
     */
    private $widgetWeight;

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;



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
     * Set name
     *
     * @param string $name
     * @return Product
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
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceDiscounted
     *
     * @param string $priceDiscounted
     * @return Product
     */
    public function setPriceDiscounted($priceDiscounted)
    {
        $this->priceDiscounted = $priceDiscounted;

        return $this;
    }

    /**
     * Get priceDiscounted
     *
     * @return string 
     */
    public function getPriceDiscounted()
    {
        return $this->priceDiscounted;
    }

    /**
     * Set viewedCount
     *
     * @param integer $viewedCount
     * @return Product
     */
    public function setViewedCount($viewedCount)
    {
        $this->viewedCount = $viewedCount;

        return $this;
    }

    /**
     * Get viewedCount
     *
     * @return integer 
     */
    public function getViewedCount()
    {
        return $this->viewedCount;
    }

    /**
     * Set soldNo
     *
     * @param integer $soldNo
     * @return Product
     */
    public function setSoldNo($soldNo)
    {
        $this->soldNo = $soldNo;

        return $this;
    }

    /**
     * Get soldNo
     *
     * @return integer 
     */
    public function getSoldNo()
    {
        return $this->soldNo;
    }

    /**
     * Set inventory
     *
     * @param integer $inventory
     * @return Product
     */
    public function setInventory($inventory)
    {
        $this->inventory = $inventory;

        return $this;
    }

    /**
     * Get inventory
     *
     * @return integer 
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Product
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set updateat
     *
     * @param \DateTime $updateat
     * @return Product
     */
    public function setUpdateat($updateat)
    {
        $this->updateat = $updateat;

        return $this;
    }

    /**
     * Get updateat
     *
     * @return \DateTime 
     */
    public function getUpdateat()
    {
        return $this->updateat;
    }

    /**
     * Set poster
     *
     * @param string $poster
     * @return Product
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return string 
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set imageLink
     *
     * @param string $imageLink
     * @return Product
     */
    public function setImageLink($imageLink)
    {
        $this->imageLink = $imageLink;

        return $this;
    }

    /**
     * Get imageLink
     *
     * @return string 
     */
    public function getImageLink()
    {
        return $this->imageLink;
    }

    /**
     * Set brand
     *
     * @param string $brand
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set weight
     *
     * @param string $weight
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set productKey
     *
     * @param string $productKey
     * @return Product
     */
    public function setProductKey($productKey)
    {
        $this->productKey = $productKey;

        return $this;
    }

    /**
     * Get productKey
     *
     * @return string 
     */
    public function getProductKey()
    {
        return $this->productKey;
    }

    /**
     * Set click
     *
     * @param integer $click
     * @return Product
     */
    public function setClick($click)
    {
        $this->click = $click;

        return $this;
    }

    /**
     * Get click
     *
     * @return integer 
     */
    public function getClick()
    {
        return $this->click;
    }

    /**
     * Set indexWidget
     *
     * @param integer $indexWidget
     * @return Product
     */
    public function setIndexWidget($indexWidget)
    {
        $this->indexWidget = $indexWidget;

        return $this;
    }

    /**
     * Get indexWidget
     *
     * @return integer 
     */
    public function getIndexWidget()
    {
        return $this->indexWidget;
    }

    /**
     * Set widgetWeight
     *
     * @param integer $widgetWeight
     * @return Product
     */
    public function setWidgetWeight($widgetWeight)
    {
        $this->widgetWeight = $widgetWeight;

        return $this;
    }

    /**
     * Get widgetWeight
     *
     * @return integer 
     */
    public function getWidgetWeight()
    {
        return $this->widgetWeight;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
