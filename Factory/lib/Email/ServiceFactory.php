<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 11.09.17
 * Time: 10:08
 */
namespace Email;

class ServiceFactory {
    public static function create(string $service) {
        $class = "\\Email\\Service\\$service";
        return new $class();
    }
}