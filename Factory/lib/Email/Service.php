<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 11.09.17
 * Time: 10:08
 */
namespace Email;

abstract class Service {
    public function send(string $betreff, string $msg) {
        $this->_deliver($betreff, $msg);
    }

    abstract protected function _deliver(string $betreff, string $msg);
}