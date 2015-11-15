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
        if ($keys) {
            $keys = preg_replace("/(\s+)|(　+)+/", " ", $keys);
            $keys = preg_replace( "/(^\s*)|(\s*$)/ ", "",$keys);
            $keys = preg_replace("/(\s+)/", " ", $keys);
            $keys = explode(" ",$keys);
        }
        else {
            $keys = array();
        }

        $products = $this->createQueryBuilder('p');
        //add weight
        if (count($keys) > 0) {
            $weight = array();
            foreach ($keys as $key) {
                array_push($weight, 'SIGN(LOCATE(\''.$key.'\', p.name))');
            }
            $weight = implode(' + ', $weight);
            $products->select($weight.' as weight');
            $products->addOrderBy('weight', 'DESC');
        }
        //add left columns
        $products->addSelect('
                        p.id AS id, 
                        p.name AS name,
                        p.price AS price,
                        p.price_discounted AS priceDiscounted,
                        p.soldNo AS soldNo,
                        p.click AS click');
        $products_no = $this->createQueryBuilder('p');
        $products_no->select('COUNT(p.id) AS total_no');
        foreach ($keys as $i => $key) {
            // $products->orWhere('p.name LIKE ?'.$i)->setParameter($i, '%'.$key.'%');
            // $products_no->orWhere('p.name LIKE ?'.$i)->setParameter($i, '%'.$key.'%');
            $products->orWhere('LOCATE(:key'.$i.', p.name) > 0')->setParameter('key'.$i, $key);
            $products_no->orWhere('LOCATE(:key'.$i.', p.name) > 0')->setParameter('key'.$i, $key);
        }
        //1 = update(default), 2 = price+, 3 = price-, 4 = soldNo-, 5 = date-
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
            case '6':
                $products->orderBy('p.click', 'DESC');
                break;
            default:
                $products->addOrderBy('p.updateAt', 'DESC');
                break;
        }
        if (!(is_numeric($page) && $page > 1)) {
            $page = 1;
        }
        if (!(is_numeric($item_no) && $item_no > 1)) {
            $item_no = 1;
        }
        $item_no = $item_no <= 18 ? 18 : ($item_no <= 24 ? 24 : 36);
        $products->setFirstResult(($page-1)*$item_no)
                ->setMaxResults($item_no);
        $data['products'] = $products->getQuery()->getResult();
        $total_no = $products_no->getQuery()->getSingleScalarResult();
        $data['total_page'] = ceil($total_no/$item_no);
        $data['total_no'] = $total_no;
        $data['row_no'] = ceil(count($data['products'])/3);
        return $data;
    }



    public function findRandomProducts($no)
    {
        $em = $this->getEntityManager();
        $rows = $em->createQuery('SELECT COUNT(p.id) FROM AppBundle:Product p')->getSingleScalarResult();
        $offset = max(0, rand(0, $rows - $no + 1));
        $query = $em->createQuery('SELECT p FROM AppBundle:Product p')
            ->setMaxResults($no)
            ->setFirstResult($offset);
        $products = $query->getResult();

        return $products;
    }
}
