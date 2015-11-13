<?php

namespace AppBundle\Controller\Widget;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RecentViewController extends Controller
{
	/* miss * annotation
	 * @Route("/cartbody")
	 */

    public function indexAction()
    {
        //need to fix backend data load
        $data = array();
         array_push($data, array(
                    'id' => '111',
                    'name' => "hehe",
                    'price' => "100"
                    ));
        return $this->render('Widget/recentView/index.html.twig', array(
            'data' => $data
            ));
    }
}
