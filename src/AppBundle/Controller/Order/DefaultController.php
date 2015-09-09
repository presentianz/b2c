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
     * @Route("/cart", name="cart")
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
                $cartProducts = 'empty';
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
        $cookies = $request->cookies;
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if ($cookies->has('cart')) {
            $cartArray = json_decode($cookies->get('cart'), true);
            $cartProducts = $em->getRepository('AppBundle:CartProduct')->findByUser($user->getId());
            foreach ($cartProducts as $value) {
                $product = $value->getProduct();
                if (array_key_exists($product->getId(), $cartArray)) {
                    $value->setCount($value->getCount()+$cartArray[$product->getId()]['count']);
                    $value->setAddAt(new \DateTime());
                    $em->persist($value);
                    unset($cartArray[$product->getId()]);
                }
            }
            if (count($cartArray) > 0) {
                foreach ($cartArray as $key => $value) {
                    $cartProduct = new CartProduct();
                    $product = $em->getRepository('AppBundle:Product')->find($key);
                    $cartProduct->setProduct($product);
                    $cartProduct->setCount($value['count']);
                    $cartProduct->setUser($user);
                    $em->persist($cartProduct);
                    unset($cartArray[$key]);
                }
                $em->flush();
            }
            $response = new Response();
            $response->headers->clearCookie('cart');
            $response->send();
        }
        $cartProducts = $em->getRepository('AppBundle:CartProduct')->findByUser($user->getId());
        return $this->render('Order/default/order_confirm.html.twig', array(
            'data' => $cartProducts
            ));
    }



    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkoutAction()
    {
        return $this->render('Order/default/checkout.html.twig');
    }
}
