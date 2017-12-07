<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 12.09.17
 * Time: 16:14
 */
namespace Model\Resource;

class Base {

    protected function connect() {
        $dataSource = "mysql:host=localhost;dbname=bilder";
        return new \PDO($dataSource, "root", "root");
    }
}