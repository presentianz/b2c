<?php

namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Product;


class ProductController extends Controller
{
    /**
     * @Route("/p/{id}", name="product", requirements={"id" : "\d+"})
     */
    public function indexAction(Product $product)
    {
        return $this->render('Product/product/index.html.twig', array(
        	'p' => $product,
        	));
    }
}
