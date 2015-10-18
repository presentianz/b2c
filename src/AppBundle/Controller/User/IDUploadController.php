<?php

namespace AppBundle\Controller\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/account/idupload")
 * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
 */

class IDUploadController extends Controller
{
    /**
     * @Route("/", name="user_id_upload")
     */
    public function indexAction()
    {
        return $this->render('User/address/id_upload.html.twig');
    }

  
}
