<?php

namespace AppBundle\Controller\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormBuilder;
use AppBundle\Entity\ShipmentAddress;
use AppBundle\Form\Type\ShipmentAddressFormType;
use AppBundle\Entity\UserInfo;
use AppBundle\Entity\UserOrder;


/**
 * @Route("/account")
 * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
 */

class OrderController extends Controller
{
    /**
     * @Route("/order", name="user_order")
     */
    public function indexAction(Request $request)
    {
    	  $type=$request->query->get('type',"1");
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('AppBundle:UserOrder')->findByUser($this->getUser()->getId());
        return $this->render('User/order/index.html.twig', array(
            'data' => $orders,
            "type" => $type
            ));
    }

    /**
     * @Route("/order/detail/{id}", name="user_order_detail")
     */
    // public function detailAction($id)
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $order = $em->getRepository('AppBundle:UserOrder')->findOneById($id);
    //     return $this->render('User/order/detail.html.twig', array(
    //         "data" => $order
    //         ));
    // }
}
