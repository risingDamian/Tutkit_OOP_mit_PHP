<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 06.09.17
 * Time: 15:35
 */

namespace Alarm\Observer;

use Alarm\Observer;
use Alarm\System;

class Telefon extends Observer {
    public function update(System $system)
    {
        printf("Telefonanruf: %s<br>", $system->getAlert());
    }
}