<?php

namespace AppBundle\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Form\CommentType;
use AppBundle\Entity\Comment;


class CommentController extends Controller
{
    /**
     * @Route("/addComment", name="add_comment_ajax", condition="request.isXmlHttpRequest()")
     */
    public function addCommentIndex(Request $request)
    {
        
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $commet = new Comment();
            $form = $this->createForm(new CommentType(), $commet);
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
             $user= $em->getRepository('AppBundle:User')->findOneById($this->getUser());
             $product =  $em->getRepository('AppBundle:Product')->findOneById($this->$getProduct);
            if ($form->isValid()) {
                $commet = $form->getData();
                $commet->setUser($user->getName());
                $commet->setProduct($product->getName());

                $commet->setCommentAt(time());
                $em = $this->getDoctrine()->getManager();
                $em->persist($commet);
                $em->flush();
                return new JsonResponse(array(
                    'success' => true,
                    'id' => $commet->getId(),
                    'text' => $commet->getText(),
                    // 'reply' => $commet->getReply(),
                    'star' => $commet->getStar(),
                    'commentAt' =>$commet->getCommentAt(),
                    'user' => $commet->getUser(),
                    'product' => $commet->getProduct(),
                    ));
            }
            else
                return new JsonResponse(array(
                    'success' => false,
                    'message' => 'Invalid form',
                    'data' => $this->getErrorMessages($form)
                    ));
        }
        else {
            return new Response(json_encode(array('success' => false, 'msg' => 'Permission denied')));
        }
    }

    protected function getErrorMessages(\Symfony\Component\Form\Form $form) 
    {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }
}

