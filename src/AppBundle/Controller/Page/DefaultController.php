<?php

namespace AppBundle\Controller\Page;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $data = array();
        return $this->render('Page/default/index.html.twig',array(
            'data' => $data));
    }

    /**
     * @Route("/404", name="404")
     */
    public function fourOfourAction()
    {
        return $this->render('Page/other/404.html.twig');
    }

      /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('Page/other/about.html.twig');
    }

     /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('Page/other/contact.html.twig');
    }

    /**
     * @Route("/checkoutTest")
     */
    public function test()
    {
        $em = $this->getDoctrine()->getManager();
        $userOrder = $em->getRepository('AppBundle:UserOrder')->find(25); //找一个order

        $check = $this->get('app.skip.checkout');
        $url = $check->checkout($userOrder, 0.01); //接受一个userOrder对象和总额

        if($url) {
            //跳转支付
            return $this->redirect($url);
        }
        else {
            //出错了do something
            return new Response('Error');
        }
    }
}
