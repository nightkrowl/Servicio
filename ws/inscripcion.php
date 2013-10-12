<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/base_datos/bd.php');

/*if ( !isset( $_SERVER["REQUEST_METHOD"] ) || $_SERVER["REQUEST_METHOD"] == "GET" ) {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request.");
}else{
	funcion();
}*/
funcion();

function funcion(){
	echo 'hola';
	//session_start();
	$bd = new bd();
	$tabla = 'alumnos';
	//$usuario = $_SESSION['usuario'];
	$usuario = 'RztJAanL';
	$bd -> where('usuario', $usuario);//$_SESSION['usuario']);
	$resultado = $bd -> selec_todo($tabla);
	$carrera = $resultado[0]['carrera'];
	
}

?>