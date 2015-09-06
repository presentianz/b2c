<?php

namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Category;

/**
 * @Route("/c")
 */

class CategoryController extends Controller
{
    /**
     * @Route("/", name="category_home")
     */
    public function indexAction()
    {
        return $this->render('Product/category/index.html.twig');
    }

    /**
     * @Route("/{id}/{page}/{sort}/{item_no}", name="category", defaults={"page":1, "sort":"soldNo-", "item_no":20}, requirements={"id" : "\d+"})
     */
    public function categoryAction($id, $page, $sort, $item_no)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppBundle:Category')->getCategoryProducts($id, $page, $sort, $item_no);

        return $this->render('Product/category/category.html.twig', array(
        	'data' => $data,
        	));
    }
}
