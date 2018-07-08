<?php 

require_once("config.php");

// Carrega apenas um usuário
/*$user = new Usuario();
$user->loadById(2);
echo $user;*/

//Carrega todos os usuários da tabela
/*$lista = Usuario::getList();
echo json_encode($lista);*/

//Carrega o usuário buscando pelo login
/*$busca = Usuario::search("us");
echo json_encode($busca);*/

//Carrega um usuário, usando o login e senha
$usuario = new Usuario();
$usuario->login("usuario", "123465");
echo $usuario;

 ?>