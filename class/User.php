<?php

class User
{
    private $id;
    private $username;
    private $email;
    private $pass;

    public function getId() {
        return $this->id;
    }

    public function setId($value) {
        $this->id = $value;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($value) {
        $this->username = $value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setPass($value) {
        $this->pass = $value;
    }

    public function loadById($id) { // Carrega os dados do banco de dados e atribui os valores aos atributos com os Setters
        $sql = new Connection;

        $result = $sql->select("SELECT * FROM users WHERE id = :id", array(
            ":id" => $id
        ));

        if (count($result) > 0) {
            $row = $result[0];

            $this->setId($row['id']);
            $this->setUsername($row['username']);
            $this->setEmail($row['email']);
            $this->setPass($row['pass']);
        }
    }

    public function __toString() { // Função que retorna os valores para o usuario quando é chamado pelo echo
        return json_encode(array(
            "id" => $this->getId(),
            "username" => $this->getUsername(),
            "email" => $this->getEmail(),
            "pass" => $this->getPass()
        ));
    }
}