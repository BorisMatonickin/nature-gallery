<?php

use Auryn\Injector;

$objectFactory = new ObjectFactory();  
$container = new Injector();

$config = $container->make('Config');
$config->setSetting('siteName', 'Nature Gallery');
$config->setSetting('languages', ['en', 'cro']);

// Routes
$config->setSetting('routes', [
    'default' => '',
    'admin' => 'admin_',
]);

$config->setSetting('defaultRoute', 'default');
$config->setSetting('defaultLanguage', 'en');
$config->setSetting('defaultController', 'default');
$config->setSetting('defaultAction', 'index');

$config->setSetting('dbHost', 'localhost');
$config->setSetting('dbUser', '');
$config->setSetting('dbPassword', '');
$config->setSetting('dbName', 'nature_gallery');

$container->share($config);

