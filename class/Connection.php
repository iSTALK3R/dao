<?php

class Connection extends PDO
{
    private $instance;

    public function __construct()
    {
        $this->instance = new PDO("mysql: host=localhost:3306; dbname=db_loginsystem", "root", "");
    }

    private function setParams($statement, $parameters = array()) // Associa varios parametros ao comando sql
    {
        foreach ($parameters as $key => $value) { // Percorre os parametros
            $this->setParam($statement, $key, $value); // Trata o comando sql com os parametros
        }
    }

    private function setParam($statement, $key, $value) // Associa somente um parametro para o comando sql
    {
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array()) // Função que recebe um comando sql sem tratamento ($rawQuery) e parametros ($params) id etc
    {
        $stmt = $this->instance->prepare($rawQuery); // Prepara o comando sql para ser tratado

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;
    }

    public function select($rawQuery, $params = array()):array // Recebe os dados do banco de dados e associa-os a um array
    {
        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>