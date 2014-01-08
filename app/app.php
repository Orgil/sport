<?php
session_start();
require_once '../vendor/autoload.php';

// Prepare app
$app = new \Slim\Slim(array(
  'templates.path' => APP_PATH. '/templates',
));

$app->config('debug',true);

ActiveRecord\Config::initialize(function($cfg) {
  $cfg->set_model_directory(APP_PATH.'/models');
  $cfg->set_connections(array('development' => 'mysql://root:root@localhost/sport'));
});


// Prepare view
$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = array(
  'debug'=>true,
  'charset' => 'utf-8',
  'cache' => ROOT_PATH.'/tmp/cache',
  'auto_reload' => true,
  'strict_variables' => false,
  'autoescape' => true
);
$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());

require_once APP_PATH. '/routes/route.php';

// Run app
$app->run();
