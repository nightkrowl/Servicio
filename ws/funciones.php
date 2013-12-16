<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once (__ROOT__.'/base_datos/bd.php');
require_once (__ROOT__.'/ws/inactividad.php');
require_once(__ROOT__.'/ws/hash.php');

/*if ( !isset( $_SERVER["REQUEST_METHOD"] ) || $_SERVER["REQUEST_METHOD"] == "GET" ) {
	header("HTTP/1.1 400 Invalid Request");
	die("ERROR 400: Invalid request.");
}elseif ($_POST['accion'] == "datos") {
	get_datos();
}elseif ($_POST['accion'] == "alta") {
	altas();
}elseif ($_POST['accion'] == "baja") {
	bajas();
}*/

//get_datos();
//altas();
/**
**Obtiene todos los registros de la tabla especificada en la llamada.
**/
function get_datos(){
	//array_shift($_POST);
	$bd = new bd();
	$tablas = unserialize (TABLAS);
	$_POST['tabla'] = "materia-profesor";
	$_POST['carrera'] = "ITS";
	$_POST['materia'] = "Álgebra para Ingeniería";
	
	if ( isset( $_POST['tabla'] ) ) {
		$tabla = $tablas[ array_shift( $_POST ) ];
	}elseif( isset( $_POST['carrera'] ) ){
		$tabla = $tablas['alumno'];
	}else{
		$tabla = $tablas['profesor'];
	}

	if ( isset( $_POST ) ) {

		if ( isset( $_POST['carrera'] ) ) {
			$bd = new bd();
			$bd -> where('siglas', array_shift( $_POST ) );
			$res = $bd -> selec_todo('carreras');
			$_POST['carrera'] = $res[0]['id'];
		}
		if ( isset( $_POST['materia'] ) ) {
			$bd = new bd();
			$bd -> where('materia',  $_POST['materia'] );
			$bd -> where('carrera', $_POST['carrera'] );
			$res = $bd -> selec_todo('materias');
			$_POST['materia'] = $res[0]['id'];
			unset($_POST['carrera']);
		}

		$bd = new bd();
		foreach ( $_POST as $key => $dato ) {
			if ( $dato != NULL ) {
				$bd -> where( $key, "$dato" );
			}
		}
	}
	
	$res = $bd -> selec_todo($tabla);

	if ( isset( $_POST['semestre'] ) ) {
		if ( $res ) {
			echo json_encode( $res );
		}else{
			echo json_encode("vacio");
		}
		
	}elseif ( isset( $_POST['materia'] ) ) {
		if ($res) {
			$profes = array();
			
			for ($i=0; $i < sizeof($res); $i++) {
				$bd = new bd();
				$bd -> where('id', $res[$i]['profesor'] );
				$aux = $bd -> selec_todo("profesores");
				$profes[$i] = $aux[0]["nombre"];
			}
			
			echo json_encode( $profes );
		}else{
			echo json_encode("vacio");
		}
	}
	else{
		if ($res) {
			echo json_encode($res);
		}else{
			echo json_encode(NULL);
		}
	}
}

