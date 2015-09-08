<?php

namespace AppBundle\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

class RecentViewedController extends Controller
{
	/**
     * @Route("/recentViewedAjaxAction/{id}/{action}", name="recent_viewed_action")
     */
	public function indexAction($id, $action, Request $request)
	{
		$cookies = $request->cookies;
		
	}
}
