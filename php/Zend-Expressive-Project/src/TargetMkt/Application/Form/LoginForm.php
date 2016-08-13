<?php

namespace TargetMkt\Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use TargetMkt\Application\InputFilter\LoginInputFilter;

class LoginForm extends Form
{
	public function __construct($name = 'customer', array $options = [])
	{
		parent::__construct($name, $options);

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
			'name' => 'password',
			'type' => Element\Password::class,
			'options' => [
				'label' => 'Senha'
			],
			'attributes' => [
				'id' => 'password',
				'type' => 'password'
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