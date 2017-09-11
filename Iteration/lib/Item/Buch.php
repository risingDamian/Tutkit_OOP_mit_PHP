<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 06.09.17
 * Time: 13:52
 */
namespace Item;

class Buch {
    private $_title = "";
    private $_author = "";

    public function __construct(string $title, string $author)
    {
        $this->_title = $title;
        $this->_author = $author;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function getAuthor() {
        return $this->_author;
    }

}