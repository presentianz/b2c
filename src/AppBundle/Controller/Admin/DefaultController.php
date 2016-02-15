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
     * @Route("", name="admin_index")
     */
    public function indexAction()
    {   
    	
    	$id=2; 	
    	$em = $this->getDoctrine()->getManager();
    	
    	$Config = $this->getDoctrine()
        ->getRepository('AppBundle:Config')
        ->find($id);
        if (!$Config) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }
    $sql="select p from AppBundle:Config p where p.id=2";
    $query=$em->createQuery($sql);
    $data=$query->getSingleResult();
    $cfgvalue=$data->getCfgvalue();
    	//$cfgvalue=$Config->getCfgvalue();
    	if($cfgvalue==1)
    	{
    		$sql="select p from AppBundle:Config p where p.id=3";
    		$query=$em->createQuery($sql);
    		$data=$query->getSingleResult();
    		$cfgvalue=$data->getCfgvalue();
    		$id=3;
    		$Config = $this->getDoctrine()
        ->getRepository('AppBundle:Config')
        ->find($id);
        if (!$Config) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }
    	$cfgvalue=$Config->getCfgvalue();
    	$rsm = new ResultSetMapping();
    	$sql="SELECT p FROM AppBundle:UserInfo p where datediff(d,p.brithday,getdate())=0";
    	
    	$sql="SELECT p FROM AppBundle:UserInfo p";
    	$query = $em->createQuery(
                $sql
            );
       $member=$query->getResult();
       //echo(exit(\Doctrine\Common\Util\Debug::dump($member)));
       $count=count($member);       
       while(list($k,$v)=each($member))      
       {       	  
       		//$id=$v->getId(); 	
       		//$entity = $em->getRepository('AppBundle:UserInfo')->find($id);
       		//echo($v->getPoints());
       		$v->setPoints($v->getPoints()+$cfgvalue);
       		
       		$em->persist($v);
        	$em->flush();
       	}
      }    		
    

    	$data = [];
    	$queries = [];

    	$queries['productNo'] = $em->createQuery(
                'SELECT COUNT(p.id) FROM AppBundle:Product p'
            );
    	$queries['userNo'] = $em->createQuery(
                'SELECT COUNT(u.id) FROM AppBundle:User u'
            );
    	$queries['categoryNo'] = $em->createQuery(
                'SELECT COUNT(c.id) FROM AppBundle:Category c'
            );
    	$queries['orderNo'] = $em->createQuery(
                'SELECT COUNT(o.id) FROM AppBundle:UserOrder o'
            );
    	$queries['soldOutpPoductNo'] = $em->createQuery(
                'SELECT COUNT(p.id) FROM AppBundle:Product p WHERE p.inventory <= 0'
            );

    	foreach ($queries as $key => $query) {
    		$data[$key] = $query->getSingleScalarResult();
    	}

		$sql = "SELECT p FROM AppBundle:UserInfo p";
		$query = $em->createQuery($sql);
		$member = $query->getResult();
		exit(\Doctrine\Common\Util\Debug::dump($member));

    	//exit(\Doctrine\Common\Util\Debug::dump($data));
        return $this->render('Admin/Default/index.html.twig', array(
        	'data' => $data,
        	));
    }
    
    /**
     * @Route("/webconfig", name="admin_webconfig")
     */
    public function webconfigAction()
    {
    	$cfg=[];
    	$em = $this->getDoctrine()->getEntityManager();
    	$sql="select p from AppBundle:Config p where p.id=1";
    $query=$em->createQuery($sql);
    $data=$query->getSingleResult();
    $cfg["cfgvalue1"]=$data->getCfgvalue();    
    $sql="select p from AppBundle:Config p where p.id=2";
    $query=$em->createQuery($sql);
    $data=$query->getSingleResult();
    $cfg["cfgvalue2"]=$data->getCfgvalue();
    
    $sql="select p from AppBundle:Config p where p.id=3";
    $query=$em->createQuery($sql);
    $data=$query->getSingleResult();
    $cfg["cfgvalue3"]=$data->getCfgvalue();
    	return $this->render('Admin/Default/config.html.twig', array(
        	'cfg' => $cfg
        	));
    	}
    	
    	/**
     * @Route("/listuserinfo", name="admin_listuserinfo")
     */
    public function listuserinfoAction(Request $request)
    {
    	$keys = $request->query->get('keys');
        $sort = $request->query->get('sort');
        $page = $request->query->get('page');
        $item_no = $request->query->get('item_no');
        if (!(is_numeric($item_no) && $item_no > 1)) {
            $item_no = 20;
        }
        if(!$sort)
            $sort = 0;
        $em = $this->getDoctrine()->getManager();
        $sql="select p from AppBundle:UserInfo p";
    $query=$em->createQuery($sql);
    $data["members"]=$query->getResult();
    $data["total_page"]=1;
    $data["total_no"]=1;
        return $this->render('Admin/Default/listuserinfo.html.twig', array(
            'data' => $data,
            ));
    	
    	}
    	
    	
    	 /**
     * @Route("/submitwebconfig", name="admin_submitwebconfig")
     */
    public function submitwebconfigAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$sql="select p from AppBundle:Config p";       
       
    	$cfg1=$_REQUEST["cfg1"];    	
    	$cfg2=$_REQUEST["cfg2"];    	
    	$cfg3=$_REQUEST["cfg3"];    	
    	
    	$query = $em->createQuery(
                $sql
            );
       $member=$query->getResult();
       //echo(exit(\Doctrine\Common\Util\Debug::dump($member)));
            
       while(list($k,$v)=each($member))      
       {       	  
       		$id=$v->getId(); 
       		
       		//$entity = $em->getRepository('AppBundle:UserInfo')->find($id);
       		if($id==1)
       		{
       		$v->setCfgvalue($cfg1);       		
       		$em->persist($v);
        	$em->flush();
        	
        }
        
        if($id==2)
       		{
       		$v->setCfgvalue($cfg2);       		
       		$em->persist($v);
        	$em->flush();
        }
        
        if($id==3)
       		{
       		$v->setCfgvalue($cfg3);       		
       		$em->persist($v);
        	$em->flush();
        }
       	}    		
       
			$ret='';
    	return new Response($ret);
    	
    	}
}