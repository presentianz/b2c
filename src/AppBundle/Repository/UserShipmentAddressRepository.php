<?php

    namespace AppBundle\Repository;

    use Doctrine\ORM\EntityRepository;

    /**
     * UserShipmentAddressRepository
     */
    class UserShipmentAddressRepository extends EntityRepository
    {
        public function getAddress($id)
        {
            $query = $this->getEntityManager()->createQuery(
                'SELECT p FROM AppBundle:Address p WHERE p.id = :id'
            );
            $query->setParameter('id', $id);
            $address = $query->getResult();

            $data = array();
            $data['address'] = $address[0];
            $data['addresses'] = $address[0]->getAddresses();
            $data['category'] = $address[0]->getCategory();

            return $data;
        }

        public function searchAddress($keys, $sort, $page, $item_no)
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

            $addresses = $this->createQueryBuilder('p');
            //add weight
            if (count($keys) > 0) {
                $weight = array();
                foreach ($keys as $key) {
                    array_push($weight, 'SIGN(LOCATE(\''.$key.'\', p.address))');
                }
                $weight = implode(' + ', $weight);
                $addresses->select($weight.' as weight');
                $addresses->addOrderBy('weight', 'DESC');
            }
            //add left columns
            $addresses->addSelect('
                        p.id AS id,
                        p.country AS country,
                        p.region AS region,
                        p.city AS city,
                        p.address AS address,
                        p.postCode AS post_code,
                        p.name AS name,
                        p.contactNo AS contact_no,
                        p.phoneNo AS phone_no,
                        p.comment AS comment
                        ');
            $addresses_no = $this->createQueryBuilder('p');
            $addresses_no->select('COUNT(p.id) AS total_no');
            foreach ($keys as $i => $key) {
                $addresses->orWhere('LOCATE(:key'.$i.', p.address) > 0')->setParameter('key'.$i, $key);
                $addresses_no->orWhere('LOCATE(:key'.$i.', p.address) > 0')->setParameter('key'.$i, $key);
            }
            switch ($sort) {
                case '2':
                    $addresses->orderBy('p.country', 'ASC');
                    break;
                case '3':
                    $addresses->orderBy('p.country', 'DESC');
                    break;
                case '4':
                    $addresses->orderBy('p.region', 'ASC');
                    break;
                case '5':
                    $addresses->orderBy('p.region', 'DESC');
                    break;
                case '6':
                    $addresses->orderBy('p.city', 'ASC');
                    break;
                case '7':
                    $addresses->orderBy('p.city', 'DESC');
                    break;
                case '8':
                    $addresses->orderBy('p.postCode', 'ASC');
                    break;
                case '9':
                    $addresses->orderBy('p.postCode', 'DESC');
                    break;
                case '10':
                    $addresses->orderBy('p.name', 'ASC');
                    break;
                case '11':
                    $addresses->orderBy('p.name', 'DESC');
                    break;
                case '12':
                    $addresses->orderBy('p.id', 'ASC');
                    break;
                case '13':
                    $addresses->orderBy('p.id', 'DESC');
                    break;
                default:
                    $addresses->orderBy('p.id', 'ASC');
                    break;
            }
            if (!(is_numeric($page) && $page > 1)) {
                $page = 1;
            }
            if (!(is_numeric($item_no) && $item_no > 1)) {
                $item_no = 18;
            }
            $addresses->setFirstResult(($page-1)*$item_no)
                ->setMaxResults($item_no);
            $data['addresses'] = $addresses->getQuery()->getResult();
            $total_no = $addresses_no->getQuery()->getSingleScalarResult();
            $data['total_page'] = ceil($total_no/$item_no);
            $data['total_no'] = $total_no;
            $data['row_no'] = ceil(count($data['addresses'])/3);
            return $data;
        }



        public function findRandomAddresses($no)
        {
            $em = $this->getEntityManager();
            //$rows = $em->createQuery('SELECT COUNT(p.id) FROM AppBundle:Address p')->getSingleScalarResult();
            //$offset = max(0, rand(0, $rows - $no + 1));
            $query = $em->createQuery('SELECT p FROM AppBundle:Address p')
                ->setMaxResults($no);
            //->setFirstResult($offset);
            $addresses = $query->getResult();

            return $addresses;
        }
    }
