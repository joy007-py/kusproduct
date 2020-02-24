<?php

namespace app;
use \app\controller\productController;

class Router 
{
    /**
     * @var string  server variable
     */
    private $_request_uri;

    /**
     * @var string server request method
     */
    private $_request_method;

    public function __construct( $server )
    {
        $this->_request_uri = $server['REQUEST_URI'];
        $this->_request_method = $server['REQUEST_METHOD'];
    }

    public function dispatch()
    {
        $pro_con = new productController();
        if ( $this->_request_uri == '/' )
        {
            if( $this->_request_method == 'GET' )
            {
                $pro_con->index();
            }
        }
        elseif( $this->_request_uri == '/create' )
        {
            if( $this->_request_method == 'POST' )
            {
                $pro_con->createInJSON( $_POST['name'], $_POST['quantity'], $_POST['price'] );
            }
        }
        elseif( $this->_request_uri == '/update'  )
        {
            if( $this->_request_method == 'POST' )
            {
                echo 'wanna update new product';
            }
        }
        elseif( $this->_request_uri == '/delete'  )
        {
            if( $this->_request_method == 'POST' )
            {
                $pro_con->deleteInJSON( $_POST['id'] );
            }
        }
        else
        {
            echo 'sorry but no route found for your request';
        }
    }
}

