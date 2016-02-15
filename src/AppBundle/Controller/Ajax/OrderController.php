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
    		$user = $this->getUser();
    		$em = $this->getDoctrine()->getManager();  
    	 	$id="1";
    	 	$points=$_REQUEST["points"];
    	  $pointsprice = $em->getRepository('AppBundle:Config')->findOneById($id)->getCfgvalue();
    	  $mpoints=$user->getUserInfo()->getPoints();
    	  if($points > $mpoints )
        {
        	 $return = array('granted' => false, 'msg' => "积分不足");
        	 return new Response(json_encode($return));
        	}
        $pointssum=$points*$pointsprice;
        $id = $request->query->get('id');
        $id = explode(' ', $id);
             
        
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
            if($order->getTotalPrice()<=$pointssum)
            {
            	
            	$id=intval($_REQUEST["address"]);
    	  			$address = $this->getDoctrine()
        											->getRepository('AppBundle:ShipmentAddress')
        											->find($id);            	
            	$order->setShipmentAddress($address);
            	$order->setPostFee($order->getTotalPrice());
            	$member=$user->getUserInfo();
            	$member->setPoints($member->getPoints()-$points);
            	$em->persist($member);
            	$em->flush();
            	$return = array('granted' => false, 'msg' => "使用积分支付完成");
            	return new Response(json_encode($return));
            	}
             else
             {
             	$order->setPostFee($pointssum);
             	}
            $em->persist($order);
            foreach ($cartProducts as $cartProduct) {
                $em->remove($cartProduct);
            }
            $em->flush();
            $return = array('granted' => true, 'id' => $order->getId());
        }
        else {
            $return = array('granted' => false,"msg"=>$id);
        }
        return new Response(json_encode($return));
    }
    
    /**
     * @Route("/orderGenerationPointsPayAjax", name="order_generationpointspay", condition="request.isXmlHttpRequest()")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function orderGenerationPointsPayAction(Request $request)
    {   
    		
    		$user = $this->getUser();
    		$em = $this->getDoctrine()->getManager();
    	 	$id="1";
    	 	$points=$_REQUEST["points"];    	 	
    	 	$sql="select p from AppBundle:Config p where p.id=1";
    		$query=$em->createQuery($sql);
    		$data=$query->getSingleResult();
    		$cfgvalue=$data->getCfgvalue();
    	  $pointsprice = $cfgvalue;
    	  $mpoints=$user->getUserInfo()->getPoints();
    	  if($points > $mpoints )
        {
        	 $return = array('granted' => false, 'msg' => iconv('GB2312', 'UTF-8', "积分不足"));
        	 return new Response(json_encode($return));
        	}
        $pointssum=$points*$pointsprice;
        //$id = $request->query->get('id');
        //$id = explode(' ', $id);
        $cartProducts = $em->getRepository('AppBundle:CartProduct')->getUserCart($user->getId());
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
            $weight=0;
            foreach ($cartProducts as $value) {
                $orderProduct = new OrderProduct();
                $orderProduct->setCount($value->getCount());
                $product = $value->getProduct();
                $orderProduct->setPrice($product->getPriceDiscounted());
                $orderProduct->setProduct($product);
                $orderProduct->setUserOrder($order);
                $em->persist($orderProduct);
                $order->addOrderProduct($orderProduct);
                $weight = $weight + $value->getCount()*$value->getProduct()->getWeight();
                $order->setTotalPrice($order->getTotalPrice()+$value->getCount()*$product->getPriceDiscounted());
            }
            $weight=round($weight/1000,2);
            $post=round((ceil($weight/5)*0.2+$weight)*8,2);
            $order->setPostFee($post);
            $sum=$order->getTotalPrice()+$order->getPostFee();
            if($sum<=$pointssum)
            {  
            	$id=intval($_REQUEST["address"]);
    	  			$address = $this->getDoctrine()
        											->getRepository('AppBundle:ShipmentAddress')
        											->find($id);            	
            	$order->setShipmentAddress($address);
            	//$order->setPaidAt(date("Y-m-d H:i:s",time()));        	
            	$order->setStatus(1);
            	$member=$user->getUserInfo();
            	$member->setPoints($member->getPoints()-$points);
            	$em->persist($member);
            	foreach ($cartProducts as $cartProduct) {
                $em->remove($cartProduct);
            }
            	$em->flush();
            	$return = array('granted' => true, 'msg' => iconv('GB2312', 'UTF-8', "使用积分支付完成"));
            	}
             else
             {
             	
            $return = array('granted' => false,"msg"=> iconv('GB2312', 'UTF-8', "提交订单失败".$weight."   ".$sum."  ".$post));
             	}
            
        }
        else {
            $return = array('granted' => false,"msg"=> iconv('GB2312', 'UTF-8', "购物车是空的"));
        }
        return new Response(json_encode($return));
    }
}