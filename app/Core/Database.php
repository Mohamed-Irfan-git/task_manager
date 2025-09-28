<?php

namespace App\Core;
class Database{
    public static ?\PDO $pdo = null;

    public static function connect(array $config): \PDO{
        if(self::$pdo){
            return self::$pdo;
        }

        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

        self::$pdo = new \PDO($dsn, $config['user'], $config['pass'], [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ]);

        return self::$pdo;
    }
}