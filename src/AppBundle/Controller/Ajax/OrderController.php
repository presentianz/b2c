<?php

namespace AppBundle\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\OrderProduct;
use AppBundle\Entity\UserOrder;

class OrderController extends Controller
{
	/**
	 * @Route("/orderGenerationAjax", name="order_generation")
	 * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
	 */
	public function orderGenerationAction()
	{
		$id = array(3);
		$em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $cartProducts = $em->getRepository('AppBundle:CartProduct')->getItem($id, $user->getId());
        if ($cartProducts) {
        	$order = new UserOrder();
	        $order->setUser($user);
	        $order->setStatus(0);
	        $order->setTotalPrice(0);
	        //generate orderid
	        $uid = $user->getId();
	        $time_order=time();
	        list($usec, $sec)=explode(" ", microtime());
	        $orderid=date('ymdHis',$sec).$uid.ceil($usec*100);
	        $order->setOrderId($orderid);
	        foreach ($cartProducts as $value) {
	        	$orderProduct = new OrderProduct();
	        	$orderProduct->setCount($value->getCount());
	        	$product = $value->getProduct();
	        	$orderProduct->setPrice($product->getPriceDiscounted());
	        	$orderProduct->setProduct($product);
	        	$orderProduct->setUserOrder($order);
	        	$em->persist($orderProduct);
	        	$order->addOrderProduct($orderProduct);
	        	$order->setTotalPrice($order->getTotalPrice()+$value->getCount()*$product->getPriceDiscounted());
	        }
	        $em->persist($order);
	        foreach ($cartProducts as $cartProduct) {
	        	$em->remove($cartProduct);
	        }
	        $em->flush();
	        exit(\Doctrine\Common\Util\Debug::dump($order));
        }
        else {
        	return new Response('No products in cart found');
        }
	}
}