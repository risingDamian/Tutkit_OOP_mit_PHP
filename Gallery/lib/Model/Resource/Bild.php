<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 12.09.17
 * Time: 16:19
 */
namespace Model\Resource;

class Bild extends Base {

    public function getBilder() {

        $sql = 'SELECT id, name, path FROM bilder';
        $dbResult = $this->connect()->query($sql);

        $bilder = array();
        while ($row = $dbResult->fetch(\PDO::FETCH_ASSOC)) {
            
        }

        return $bilder;
    }
}