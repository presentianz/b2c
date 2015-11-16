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
        //1 = update(default), 2 = price+, 3 = price-, 4 = soldNo-, 5 = date-, 6 = click-, 7 = id+
        //8 = id-, 9 = name+, 10 = name-, 11 = disprice+, 12 = disprice-, 13 = click+, 14 = soldNo+
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
            case '7':
                $products->orderBy('p.id', 'ASC');
                break;
            case '8':
                $products->orderBy('p.id', 'DESC');
                break;
            case '9':
                $products->orderBy('p.name', 'ASC');
                break;
            case '10':
                $products->orderBy('p.name', 'DESC');
                break;
            case '11':
                $products->orderBy('p.price_discounted', 'ASC');
                break;
            case '12':
                $products->orderBy('p.price_discounted', 'DESC');
                break;
            case '13':
                $products->orderBy('p.click', 'ASC');
                break;
            case '6':
                $products->orderBy('p.click', 'DESC');
                break;
            case '14':
                $products->orderBy('p.soldNo', 'ASC');
                break;
            case '4':
                $products->orderBy('p.soldNo', 'DESC');
                break;
            default:
                $products->addOrderBy('p.updateAt', 'DESC');
                break;
        }
        if (!(is_numeric($page) && $page > 1)) {
            $page = 1;
        }
        if (!(is_numeric($item_no) && $item_no > 1)) {
            $item_no = 18;
        }
        //$item_no = $item_no <= 18 ? 18 : ($item_no <= 24 ? 24 : 36);
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
