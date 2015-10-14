<?php

namespace AppBundle\Controller\Page;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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

    // /**
    //  * @Route("/test")
    //  */
    // public function testAction()
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $repo = $em->getRepository('AppBundle:Category');
    //     // $food = new Category();
    //     // $food->setName('Food');
    //     $food = $repo->findOneByName('Food');
    //     $meat = new Category();
    //     $meat->setName('Meat');
    //     $meat->setParent($food);

    //     // $fruits = new Category();
    //     // $fruits->setName('Fruits');
    //     // $fruits->setParent($food);

    //     // $vegetables = new Category();
    //     // $vegetables->setName('Vegetables');
    //     // $vegetables->setParent($food);

    //     // $carrots = new Category();
    //     // $carrots->setName('Carrots');
    //     // $carrots->setParent($vegetables);

    //     //$em->persist($meat);
    //     // $em->persist($fruits);
    //     // $em->persist($vegetables);
    //     // $em->persist($carrots);
    //     // $meat = $repo->findOneByName('Meat');
    //     // $repo->removeFromTree($meat);
    //     // $em->clear();
    //     // $data = $repo->childrenHierarchy();
    //     //$carrots = $repo->findOneByName('Carrots');
    //     $food = $repo->findOneByName('Food');
    //     $children = $repo->children($food);
    //     //$path = $repo->getPath($carrots);
    //     return $this->render('Page/default/test.html.twig', array(
    //         'data' => $children,
    //         ));

    // }
}
