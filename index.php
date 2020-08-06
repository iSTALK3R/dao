<?php

require_once 'config.php';

// Select padrao
//$sql = new Connection();
//$users = $sql->select("SELECT * FROM users");
//echo json_encode($users);


// Carrega somente um usuario
//$root = new User();
//$root->loadById(1);
//echo $root;


// Carrega uma lista de usuarios
//$list = User::getList();
//echo json_encode($list);


// Carrega uma lista de usuarios buscando pelo username
//$search = User::search("ali");
//echo json_encode($search);


// Carrega um usuario usando o login e a senha
$user = new User();
$user->login("Alison", "admin");

echo $user;

?>