<?php

namespace app\controller;

use app\model\Product;

class productController
{

    /**
     * render all product
     */
    public function index()
    {
        $model = $this->model();

        return $this->render( 'product.php', [
            'data' => $model->getAllProductFormattedData(),
        ] );
    }

    /**
     * create a new product
     * @param string product name
     * @param string product quantity
     * @param string product price
     */
    public function create( $name, $quantity, $price )
    {
        $model = $this->model();
        if ( $model->createNewProduct( $name, $quantity, $price ) )
            echo 'product created';
        else
            echo 'sorry some error whappen';
    }

    /**
     * load the product model
     * @return object
     */
    public function model()
    {
        return new Product();
    }


    /**
     * render a view file
     * @param string $file_name name of the view file in the form of file.php
     * @param array  $data data which will be proccess on the view file
     */
    private function render( $file_name, $data = array() )
    {
        \extract($data);
        \ob_start();
        include PROJECT_DIR . '/src/views/' . $file_name;
    }
}