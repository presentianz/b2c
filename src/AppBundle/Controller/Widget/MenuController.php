<?php

namespace AppBundle\Controller\Widget;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class MenuController extends Controller
{
	/* miss * annotation
	 * @Route("/menu", name = "menu")
	 */

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
		$tree = $em->getRepository('AppBundle:Category')->get2LevelCategory();
       	return $this->render('Widget/menu/index.html.twig', array(
            'data' => $tree
            ));
    }
}
