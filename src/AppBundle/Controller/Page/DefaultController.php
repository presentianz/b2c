<?php

namespace AppBundle\Controller\Page;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $data = array();
        return $this->render('Page/default/index.html.twig',array(
            'data' => $data));
    }

    /**
     * @Route("/alipay", name="alipay")
     */
    public function alipayAction()
    {
        return $this->render('Page/other/alipay.html.twig');
    }


    /**
     * @Route("/error", name="error")
     */
    public function errorAction()
    {
        return $this->render('Page/other/404.html.twig');
    }


    /**
     * @Route("/terms", name="terms")
     */
    public function termsAndConditionsAction()
    {
        return $this->render('Page/other/termsandconditions.html.twig');
    }

    /**
     * @Route("/terms_en", name="terms_en")
     */
    public function termsAndConditionsEnAction()
    {
        return $this->render('Page/other/termsandconditions_en.html.twig');
    }


    /**
     * @Route("/refundpolicy", name="refundpolicy")
     */
    public function refundpolicyAction()
    {
        return $this->render('Page/other/refundpolicy.html.twig');
    }

    /**
     * @Route("/refundprocess", name="refundprocess")
     */
    public function refundprocessAction()
    {
        return $this->render('Page/other/refundprocess.html.twig');
    }

    /**
     * @Route("/privacy", name="privacy")
     */
    public function privacyAction()
    {
        return $this->render('Page/other/privacy.html.twig');
    }

    /**
     * @Route("/privacy_en", name="privacy_en")
     */
    public function privacy_enAction()
    {
        return $this->render('Page/other/privacy_en.html.twig');
    }

  
    /**
     * @Route("/404", name="404")
     */
    public function fourOfourAction()
    {
        return $this->render('Page/other/404.html.twig');
    }

      /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('Page/other/about.html.twig');
    }

     /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('Page/other/contact.html.twig');
    }

    /**
     * @Route("/testMail", name="testMail")
     */
    public function MailAction()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('support@pbay.co.nz')
            ->setTo('support@pbay.co.nz')
            ->setBody('123')
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        $this->get('mailer')->send($message);

        return new Response(0);
    }
}
