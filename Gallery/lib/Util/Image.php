<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 07.12.17
 * Time: 13:50
 */

namespace Util;

use Model\Bild;

class Image {

    public static function processUpload($uploadedFile) {
        $tmpFile = $uploadedFile['tmp_name'];
        $fileName = $uploadedFile['name'];
        $imgExt = pathinfo($fileName, PATHINFO_EXTENSION);

        //checks
        if (!getimagesize($tmpFile)) {
            throw new \RuntimeException('Das ist leider kein Bild!');

        }

        if ($imgExt != "jpg" && $imgExt != "jpeg" && $imgExt != "png") {
            throw new \RuntimeException('Nur JPG & PNG erlaubt');
        }

        if ($uploadedFile['size'] > 50000000) {
            throw new \RuntimeException('Datei ist zu groß');
        }

        // process
        $imgDir = BASEPATH . '/bilder/';
        $randomFile = sprintf("%s.%s", self::_getRndString(), $imgExt);
        $targetPath = $imgDir . $randomFile;

        if (move_uploaded_file($tmpFile, $targetPath)) {
            /** @var Bild $bild */
            $bild = \App::getModel('Bild');
            $bild->setName($fileName);
            $bild->setPath($randomFile);

            /** @var \Model\Resource\Bild $resource */
            $resource = \App::getResourceModel('Bild');
            $newId = $resource->insertImg($bild);

            return $newId;
        }

        return false;
    }


    protected static function _getRndString() {

        return sha1( uniqid( rand(1, 232222) . md5(microtime()) . mt_rand(), true )) ;
    }
}