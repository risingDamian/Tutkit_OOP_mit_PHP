<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 31.08.17
 * Time: 12:07
 */

ini_set('display_errors', true);

use Todo\Item as TodoItem;
use Todoliste\Item as ListItem;

function autoloader ($class) {
    $newName = str_replace('\\', '/', $class);

    $path = "lib/$newName.php";

    if (file_exists($path)) {
        require $path;
    }
}

spl_autoload_register("autoloader");

$list = new ListItem("Einkauf");
$list->addTodo(new TodoItem("Milch"));
$list->addTodo(new TodoItem("Müsli"));
$list->addTodo(new TodoItem("Bananen"));

$items = $list->getTodoItems();
foreach ($items as $item) {
    echo $item->getTitle() . "<br>";
}