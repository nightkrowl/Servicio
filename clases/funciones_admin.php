<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once (__ROOT__.'/base_datos/bd_config.php');

class funciones_admin{

	private $tabla;
	private $bd;

	public function __construct(){
		$this->conexion();
	}
	
	private function conexion(){
		$con = new bd_config;
		$this->bd = $con->bd;
		$this->tabla = $con->tabla;
		mysql_select_db($this->bd) or die('Hay error');
	}
	
	public function mostrar_registros(){
		$query = "SELECT * FROM ".$this->tabla;
		$result = mysql_query($query);
		if (!$result) die ("Database access failed: " . mysql_error());
		$rows = mysql_num_rows($result);
		return array($rows, $result);
		/*for ($j=0; $j<$rows; ++$j){
			echo 'usuario: '. mysql_result($result,$j,'usuario').'<br />';
			echo 'contra: ' . mysql_result($result,$j,'contrasena').'<br />';
		}*/
	}
}

//$admin = new funciones_admin;
//$admin->mostrar_registros();
?>
