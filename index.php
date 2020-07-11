<?php 
session_start();
require_once("vendor/autoload.php");//sempre exite para trazer as dependencias, o que meu projeto precisa 
//vc excolhe o q vc vai querer q serje usado
use \Slim\Slim;
//nova aplicação do slim
$app = new Slim();
//modo debug configurado para saber detalhando o erro
$app->config('debug', true);

require_once("functions.php");
require_once("site.php");
require_once("admin.php");
require_once("admin-users.php");
require_once("admin-categories.php");
require_once("admin-products.php");
require_once("admin-orders.php");
//tudo carregado vamos rodar
$app->run();

 ?>