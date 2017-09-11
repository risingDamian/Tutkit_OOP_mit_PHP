<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 31.08.17
 * Time: 13:49
 */

namespace Todoliste;
use Todo\Item as TodoItem;

class Item {
    private $name = "";
    private $todoItems = array();

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addTodo (TodoItem $item) {
        $this->todoItems[] = $item;
    }

    /**
     * @return array
     */
    public function getTodoItems()
    {
        return $this->todoItems;
    }
}