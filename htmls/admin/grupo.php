<?php
	define('__ROOT__', dirname(dirname(dirname(__FILE__))));

	require_once (__ROOT__.'/clases/funciones_admin.php');

	$admin = new funciones_admin;
	list($rows, $result) = $admin->mostrar_registros();
	echo "<table>";
	for ($j=0; $j<$rows; ++$j){
		echo '<tr><td>'.mysql_result($result,$j,'usuario').'</td></tr>';
		echo '<tr><td>'.mysql_result($result,$j,'contrasena').'</td></tr>';
	}
	echo "</table>";
?>
