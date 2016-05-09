<?php

namespace AppBundle\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

//use AppBundle\Repository\ImgUploader;


class DeleteUserController extends Controller
{
    // a user should be only disabled in the database, not deleted....?   
    /**
     * @Route("/delete_user", name="remove_user_from_database", condition="request.isXmlHttpRequest()", options={"expose"=true})
     */
    /* public function deleteImage(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $imgLink = $this->container->get('request')->get('imgLink');
            $type = $this->container->get('request')->get('type');
            $fileName = $this->container->get('request')->get('fileName');
            $dir = $this->get('kernel')->getImgSrcDir().'/'.$imgLink.'/'.$type.'/'.$fileName;
            if(file_exists($dir)) {
                unlink($dir);
                return new Response(json_encode(array(
                    'success' => true,
                )));
            }
            else
                return new Response(json_encode(array(
                    'success' => false,
                )));
        }
        else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    } */
}
