<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/base_datos/bd.php');

if ( !isset( $_SERVER["REQUEST_METHOD"] ) || $_SERVER["REQUEST_METHOD"] == "GET" ) {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request.");
}else{
	buscar();
}

function buscar(){
	$bd = new bd();
	/*foreach ($_POST as $dato) {
		$params[] = $dato;
	}*/
	$tablas = unserialize (TABLAS);
	$n = array_shift($_POST);
	$tabla = $tablas[$n];

	if ( sizeof($_POST) > 1) {
		if ( isset( $_POST['usuario'] ) && isset( $_POST['contrasena'] ) ) {
			$bd -> where('usuario', $_POST['usuario']);
			$bd -> where('contrasena', $_POST['contrasena']);
			$resultado = $bd -> selec_todo($tabla);

			if ( sizeof($resultado) == 1 ) {
				session_start();
				$_SESSION['usuario'] = $_POST['usuario'];
				$data = array('sesion' => True);
				echo json_encode($data);
				
			}else{
				$data = array('sesion' => False);
				echo json_encode($data);
			}
		}

	}if ( isset( $_POST['id_profe'] ) ) {
		$bd -> where( 'id', $_POST['id_profe'] );
		$resultado = $bd -> selec_todo( $tabla );
		echo json_encode( $resultado );

	}if ( isset( $_POST['buscar'] ) ) {
		$bd -> where('usuario', $_POST['buscar']);
		$resultado = $bd -> selec_todo($tabla);
		echo json_encode($resultado);
	}
}
?>