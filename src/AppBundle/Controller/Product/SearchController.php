<?php

namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Request;

// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpFoundation\JsonResponse;
// use Symfony\Component\HttpFoundation\Cookie;

class SearchController extends Controller
{
    /**
     * @Route("/s", name="search")
     */
    public function indexAction(Request $request)
    {
        $keys = $request->query->get('keys');
        $sort = $request->query->get('sort');
        $page = $request->query->get('page');
        $item_no = $request->query->get('item_no');
        
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Product')->searchProduct($keys, $sort, $page, $item_no);
        return $this->render('Product/search/index.html.twig', array(
            'data' => $data,
            ));
    }
}
