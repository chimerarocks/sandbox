<?php

namespace Code\System\Service;

use Code\System\Entity\Interest;
use Doctrine\ORM\EntityManager;

class InterestService
{
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function insert(array $data)
	{
		$interest = new Interest();
		$interest->setName($data['name']);

		$this->em->persist($interest);
		$this->em->flush();

		return $interest;
	}

	public function fetchAll()
	{
		return $this->em->getRepository(Interest::class)->findAll();
	}

	public function find($id)
	{
		return $this->em->find(Interest::class, $id);
	}

	public function update($id, array $data)
	{
		$interest = $this->em->getReference(Interest::class, $id);
		$interest->setName($data['name']);

		$this->em->persist($interest);
		$this->em->flush();

		return $interest;
	}

	public function remove($id)
	{
		$interest = $this->em->getReference(Interest::class, $id);
		$this->em->remove($interest);
		$this->em->flush();
		return [
			'success' => true
		];
	}
}