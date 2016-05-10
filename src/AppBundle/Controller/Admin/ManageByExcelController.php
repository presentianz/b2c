<?php

    namespace AppBundle\Controller\Admin;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

    use AppBundle\Entity\Product;
    use AppBundle\Form\ProductType;

    /**
     * Product controller.
     *
     * @Route("/admin/product/manage_by_excel")
     */
    class ManageByExcelController extends Controller
    {

        /**
         * Lists all Product entities.
         *
         * @Route("", name="admin_product_manage_by_excel")
         * @Method("GET")
         */
        public function indexAction(Request $request)
        {
            $keys = $request->query->get('keys');
            $sort = $request->query->get('sort');
            $page = $request->query->get('page');
            $item_no = $request->query->get('item_no');
            $widget = $request->query->get('widget');
            $item_no = null;
            if (! $sort)
                $sort = 7;
            $em = $this->getDoctrine()->getManager();
            $data = $em->getRepository('AppBundle:Product')->searchProduct($keys, $sort, $page, $item_no, $widget);
            $em->flush();
            return $this->render('Admin/Product/manage_by_excel.html.twig', array(
                'data' => $data,
            ));
        }
    }
