<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/base_datos/bd.php');

if ( !isset( $_SERVER["REQUEST_METHOD"] ) || $_SERVER["REQUEST_METHOD"] == "GET" ) {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request.");
}else{
	if ( count($_POST) > 2 ) {
		actualizar();
	}else{
		borrar();
	}
}

function actualizar(){
	$bd = new bd();
	$tabla = array_shift($_POST);
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
	$tabla = array_shift($_POST);

	$bd -> where('id', $_POST['id']);
	if ( $bd -> borrar( $tabla ) ) {
		echo json_encode( 'Borrado' );
	}
	
}

?>