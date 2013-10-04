<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/base_datos/bd.php');

if ( !isset( $_SERVER["REQUEST_METHOD"] ) || $_SERVER["REQUEST_METHOD"] == "GET" ) {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request.");
}else{
	actualizar();
}

function actualizar(){
	//UPDATE
/*$data_update = array(
	'contrasena' => '09876'
	);
$bd -> where('id', 1);
if ($bd -> actualizar('alumnos', $data_update)) {
	echo 'Actualizado';
}*/
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
	}else{
		echo json_encode($_POST['id']);
	}
}

?>