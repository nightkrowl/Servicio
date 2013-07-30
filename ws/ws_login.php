<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once (__ROOT__.'/base_datos/bd_config.php');

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] == "GET") {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request.");
}else{
	login();
}

function login(){
	$con = new bd_config;
	$bd = $con->bd;
	$tabla = $con->tabla;
	mysql_select_db($bd) or die('Hay error');
	$usuario = $_POST['usuario'];
	$contra = $_POST['contrasena'];
	$query = "SELECT * FROM $tabla WHERE usuario='$usuario' AND contrasena='$contra' LIMIT 1";
	$resultado = mysql_query($query);
	$cont = mysql_num_rows($resultado);
	if ($cont){
		$data = array('sesion' => True);
		echo json_encode($data);
	}else{
		$data = array('sesion' => False);
		echo json_encode($data);
	}
}
?>
