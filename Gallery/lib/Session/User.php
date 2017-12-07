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

    #Nutzer Authentifizieren und neue Session Einleiten sofern erfolgreich
    public static function login($email, $pass) {

        //neues Session starten, sofern noch nicht vorhanden
        self::initSession();

        //Erstellen neuer Benutzer Instanz Anhand von Eingaben
        /** @var \Model\Resource\Benutzer $resourceModel */
        $resourceModel = \App::getResourceModel('Benutzer');
        $benutzer = $resourceModel->authUser($email, $pass);

        //Sofern Benutzerinstanz erfolgreich erstellt wurde setzen der Session ID & Email auf Benutzereingaben
        if ($benutzer != false) {
            $_SESSION['user_id'] = $benutzer->getId();
            $_SESSION['user_email'] = $benutzer->getEmail();
            return true;
        } else {
            $_SESSION['msg'] = "Login fehlgeschlagen";
        }

        return false;
    }

    #Aktuelle Session Daten Löschen
    public static function logout() {
        self::initSession();

        session_destroy();
    }

    #überprüfen ob jew. Nutzer eingeloggt ist/ session existiert
    public static function isLoggedIn() {
        self::initSession();

        if (isset($_SESSION['user_id'])) {
            return true;
        }

        return false;
    }

    //startet sofern noch keine Existenz eine neue Session (neues cookie mit Zugangsaberechtigung für einen gewissen Zeitraum
    public static function initSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
