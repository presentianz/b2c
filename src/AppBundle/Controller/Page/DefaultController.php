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
            ->setFrom('lyan776.test@gmail.com')
            ->setTo('support@plentybay.co.nz')
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
