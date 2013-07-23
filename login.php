<?php
require_once 'base_datos/bd_config.php';

$object = new login;
$object->prueba();

class login{

	private $con, $bd;

	function __construct(){
		$this->con = new bd_config;
	}

	function prueba(){
		mysql_select_db('Usuarios') or die('Hay error');
		$query = "SELECT * FROM sesiones";
		$result = mysql_query($query);
		if (!$result) die ("Database access failed: " . mysql_error());

		$rows = mysql_num_rows($result);
		for ($j = 0 ; $j < $rows ; ++$j){
			echo 'id: '. mysql_result($result,$j,'id').'<br />';
			echo 'usuario: '. mysql_result($result,$j,'usuario').'<br />';
			echo 'contra: ' . mysql_result($result,$j,'contrasena').'<br />';
		}
	}
}
?>
