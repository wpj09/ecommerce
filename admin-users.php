<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;
//rota onde vai listar todos os usuarios
$app->get("/admin/users", function() {

	User::verifyLogin();
	//metodo para listar os usuarios
	$users = User::listALL();

	$page = new PageAdmin();
	//Passar o array para o tamplete
	$page->setTpl("users", array(
		"users"=>$users
	));

});
//Rota para cadastro de usuarios
$app->get("/admin/users/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("users-create");

});
//Rota para deletra de usuario
$app->get("/admin/users/:iduser/delete", function($iduser) {

	User::verifyLogin();	

	$user = new User();

	$user->get((int)$iduser);

	$user->delete();

	header("Location: /admin/users");
	exit;

});
//Rota para atualização de usuario
$app->get("/admin/users/:iduser", function($iduser){

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$page = new PageAdmin();

	$page->setTpl("users-update", array(
		"user"=>$user->getValues()
	));

});
//Rota para adicionar novos usuarios
$app->post("/admin/users/create", function(){

	User::verifyLogin();

	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;
	
	$_POST['despassword'] = User::getPasswordHash($_POST['despassword']);

	$user->setData($_POST);

	$user->save();

	header("Location: /admin/users");
	exit;

});
//Rota para salvar a atualização de usuario
$app->post("/admin/users/:iduser", function($iduser){

	User::verifyLogin();

	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;
	//passando o id
	$user->get((int)$iduser);
	//Setando o post
	$user->setData($_POST);
	//Atulizando e jogando no banco
	$user->update();

	header("Location: /admin/users");
	exit;

});

 ?>