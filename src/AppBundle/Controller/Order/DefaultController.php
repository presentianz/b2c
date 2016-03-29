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
use AppBundle\Entity\UserInfo;
use AppBundle\Form\Type\ShipmentAddressFormType;

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
     * @Route("/orderConfirm", name="order_confirm", options={"expose"=true}))
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function orderConfirmAction(Request $request)
    {
        $id = $request->query->get('id');
        $type = $request->query->get('type');
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('AppBundle:UserOrder')->findOneByOrderId($id);
        if (!$order) {
            return $this->redirectToRoute('user_order');
        }
        if ($order->getStatus() != 0) {
            $this->redirectToRoute('user_order');
        }
        else {
            if ($type == 'online') {
                $check = $this->get('app.skip.checkout');
                $url = $check->checkout($order, $order->getTotalPrice()/* + $order->getPostFee()*/);

                if($url) {
                    //跳转支付
                    return $this->redirect($url);
                }
                else {
                    //出错了do something
                    return new Response('Error');
                }
            }
            else {
                return $this->render('Order/default/order_confirm.html.twig', array(
                    'data' => $order
                ));
            }
        }
    }

    /**
     * @Route("/checkout", name="checkout")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function checkoutAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $points=$this->getUser()->getUserInfo()->getPoints();
        $cartArray = $request->request->get('product-id');

        $products = $em->getRepository('AppBundle:CartProduct')->getItem($cartArray, $this->getUser()->getId());
        $form = $this->createForm(new ShipmentAddressFormType());
        return $this->render('Order/default/checkout.html.twig', array(
            'data' => $products,
            'points' => $points,
            'form' => $form->createView(),
            ));
    }

    /**
     * @Route("/payprocess", name="pay_process")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function payprocessAction(Request $request)
    {
        $result = $request->query->get('result');
        $check = $this->get('app.skip.checkout');
        $result = $check->processResponse($result);
        if ($result['success'] == 0) {
            return $this->redirectToRoute('pay_fail');
        }
        else {
            $em = $this->getDoctrine()->getManager();
            $order = $em->getRepository('AppBundle:UserOrder')->findOneByOrderId($result['id']);
            if (!$order) {
                return $this->redirectToRoute('user_order');
            }
            $order->setStatus(1);
            $order->setPaidAt(new \DateTime());
            $em->persist($order);
            $em->flush();
            return $this->redirectToRoute('pay_success', array(
                'orderId' => $result['id'],
                ));
        }
    }

    /**
     * @Route("/payfail", name="pay_fail")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function payfailAction(Request $request)
    {
        return $this->render('Order/default/payfail.html.twig');
    }

    /**
     * @Route("/paysuccess", name="pay_success")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function paysuccessAction(Request $request)
    {
        $orderId = $request->query->get('orderId');
        if (!$orderId) {
            return $this->redirectToRoute('user_order');
        }
        else {
            $em = $this->getDoctrine()->getManager();
            $order = $em->getRepository('AppBundle:UserOrder')->findOneByOrderId($orderId);
            if (!$order || $order->getStatus() == 0 || $order->getStatus() == 4)
                return $this->redirectToRoute('user_order');
        }
        return $this->render('Order/default/paysuccess.html.twig', array(
            'orderId' => $orderId,
            'status' => $order->getStatus()
            ));
    }
}
