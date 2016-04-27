<?php 
   
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT . DS . 'views');

require_once(ROOT . DS . 'lib' . DS . 'init.php');
require_once(ROOT . DS . 'config' . DS . 'config.php');

$session = new Session();
$session->init();
$container->share($session);

$uri = $_SERVER['REQUEST_URI'];

// create router
$router = new Router($config, $uri);

// create request
$request = new Request($uri);
$container->share($request);

$accessController = new AccessController($session, $request);

// create app
$app = new Application($accessController, $container, $router);
$app->run();

//var_dump($_SESSION);


