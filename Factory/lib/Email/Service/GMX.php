<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 11.09.17
 * Time: 10:24
 */
namespace Email\Service;

use Email\Service;

class GMX extends Service {

    protected function _deliver(string $betreff, string $msg)
    {
        printf("Über GMX gesendet: %s<br>", $betreff);
    }
}