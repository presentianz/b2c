<?php

namespace AppBundle\Controller\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Product;
use AppBundle\Form\CommentType;

class ProductController extends Controller
{
    /**
     * @Route("/p/{id}", name="product", requirements={"id" : "\d+"}, options={"expose"=true})
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $data = array();
        $data['product'] = $em->getRepository('AppBundle:Product')->findOneById($id);
        $dir = $this->get('kernel')->getImgSrcDir().'/'.$data['product']->getImageLink();
        if(file_exists($dir.'/poster'))
           $data['poster'] = array_values(array_diff(scandir($dir.'/poster'), array('.', '..')));
        else
            $data['poster'] = array();

        if(file_exists($dir.'/imgDes'))
           $data['imgDes'] = array_values(array_diff(scandir($dir.'/imgDes'), array('.', '..')));
        else
            $data['imgDes'] = array();

        if($data['product']->getCategory() == null)
            $data['path'] = null;
        else
            $data['path'] = $em->getRepository('AppBundle:Category')->getPath($data['product']->getCategory());

        $this->get('product.click.increment')->clickIncrement($data['product']);
         $form = $this->createForm(new CommentType());
        return $this->render('Product/product/index.html.twig', array(
            'data' => $data,
            'form' => $form->createView(),
            ));
    }
}
