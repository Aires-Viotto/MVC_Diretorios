<?php

require_once 'environment.php';

global $conn;
$config = array();

if(ENVIRONMENT == 'development') {

	//configuração server local
	define("BASE_URL", "http://localhost/ModeloMVC-main/public");//definir o diretorio padrao
	$config['dbname'] = 'database_name';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}else{
	//configuração servidor hospedagem
	$config['dbname'] = 'database_name';
	$config['host'] = 'localhost';
	$config['dbuser'] = '';
	$config['dbpass'] = '';
}

$config['default_lang'] = 'pt-br';
$config['host_email'] = 'https://accounts.google.com/';
$config['user_email'] = 'exemplo@gmail.com';
$config['pass_email'] = 'password';
try {

	$conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'],$config['dbuser'],$config['dbpass']);
	
} catch (PDOException $e) {
	echo 'ERROR'.$e->getMessage();
	exit;
}