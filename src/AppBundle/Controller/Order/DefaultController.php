<?php

namespace AppBundle\Controller\Order;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

use AppBundle\Entity\CartProduct;

class DefaultController extends Controller
{
    /**
     * @Route("/cart", name="cart", options={"expose"=true})
     */
    public function cartAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $cartProducts = $em->getRepository('AppBundle:CartProduct')->findByUser($user->getId());
        }
        else {
            $cookies = $request->cookies;
            if ($cookies->has('cart')) {
                $cartArray = json_decode($cookies->get('cart'), true);
                $em = $this->getDoctrine()->getManager();
                $products = $em->getRepository('AppBundle:Product')->findById(array_keys($cartArray));
                $cartProducts = array();
                foreach ($products as $value) {
                    $cartProduct = new CartProduct();
                    $cartProduct->setProduct($value);
                    $cartProduct->setCount($cartArray[$value->getId()]['count']);
                    $cartProduct->setAddAt($cartArray[$value->getId()]['addAt']);
                    array_push($cartProducts, $cartProduct);
                }
            }
            else {
                $cartProducts = '';
            }
        }
        return $this->render('Order/default/cart.html.twig', array(
            'data' => $cartProducts
            ));
    }

    /**
     * @Route("/orderConfirm", name="order_confirm")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function orderConfirmAction(Request $request)
    {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('AppBundle:UserOrder')->findOneById($id);
        
        return $this->render('Order/default/order_confirm.html.twig', array(
            'data' => $order
            ));
    }



    /**
     * @Route("/checkout", name="checkout")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function checkoutAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cartArray = $request->request->get('product-id');
        $products = $em->getRepository('AppBundle:CartProduct')->getItem($cartArray, $this->getUser()->getId());
        return $this->render('Order/default/checkout.html.twig', array(
            'data' => $products
            ));
    }
}
