<?php

namespace Code\System\Entity;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository 
{
	public function getOrderedProductsBy($column, $direction = 'asc')
	{
		return $this
				->createQueryBuilder('p')
				->orderBy('p.' . $column, $direction)
				->getQuery()
				->getResult()
		;
	}

	public function getOrderedProductsDesc()
	{
		$dql = "SELECT p FROM Cody\System\Entity\Product p
			ORDER BY p.name DESC";

		return $this
				->getEntityManager()
				->createQuery($sql)
				->getResult()
		;
	}
}