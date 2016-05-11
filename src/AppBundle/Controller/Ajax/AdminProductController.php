<?php

namespace AppBundle\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

use AppBundle\Entity\Product;


class AdminProductController extends Controller
{
    /**
    * @Route("/ajax_product_status", name="ajax_product_status")
    *
    */
    public function updateStatusAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $id = $_REQUEST["id"];
            $status = $_REQUEST["status"];

            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.status = :status WHERE P.id = :id');
            $query->setParameter('status', $status);
            $query->setParameter('id', $id);
            $query->getResult(); 

            return new Response(json_encode(array('success' => true, 'id' => $id, 'status' => $status)));
        } else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    } 

    /**
    * @Route("/ajax_product_price", name="ajax_product_price")
    *
    */
    public function updatePriceAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $id = $_REQUEST["id"];
            $price = $_REQUEST["price"];

            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.price = :price WHERE P.id = :id');
            $query->setParameter('price', $price);
            $query->setParameter('id', $id);
            $query->getResult(); 

            return new Response(json_encode(array('success' => true, 'id' => $id, 'price' => $price)));
        } else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    } 

    /**
    * @Route("/ajax_product_priceDiscounted", name="ajax_product_priceDiscounted")
    *
    */
    public function updatePriceDiscountedAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $id=$_REQUEST["id"];
            $priceDiscounted = $_REQUEST["priceDiscounted"];
            
            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.price_discounted = :priceDiscounted WHERE P.id = :id');
            $query->setParameter('priceDiscounted', $priceDiscounted);
            $query->setParameter('id', $id);
            $query->getResult();  

            return new Response(json_encode(array('success' => true, 'id' => $id, 'priceDiscounted' => $priceDiscounted)));
        } else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    } 

    /**
    * @Route("/ajax_product_inventory", name="ajax_product_inventory")
    *
    */
    public function updateInventoryAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $id=$_REQUEST["id"];
            $inventory = $_REQUEST["inventory"];
            
            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.inventory = :inventory WHERE P.id = :id');
            $query->setParameter('inventory', $inventory);
            $query->setParameter('id', $id);
            $query->getResult();

            return new Response(json_encode(array('success' => true, 'id' => $id, 'inventory' => $inventory)));
        } else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    } 

    /**
    * @Route("/ajax_product_viewed_count", name="ajax_product_viewed_count")
    *
    */
    public function updateViewedCountAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $id=$_REQUEST["id"];
            $viewed_count = $_REQUEST["viewed_count"];

            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.viewed_count = :viewed_count WHERE P.id = :id');
            $query->setParameter('viewed_count', $viewed_count);
            $query->setParameter('id', $id);
            $query->getResult();

            return new Response(json_encode(array('success' => true, 'id' => $id, 'viewed_count' => $viewed_count)));
        } else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    } 


    /**
    * @Route("/ajax_product_soldNo", name="ajax_product_soldNo")
    *
    */
    public function updateSoldNoAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $id=$_REQUEST["id"];
            $soldNo = $_REQUEST["soldNo"];
            
            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.sold_no = :soldNo WHERE P.id = :id');
            $query->setParameter('soldNo', $soldNo);
            $query->setParameter('id', $id);
            $query->getResult();

            return new Response(json_encode(array('success' => true, 'id' => $id, 'soldNo' => $soldNo)));
        } else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    } 


    /**
    * @Route("/ajax_product_widget_weight", name="ajax_product_widget_weight")
    *
    */
    public function updateWidgetWeightAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $id=$_REQUEST["id"];
            $widget_weight = $_REQUEST["widget_weight"];

            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.widget_weight = :widget_weight WHERE P.id = :id');
            $query->setParameter('widget_weight', $widget_weight);
            $query->setParameter('id', $id);
            $query->getResult();
            
            return new Response(json_encode(array('success' => true, 'id' => $id, 'widget_weight' => $widget_weight)));
        } else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    }

    /**
    * @Route("/ajax_product_weight", name="ajax_product_weight")
    *
    */
    public function updateWeightAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $id=$_REQUEST["id"];
            $weight = $_REQUEST["weight"];

            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.weight = :weight WHERE P.id = :id');
            $query->setParameter('weight', $weight);
            $query->setParameter('id', $id);
            $query->getResult();
            
            return new Response(json_encode(array('success' => true, 'id' => $id, 'weight' => $weight)));
        } else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    }

    /**
    * @Route("/ajax_product_productKey", name="ajax_product_productKey")
    *
    */
    public function updateProductKeyAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $id=$_REQUEST["id"];
            $productKey = $_REQUEST["productKey"];

            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.productKey = :productKey WHERE P.id = :id');
            $query->setParameter('productKey', $productKey);
            $query->setParameter('id', $id);
            $query->getResult();
            
            return new Response(json_encode(array('success' => true, 'id' => $id, 'productKey' => $productKey)));
        } else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    }

    /**
    * @Route("/ajax_product_click", name="ajax_product_click")
    *
    */
    public function updateClickAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $id=$_REQUEST["id"];
            $click = $_REQUEST["click"];

            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.click = :click WHERE P.id = :id');
            $query->setParameter('click', $click);
            $query->setParameter('id', $id);
            $query->getResult();
            
            return new Response(json_encode(array('success' => true, 'id' => $id, 'click' => $click)));
        } else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    }

}
