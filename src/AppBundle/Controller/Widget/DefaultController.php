<?php

namespace AppBundle\Controller\Widget;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /* miss * annotation
     * @Route("/menubody")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tree = $em->getRepository('AppBundle:Category')->get2LevelCategory();
        $data = array();
        foreach ($tree as $key => $value) {
            $products = $em->getRepository('AppBundle:Category')->getRandomProductsUnderCategory($value['id'], 4);
            array_push($data, array(
                'products' => $products,
                'node' => $tree[$key]
                ));
        }
        return $this->render('Widget/default/index.html.twig', array(
            'data' => $data
            ));
    }

    public function underSearchBox()
    {
        
    }
}
