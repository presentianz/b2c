<?php

namespace AppBundle\Controller\Widget;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;
use AppBundle\Entity\Product;
use AppBundle\Entity\CartProduct;

class CartController extends Controller
{
	/* miss * annotation
	 * @Route("/cartbody")
	 */
    public function indexAction()
    {
        $cartProducts = array();
        return $this->render('Widget/cart/index.html.twig', array(
            'data' => $cartProducts
            ));
    
    }

}
