<?php

namespace TargetMkt\Application\InputFilter;

use Zend\InputFilter\InputFilter;
use Zend\Filter;
use Zend\Validator;

class LoginInputFilter extends InputFilter
{
	public function __construct()
	{
		$this->add([
			'name' => 'email',
			'required' => true,
			'filters' => [
				['name' => Filter\StringTrim::class],
			],
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'options' => [
						'messages' => [
							Validator\NotEmpty::IS_EMPTY =>	'Este campo é obrigatório.' 
						]
					]
				],
				[
					'name' => Validator\EmailAddress::class,
					'options' => [
						'messages' => [
							Validator\EmailAddress::INVALID =>	'Este email não é válido.',
							Validator\EmailAddress::INVALID_FORMAT =>	'Este email não é válido.'
						]
					]
				]
			]
		]);

		$this->add([
			'name' => 'password',
			'required' => true,
			'validators' => [
				[
					'name' => Validator\NotEmpty::class,
					'break_chain_on_failure' => true,
					'options' => [
						'messages' => [
							Validator\NotEmpty::IS_EMPTY =>	'Este campo é obrigatório.' 
						]
					]
				],
			]
		]);		
	}
}