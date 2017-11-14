<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new \Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// db
$container['db'] = function ($c) {
	$settings = $c->get('settings')['my']['db'];
	$selfsql = new \SelfApp\Helper\Selfsql($settings);
	return $selfsql;
};

// mail
$container['mail'] = function ($c) {
    $settings = (array) $c->get('settings')['my']['mail'];
    $settings['logger'] = $c->logger;
    $mail = new \LianzhMail\MailHelper($settings);
    return $mail;
};