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
    public function insertNewProduct( $name, $quantity, $price )
    {
        $query = $this->con->prepare('INSERT INTO kus_product (name, quantity_in_stock, price)
        VALUES (:name, :quantity, :price)');
        $res = $query->execute([
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
        ]);
        return $res;
    }

    /**
     * get product data
     * 
     * @return array
     */
    public function getAllProduct()
    {
        $query = $this->con->prepare('SELECT * FROM kus_product');
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * get product by id
     * 
     * @param $id
     * 
     * @return array
     */
    public function getProductById( $id )
    {
        $sql = 'SELECT *
            FROM kus_product
            WHERE id = :id';
        $sth = $this->con->prepare($sql);
        $sth->execute(array(':id' => $id ));
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }
}