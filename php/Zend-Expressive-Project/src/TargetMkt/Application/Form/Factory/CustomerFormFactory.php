<?php

namespace TargetMkt\Application\Form\Factory;

use Zend\Hydrator\ClassMethods;
use TargetMkt\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;
use TargetMkt\Application\Form\CustomerForm;
use TargetMkt\Application\InputFilter\CustomerInputFilter;

class CustomerFormFactory
{
	public function __invoke(ContainerInterface $container)
	{
		$form = new CustomerForm();
		$form->setHydrator(new ClassMethods());
		$form->setObject(new Customer());
		$form->setInputFilter(new CustomerInputFilter());

		return $form;		
	}
}