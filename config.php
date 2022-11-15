<?php 	
require 'environment.php';

$config = array();

if(ENVIRONMENT == "DEV"){
	define("BASE_URL", "http://localhost/PHP/classificados_mvc/");
	
	$config['dbname'] = "classificados";
	$config['host'] = "localhost";
	$config['user'] = "root";
	$config['password'] = "123456";
}else{
	//config servidor 
}
	
try {
	global $db;
	$db = new PDO("mysql:host=".$config['host'].";dbname=".$config['dbname']."",$config['user'],$config['password']);
} catch (PDOException $e) {
		echo "Erro ao conectar ao banco <br>";
		exit;
}


 ?>