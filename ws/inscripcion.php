<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/base_datos/bd.php');

if ( !isset( $_SERVER["REQUEST_METHOD"] ) || $_SERVER["REQUEST_METHOD"] == "GET" ) {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request.");
}else{
	if ( $_POST['accion'] == 1 ) {
		inscribir();	
	}if ( $_POST['accion'] == 2 ) {
		get_materia();
	}
	if ( $_POST['accion'] == 3) {
		get_profes();
	}
}

//inscribir();

function inscribir(){
	$tablas = unserialize (TABLAS);
	$tabla = $tablas[8];
	$bd = new bd();
	
	$bd -> where('siglas', $_POST['carrera']);
	$res = $bd -> selec_todo($tablas[1]);
	$carrera = $res[0]['id'];

	$bd = new bd();
	$bd -> where('materia', $_POST['materia']);
	$res = $bd -> selec_todo($tablas[2]);
	$materia = $res[0]['id'];

	$bd = new bd();
	$bd -> where('nombre', $_POST['profe']);
	$res = $bd -> selec_todo($tablas[3]);
	$profe = $res[0]['id'];

	$bd = new bd();
	$bd -> where('siglas', $_POST['hora']);
	$res = $bd -> selec_todo($tablas[4]);
	$hora = $res[0]['id'];

	$bd = new bd();
	$bd -> where('salon', $_POST['salon']);
	$res = $bd -> selec_todo($tablas[5]);
	$salon = $res[0]['id'];

	$bd = new bd();
	$data = array(
		'carrera' => $carrera, 'materia' => $materia, 
		'profesor' => $profe, 'hora'=>$hora, 'salon' => $salon);

	if($bd -> insertar($tabla, $data)){
		echo json_encode('Se dio de alta');

	}
	// INSERT INTO inscripciones(carrera, materia, profesor, hora, salon) VALUES (1, 81, 68, 1, 396);

}

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