<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $n = new \LianzhSQL\SqlError("ddddddd");
    var_dump($n->getMessage());

    $n = \LianzhSQL\Sql::ds([
    		'type' => 'mysql',
			'dbpath'  => "mysql:host=127.0.0.1;port=3306;dbname=mautic_ma",
			'login'	=> 'root',
			'password' => '123456',

			'initcmd' => [
					"SET NAMES 'utf8'",
				],

			'attr'	=> [
					PDO::ATTR_PERSISTENT => false,
				],
    	]);

    \SelfApp\Hello::info();

    $arr = $n->all('show tables');

    print_r($arr);

    $arr = $this->db->sqlMaster()->getDataSource()->all('show tables');

    print_r($arr);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
