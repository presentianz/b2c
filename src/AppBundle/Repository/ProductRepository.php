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
            $query = $this->getEntityManager()->createQuery('SELECT p FROM AppBundle:Product p WHERE p.id = :id');
            $query->setParameter('id', $id);
            $product = $query->getResult();

            $data = array();
            $data['product'] = $product[0];
            $data['comments'] = $product[0]->getComments();
            $data['category'] = $product[0]->getCategory();

            return $data;
        }

        public function searchProduct($keys, $sort, $page, $item_no, $widget = null)
        {
            if ($keys) {
                $keys = preg_replace("/(\s+)|(　+)+/", " ", $keys);
                $keys = preg_replace("/(^\s*)|(\s*$)/ ", "", $keys);
                $keys = preg_replace("/(\s+)/", " ", $keys);
                $keys = explode(" ", $keys);
            } else {
                $keys = array();
            }

            $products = $this->createQueryBuilder('p');
            //add weight
            if (count($keys) > 0) {
                $weight = array();
                foreach ($keys as $key) {
                    array_push($weight, 'SIGN(LOCATE(\'' . $key . '\', p.name))');
                }
                $weight = implode(' + ', $weight);
                $products->select($weight . ' as weight');
                $products->addOrderBy('weight', 'DESC');
            }
            //add left columns
            $products->addSelect('
                        p.id AS id, 
                        p.name AS name,
                        p.price AS price,
                        p.price_discounted AS priceDiscounted,
                        p.viewed_count AS viewedCount,
                        p.soldNo AS soldNo,
                        p.inventory AS inventory,
                        p.description AS discription,
                        p.weight AS weight,
                        p.status AS status,
                        p.productKey AS productKey,
                        p.poster AS poster,
                        p.widget_weight AS widget_weight,
                        p.click AS click,
                        p.brand As brand,
                        p.imageLink AS imageLink');
            $products_no = $this->createQueryBuilder('p');
            $products_no->select('COUNT(p.id) AS total_no');
            foreach ($keys as $i => $key) {
                // $products->orWhere('p.name LIKE ?'.$i)->setParameter($i, '%'.$key.'%');
                // $products_no->orWhere('p.name LIKE ?'.$i)->setParameter($i, '%'.$key.'%');
                $products->orWhere('LOCATE(:key' . $i . ', p.name) > 0')->setParameter('key' . $i, $key);
                $products_no->orWhere('LOCATE(:key' . $i . ', p.name) > 0')->setParameter('key' . $i, $key);
            }

            if (is_numeric($widget) && $widget != 0) {
                $products->andWhere('p.index_widget = ' . $widget);
            }

            //1 = update(default), 2 = price+, 3 = price-, 4 = soldNo-, 5 = date-, 6 = click-, 7 = id+,
            //8 = id-, 9 = name+, 10 = name-, 11 = disprice+, 12 = disprice-, 13 = click+, 14 = soldNo+,
            //15 = inventory+， 16 = invertory-
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
                case '14':
                    $products->orderBy('p.soldNo', 'ASC');
                    break;
                case '15':
                    $products->orderBy('p.inventory', 'ASC');
                    break;
                case '16':
                    $products->orderBy('p.inventory', 'DESC');
                    break;
                case '17':
                    $products->orderBy('p.widget_weight', 'ASC');
                    break;
                case '18':
                    $products->orderBy('p.widget_weight', 'DESC');
                    break;
                case '19':
                    $products->orderBy('p.viewed_count', 'DESC');
                    break;
                case '20':
                    $products->orderBy('p.viewed_count', 'DESC');
                    break;   
                default:
                    $products->addOrderBy('p.updateAt', 'DESC');
                    break;
            }
            if (! (is_numeric($page) && $page > 1)) {
                $page = 1;
            }
            //if (! (is_numeric($item_no) && $item_no > 1)) {
            //    $item_no = 18;
            //}
            //$item_no = $item_no <= 18 ? 18 : ($item_no <= 24 ? 24 : 36);

            $products->setFirstResult(($page - 1) * $item_no)->setMaxResults($item_no);
            $data['products'] = $products->getQuery()->getResult();
            $total_no = $products_no->getQuery()->getSingleScalarResult();
            $data['total_no'] = $total_no;
            $data['row_no'] = ceil(count($data['products']) / 3);
            if ( (is_numeric($item_no) && $item_no > 1) ) {
                $data['total_page'] = ceil($total_no / $item_no);
            } else {
                $data['total_page'] = 1;
            }
            return $data;
        }


        public function findRandomProducts($no)
        {
            $em = $this->getEntityManager();
            //$rows = $em->createQuery('SELECT COUNT(p.id) FROM AppBundle:Product p')->getSingleScalarResult();
            //$offset = max(0, rand(0, $rows - $no + 1));
            $query = $em->createQuery('SELECT p FROM AppBundle:Product p')->setMaxResults($no);
            //->setFirstResult($offset);
            $products = $query->getResult();

            return $products;
        }

        /**
         * @param $widget
         * @param $num
         * @return mixed
         */
        public function findIndexWidgetProducts($widget, $num)
        {
            $query = $this->createQueryBuilder('p')->where('p.index_widget = ' . $widget)->orderBy('p.widget_weight', 'DESC')->setMaxResults($num)->getQuery();

            $products = $query->getResult();
            return $products;
        }

    }
