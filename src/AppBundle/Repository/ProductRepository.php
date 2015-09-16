<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 */
class ProductRepository extends EntityRepository
{
    public function getProduct($id)
    {
        $query = $this->getEntityManager()->createQuery(
                'SELECT p FROM AppBundle:Product p WHERE p.id = :id'
            );
        $query->setParameter('id', $id);
        $product = $query->getResult();

        $data = array();
        $data['product'] = $product[0];
        $data['comments'] = $product[0]->getComments();
        $data['category'] = $product[0]->getCategory();

        return $data;
    }

    public function searchProduct($keys, $sort, $page, $item_no)
    {
        $products = $this->createQueryBuilder('p');
        $products_no = $this->createQueryBuilder('p');
        $products_no->select('COUNT(p.id) AS total_no');
        if ($keys) {
            $keys = explode(' ', $keys);
            foreach ($keys as $key => $value) {
                if ($value == '') {
                    unset($keys[$key]);
                }
            }
            if (count($keys) == 0) {
                $keys = array();
            }
        }
        else {
            $keys = array();
        }
        foreach ($keys as $i => $key) {
            $products->orWhere('p.name LIKE ?'.$i)->setParameter($i, '%'.$key.'%');
            $products_no->orWhere('p.name LIKE ?'.$i)->setParameter($i, '%'.$key.'%');
        }
        //1 = name(default), 2 = price+, 3 = price-, 4 = soldNo-, 5 = date-
        switch ($sort) {
            case '2':
                $products->orderBy('p.price', 'ASC');
                break;
            case '3':
                $products->orderBy('p.price', 'DESC');
                break;
            case '4':
                $products->orderBy('p.soldNo', 'DESC');
                break;
            case '5':
                $products->orderBy('p.updateAt', 'DESC');
                break;
            default:
                $products->orderBy('p.name');
                break;
        }
        if (!(is_numeric($page) && $page > 1)) {
            $page = 1;
        }
        if (!(is_numeric($item_no) && $item_no > 1)) {
            $item_no = 1;
        }
        $item_no = $item_no <= 1 ? 1 : ($item_no <= 2 ? 2 : 3);
        $products->setFirstResult(($page-1)*$item_no)
                ->setMaxResults($item_no);
        $data['products'] = $products->getQuery()->getResult();
        $total_no = $products_no->getQuery()->getResult();
        $data['total_page'] = ceil($total_no[0]['total_no']/$item_no);
        return $data;
    }
}
