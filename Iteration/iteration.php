<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 06.09.17
 * Time: 13:52
 */

use Buch\Liste;
use Item\Buch;

function autoloader($class) {
    $newName = str_replace('\\', '/', $class);
    $path = "lib/$newName.php";

    if (!class_exists($class) && (file_exists($path))) {
        require $path;
    }
}
spl_autoload_register('autoloader');

ini_set('display_errors', true);

$liste = new Liste();

$liste->neuesBuch(new Buch("Es", "Stephen King"));
$liste->neuesBuch(new Buch("The C Programming Language", "Dennis Ritche"));
$liste->neuesBuch(new Buch("Verbrennung", "Dennis Ritche"));

foreach ($liste as $buch) {
    printf("%s, %s <br>", $buch->getTitle(), $buch->getAuthor());
}