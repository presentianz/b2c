<?php
//login listener
namespace AppBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

use AppBundle\Entity\CartProduct;


/**
 * Listener responsible to merge cookie cart to database after user login
 */
class OnLoginListener implements EventSubscriberInterface
{
	private $request;
	private $em;
	private $user;

    public function __construct($request, $em, $securityContext){
        $this->request = $request;
        $this->em = $em;
        $this->user = $securityContext->getToken()->getUser();
   	}
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onLoginSuccess',
            SecurityEvents::INTERACTIVE_LOGIN => 'onLoginSuccess',
        );
    }

    public function onLoginSuccess()
    {
        if ($cookies->has('cart')) {
        	$request = $this->request;
	    	$cookies = $request->cookies;
	    	$em = $this->em;
	    	$user = $this->user;
            $cartArray = json_decode($cookies->get('cart'), true);
            $cartProducts = $em->getRepository('AppBundle:CartProduct')->findByUser($user->getId());
            foreach ($cartProducts as $value) {
                $product = $value->getProduct();
                if (array_key_exists($product->getId(), $cartArray)) {
                    $value->setCount($value->getCount()+$cartArray[$product->getId()]['count']);
                    $value->setAddAt(new \DateTime());
                    $em->persist($value);
                    unset($cartArray[$product->getId()]);
                }
            }
            if (count($cartArray) > 0) {
            	$products = $em->getRepository('AppBundle:Product')->findById(array_keys($cartArray));
                foreach ($products as  $value) {
                    $cartProduct = new CartProduct();
                    $cartProduct->setProduct($value);
                    $cartProduct->setCount($cartArray[$value->getId()]['count']);
                    $cartProduct->setUser($user);
                    $em->persist($cartProduct);
                    unset($cartArray[$value->getId()]);
                }
                $em->flush();
            }
            $response = new Response();
            $response->headers->clearCookie('cart');
            $response->send();
        }
    }
}