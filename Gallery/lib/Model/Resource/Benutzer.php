<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 21.11.17
 * Time: 15:06
 */
namespace Model\Resource;

class Benutzer extends Base {

    #Erfassen des Benutzers anhand von Email und Passwort und erstellen eines neuen Benutzerobjektes
    public function authUser(string $email, string $password) {

        //erzeugen neuer PDO Instanz
        $connection = $this->connect();

        //SQL Statement zum abrufen/ validieren von Nutzereingabe
        $sql = sprintf("SELECT id, email FROM benutzer WHERE email = %s AND password = %s",
                        $connection->quote($email), $connection->quote($password)
            );

        //Executen des SQL Statements und Rückgabe als PDOStatement Object
        $dbResult =  $connection->query($sql);

        // Erstellen des Benutzer Model Objektes aus SQL Daten (???)
        while ($row = $dbResult->fetch(\PDO::FETCH_ASSOC)) {
            /** @var \Model\Benutzer $benutzer */
            $benutzer = \App::getModel('Benutzer');
            $benutzer->setEmail($row['email']);
            $benutzer->setId($row['id']);

            return $benutzer;
        }

        return false;
    }
}