<?php

namespace AppBundle\Controller\Widget;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Product')->findRandomFourProducts();
        return $this->render('Widget/test/index.html.twig', array(
            'data' => $data
            ));
    }
}
