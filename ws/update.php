<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/base_datos/bd.php');
require_once("hash.php");

/*if ( !isset( $_SERVER["REQUEST_METHOD"] ) || $_SERVER["REQUEST_METHOD"] == "GET" ) {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request.");
}else{
	if ( $_POST['accion'] == 'alta' ) {
		insertar();
	}elseif ( count($_POST) > 2 ) {
		actualizar();
	}elseif (count($_POST) == 2) {
		borrar();
	}
}*/

insertar();

function insertar(){
	$bd = new bd();
	$tablas = unserialize (TABLAS);
	$params = array();
	$x = array_shift($_POST);
	foreach ($_POST as $key => $dato) {
		$params[$key] = $dato;
	}



	/*if ( isset( $_POST['semestre'] ) ) {
		$tabla = $tablas[0];
		$bd -> where('siglas', $_POST['carrera']);
		$resultado = $bd -> selec_todo('carreras');
		$params['carrera'] = $resultado[0]['id'];
		$bd = new bd();
		if($bd -> insertar( $tabla, $params)){
			echo json_encode('Se inserto');
		}
	}else{
		echo json_encode('No se pudo agregar el alumno');
	}*/

}

function actualizar(){
	$bd = new bd();
	$tablas = unserialize (TABLAS);
	$n = array_shift($_POST);
	$tabla = $tablas[$n];
	$params = array();
	foreach ($_POST as $key => $dato) {
		$params[$key] = $dato;
	}
	
	if ( isset( $_POST['usuario'] ) && isset( $_POST['contrasena'] ) && isset( $_POST['id'] ) ) {
		$bd -> where('id', $_POST['id']);
		
		if ($bd -> actualizar($tabla, $params)) {
			echo json_encode ('Actualizado');
		}
	}
}

function borrar(){
	$bd = new bd();
	$tablas = unserialize (TABLAS);
	$n = array_shift($_POST);
	$tabla = $tablas[$n];

	$bd -> where('id', $_POST['id']);
	if ( $bd -> borrar( $tabla ) ) {
		echo json_encode( 'Borrado' );
	}
}

?>