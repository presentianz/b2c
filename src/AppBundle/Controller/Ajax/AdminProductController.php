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
    * @Route("/ajax_product_price", name="ajax_product_price")
    *
    */
    public function updatePriceAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $em = $this->getDoctrine()->getManager();  
            $id = $_REQUEST["id"];
            $price = $_REQUEST["price"];

            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.price = :price WHERE P.id = :id');
            $query->setParameter('price', $price);
            $query->setParameter('id', $id);
            $query->getResult(); 

            //ProductRepository
            //$pointsprice = $em->getRepository('AppBundle:Product')->deleteorder($id);
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
            $em = $this->getDoctrine()->getManager();  
            $id=$_REQUEST["id"];
            $priceDiscounted = $_REQUEST["priceDiscounted"];
            
            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.price_discounted = :priceDiscounted WHERE P.id = :id');
            $query->setParameter('priceDiscounted', $priceDiscounted);
            $query->setParameter('id', $id);
            $query->getResult();   
            //ProductRepository
            //$pointsprice = $em->getRepository('AppBundle:Product')->deleteorder($id);
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
            $em = $this->getDoctrine()->getManager();  
            $id=$_REQUEST["id"];
            $inventory = $_REQUEST["inventory"];
            
            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product P SET P.inventory = :inventory WHERE P.id = :id');
            $query->setParameter('inventory', $inventory);
            $query->setParameter('id', $id);
            $query->getResult();

            //ProductRepository
            //$pointsprice = $em->getRepository('AppBundle:Product')->deleteorder($id);
            return new Response(json_encode(array('success' => true, 'id' => $id, 'inventory' => $inventory)));
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
            //$em = $this->getDoctrine()->getManager();  
            $id=$_REQUEST["id"];
            $click = $_REQUEST["click"];

            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery('UPDATE AppBundle:Product O SET O.viewed_count = :click WHERE O.id = :id');
            $query->setParameter('click', $click);
            $query->setParameter('id', $id);
            $query->getResult();

            return new Response(json_encode(array('success' => true, 'id' => $id, 'click' => $click)));
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
            $em = $this->getDoctrine()->getManager();  
            $id=$_REQUEST["id"];
            $soldNo = $_REQUEST["soldNo"];
            
            //ProductRepository
            //$pointsprice = $em->getRepository('AppBundle:Product')->deleteorder($id);
            return new Response(json_encode(array('success' => true, 'id' => $id, 'soldNo' => $soldNo)));
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
            $em = $this->getDoctrine()->getManager();  
            $id=$_REQUEST["id"];
            $weight = $_REQUEST["weight"];
            
            //ProductRepository
            //$pointsprice = $em->getRepository('AppBundle:Product')->deleteorder($id);
            return new Response(json_encode(array('success' => true, 'id' => $id, 'weight' => $weight)));
        } else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    }
}
