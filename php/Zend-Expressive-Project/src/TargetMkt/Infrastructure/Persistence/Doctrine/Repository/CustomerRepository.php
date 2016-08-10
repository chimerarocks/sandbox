<?php

namespace TargetMkt\Infrastructure\Persistence\Doctrine\Repository;

use TargetMkt\Domain\Repository\CustomerRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class CustomerRepository extends EntityRepository implements CustomerRepositoryInterface
{
	public function create($entity)
	{
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush();
		return $entity;
	}
	public function update($entity)
	{
			
	}
	public function remove($entity)
	{
		
	}
	public function find($id)
	{
		
	}
	public function findAll()
	{
		return parent::findAll();
	}
}