<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 11.09.17
 * Time: 10:24
 */

namespace Email\Service;

use Email\Service;

class Gmail extends Service {

    protected function _deliver(string $betreff, string $msg)
    {
        printf("Über Gmail gesendet: %s und enthält folgende Nachricht: \"%s\"<br>", $betreff, $msg);
    }
}
