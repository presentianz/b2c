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
use AppBundle\Entity\Config;
use AppBundle\Entity\UserInfo;
use AppBundle\Entity\ShipmentAddress;

class OrderController extends Controller
{
    /**
     * @Route("/orderGenerationAjax", name="order_generation", condition="request.isXmlHttpRequest()")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function orderGenerationAction(Request $request)
    {
        $id = $request->query->get('id');
        $address_id = $request->query->get('address');
        $id = explode(' ', $id);
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $address = $em->getRepository('AppBundle:ShipmentAddress')->find($address_id);
        $cartProducts = $em->getRepository('AppBundle:CartProduct')->getItem($id, $user->getId());
        if ($cartProducts) {
            $order = new UserOrder();
            $order->setUser($user);
            $order->setShipmentAddress($address);
            $order->setStatus(0);
            $order->setTotalPrice(0);
            $total_weight = 0;
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
                $total_weight += $value->getCount()*$product->getWeight();
                $orderProduct->setPrice($product->getPriceDiscounted());
                $orderProduct->setProduct($product);
                $orderProduct->setUserOrder($order);
                $em->persist($orderProduct);
                $order->addOrderProduct($orderProduct);
                $order->setTotalPrice($order->getTotalPrice()+$value->getCount()*$product->getPriceDiscounted());
            }

            $total_weight = $this->ceiling($total_weight/1000, 0.01);
            $total_weight += $this->ceiling(0.2*($this->ceiling($total_weight/5, 1)), 0.01);
            $order->setPostFee(8*$total_weight);
            $em->persist($order);
            foreach ($cartProducts as $cartProduct) {
                $em->remove($cartProduct);
            }
            $em->flush();
            $return = array('granted' => true, 'id' => $order->getOrderId());
        }
        else {
            $return = array('granted' => false);
        }
        return new Response(json_encode($return));
    }
    
    /**
    * @Route("/delorder", name="order_delorder", condition="request.isXmlHttpRequest()")
    * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
    */
    public function deleteorder(Request $request)
    {
		$em = $this->getDoctrine()->getManager();  
	 	$id=$_REQUEST["id"];
        $pointsprice = $em->getRepository('AppBundle:UserOrder')->deleteorder($id);
        return new Response(json_encode(""));
	}


    private function ceiling($number, $significance)
    {
        return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
    }

}