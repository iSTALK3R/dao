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
            $this->setData($result[0]);
        }
    }

    public static function getList() { // Listar dados de uma tabela
        $sql = new Connection();

        return $sql->select("SELECT * FROM users ORDER BY username");
    }

    public static function search($username) { // Lista dados buscando pelo username
        $sql = new Connection();

        return $sql->select("SELECT * FROM users WHERE username LIKE :search ORDER BY username", array(
            ':search' => '%'.$username.'%'
        ));
    }

    public function login($login, $password) { // Carrega o usuario pelo login e senha informado
        $sql = new Connection();

        $result = $sql->select("SELECT * FROM users WHERE username = :username AND pass = :pass", array(
            ":username" => $login,
            ":pass" => $password
        ));

        if (count($result) > 0) {
            $this->setData($result[0]);
        } else {
            throw new Exception("Login e/ou senha inválidos.");
        }
    }

    public function setData($data) {
        $this->setId($data['id']);
        $this->setUsername($data['username']);
        $this->setEmail($data['email']);
        $this->setPass($data['pass']);
    }

    public function insert() { // Insert de usuario utilizando procedure
        $sql = new Connection();

        $results = $sql->select("CALL sp_users_insert(:login, :password)", array(
            ":login" => $this->getUsername(),
            ":password" => $this->getPass()
        ));

        if (count($results) > 0) {
            $this->setData($result[0]);
        }
    }

    public function update($login, $email, $password) {
        $this->setUsername($login);
        $this->setEmail($email);
        $this->setPass($password);

        $sql = new Connection();

        $sql->query("UPDATE users SET username = :username, email = :email, pass = :pass WHERE id = :id", array(
            ":username" => $this->getUsername(),
            ":email" => $this->getEmail(),
            ":pass" => $this->getPass(),
            ":id" => $this->getId()
        ));
    }

    public function __construct($login = "", $email = "", $password = "") {
        $this->setUsername($login);
        $this->setEmail($email);
        $this->setPass($password);
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

?>