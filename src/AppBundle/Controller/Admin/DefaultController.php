<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/admin")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class DefaultController extends Controller
{   
    /**
     * @Route("", name="admin_index")
     */
    public function indexAction()
    {
        return $this->render('Admin/Default/index.html.twig');
    }
}