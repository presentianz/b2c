<?php

namespace AppBundle\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * CatecoryRepository
 */
class CategoryRepository extends NestedTreeRepository
{
    public function getCategoryProducts($id, $page, $sort, $item_no)
    {
        //sorting
        switch ($sort) {
            case '2':
                $orderby = 'price ASC';
                break;
            case '3':
                $orderby = 'price DESC';
                break;

            case '4':
                $orderby = 'soldNo DESC';
                break;

            case '5':
                $orderby = 'p.updateAt DESC';
                break;

            case '6':
                $orderby = 'p.click DESC';
                break;

            default:
                $orderby = 'p.updateAt DESC';
                break;
        }

        //item per page
        $item_no = $item_no <= 18 ? 18 : ($item_no <= 24 ? 24 : 36);

        $gEM = $this->getEntityManager();
        $this_root = $gEM->getRepository('AppBundle:Category')->findOneById($id);
        $children = $gEM->getRepository('AppBundle:Category')->children($this_root);
        $ids = [$id];
        foreach ($children as $child) {
            array_push($ids, $child->getId());
        }

        //find data
        $query_products = $gEM->createQuery(
                'SELECT c.name AS category_name, 
                        p.id, p.name, p.price AS price, 
                        p.price_discounted AS priceDiscounted, 
                        p.soldNo AS soldNo, 
                        p.inventory, 
                        p.status, 
                        p.updateAt, 
                        p.click, 
                        p.poster, 
                        p.imageLink 
                FROM AppBundle:Category c JOIN c.products p 
                WHERE c.id IN (:ids) 
                ORDER BY '.$orderby
            )
            ->setFirstResult(($page-1)*$item_no)
            ->setMaxResults($item_no)
            ->setParameter('ids', $ids);
        $products = $query_products->getResult();

        //find total
        $query_total = $gEM->createQuery(
                'SELECT COUNT(p.id) AS total 
                FROM AppBundle:Category c JOIN c.products p 
                WHERE c.id IN (:ids)'
            )
            ->setParameter('ids', $ids);
        $total = $query_total->getSingleScalarResult();

        $data = array();
        $data['products'] = $products;
        $data['total_no'] = $total;
        $data['total_page'] = ceil($total/$item_no);
        $data['path'] = $gEM->getRepository('AppBundle:Category')->getPath($this_root);
        $data['children'] = $gEM->getRepository('AppBundle:Category')->children($this_root, true);
        $data['row_no'] = ceil(count($data['products'])/3);

        return $data;
    }

    public function getRandomProductsUnderCategory($id, $no)
    {
        $em = $this->getEntityManager();
        $this_root = $em->getRepository('AppBundle:Category')->findOneById($id);
        $children = $em->getRepository('AppBundle:Category')->children($this_root);
        $ids = [$id];
        foreach ($children as $child) {
            array_push($ids, $child->getId());
        }
        $rows = $em->createQuery('SELECT COUNT(p.id) 
                FROM AppBundle:Category c JOIN c.products p 
                WHERE c.id IN (:ids)')->setParameter('ids', $ids)->getSingleScalarResult();
        $offset = max(0, rand(0, $rows - 3));
        $query = $em->createQuery('SELECT 
                                    c.name AS category_name, 
                                    p.id, p.name, p.price AS price, 
                                    p.price_discounted AS priceDiscounted, 
                                    p.soldNo AS soldNo, 
                                    p.inventory, 
                                    p.status, 
                                    p.updateAt, 
                                    p.click,
                                    p.poster, 
                                    p.imageLink 
                FROM AppBundle:Category c JOIN c.products p 
                WHERE c.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->setMaxResults($no)
            ->setFirstResult($offset);
        $products = $query->getResult();
        return $products;
    }

    public function get2LevelCategory()
    {
        $em = $this->getEntityManager();
        $query = $em
            ->createQueryBuilder()
            ->select('node')
            ->from('AppBundle:Category', 'node')
            ->orderBy('node.root, node.lft', 'ASC')
            ->where('node.lvl = 0 OR node.lvl = 1')
            ->getQuery();
        $options = array('decorate' => false);
        $tree = $em->getRepository('AppBundle:Category')->buildTree($query->getArrayResult(), $options);
        return $tree;
    }

    public function findByParentId($parentId)
    {
        $query = $this->getEntityManager()->createQuery(
                'SELECT c FROM AppBundle:Category c WHERE c.parent = :parentId'
            )
            ->setParameter('parentId', $parentId);
        $category = $query->getResult();
        return $category;
    }

    public function findBrothers($parentId, $id)
    {
        $query = $this->getEntityManager()->createQuery(
                'SELECT c FROM AppBundle:Category c WHERE c.parent = :parentId AND c.id != :id'
            )
            ->setParameter('parentId', $parentId)
            ->setParameter('id', $id);
        $category = $query->getResult();
        return $category;
    }
}
