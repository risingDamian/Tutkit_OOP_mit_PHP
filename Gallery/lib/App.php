<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 20.11.17
 * Time: 16:40
 */
class App {

    //Erzeugen von Basis URL des Projektes zur Dynamischen Verwendbarkeit
    public static function getBaseUrl() {
        return "http://localhost:8888/Tutkit_OOP_mit_PHP/Gallery/";
    }

    //Erzeugen von dynamischen Model Aufrufen & instanzierrung
    public static function getModel (string $model) {
        $class= "\\Model\\$model";
        return new $class;
    }

    // s.o.
    public static function getResourceModel (string $model) {
        $class= "\\Model\\Resource\\$model";
        return new $class;
    }
}