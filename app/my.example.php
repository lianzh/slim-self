<?php

// 应用的配置信息 

return [
	'db'	=> [

		'master'	=> [
			'type' => 'mysql',
			'dbpath'  => "mysql:host=127.0.0.1;port=3306;dbname=mautic_ma",
			'login'	=> 'root',
			'password' => 'root',

			'initcmd' => [
					"SET NAMES 'utf8'",
				],

			'attr'	=> [
					PDO::ATTR_PERSISTENT => false,
				],
			'monitor'	=> '\SelfApp\Helper\Selfsql::monitor',
		],

		'slaver'	=> [
			'type' => 'mysql',
			'dbpath'  => "mysql:host=127.0.0.1;port=3306;dbname=mautic_ma",
			'login'	=> 'root',
			'password' => 'root',

			'initcmd' => [
					"SET NAMES 'utf8'",
				],

			'attr'	=> [
					PDO::ATTR_PERSISTENT => false,
				],
			'monitor'	=> '\SelfApp\Helper\Selfsql::monitor',
		],		
	]
];