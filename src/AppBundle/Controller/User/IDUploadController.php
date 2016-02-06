<?php

namespace AppBundle\Controller\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormBuilder;
use AppBundle\Entity\ShipmentAddress;
use AppBundle\Form\Type\ShipmentAddressFormType;

/**
 * @Route("/account")
 * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
 */

class IDUploadController extends Controller
{
    /**
     * @Route("/idupload", name="user_id_upload")
     */
    public function indexAction()
    {
    	$user = $this->getUser()->getId();
    	
    	$addresses = $this->Doctrine()->findBy(
    			array('user' => $user)
    	);
        return $this->render('User/address/id_upload.html.twig',array('addresses'=>$addresses));
    }

   
    /**
     * @Route("/idupload/edit/{id}", name="user_idupload_edit")
     */
    public function editAction(Request $request , $id)
    {
        //$address = new ShipmentAddress();
        $address = $this->Doctrine()->find($id);
        
        $form = $this->createForm(new ShipmentAddressFormType());
        $form->setData($address);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $address = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        
            return $this->redirectToRoute('user_id_upload');
        }
        
        return $this->render('User/address/id_upload_edit.html.twig', array(
             'address' => $address,
             'form' => $form->createView(),
            )
        );
    }
    
    /**
     * @Route("/idupload/create", name="user_idupload_create")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(new ShipmentAddressFormType());
         
        $form->handleRequest($request);
         
        $address = new ShipmentAddress();
        
        if ($form->isSubmitted() && $form->isValid()) {
    
            $address = $form->getData();
            //$address = new ShipmentAddress();
            $address->setUser($this->getUser());
    
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
             
            return $this->redirectToRoute('user_id_upload');
        }
         
        return $this->render('User/address/id_upload_edit.html.twig', array(
                'address' => $address,
                'form' => $form->createView(),
            )
        );
    }
    
    /**
     * @Route("/idupload/remove/{id}", name="user_idupload_remove")
     */
    public function removeAction($id)
    {
        
        $address = $this->Doctrine()->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();
        
        return $this->redirectToRoute('user_id_upload');
    }


    public function Doctrine() {
        return $this->getDoctrine()->getRepository('AppBundle:ShipmentAddress');
    }
}
