<?php

namespace app\controller;

use app\model\Product;

class siteController
{
    public function index()
    {
        $model = new Product();

        return $this->render( 'product.php', [
            'data' => $model->getProductById(1),
            'name' => 'my name'
        ] );
    }

    private function render( $file_name, $data = array() )
    {
        \extract($data);
        \ob_start();
        include PROJECT_DIR . '/src/views/' . $file_name;
    }
}