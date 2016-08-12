<?php

namespace TargetMkt\Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use TargetMkt\Application\InputFilter\CustomerInputFilter;

class CustomerForm extends Form
{
	public function __construct($name = 'customer', array $options = [])
	{
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
			'type' => Element\Text::class,
			'options' => [
				'label' => 'Email'
			],
			'attributes' => [
				'id' => 'email',
				'type' => 'email'
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