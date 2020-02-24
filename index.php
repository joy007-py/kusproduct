<?php

require 'vendor/autoload.php';

define('PROJECT_DIR', __DIR__);

use \app\Router;

$router = new Router($_SERVER);
$router->dispatch();

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';


