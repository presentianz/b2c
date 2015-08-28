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
 * @Route("/address")
 * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
 */

class ShipmentAddressControler extends Controller
{
    /**
     * @Route("/", name="user_address")
     */
    public function indexAction()
    {
    	
    	$user = $this->getUser()->getId();
    	
    	$addresses = $this->Doctrine()->findBy(
    			array('user' => $user)
    	);
    	
        return $this->render('User/address/index.html.twig',array('addresses'=>$addresses));
    }
    
    /**
     * @Route("/show/{id}", name="user_address_show")
     */
    public function showAction($id)
    {
    	//$address = new ShipmentAddress();
       
    	$address = $this->Doctrine()->find($id);
    	
    	return $this->render('User/address/show.html.twig',array(
            'address' => $address));
    }
    
    /**
     * @Route("/edit/{id}", name="user_address_edit")
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
    	
    		return $this->redirectToRoute('user_address');
    	}
    	
    	return $this->render('User/address/edit.html.twig', array(
           	 'address' => $address,
    		 'form' => $form->createView(),
    		)
    	);
    }
    
    /**
     * @Route("/create", name="user_address_create")
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
    		 
    		return $this->redirectToRoute('user_address');
    	}
    	 
    	return $this->render('User/address/edit.html.twig', array(
    			'address' => $address,
    			'form' => $form->createView(),
    		)
    	);
    }
    
    /**
     * @Route("/remove/{id}", name="user_address_remove")
     */
    public function removeAction($id){
    	
    	$address = $this->Doctrine()->find($id);
    	
    	$em = $this->getDoctrine()->getManager();
    	$em->remove($address);
    	$em->flush();
    	
    	return $this->redirectToRoute('user_address');
    }
    
    
    public function Doctrine() {
    	return $this->getDoctrine()->getRepository('AppBundle:ShipmentAddress');
    }
}
