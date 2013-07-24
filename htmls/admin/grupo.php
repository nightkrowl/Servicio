<?php
	define('__ROOT__', dirname(dirname(dirname(__FILE__))));
	require_once (__ROOT__.'/clases/funciones_admin.php');

	$admin = new funciones_admin;
	list($rows, $result) = $admin->mostrar_registros();
	//echo "<table>";
echo <<<_END
<table cellspacing='0'>
	<!-- Table Header -->
	<thead>
		<tr>
			<th>Matrícula</th>
			<th>Alumno</th>
			<th>Calificación</th>
		</tr>
	</thead>
	<tbody>
_END;
	for ($j=0; $j<$rows; ++$j){
		echo '<tr><td>'.mysql_result($result,$j,'usuario').'</td>
		<td>'.mysql_result($result,$j,'contrasena').'</td></tr>';
		//echo '<tr><td>'.mysql_result($result,$j,'contrasena').'</td></tr>';
	}
	echo "</tbody></table>";

?>
