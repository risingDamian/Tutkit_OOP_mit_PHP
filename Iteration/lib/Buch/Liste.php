<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 06.09.17
 * Time: 13:52
 */
namespace Buch;
use Item\Buch;

class Liste implements \Iterator {
    private $_buecher = array();
    private $_position = 0;

    public function neuesBuch (Buch $buch) {
        $this->_buecher [] = $buch;
    }

    public function rewind()
    {
        $this->_position = 0;
    }

    public function key()
    {
        return $this->_position;
    }

    public function valid()
    {
        $buecherAnzahl = count($this->_buecher);

        if ($this->_position < $buecherAnzahl) {
            return true;
        }

        return false;
    }

    public function current()
    {
        return $this->_buecher[$this->_position];
    }

    public function next()
    {
        $this->_position++;
    }
}