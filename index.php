<?php

require 'vendor/autoload.php';

define('PROJECT_DIR', __DIR__);
define('DB_NAME', 'kusproduct');
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PSWD', '');

use \app\route\Router;
use \app\controller\productController;

$route = new Router();

$route->add('/',function(){
    $product_con = new productController();
    $product_con->index();
});

$route->add('/create', function(){
    $product_con = new productController();
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        $product_con->createInJSON( $_POST['name'], $_POST['quantity'], $_POST['price'] );
    }
});

$route->add('/delete', function(){
    $product_con = new productController();
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        $product_con->deleteInJSON( $_POST['id'] );
    }
});

$route->add('/edit', function(){
    $product_con = new productController();
    if ( $_SERVER['REQUEST_METHOD'] == 'GET' )
    {
        echo $product_con->getSingleProductInfoInJSON($_GET['id']);
    }
    elseif ( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        echo 'fire edit request';
    }
});

$route->dispatch();
