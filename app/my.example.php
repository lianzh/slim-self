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
					\PDO::ATTR_PERSISTENT => false,
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
					\PDO::ATTR_PERSISTENT => false,
				],
			'monitor'	=> '\SelfApp\Helper\Selfsql::monitor',
		],		
	],


	'mail'	=> [

		'driver'       => 'smtp', #Supported: "smtp", "mail", "sendmail"
	    'host' => 'smtp.exmail.qq.com',
	    'port' => 465,
	    'encryption' => 'ssl',
	    'username' => "yourname",
	    'password' =>"yourpass",
	    'pretend' => 1,#When this option is enabled, the message will not be sent, but written in the log file

	    'from' => ['address' => 'youraddress', 'name' => 'yoursitetitle'],

	],	

	'ErrorHandler'	=> [
		'level' => E_ALL | E_STRICT,
        'exception' => 'SelfApp\\Helper\\ErrorHandler::exception',
        'userlevel' => 'SelfApp\\Helper\\ErrorHandler::userlevel',
        'fatal'     => 'SelfApp\\Helper\\ErrorHandler::fatal',
	],
];