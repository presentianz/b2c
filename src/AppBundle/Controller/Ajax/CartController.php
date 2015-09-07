<?php

namespace AppBundle\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

use AppBundle\Entity\CartProduct;


class CartController extends Controller
{
    /**
     * @Route("/cartAjax/{id}/{no}/{action}", name="cart_ajax")
     */
    public function indexAction($id, $no, $action, Request $request)
    {
        //check if user logged in
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            //entity manager
            $em = $this->getDoctrine()->getManager();
            //user
            $user = $this->getUser();
            //request
            //$get_request = $this->container->get('request');
            //product
            //$product_id = $get_request('id');
            $product = $em->getRepository('AppBundle:Product')->find($id);
            //product count
            //$product_no = $get_request('no');
            //action
            //$action = $get_request('action');
            $cartProduct = $em->getRepository('AppBundle:CartProduct')->hasItem($id, $user->getId());

            switch ($action) {
                //add one
                case '+':
                    if ($cartProduct === false) {
                        $cartProduct = new CartProduct();
                        $cartProduct->setProduct($product);
                        $cartProduct->setCount(1);
                        $cartProduct->setUser($user);
                    }
                    else {
                        $cartProduct->setCount($cartProduct->getCount() + 1);

                    }
                    $em->persist($cartProduct);
                    $em->flush();
                    return new Response('success');
                    break;
                //delete one
                case '-':
                    if ($cartProduct && $cartProduct->getCount() > 1) {
                        $cartProduct->setCount($cartProduct->getCount() - 1);
                        $em->persist($cartProduct);
                        $em->flush();
                        return new Response('success');
                    }
                    elseif ($cartProduct) {
                        return new Response('<= 1');
                    }
                    else {
                        return new Response('fail');
                    }
                    break;
                //edit or insert
                case 'edit':
                    if ($cartProduct) {
                        $cartProduct->setCount($no);
                        $em->persist($cartProduct);
                    }
                    else {
                        $cartProduct = new CartProduct();
                        $cartProduct->setProduct($product);
                        $cartProduct->setCount($no);
                        $cartProduct->setUser($user);
                    }
                    $em->persist($cartProduct);
                    $em->flush();
                    return new Response('success');
                    break;
                //remove
                case 'rm':
                    if ($cartProduct) {
                        $em->remove($cartProduct);
                        $em->flush();
                        return new Response('success');
                    }
                    else {
                        return new Response('fail');
                    }
                    break;

                default:
                    return new Response('fail');
                    break;
            }
        }
        else {
            $serializer = $this->get('serializer');
            $cookies = $request->cookies;
            if ($cookies->has('cart')) {
                
                $cart = json_decode($cookies->get('cart'), true);
                //exit(\Doctrine\Common\Util\Debug::dump($cart));
                $response = new Response();
                $response->headers->clearCookie('cart');
                $response->send();
                return new Response($cookies->get('cart'));
            }
            else {
                $cart = array(
                    $id => $no,
                    );
                $response = new Response('success');
                $response->headers->setCookie(new Cookie('cart', json_encode($cart), time() + (3600*48)));
                //$response->send();
                return $response;
            }
        }
    }
}
