<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Product;

/**
* 
*/
class ProductClikcIncrement
{
    private $em;

    function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function clickIncrement(Product $product)
    {
        $product->setClick($product->getClick()+1);
        $this->em->persist($product);
        $this->em->flush();
    }
}