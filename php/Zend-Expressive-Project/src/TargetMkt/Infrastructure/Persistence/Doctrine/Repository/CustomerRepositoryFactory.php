<?php

namespace TargetMkt\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use TargetMkt\Domain\Entity\Customer;

class CustomerRepositoryFactory
{
	public function __invoke(ContainerInterface $container)
	{
		$entityManager = $container->get(EntityManager::class);
		return $entityManager->getRepository(Customer::class);
	}
}