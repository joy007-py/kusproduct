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
     * @return bool
     */
    public function createNewProduct( $name, $quantity, $price )
    {
        if( !$this->validateData( $price, $quantity ) )
            return false;
        $query = $this->con->prepare('INSERT INTO test_product (name, quantity_in_stock, price)
        VALUES (:name, :quantity, :price)');
        $res = $query->execute([
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
        ]);
        return $res;
    } 

    /**
     * get all product data with formatted value
     */
    public function getAllProductFormattedData()
    {
        $all_products = $this->getAllProduct();
        if ( empty($all_products) ||  !\is_array($all_products) )
        {
            return;
        }
        $data = array();
        $counter = 1;
        foreach( $all_products as  $value )
        {
            $dt = new \DateTime($value['created_at']);
            $data[] = array(
                'id' => $counter,
                'name' => $value['name'],
                'in_stock' => $value['quantity_in_stock'],
                'price' => $value['price'],
                'created_at' => $dt->format('Y-m-d'),
                'total_val_num' => $value['quantity_in_stock'] * $value['price']
            );
            $counter += 1;
        }
        return $data;
    }

    /**
     * get product data
     * 
     * @return array
     */
    public function getAllProduct()
    {
        $query = $this->con->prepare('SELECT * FROM test_product');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * get product information by id
     * 
     * @param $id
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
}