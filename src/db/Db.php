<?php

namespace app\db;

class Db 
{
    protected $con;
    public function __construct()
    {
        $dsn = "mysql:dbname=". DB_NAME . ";host=" . DB_HOST;
        $user = DB_USER;
        $password = DB_PSWD;
        try {
            $this->con = new \PDO($dsn, $user, $password);
            return $this->con;
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }
}

