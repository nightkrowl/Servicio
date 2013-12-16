<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once (__ROOT__.'/base_datos/bd.php');
require_once (__ROOT__.'/ws/inactividad.php');

if ( !isset( $_SERVER["REQUEST_METHOD"] ) || $_SERVER["REQUEST_METHOD"] == "GET" ) {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request.");
}/*elseif ( inactividad() and $_POST['accion'] == "otro" ) {
	get_all();
}elseif ( inactividad() and $_POST['accion'] == "datos" ) {
	get_datos();
}*/
elseif ($_POST['accion'] == "datos") {
	get_datos();
}
/*else{
	echo json_encode("False");
}*/

/**
**Obtiene todos los registros de la tabla especificada en la llamada
**/
function get_all(){
	$bd = new bd();
	$tablas = unserialize (TABLAS);
	$tabla = $tablas[$_POST['tabla']];
	$res = $bd -> selec_todo($tabla);

	if ($res) {
		//$data = array('alumnos' => $res);
		echo json_encode($res);
	}
}

function get_datos(){
	session_start();
	$usuario = $_SESSION['usuario'];
	$bd = new bd();
	$bd -> where( 'usuario', $usuario );
	$tablas = unserialize (TABLAS);
	$tabla = $tablas[0];//$_POST['tabla']];
	$resultado = $bd -> selec_todo( $tabla );
	echo json_encode($resultado);
}
?>