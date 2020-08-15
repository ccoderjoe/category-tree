<?php

namespace App\Core;

use App\Core\Config\DatabaseConfig;
use PDO;

class Database
{
    private $connection;

    public static $instance = null;

    public function __construct()
    {
        if (self::$instance === null) {
            self::$instance = $this;
        }

//        $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
        $config = DatabaseConfig::getConfig();
        $this->connection = new PDO(
            $config['dbType'] . ':host=' . $config['host'] . ';dbname=' . $config['dbName'],
            $config['user'],
            $config['password']);
    }

    public static function getInstance(): self
    {
        return self::$instance ?? new Database();
    }

    public function connection()
    {
        return $this->connection;
    }
}