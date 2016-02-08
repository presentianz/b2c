<?php

namespace AppBundle\Controller\Order;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

use Symfony\Component\Form\FormBuilder;
use AppBundle\Entity\ShipmentAddress;
use AppBundle\Form\Type\ShipmentAddressFormType;
use AppBundle\Entity\CartProduct;

class DefaultController extends Controller
{
    /**
     * @Route("/cart", name="cart", options={"expose"=true})
     */
    public function cartAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $cartProducts = $em->getRepository('AppBundle:CartProduct')->findByUser($user->getId());
        }
        else {
            $cookies = $request->cookies;
            if ($cookies->has('cart')) {
                $cartArray = json_decode($cookies->get('cart'), true);
                $em = $this->getDoctrine()->getManager();
                $products = $em->getRepository('AppBundle:Product')->findById(array_keys($cartArray));
                $cartProducts = array();
                foreach ($products as $value) {
                    $cartProduct = new CartProduct();
                    $cartProduct->setProduct($value);
                    $cartProduct->setCount($cartArray[$value->getId()]['count']);
                    $cartProduct->setAddAt($cartArray[$value->getId()]['addAt']);
                    array_push($cartProducts, $cartProduct);
                }
            }
            else {
                $cartProducts = '';
            }
        }
        return $this->render('Order/default/cart.html.twig', array(
            'data' => $cartProducts
            ));
    }

    /**
     * @Route("/orderConfirm", name="order_confirm", options={"expose"=true}))
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function orderConfirmAction(Request $request)
    {
        $id = $request->query->get('id');
        $type = $request->query->get('type');
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('AppBundle:UserOrder')->findOneByOrderId($id);
        if ($type == 'trans') {
            if ($order->getUser() != $this->getUser()) {
                return new Response('Not your thing!');
            }
            return $this->render('Order/default/order_confirm.html.twig', array(
                'data' => $order
                ));
        }
        elseif ($type == 'online') {
            $amount = $order->getTotalPrice()+$order->getPostFee();
//             $xml = '<GenerateRequest>
// <PxPayUserId>SamplePXPayUser</PxPayUserId>
// <PxPayKey>cff9bd6b6c7614bec6872182e5f1f5bcc531f1afb744f0bcaa00e82ad3b37f6d</PxPayKey>
// <MerchantReference>Purchase Example</MerchantReference>
// <TxnType>Purchase</TxnType>
// <AmountInput>1.00</AmountInput>
// <CurrencyInput>NZD</CurrencyInput>
// <TxnData1>John Doe</TxnData1>
// <TxnData2>0211111111</TxnData2>
// <TxnData3>98 Anzac Ave, Auckland 1010</TxnData3>
// <EmailAddress>samplepxpayuser@paymentexpress.com</EmailAddress>
// <UrlSuccess>https://www.dpsdemo.com/SandboxSuccess.aspx</UrlSuccess>
// <UrlFail>https://www.dpsdemo.com/SandboxSuccess.aspx</UrlFail>
// </GenerateRequest>';
            $xml = '<GenerateRequest>
<PxPayUserId>SamplePXPayUser</PxPayUserId>
<PxPayKey>cff9bd6b6c7614bec6872182e5f1f5bcc531f1afb744f0bcaa00e82ad3b37f6d</PxPayKey>
<MerchantReference>'.$id.'</MerchantReference>
<TxnType>Purchase</TxnType>
<AmountInput>'.number_format($amount, 2).'</AmountInput>
<CurrencyInput>NZD</CurrencyInput>
<TxnData1>'.$this->getUser()->getUsername().'</TxnData1>
<UrlSuccess>http://localhost/b2c/web/app_dev.php/</UrlSuccess>
<UrlFail>http://localhost/b2c/web/app_dev.php/</UrlFail>
</GenerateRequest>';
            $ch = curl_init("https://sec.paymentexpress.com/pxaccess/pxpay.aspx");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
            $response = curl_exec($ch);
            curl_close ($ch);
            $temp = simplexml_load_string($response);
            $json = json_encode($temp);
            $array = json_decode($json,TRUE);

            //exit(\Doctrine\Common\Util\Debug::dump($array['URI']));
            return $this->redirect($array['URI']);
        }
    }



    /**
     * @Route("/checkout", name="checkout")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function checkoutAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cartArray = $request->request->get('product-id');
        $products = $em->getRepository('AppBundle:CartProduct')->getItem($cartArray, $this->getUser()->getId());


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
             
            return $this->redirectToRoute('order_confirm');
        }
         
        return $this->render('Order/default/checkout.html.twig', array(
            'data' => $products,
            'form' => $form->createView(),
            ));
    }
}
