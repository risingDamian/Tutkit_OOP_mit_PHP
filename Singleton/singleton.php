<?php

use Util\Logger;

function autoloader($class) {
    $newName = str_replace('\\', '/', $class);
    $path = "lib/$newName.php";

    if (!class_exists($class)) {
        if (file_exists($path)) {
            require $path;
        }
    }
}
spl_autoload_register('autoloader');

ini_set('display_errors', true);

Logger::getInstance()->log("Arrr Pirat!");