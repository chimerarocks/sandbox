<?php

namespace TargetMkt\Application\Form\Factory;

use Zend\Hydrator\ClassMethods;
use TargetMkt\Domain\Entity\Customer;
use Interop\Container\ContainerInterface;
use TargetMkt\Application\Form\LoginForm;
use TargetMkt\Application\InputFilter\LoginInputFilter;

class LoginFormFactory
{
	public function __invoke(ContainerInterface $container)
	{
		$form = new LoginForm();
		//$form->setHydrator(new ClassMethods());
		//$form->setObject(new Customer());
		$form->setInputFilter(new LoginInputFilter());

		return $form;		
	}
}