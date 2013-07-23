<?php
require_once 'base_datos/bd_config.php';

//if (isset($_POST['usuario']) AND isset($_POST['contrasena'])){
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['contrasena'];
	login($usuario, $contrasena);
}else{
	echo 'Usuario y contra vacios';
}

function login($usuario, $contra){
	$con = new bd_config;
	$bd = $con->bd;
	$tabla = $con->tabla;
	mysql_select_db($bd) or die('Hay error');
	$query = "SELECT * FROM $tabla WHERE usuario='$usuario' AND contrasena='$contra' LIMIT 1";
	$resultado = mysql_query($query);
	$cont = mysql_num_rows($resultado);
	if ($cont){
		$aux = mysql_fetch_row($resultado);
		session_start();
		$_SESSION['usuario'] = $usuario;
		$_SESSION['contrasena'] = $contra;
		echo 'id: '.$aux[0].'<br />';
		echo 'usuario: '.$aux[1].'<br />';
		echo 'contra: ' .$aux[2].'<br />';
		//return $resultado;
		header('Location: /admin.php');
	}
}

function mysql_entities_fix_string($string){
	return htmlentities(mysql_fix_string($string));
}


//if (isset($_POST['contrasena'])) $contrasena = $_POST['contrasena'];
//else $contrasena = "(Not entered)";

echo <<<_END
	<!DOCTYPE html>
	<html lang="es">
	<head>
  		<meta charset="utf-8">
  		<title>Login</title>
  		<link rel="stylesheet" href="css/login.css">
  		<!-- IE6-8 support of HTML5 elements --> <!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script> 
  		<![endif]-->
	</head>

	<body>
  		<form id="login" method="post" action="index.php">
    	<h1>Login</h1>
    	<fieldset id="campos">
      		<input id="usuario" type="text" name="usuario" maxlength="30" placeholder="Username" autofocus required/>

      		<input id="contrasena" type="password" name="contrasena" maxlength="30" placeholder="Password" required/>
    	</fieldset>
	
    	<fieldset id="acciones">
      		<input type="submit" id="entrar" value="Log in">
      		<a href="#">Forgot your password?</a>
    	</fieldset>
  		</form>
	</body>
</html>
_END;
?>
