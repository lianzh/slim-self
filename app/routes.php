<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    \SelfApp\Hello::info();

    $arr = $this->db->sqlMaster()->getDataSource()->all('show tables');

    print_r($arr);

    \LianzhMail\MailHelper::thisIsExample($this->mail);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
