<?php

$forms = [
	'dependencies' => [
		'aliases' => [

		],
		'invokables' => [
		],
		'factories' => [
			Zend\View\HelperPluginManager::class => 
				TargetMkt\Infrastructure\View\HelperPluginManagerFactory::class,
			TargetMkt\Application\Form\CustomerForm::class =>
				TargetMkt\Application\Form\Factory\CustomerFormFactory::class,
		]
	],
	'view_helpers' => [
		'aliases' => [
		],
		'invokables' => [
		],
		'factories' => [
		]
	]
];

$configProviderForm = (new \Zend\Form\ConfigProvider())->__invoke();

return \Zend\Stdlib\ArrayUtils::merge($configProviderForm, $forms);