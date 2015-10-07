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

            default:
                $orderby = 'p.name ASC';
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
                'SELECT c.name AS category_name, p.id, p.name, p.price AS price, p.price_discounted AS priceDiscounted, p.soldNo AS soldNo, p.inventory, p.status, p.updateAt 
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
        $total = $query_total->getResult();

        $data = array();
        $data['products'] = $products;
        $data['total_page'] = ceil($total[0]['total']/$item_no);
        $data['path'] = $gEM->getRepository('AppBundle:Category')->getPath($this_root);
        $data['children'] = $gEM->getRepository('AppBundle:Category')->children($this_root, true);
        $data['row_no'] = ceil(count($data['products'])/3);

        return $data;
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
}
