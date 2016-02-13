<?php

namespace AppBundle\Controller\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/account")
 * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
 */

class DefaultController extends Controller
{
    /**
     * @Route("/", name="user_home")
     */
    public function indexAction()
    {
        return $this->render('User/default/index.html.twig');
    }

     /**
     * @Route("/email", name="user_email")
     */
    public function emailAction()
    {
        return $this->render('User/email/email.html.twig');
    }

  
}
