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

        $sql = 'SELECT id, name, path FROM bild';
        $dbResult = $this->connect()->query($sql);

        $bilder = array();
        while ($row = $dbResult->fetch(\PDO::FETCH_ASSOC)) {
            /** @var /Model/Bild $bild */
            $bild = \App::getModel('Bild');
            $bild->setId($row['id']);
            $bild->setName($row['name']);
            $bild->setPath($row['path']);

            $bilder[] = $bild;
        }

        return $bilder;
    }

    public function insertImg(\Model\Bild $bild) {
        $sql = "INSERT INTO bild (name, path) VALUES (:name, :path)";

        $connection = $this->connect();
        $statement = $connection->prepare($sql);

        $statement->bindValue(':name', $bild->getName());
        $statement->bindValue(':path', $bild->getPath());

        $statement->execute();

        return $connection->lastInsertId();
    }
}