<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/base_datos/bd.php');

if ( !isset( $_SERVER["REQUEST_METHOD"] ) || $_SERVER["REQUEST_METHOD"] == "GET" ) {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request.");
}else{
	if ( $_POST['accion'] == 1 ) {
		get_carreras();	
	}if ( $_POST['accion'] == 2 ) {
		get_materia();
	}
	if ( $_POST['accion'] == 3) {
		get_profes();
	}
}

//get_materia();
function get_materia(){
	//session_start();
	$tablas = unserialize (TABLAS);
	$tabla = $tablas[1];

	$bd = new bd();
	$bd -> where('siglas', $_POST['carrera'] );
	$resultado = $bd -> selec_todo($tabla);

	$id = $resultado[0]['id'];
	$data = array($id);
	$bd = new bd();
	$query = "SELECT materias.materia FROM materias JOIN carreras_materias ON materias.id = carreras_materias.materia WHERE carreras_materias.carrera = ?";
	$materias = $bd -> ejecutar_query($query, $data);
	//print_r($materias[0]['materia']);
	//echo json_encode($materias);
	//echo $materias[0]['materia'];
	
	$inscripciones = $tablas[7];
	$tabla = $tablas[2];

	for ($i=0; $i < sizeof($materias); $i++) {
		$bd = new bd();
		$bd -> where('materia', $materias[$i]['materia']);
		$resultado = $bd -> selec_todo($tabla);		
		$bd = new bd();
		$bd -> where('materia', $resultado[0]['id']);
		$resultado = $bd -> selec_todo( $inscripciones );
		
		if ( sizeof( $resultado ) > 4 ) {
			unset( $materias[ $i ] );
			//$materias = array_values($materias);
		}
	}

	echo json_encode($materias);
	//$tabla = 'alumnos';
	//$usuario = $_SESSION['usuario'];
	//$usuario = 'RztJAanL';
	//$bd -> where('usuario', $usuario);//$_SESSION['usuario']);
	//$resultado = $bd -> selec_todo($tabla);
	//$carrera = $resultado[0]['carrera'];

	/*$bd = new bd();
	$data = array($carrera);
	$query = "SELECT materias.materia FROM materias JOIN carreras_materias ON materias.id = carreras_materias.materia WHERE carreras_materias.carrera = ?";
	$resultado = $bd -> ejecutar_query($query, $data);
	echo json_encode($resultado);*/

	/*$bd = new bd();
	$data = array($carrera);
	$query = "SELECT profesores.nombre, profesores.apellidos FROM profesores JOIN materias_profesores ON profesores.id = materias_profesores.materia WHERE materias_profesores.materia = ?";
	$resultado = $bd -> ejecutar_query($query, $data);*/
}

function get_profes(){
	$tablas = unserialize (TABLAS);
	$tabla = $tablas[2];

	$bd = new bd();
	$bd -> where( 'materia', $_POST['materia'] );
	$resultado = $bd -> selec_todo($tabla);

	$id = $resultado[0]['id'];
	$data = array($id);
	
	$bd = new bd();
	$query = "SELECT profesores.nombre FROM profesores JOIN materias_profesores ON profesores.id = materias_profesores.materia WHERE materias_profesores.materia = ?";
	$profes = $bd -> ejecutar_query($query, $data);
	echo json_encode($profes);
}

?>