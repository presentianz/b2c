<?php

namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class SearchController extends Controller
{
    /**
     * @Route("/s/{keywords}", name="search", defaults={"keywords" : ""})
     */
    public function indexAction($keywords)
    {
        return $this->render('Product/search/index.html.twig', array(
        	'keywords' => $keywords,
        	));
    }
}
