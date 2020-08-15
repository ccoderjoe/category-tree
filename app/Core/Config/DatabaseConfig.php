<?php

namespace App\Core\Config;

class DatabaseConfig
{
    public static function getConfig(): array
    {
        return $config = [
            'dbType' => 'mysql',
            'host' => 'localhost',
            'dbName' => 'web_tree',
            'user' => 'root',
            'password' => 'vp2211'
        ];
    }
}