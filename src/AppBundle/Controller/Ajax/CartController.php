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
     * @Route("/cartAjaxAction/{id}/{no}/{action}", name="cart_ajax_action")
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
            $cookies = $request->cookies;
            if ($cookies->has('cart')) {
                //cookie to array
                $cart = json_decode($cookies->get('cart'), true);

                switch ($action) {
                    case '+':
                        if (array_key_exists($id, $cart)) {
                            $cart[$id]++;
                        }
                        else {
                            $cart[$id] = 1;
                        }
                        break;

                    case '-':
                        if (array_key_exists($id, $cart) && $cart[$id] > 1) {
                            $cart[$id]--;
                        }
                        elseif (array_key_exists($id, $cart)) {
                            unset($cart[$id]);
                        }
                        else {
                            return new Response('fail');
                        }
                        break;

                    case 'edit':
                        # code...
                        if ($no <= 0) {
                            unset($cart[$id]);
                        }
                        else {
                            $cart[$id] = $no;
                        }
                        break;

                    case 'rm':
                        unset($cart[$id]);
                        break;
                    default:
                        # code...
                        break;
                }
                $response = new Response();
                $response->headers->setCookie(new Cookie('cart', json_encode($cart), time() + (3600*48)));
                $response->send();
                return new Response($cookies->get('cart'));
            }
            else {
                $cart = array(
                    $id => $no,
                    );
                $response = new Response('success');
                $response->headers->setCookie(new Cookie('cart', json_encode($cart), time() + (3600*48)));
                $response->send();
                return $response;
            }
        }
    }

    /**
     * @Route("/cartAjaxGetCart", name="cart_ajax_get")
     */
    public function getCartAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            //entity manager
            $em = $this->getDoctrine()->getManager();
            //user
            $user = $this->getUser();
            $cartProduct = $em->getRepository('AppBundle:CartProduct')->getUserCart($user->getId());
            if ($cartProduct) {
                $data = array();
                foreach ($cartProduct as $value) {
                    $product = $value->getProduct();
                    $data[$product->getId()] = array(
                        'id' => $product->getId(),
                        'name' => $product->getName(),
                        'count' => $value->getCount(),
                        'poster' => $product->getPoster(),
                        'price' => $product->getPrice(),
                        'price_discounted' => $product->getPriceDiscounted()
                        );
                }
                //exit(\Doctrine\Common\Util\Debug::dump($data));
                return new JsonResponse($data);
            }
            else {
                return new JsonResponse('none');
            }
        }
        else {
            $cookies = $request->cookies;
            if ($cookies->has('cart')) {
                //cookie to array
                $cart = json_decode($cookies->get('cart'), true);
                $em = $this->getDoctrine()->getManager();
                $products = $em->getRepository('AppBundle:Product')->findById(array_keys($cart));
                $data = array();
                foreach ($products as $value) {
                    $data[$value->getId()] = array(
                        'id' => $value->getId(),
                        'name' => $value->getName(),
                        'count' => $cart[$value->getId()],
                        'poster' => $value->getPoster(),
                        'price' => $value->getPrice(),
                        'price_discounted' => $value->getPriceDiscounted()
                        );
                }
                return new JsonResponse($data);
            }
            else {
                return new JsonResponse('none');
            }
        }
    }
}
