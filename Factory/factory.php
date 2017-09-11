<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 08.09.17
 * Time: 16:50
 */
use Email\ServiceFactory as Factory;

function autoloader($class) {
    $newName = str_replace('\\', '/', $class);
    $path = "lib/$newName.php";

    if(!class_exists($class) && file_exists($path)) {
        require $path;
    }
}
spl_autoload_register('autoloader');

ini_set('display_errors', true);

$mailConfig = array('anbieter' => "Gmail");

$mailService = Factory::create($mailConfig['anbieter']);
$mailService->send("Testbetreff", "Hallo Jan");