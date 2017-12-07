<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 07.12.17
 * Time: 15:26
 */

namespace Session;

class Msg {

    public static function setMsg (string $msg) {

        $_SESSION['msg'] = $msg;
    }

    public static function readMsg() {
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']);

        return $msg;
    }

    public static function hasMsg() {
        if (isset($_SESSION['msg'])) {
            return true;
        }

        return false;
    }
}