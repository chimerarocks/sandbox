<?php

namespace TargetMkt\Application\InputFilter;

use Zend\InputFilter\InputFilter;
use Zend\Filter;
use Zend\Validator;

class CustomerInputFilter extends InputFilter
{
	public function __construct()
	{
		$this->add([
			'name' => 'name',
			'required' => false,
			'filters' => [
				['name' => Filter\StringTrim::class],
				['name' => Filter\StripTags::class]
			]
		]);

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
							Validator\EmailAddress::INVALID =>	'Este email não é válido.' 
						]
					]
				]
			]
		]);
	}
}