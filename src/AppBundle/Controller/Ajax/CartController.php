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
     * @Route("/cartAjaxAction", name="cart_ajax_action", condition="request.isXmlHttpRequest()")
     */
    public function indexAction(Request $request)
    {
        $id = $this->container->get('request')->get('id');
        $no = $this->container->get('request')->get('no');
        $action = $this->container->get('request')->get('action');
        $return = array('granted' => true);
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

            if ($product) {
                switch ($action) {
                    //add one
                    case '+':
                        if ($cartProduct == false) {
                            $cartProduct = new CartProduct();
                            $cartProduct->setProduct($product);
                            $cartProduct->setCount($no);
                            $cartProduct->setUser($user);
                        }
                        else {
                            $cartProduct->setCount($cartProduct->getCount() + $no);

                        }
                        $em->persist($cartProduct);
                        $em->flush();
                        break;
                    case 'number':
                        if ($cartProduct == false) {
                            $cartProduct = new CartProduct();
                            $cartProduct->setProduct($product);
                            $cartProduct->setCount($no);
                            $cartProduct->setUser($user);
                        } 
                        else {
                        $cartProduct->setCount($no);
                        } 
                        $em->persist($cartProduct);
                        $em->flush();
                        break;
                    //delete one
                    case '-':
                        if ($cartProduct && $cartProduct->getCount() > 1) {
                            $cartProduct->setCount($cartProduct->getCount() - 1);
                            $em->persist($cartProduct);
                            $em->flush();
                        }
                        // elseif ($cartProduct && $cartProduct->getCount() < 1) {
                        //     $cartProduct->setCount(0);
                        //     $em->persist($cartProduct);
                        //     $em->flush();
                        // }
                        elseif ($cartProduct) {
                             $return['granted'] = false;
                        }
                        else {
                            $return['granted'] = false;
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
                        break;
                    //remove
                    case 'rm':
                        if ($cartProduct) {
                            $em->remove($cartProduct);
                            $em->flush();
                        }
                        else {
                            $return['granted'] = false;
                        }
                        break;

                    default:
                        $return['granted'] = false;
                        break;
                }

            }
            else {
                $return['granted'] = false;
            }
            return new Response(json_encode($return));
        }

        //anonymous user
        else {
            $cookies = $request->cookies;
            $response = new Response();
            if ($cookies->has('cart')) {
                //cookie to array
                $cart = json_decode($cookies->get('cart'), true);
                switch ($action) {
                    case '+':
                        if (array_key_exists($id, $cart)) {
                            $cart[$id]['count'] += $no;
                            $cart[$id]['addAt'] = new \DateTime();
                        }
                        else {
                            $cart[$id]['count'] = $no;
                            $cart[$id]['addAt'] = new \DateTime();
                        }
                        break;

                    case '-':
                        if (array_key_exists($id, $cart) && $cart[$id] > 1) {
                            $cart[$id]['count']--;
                            $cart[$id]['addAt'] = new \DateTime();
                        }
                        elseif (array_key_exists($id, $cart)) {
                            unset($cart[$id]);
                        }
                        else {
                            $return['granted'] == false;
                        }
                        break;

                    case 'edit':
                        # code...
                        if ($no <= 0) {
                            unset($cart[$id]);
                        }
                        else {
                            $cart[$id]['count'] = $no;
                            $cart[$id]['addAt'] = new \DateTime();
                        }
                        break;

                    case 'rm':
                        unset($cart[$id]);
                        break;
                    default:
                        $return['granted'] == false;
                        break;
                }
                if (count($cart) <= 0) {
                    $response->headers->clearCookie('cart');
                }
                else {
                    $response->headers->setCookie(new Cookie('cart', json_encode($cart), time() + (3600*48)));
                }
                $response->send();
            }
            else {
                if ($action == '+') {
                    $cart = array(
                        $id => array(
                            'count' => $no,
                            'addAt' => new \DateTime(),
                            )
                        );
                }
                elseif ($action == 'edit') {
                    $cart = array(
                        $id => array(
                            'count' => $no,
                            'addAt' => new \DateTime(),
                            )
                        );
                }
                else {
                    $return['granted'] == false;
                }
                $response->headers->setCookie(new Cookie('cart', json_encode($cart), time() + (3600*48)));
                $response->send();
            }
            return new Response(json_encode($return));
        }
    }

    /**
     * @Route("/cartAjaxGet", name="cart_ajax_get")
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
                        'count' => $cart[$value->getId()]['count'],
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