/**
**Toma datos via POST.
**Hace las consultas necesarias para obtener id's de cada campo.
**Comprueba que no exista ya en la base de datos.
**Si no existe se inserta en la BD en caso contrario retorna NULL.
**/
function altas(){
	//array_shift($_POST);
	$tablas = unserialize (TABLAS);
	$max = 0;
	$params = array();
	/*grupo*/
	$_POST['tabla'] = "materia-profesor";$_POST['carrera'] = "ITS";
	$_POST['materia'] = "Álgebra para Ingeniería";$_POST['semestre'] = "1";
	$_POST['profesor'] = "Jonathan";$_POST['hora'] = "M1";$_POST['ciclo'] = "Agosto-Diciembre";
	$_POST['salon'] = "1108";

	/*profe
	$_POST['nombre'] = "Jonathan";$_POST['apellidos'] = "Alvarado";
	$_POST['tabla'] = "profesor";$_POST['carrera'] = "ITS";
	$_POST['materia'] = "Álgebra para Ingeniería";
	$_POST['correo'] = "jonathan@gmail.com";*/
	
	
	//ALTA DE ALUMNOS
	if ( isset( $_POST['carrera'] ) && isset( $_POST['nombre'] ) && !isset( $_POST['materia'] ) )  {
		$tabla = $tablas[ 'alumno' ];
		$bd = new bd();
		$query = "SELECT MAX(usuario) FROM alumnos";
		$res = $bd -> ejecutar_query($query);
		$max = ($res[0]['MAX(usuario)']);
		$params = crear_usuario($max, $params);

		$bd = new bd();
		$bd -> where('siglas', $_POST['carrera']);
		$resultado = $bd -> selec_todo('carreras');
		$params['carrera'] = $resultado[0]['id'];
		
		$comprobar = array('nombre' => $_POST['nombre'],
			'apellidos' => $_POST['apellidos']);

		$bd = new bd();
		if ( existe( $tabla, $comprobar ) ) {
			if($bd -> insertar( $tabla, $params)){
				echo json_encode('Se inserto');
			}else {
				echo json_encode(NULL);
			}	
		}else{
			echo json_encode(NULL);
		}
		
		//ALTA DE PROFESORES
	}elseif ( isset( $_POST['nombre'] ) && isset( $_POST['materia'] ) ) {
		$tabla = $tablas[ 'profesor' ];
		$bd = new bd();
		$query = "SELECT MAX(usuario) FROM profesores";
		$res = $bd -> ejecutar_query($query);
		$max = ($res[0]['MAX(usuario)']);

		$bd = new bd();
		$bd -> where('siglas', $_POST['carrera']);
		$resultado = $bd -> selec_todo('carreras');
		
		$bd = new bd();
		$bd -> where('carrera', $resultado[0]['id'] );
		$bd -> where('materia', $_POST['materia'] );
		$resultado = $bd -> selec_todo('materias');
		$materia = $resultado[0]['id'];

		unset($_POST['carrera']);
		unset($_POST['materia']);
		$params = crear_usuario($max, $params);
		
		$comprobar = array('nombre' => $_POST['nombre'],
			'apellidos' => $_POST['apellidos']);

		$bd = new bd();
		if ( existe( $tabla, $comprobar ) ) {
			if( $bd -> insertar( $tabla, $params) ){
				$bd = new bd();
				$bd -> where('nombre', $params['nombre'] );
				$res = $bd -> selec_todo('profesores');
				$profe = $res[0]['id'];
				$bd = new bd();
				$data = array('materia' => $materia,
							'profesor' => $profe);
				if ( $bd -> insertar( 'materias_profesores', $data ) ) {
					echo json_encode("se insertó");
				}else{
					echo json_encode(NULL);	
				}
			}else {
				echo json_encode(NULL);
			}		
		}else{
			echo json_encode(NULL);
		}

		//ALTA DE GRUPOS
	}elseif ( isset( $_POST['profesor'] ) && isset( $_POST['materia'] ) ) {
		$tabla = $tablas[ 'inscripcion' ];
		/*$bd = new bd();
$data = array(1, 'Jonathan Arturo');
$query = "SELECT * FROM alumnos WHERE id = ? AND nombre = ?";
$resultado = $bd -> ejecutar_query($query, $data);
print_r($resultado);*/
		$bd = new bd();
		$bd -> where('siglas', $_POST['carrera'] );
		$res = $bd -> selec_todo('carreras');
		$params['carrera'] = $res[0]['id'];

		$bd = new bd();
		$bd -> where('materia', $_POST['materia'] );
		$bd -> where('carrera', $params['carrera'] );
		$res = $bd -> selec_todo('materias');
		$params['materia'] = $res[0]['id'];

		$bd = new bd();
		$bd -> where('nombre', $_POST['profesor'] );
		$res = $bd -> selec_todo('profesores');
		$params['profesor'] = $res[0]['id'];

		$bd = new bd();
		$bd -> where('siglas', $_POST['hora'] );
		$res = $bd -> selec_todo('horas');
		$params['hora'] = $res[0]['id'];

		$bd = new bd();
		$bd -> where('salon', $_POST['salon'] );
		$res = $bd -> selec_todo('salones');
		$params['salon'] = $res[0]['id'];

		$params["ciclo"] = $_POST["ciclo"];
		$params['ano'] = date("Y");
		
		$comprobar = array( "hora" => $params["hora"],
			"salon" => $params["salon"], 
			"ciclo" => $params["ciclo"] );

		if ( existe($tabla, $comprobar ) ) {
			$bd = new bd();
			$res = $bd -> insertar( $tabla, $params);
			echo json_encode("se insertó");
		}else{
			echo json_encode(NULL);
		}

		/*SELECT Customers.CustomerName, Orders.OrderID
FROM Customers
INNER JOIN Orders
ON Customers.CustomerID=Orders.CustomerID
ORDER BY Customers.CustomerName;*/
		//$res = $bd -> ejecutar_query($query);
		//$max = ($res[0]['MAX(usuario)']);
	}
}

/**
**Crear un hash de acuerdo al usuario que se pase como parametro.
**$params guarda el usuario, contrasena y salt para autentificar al usuario.
**La funcion crear hash se encuentra en "hash.php".
**Retorna el arreglo $params.
**/
function crear_usuario($usuario, $params){
	$params['usuario'] = $usuario +1;
	$hash = crear_hash( strval($usuario +1) );
	$params['contrasena'] = $hash['hash'];
	$params['salt'] = $hash['salt'];

	foreach ($_POST as $key => $dato) {
		if ( $dato != NULL ) {
			$params[$key] = $dato;
		}
	}

	return $params;
}

/**
**Comprueba si lo que se trata de agregar a la base de datos ya existe.
**Retorna Falso si ya existe, de lo contrario retorna True
**
**/
function existe($tabla, $comprobar){
	$bd = new bd();

	foreach ($comprobar as $key => $dato) {
		if ( $dato != NULL ) {
			$bd -> where($key, $dato );
		}
	}

	if ($bd -> selec_todo($tabla)) {
		return False;
	}else{
		return True;
	}
}

/**
**Toma datos via POST (tabla, id) y elimina de la base de datos. 
**/
function bajas(){
	array_shift($_POST);
	$bd = new bd();
	$tablas = unserialize (TABLAS);
	$tabla = $tablas[ array_shift( $_POST ) ];
	$bd -> where('id', $_POST['id']);

	if ( $bd -> borrar( $tabla ) ) {
		echo json_encode( 'Borrado' );
	}else{
		echo json_encode( NULL );
	}
}

?>