<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 06.09.17
 * Time: 11:13
 */
namespace Util;

class Logger {

    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Logger();
        }

        return self::$instance;
    }

    public function log($message){
        printf("Logged: %s <br>", $message);
    }
}