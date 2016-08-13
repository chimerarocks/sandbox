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
				'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
				'cache' => 'array',
				'paths' => [__DIR__ . '/../../src/TargetMkt/Infrastructure/Persistence/Doctrine/ORM']
			],
			'orm_default' => [
				'drivers' => [
					'TargetMkt\Domain\Entity' => 'TargetMkt_driver'
				]
			]
		],
		'authentication' => [
            'orm_default' => [
                'object_manager' => \Doctrine\ORM\EntityManager::class,
                'identity_class' => \TargetMkt\Domain\Entity\User::class,
                'identity_property' => 'email',
                'credential_property' => 'password',
            ],
        ],
	]
];