<?php


    namespace AppBundle\Controller\Admin;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
    use Doctrine\ORM\Query\ResultSetMapping;
    use AppBundle\Entity\Config;
    use Symfony\Component\HttpFoundation\Response;

    /**
     * @Route("/admin")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    class DefaultController extends Controller
    {
        /**
         * @Route("/", name="admin_index")
         */
        public function indexAction()
        {
            $em = $this->getDoctrine()->getEntityManager();
            $data = [];
            $queries = [];

            $queries['productNo'] = $em->createQuery('SELECT COUNT(p.id) FROM AppBundle:Product p');
            $queries['userNoThisWeek'] = $em->createQuery(
                'SELECT COUNT(u.id) FROM AppBundle:User u 
                JOIN u.userInfo uin 
                WHERE uin.createAt >= :weekBefore')
                ->setParameter('weekBefore', new \DateTime('-7 DAYS'));
            $queries['userNo'] = $em->createQuery('SELECT COUNT(u.id) FROM AppBundle:User u');
            $queries['categoryNo'] = $em->createQuery('SELECT COUNT(c.id) FROM AppBundle:Category c');
            $queries['orderNo'] = $em->createQuery('SELECT COUNT(o.id) FROM AppBundle:UserOrder o');
            $queries['soldOutpPoductNo'] = $em->createQuery('SELECT COUNT(p.id) FROM AppBundle:Product p WHERE p.inventory <= 0');
            $queries['paid'] = $em->createQuery('SELECT COUNT(o.id) FROM AppBundle:UserOrder o WHERE o.status = 1');
            $queries['unpaid'] = $em->createQuery('SELECT COUNT(o.id) FROM AppBundle:UserOrder o WHERE o.status = 0');

            foreach ($queries as $key => $query) {
                $data[$key] = $query->getSingleScalarResult();
            }
            return $this->render('Admin/Default/index.html.twig', array(
                'data' => $data,
            ));
        }
    }
