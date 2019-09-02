<?php 

class Db
{
    public static function getConnection()
    {
        $pathParamsForDb = ROOT . '/config/db_params.php';

        $params = include($pathParamsForDb);
        
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}