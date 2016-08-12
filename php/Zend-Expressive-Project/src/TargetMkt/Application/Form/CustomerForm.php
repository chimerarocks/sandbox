<?php

namespace TargetMkt\Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Hydrator\ClassMethods;
use TargetMkt\Domain\Entity\Customer;

class CustomerForm extends Form
{
	public function __construct($name = 'customer', array $options = [])
	{
		$this->setHydrator(new ClassMethods());
		$this->setObject(new Customer());
		parent::__construct($name, $options);

		$this->add([
			'name' => 'id',
			'type' => Element\Hidden::class 
		]);

		$this->add([
			'name' => 'name',
			'type' => Element\Text::class,
			'options' => [
				'label' => 'Nome'
			],
			'attributes' => [
				'id' => 'name'
			]
		]);

		$this->add([
			'name' => 'email',
			'type' => Element\Email::class,
			'options' => [
				'label' => 'Email'
			],
			'attributes' => [
				'id' => 'email'
			]
		]);

		$this->add([
			'name' => 'submit',
			'type' => Element\Button::class,
			'attributes' => [
				'type' => 'submit'
			]
		]);
	}
}