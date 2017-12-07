<?php
/**
 * Created by PhpStorm.
 * User: froese
 * Date: 21.11.17
 * Time: 15:04
 */

namespace Model;

class Benutzer {
    private $_id = 0;
    private $_email = "";

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

}