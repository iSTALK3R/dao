<?php

require_once 'config.php';

// $sql = new Connection();

// $users = $sql->select("SELECT * FROM users");

// echo json_encode($users);

$root = new User();

$root->loadById(1);

echo $root;

?>