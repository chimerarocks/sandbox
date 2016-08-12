<?php

namespace TargetMkt\Infrastructure\Persistence\Doctrine\DataFixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TargetMkt\Domain\Entity\Customer;
use Faker\Factory as Faker;

class CustomerFixture implements FixtureInterface {


	//./vendor/bin/doctrine-module data-fixture:import --purge-with-truncate
	public function load(ObjectManager $manager)
	{
		$faker = Faker::create();
		foreach (range(1,100) as $value) {
			$customer = new Customer();
			$customer
			    ->setName($faker->firstName . ' ' . $faker->lastName)
				->setEmail($faker->email)
			;
			$manager->persist($customer);
		}

		$manager->flush();
	}
}