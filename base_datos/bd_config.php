<?php
//conexion a base de datos
class bd_config{
	//datos para conectar con la base de datos
	private $hostname = 'localhost';
	private $usuario = 'root';
	private $contrasena = 'root';
	public $bd = 'Usuarios';
	public $tabla = 'sesiones';
	private $con;

	function __construct(){
		$this->bd_conexion();
	}

	function bd_conexion(){
		$this->con = mysql_connect($this->hostname, $this->usuario, $this->contrasena);	
		if (!$this->con) die(mysql_fatal_error());
	}

	function mysql_fatal_error(){
		$msg = mysql_error();
		echo <<< _END
		Lo sentimos pero nos es imposible completar su petición. El error que recibieron nuestro equipo de monos es:
		<p>$msg</p>
		Por favor regresa e intenta más tarde. Si los problemas continúan porfavor envíanos un correo con una impresión de pantalla y el problema que encontraste y nuestro equipo de monos tratará de resolverlo.<a href="mailto:admin@server.com"></a>. Muchas gracias.
_END;
	}

	
}
?>
