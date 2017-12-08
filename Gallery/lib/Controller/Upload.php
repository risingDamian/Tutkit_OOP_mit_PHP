<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 07.12.17
 * Time: 11:17
 */

namespace Controller;

use Session\User;
use Util\Image;

class Upload extends Base {

    //aufrufen des upload Seitentemplates
    public function indexAction($params) {

        $this->_checkLogin();

        echo $this->render('upload.phtml', array());
    }

    //speichern des Bildes
    public function saveAction($params) {

        $this->_checkLogin();

        if (!$this->isFileUpload()) {

            throw new \RuntimeException('Kein Dateiupload');
        }

        $newId = Image::processUpload($_FILES['uploadImg']);

        if(!$newId) {
            User::initSession();
            $_SESSION['msg'] = "Uploadfehler beim Speichern";
            return;
        }

        $url = \App::getBaseUrl() . 'index/index/id/' . $newId;
        header('Location: ' . $url);
    }


    //überprüfen ob nutzer NICHT eingeloggt -> verweis auf startseite
    protected function _checkLogin() {
        if (!User::isLoggedIn()) {
            $url = \App::getBaseUrl() . 'index/login';
            header('Location:' . $url);
        }
    }
}