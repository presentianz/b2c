<?php

namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Product;


class ProductController extends Controller
{
    /**
     * @Route("/p/{id}", name="product", requirements={"id" : "\d+"})
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = array();
        $data['product'] = $em->getRepository('AppBundle:Product')->findOneById($id);
        $data['path'] = $em->getRepository('AppBundle:Category')->getPath($data['product']->getCategory());
        return $this->render('Product/product/index.html.twig', array(
            'data' => $data,
            ));
    }
}
