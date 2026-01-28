<?php
function ConnexionBDD() {
    $ctxBDD = null;
    $cnxStr = "mysql:host=localhost;dbname=e-commerce2022-2023;charset=utf8";
    try {
        $ctxBDD = new PDO($cnxStr, 'root', '', array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        ));
    } catch (PDOException $ex) {
        var_dump($ex->getMessage());
        die();
    }finally{
        return $ctxBDD;
    }
}