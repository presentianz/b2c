<?php

namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ProductController extends Controller
{
    /**
     * @Route("/p/{id}", name="product", requirements={"id" : "\d+"})
     */
    public function indexAction($id)
    {
        return $this->render('Product/product/index.html.twig', array(
        	'product_id' => $id,
        	));
    }
}
