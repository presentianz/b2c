<?php

namespace AppBundle\Controller\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/account")
 * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
 */

class TopupController extends Controller
{
    /**
     * @Route("/topup", name="user_topup")
     */
    public function indexAction()
    {
        return $this->render('User/payment/topup.html.twig');
    }
}
