<?php

    namespace AppBundle\Controller\Widget;

    use Doctrine\Common\Util\Debug;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

    use AppBundle\Entity\Category;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;

    /**
     * @Cache(expires="tomorrow", public=true)
     */
    class DefaultController extends Controller
    {
        /* miss * annotation
         * @Route("/menubody")
         */
        public function indexAction()
        {
            $em = $this->getDoctrine()->getManager();
            $tree = $em->getRepository('AppBundle:Category')->get2LevelCategory();

            $data = array();
            foreach ($tree as $key => $value) {
                $products = $em->getRepository('AppBundle:Category')->getRandomProductsUnderCategory($value['id'], 3);
                array_push($data, array(
                    'products' => $products,
                    'node' => $tree[$key]
                ));
            }
            /* 今日推介,热卖畅销,限时特卖 */
            for ($i = 0; $i < 3; $i ++) {
                $widget[$i] = $em->getRepository('AppBundle:Product')->findIndexWidgetProducts($i + 1, 3);
            }

            $data['widget'] = $widget;

            return $this->render('Widget/default/index.html.twig', array(
                'data' => $data
            ));
        }

        public function bestProAction()
        {
            $em = $this->getDoctrine()->getManager();
            $products = $em->getRepository('AppBundle:Product')->findIndexWidgetProducts(5, 2);

            return $this->render('Widget/default/bestPro.html.twig', array(
                'products' => $products
            ));
        }

        public function discountProAction()
        {
            $em = $this->getDoctrine()->getManager();
            $products = $em->getRepository('AppBundle:Product')->findIndexWidgetProducts(4, 2);

            return $this->render('Widget/default/discountPro.html.twig', array(
                'products' => $products
            ));
        }

        public function hotProAction()
        {
            $em = $this->getDoctrine()->getManager();
            $products = $em->getRepository('AppBundle:Product')->findRandomProducts(4);
            return $this->render('Widget/default/hotPro.html.twig', array(
                'data' => $products
            ));
        }

        public function brandAction()
        {
            //  $em = $this->getDoctrine()->getManager();
            //   $products = $em->getRepository('AppBundle:Product')->findRandomProducts(4);
            return $this->render('Widget/default/brand.html.twig', array(//     'data' => $products
            ));
        }

        public function brandlistAction()
        {
            //  $em = $this->getDoctrine()->getManager();
            //   $products = $em->getRepository('AppBundle:Product')->findRandomProducts(4);
            return $this->render('Widget/default/brandList.html.twig', array(//     'data' => $products
            ));
        }

        public function postfeeAction()
        {
            //  $em = $this->getDoctrine()->getManager();
            //   $products = $em->getRepository('AppBundle:Product')->findRandomProducts(4);
            return $this->render('Widget/default/postFee.html.twig', array(//     'data' => $products
            ));
        }
    }
