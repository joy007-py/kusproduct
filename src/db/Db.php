<?php

namespace app\db;

class Db 
{
    protected $con;
    public function __construct()
    {
        $dsn = 'mysql:dbname=kusproduct;host=127.0.0.1';
        $user = 'root';
        $password = '';
        try {
            $this->con = new \PDO($dsn, $user, $password);
            return $this->con;
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }
}