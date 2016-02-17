<?php

    namespace AppBundle\Repository;

    use Doctrine\ORM\EntityRepository;

    /**
     * UserCommentRepository
     */
    class UserCommentRepository extends EntityRepository
    {
        public function getComment($id)
        {
            $query = $this->getEntityManager()->createQuery(
                'SELECT p FROM AppBundle:Comment p WHERE p.id = :id'
            );
            $query->setParameter('id', $id);
            $comment = $query->getResult();

            $data = array();
            $data['comment'] = $comment[0];
            $data['comments'] = $comment[0]->getComments();
            $data['category'] = $comment[0]->getCategory();

            return $data;
        }

        public function searchComment($keys, $sort, $page, $item_no)
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

            $comments = $this->createQueryBuilder('p');
            //add weight
            if (count($keys) > 0) {
                $weight = array();
                foreach ($keys as $key) {
                    array_push($weight, 'SIGN(LOCATE(\''.$key.'\', p.text))');
                }
                $weight = implode(' + ', $weight);
                $comments->select($weight.' as weight');
                $comments->addOrderBy('weight', 'DESC');
            }
            //add left columns
            $comments->addSelect('
                        p.id AS id,
                        p.commentAt AS comment_at,
                        p.star AS star,
                        p.text AS text,
                        p.reply AS reply');
            $comments_no = $this->createQueryBuilder('p');
            $comments_no->select('COUNT(p.id) AS total_no');
            foreach ($keys as $i => $key) {
                $comments->orWhere('LOCATE(:key'.$i.', p.text) > 0')->setParameter('key'.$i, $key);
                $comments_no->orWhere('LOCATE(:key'.$i.', p.text) > 0')->setParameter('key'.$i, $key);
            }
            switch ($sort) {
                case '2':
                    $comments->orderBy('p.commentAt', 'ASC');
                    break;
                case '3':
                    $comments->orderBy('p.commentAt', 'DESC');
                    break;
                case '4':
                    $comments->orderBy('p.star', 'ASC');
                    break;
                case '5':
                    $comments->orderBy('p.star', 'DESC');
                    break;
                case '7':
                    $comments->orderBy('p.id', 'ASC');
                    break;
                case '8':
                    $comments->orderBy('p.id', 'DESC');
                    break;
            }
            if (!(is_numeric($page) && $page > 1)) {
                $page = 1;
            }
            if (!(is_numeric($item_no) && $item_no > 1)) {
                $item_no = 18;
            }
            //$item_no = $item_no <= 18 ? 18 : ($item_no <= 24 ? 24 : 36);
            $comments->setFirstResult(($page-1)*$item_no)
                ->setMaxResults($item_no);
            $data['comments'] = $comments->getQuery()->getResult();
            $total_no = $comments_no->getQuery()->getSingleScalarResult();
            $data['total_page'] = ceil($total_no/$item_no);
            $data['total_no'] = $total_no;
            $data['row_no'] = ceil(count($data['comments'])/3);
            return $data;
        }



        public function findRandomComments($no)
        {
            $em = $this->getEntityManager();
            //$rows = $em->createQuery('SELECT COUNT(p.id) FROM AppBundle:Comment p')->getSingleScalarResult();
            //$offset = max(0, rand(0, $rows - $no + 1));
            $query = $em->createQuery('SELECT p FROM AppBundle:Comment p')
                ->setMaxResults($no);
            //->setFirstResult($offset);
            $comments = $query->getResult();

            return $comments;
        }
    }
