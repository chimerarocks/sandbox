<?php

return [
	'doctrine' => [
		'connection' => [
			'orm_default' => [
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => [
					'host' => 'localhost',
					'port' => '3306',
					'user' => 'root',
					'password' => '621544',
					'dbname' => 'targetmkt',
					'driverOptions' => [
						\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
					]
				]
			]
		],
		'driver' => [
			'TargetMkt_driver' => [
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => [__DIR__ . '/../../src/TargetMkt/Entity']
			],
			'orm_default' => [
				'drivers' => [
					'TargetMkt\Entity' => 'TargetMkt_driver'
				]
			]
		]
	]
];