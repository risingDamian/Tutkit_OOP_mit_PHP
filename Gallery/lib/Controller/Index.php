<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 12.09.17
 * Time: 14:12
 */

namespace Controller;


use Session\User;

class Index extends Base{

    public function indexAction($params) {
        // resource model instanzieren
        /** @var \Model\Resource\Bild $model */
        $model = \App::getResourceModel('Bild');

        //bilder abrufen
        $bilder = $model->getBilder();

        // bilder darstellen / template
        echo $this->render('bilder.phtml', array('bilder' => $bilder));
    }

    public function loginAction($params) {

        if ($this->isPost()) {
            if(User::login($_POST['email'], $_POST['password'])) {
                header('Location: ' . \App::getBaseUrl());
            }
        }

        // login darstellen / template
        echo $this->render('login.phtml', array());
    }

    public function registerAction($params) {
        echo "Zeit sich zu registrieren!";
    }

    public function logoutAction($params) {

        User::logout();

        $url = \App::getBaseUrl() . 'index/login';
        header('Location: ' . $url);
    }

    public function uploadAction($params) {

    }
}