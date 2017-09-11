<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 11.09.17
 * Time: 13:40
 */

function autoloader($class) {
    $newName = str_replace('\\', '/', $class);
    $path = "lib/$newName.php";

    if (!class_exists($class) && file_exists($path)) {
        require $path;
    }
}
spl_autoload_register('autoloader');

ini_set('display_errors', true);

define('BASEPATH', dirname(__FILE__));

$bootstrap = new Bootstrap();
$bootstrap->run();