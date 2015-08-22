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
     * @Route("/{id}", name="category", requirements={"id" : "\d+"})
     */
    public function categoryAction(Category $category)
    {
        return $this->render('Product/category/category.html.twig', array(
        	'c' => $category,
        	));
    }
}
