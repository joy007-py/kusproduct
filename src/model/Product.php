<?php

namespace app\model;

use app\db\Db;

class Product extends Db
{
    /**
     * insert new product
     * @param string $name name of the product to be inserted
     * @param integer $quantity quantity of the product
     * @param integer $price price of the product
     * 
     * @return integer the last inserted id of the product
     */
    public function createNewProduct( $name, $quantity, $price )
    {
        if( !$this->validateData( $price, $quantity ) )
            return false;
        $query = $this->con->prepare('INSERT INTO test_product (name, quantity_in_stock, price)
        VALUES (:name, :quantity, :price)');
        $query->bindParam(':name', $name, \PDO::PARAM_STR);
        $query->bindParam(':quantity', $quantity, \PDO::PARAM_STR);
        $query->bindParam(':price', $price, \PDO::PARAM_INT);
        $query->execute();
        return $this->con->lastInsertId();
    } 

    /**
     * Create new product using ajax
     * @param string $name name of the product
     * @param integer $quantity quantity of the product
     * @param integer $price price of the product
     * 
     * @return json return response in json format 
     */
    public function createNewProductInAjax( $name, $quantity, $price  )
    {
        $new_product_id = $this->createNewProduct( $name, $quantity, $price );
        if( !empty( $new_product_id ) )
        {
            $new_product_data = $this->getProductById( $new_product_id );
            $response = array(
                'status' => 'true',
                'product' => $this->reformatData( $new_product_data )
            );
        }
        else
        {
            $response = array(
                'status' => 'false',
                'product' => []
            );
        }
        return \json_encode($response);
    }

    /**
     * get all product data with formatted value
     * 
     * @return array
     */
    public function getAllProductFormattedData()
    {
        $all_products = $this->getAllProduct();
        if ( empty($all_products) ||  !\is_array($all_products) )
        {
            return;
        }
        $data = array();
        foreach( $all_products as  $value )
        {
            $data[] = $this->reformatData( $value );
        }
        return $data;
    }

    /**
     * reformat data
     * @param array $data 
     * @return array
     */
    public function reformatData( $data = array() )
    {
        $output = array();
        if( is_array( $data ) && count( $data ) > 0)
        {
            $output = $data;
            if( array_key_exists('created_at',$output) )
            {
                $dt = new \DateTime($output['created_at']);
                $output['created_at'] = $dt->format('Y-m-d');
            }

            if( array_key_exists('quantity_in_stock',$output) && array_key_exists('price',$output) )
            {
                $output['total_val_num'] = $output['quantity_in_stock'] * $output['price'];
            }
        }
        return $output;
    }   

    /**
     * get product data
     * 
     * @return array
     */
    public function getAllProduct()
    {
        $query = $this->con->prepare('SELECT * FROM test_product ORDER BY created_at DESC');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * get product information by id
     * 
     * @param integer $id
     * 
     * @return array
     */
    public function getProductById( $id )
    {
        $sql = 'SELECT *
            FROM test_product
            WHERE id = :id';
        $sth = $this->con->prepare($sql);
        $sth->execute(array(':id' => $id ));
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * delete product in ajax
     * @param string $id 
     */
    public function deleteInAjax( $id )
    {
        $response = $this->deleteProductById( $id );
        return $this->jsonMsg( $response );
    }


    /**
     * delete an product
     * @param string $id id of the product which will be deleted
     */
    public function deleteProductById( $id )
    {
        $query = $this->con->prepare('DELETE FROM test_product WHERE id = :id');
        $res = $query->execute([
            ':id' => $id,
        ]);
        return $res;
    }

    /**
     * validate data
     * @param float $price
     * @param integer $quantity
     * 
     * apply simple validation to check if price in only number and should not contain any characher 
     * and qunatity is only ineger number also quantity should be greater than zero
     */
    private function validateData( $price, $quantity )
    {

        if( empty($price) || empty($quantity) )
            return false;
        
        if( !is_numeric($price) && !is_numeric($quantity) )
            return false;

        if ( $quantity < 0 )
            return false;

        return true;
    }

    /**
     * return json msg
     */
    private function jsonMsg( $data )
    {
        if($data)
        {
            $respones = array(
                'status' => $data
            );
        }
        else
        {
            $respones = array(
                'status' => 'false'
            );
        }
        return \json_encode($respones);
    }
}