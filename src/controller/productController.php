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
        $model->dumpData( new \app\helper\JsonDumper );

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
     * create a new product using ajax
     * @param string product name
     * @param string product quantity
     * @param string product price
     */
    public function createInJSON( $name, $quantity, $price )
    {
        $model = $this->model();
        echo $model->createNewProductInAjax($name, $quantity, $price);
    }

    /**
     * update in json
     */
    public function updaeInJSON( $id, $name, $quantity, $price )
    {
        $model = $this->model();
        echo $model->updateSingleProductInAJAX( $id, $name, $quantity, $price );
    }


    /**
     * delete an product in json
     * @param string $id id of the product
     */
    public function deleteInJSON( $id )
    {
        $model = $this->model();
        echo $model->deleteInAjax( $id );
    }

    /**
     * get single product info by id
     * @param int $id id of the product
     */
    public function getSingleProductInfoInJSON( $id )
    {
        $model = $this->model();
        echo $model->getSingleProductFromattedDatainJSON( $id );
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