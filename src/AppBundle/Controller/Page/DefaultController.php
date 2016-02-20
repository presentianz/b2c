<?php

namespace AppBundle\Controller\Page;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $data = array();
        return $this->render('Page/default/index.html.twig',array(
            'data' => $data));
    }

    /**
     * @Route("/404", name="404")
     */
    public function fourOfourAction()
    {
        return $this->render('Page/other/404.html.twig');
    }

      /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('Page/other/about.html.twig');
    }

     /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('Page/other/contact.html.twig');
    }
}
