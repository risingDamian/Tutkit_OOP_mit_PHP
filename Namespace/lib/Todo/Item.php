<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 31.08.17
 * Time: 13:48
 */

namespace Todo;

class Item {
    private $_title;

    public function __construct(string $title)
    {
        $this->_title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }
}