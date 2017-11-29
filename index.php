<?php
require __DIR__ . '/vendor/autoload.php';

session_start();

// load globalfunc
require __DIR__ . '/app/globalfunc.php';

classLoader()->addPsr4('SelfApp\\', __DIR__ . '/app/classes');

PHP_SAPI === 'cli' and \SelfApp\Helper\CLI::initCliArgv();

// Instantiate the app
$settings = require __DIR__ . '/app/settings.php';

// \SelfApp\Service\ErrorHandler::init($setting['my']['ErrorHandler']);

$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/app/dependencies.php';

// Register middleware
require __DIR__ . '/app/middleware.php';

// Register routes
require __DIR__ . '/app/routes.php';

// Run app
$app->run();
