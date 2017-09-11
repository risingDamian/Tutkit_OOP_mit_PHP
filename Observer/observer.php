<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 06.09.17
 * Time: 15:11
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

$alarmAnlage = new \Alarm\System();

$alarmAnlage->attach(new \Alarm\Observer\Email());
$alarmAnlage->attach(new \Alarm\Observer\Telefon());
$alarmAnlage->attach(new \Alarm\Observer\SMS());

$alarmAnlage->triggerAlert("Klimaanlage ausgefallen!");

$alarmAnlage->detach(new \Alarm\Observer\Telefon());

$alarmAnlage->triggerAlert("Telefon ausgefallen!");
