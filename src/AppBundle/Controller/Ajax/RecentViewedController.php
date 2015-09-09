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
		$response = new Response();
		if ($cookies->has('recentViewed')) {
			$recentViewed = json_decode($cookies->get('recentViewed'), true);
			if ($action === '+') {
				if (!in_array($id, $recentViewed)) {
					array_push($recentViewed, $id);
				}
				$response->headers->setCookie(new Cookie('recentViewed', json_encode($recentViewed), time() + (3600*48)));
                $response->send();
                return new Response($cookies->get('recentViewed'));
			}
			else {
				$response->headers->clearCookie('recentViewed');
 				$response->send();
 				return new Response('cleared');
			}
		}
		else {
			$response = new Response();
			if ($action === '+') {
				$response->headers->setCookie(new Cookie('recentViewed', json_encode(array($id)), time() + (3600*48)));
                $response->send();
                return new Response($cookies->get('recentViewed'));
			}
			else {
				return new Response('nothing to delete');
			}
		}
	}

	/**
     * @Route("/recentViewedAjaxGet", name="recent_view_ajax_get")
     */
	public function getRecentViewed(Request $request)
	{
		$cookies = $request->cookies;
		if ($cookies->has('recentViewed')) {
			$recentViewed = json_decode($cookies->get('recentViewed', true));
			$em = $this->getDoctrine()->getManager();
            $products = $em->getRepository('AppBundle:Product')->findById($recentViewed);
            //exit(\Doctrine\Common\Util\Debug::dump($products));
            $data = array();
            foreach ($products as $value) {
                array_push($data, array(
                	'id' => $value->getId(),
                    'name' => $value->getName(),
                    'poster' => $value->getPoster(),
                    'price' => $value->getPrice(),
                    'price_discounted' => $value->getPriceDiscounted()
                	));
            };
            return new JsonResponse($data);
		}
		else {
			return new Response('no recent viewed');
		}
	}
}
