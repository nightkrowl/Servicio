<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/base_datos/bd.php');

if ( !isset( $_SERVER["REQUEST_METHOD"] ) || $_SERVER["REQUEST_METHOD"] == "GET" ) {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request.");
}else{
	funcion();
}
//funcion();

function funcion(){
	//session_start();
	$bd = new bd();
	$tabla = 'alumnos';
	//$usuario = $_SESSION['usuario'];
	$usuario = 'RztJAanL';
	$bd -> where('usuario', $usuario);//$_SESSION['usuario']);
	$resultado = $bd -> selec_todo($tabla);
	$carrera = $resultado[0]['carrera'];

	$bd = new bd();
	$data = array($carrera);
	$query = "SELECT materias.materia FROM materias JOIN carreras_materias ON materias.id = carreras_materias.materia WHERE carreras_materias.carrera = ?";
	$resultado = $bd -> ejecutar_query($query, $data);
	echo json_encode($resultado);

	/*$bd = new bd();
	$data = array($carrera);
	$query = "SELECT profesores.nombre, profesores.apellidos FROM profesores JOIN materias_profesores ON profesores.id = materias_profesores.materia WHERE materias_profesores.materia = ?";
	$resultado = $bd -> ejecutar_query($query, $data);*/
}

?>