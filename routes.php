<?php
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
        $product_con->getSingleProductInfoInJSON($_GET['id']);
    }
    elseif ( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        $product_con->updaeInJSON( $_POST['id'], $_POST['name'], $_POST['quantity'], $_POST['price'] );
    }
});

$route->dispatch();