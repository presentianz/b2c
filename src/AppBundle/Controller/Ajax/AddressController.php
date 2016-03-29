<?php

namespace AppBundle\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Form\Type\ShipmentAddressFormType;
use AppBundle\Entity\ShipmentAddress;


class AddressController extends Controller
{
    /**
     * @Route("/addAddress", name="add_address_ajax", condition="request.isXmlHttpRequest()")
     */
    public function FunctionName(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $address = new ShipmentAddress();
            $form = $this->createForm(new ShipmentAddressFormType(), $address);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $address = $form->getData();
                $address->setUser($this->getUser());

                $em = $this->getDoctrine()->getManager();
                $em->persist($address);
                $em->flush();
                return new JsonResponse(array(
                    'success' => true,
                    'id' => $address->getId(),
                    'name' => $address->getName(),
                    'phoneNo' => $address->getPhoneNo(),
                    'country' => $address->getCountry(),
                    'region' => $address->getRegion(),
                    'city' => $address->getCity(),
                    'address' => $address->getAddress(),
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