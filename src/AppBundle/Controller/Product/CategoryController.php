<?php

namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;

/**
 * @Route("/c")
 */

class CategoryController extends Controller
{
    /**
     * @Route("/{id}/{page}/{sort}/{item_no}", name="category", defaults={"id" : -1, "page":1, "sort":1, "item_no":18})
     */
    public function categoryAction($id, $page, $sort, $item_no)
    {
        $em = $this->getDoctrine()->getManager();
        if ($id < 0) {
            $data = $em->getRepository('AppBundle:Product')->searchProduct('', $sort, $page, $item_no);
            $data['children'] = $em->getRepository('AppBundle:Category')->findByLvl(0);
        }
        else {
            $data = $em->getRepository('AppBundle:Category')->getCategoryProducts($id, $page, $sort, $item_no);
            if(count($data['children']) == 0) {
                $data['children'] = $em->getRepository('AppBundle:Category')->findBrothers(
                    $data['path'][count($data['path']) - 1]->getParent(), $id);
            }
        }
        return $this->render('Product/category/category.html.twig', array(
        	'data' => $data,
            'id' => $id,
            'sort' => $sort,
            'page' => $page,
            'item_no' => $item_no
        	));
    }
}
