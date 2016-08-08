<?php

namespace Code\System\Entity;

use Doctrine\ORM\EntityRepository;

class ClientRepository extends EntityRepository 
{
	public function getOrderedClientsBy($column, $direction = 'asc')
	{
		return $this
				->createQueryBuilder('c')
				->orderBy('c.' . $column, $direction)
				->getQuery()
				->getResult()
		;
	}

	public function getOrderedClientsDesc()
	{
		$dql = "SELECT c FROM Cody\System\Entity\Client c
			ORDER BY c.name DESC";

		return $this
				->getEntityManager()
				->createQuery($sql)
				->getResult()
		;
	}
}