<?php

namespace AppBundle\Controller\Order;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    /**
     * @Route("/cart", name="cart")
     */
    public function cartAction()
    {
        return $this->render('Order/default/cart.html.twig');
    }

    /**
     * @Route("/checkout", name="checkout")
     */
    public function indexAction()
    {
        return $this->render('Order/default/checkout.html.twig');
    }
}
