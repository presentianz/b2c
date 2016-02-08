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
     * @Route("/order/{type}", name="user_order", defaults={"type":0})
     */
    public function indexAction($type)
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('AppBundle:UserOrder')->findByType($this->getUser()->getId(), $type);
        return $this->render('User/order/index.html.twig', array(
            'data' => $orders,
            'type' => $type
            ));
    }


}
