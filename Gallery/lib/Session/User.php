<?php
/**
 *
 * Created by PhpStorm.
 * User: froese
 * Date: 01.12.17
 * Time: 15:56
 */

namespace Session;

class User {

    public static function login($email, $pass) {

        session_start();

        /** @var \Model\Resource\Benutzer $resourceModel */
        $resourceModel = \App::getResourceModel('Benutzer');
        $benutzer = $resourceModel->authUser($email, $pass);

        if ($benutzer != false) {
            $_SESSION['user_id'] = $benutzer->getId();
            $_SESSION['user_email'] = $benutzer->getEmail();

            return true;
        } else {
            $_SESSION['msg'] = "Login fehlgeschlagen";
        }

        return false;
    }
}
