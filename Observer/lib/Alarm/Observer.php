<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 06.09.17
 * Time: 15:19
 */
namespace Alarm;

abstract class Observer {
    abstract public function update(System $system);
}