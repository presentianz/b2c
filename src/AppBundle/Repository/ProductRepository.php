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
}
