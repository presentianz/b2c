<?php

namespace AppBundle\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

use AppBundle\Repository\ImgUploader;


class ImgUploadController extends Controller
{
    /**
     * @Route("/img_upload", name="img_upload", condition="request.isXmlHttpRequest()", options={"expose"=true})
     */
    public function indexAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $imgLink = $this->container->get('request')->get('imgLink');
            $type = $this->container->get('request')->get('type');
            $upload_dir = $this->get('kernel')->getImgSrcDir().'/'.$imgLink.'/'.$type;
            if(!is_writable ($this->get('kernel')->getImgSrcDir()))
                return new Response(json_encode(array('success' => false, 'msg' => 'Floder not writable')));
            if(!file_exists($upload_dir))
                mkdir($upload_dir, 0755, true);
            $uploader = new ImgUploader('uploadfile');
            // Handle the upload
            $result = $uploader->handleUpload($upload_dir);
            if (!$result) {
                return new Response(json_encode(array(
                    'success' => false,
                    'msg' => $uploader->getErrorMsg()
                )));
            }

            return new Response(json_encode(array(
                'success' => true,
                'file' => $uploader->getFileName()
            )));
        }
        else
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
    }

    /**
     * @Route("/get_image", name="get_image", condition="request.isXmlHttpRequest()", options={"expose"=true})
     */
    public function getImage(Request $request)
    {
        $imgLink = $this->container->get('request')->get('imgLink');
        $type = $this->container->get('request')->get('type');
        $dir = $this->get('kernel')->getImgSrcDir().'/'.$imgLink.'/'.$type;
        if(file_exists($dir))
            $files = scandir($dir);
        else
            $files = array();
        return new Response(json_encode(array_diff($files, array('.', '..'))));
    }

    /**
     * @Route("/delete_image", name="delete_image", condition="request.isXmlHttpRequest()", options={"expose"=true})
     */
    public function deleteImage(Request $request)
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
    }
}
