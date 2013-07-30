<meta charset="UTF-8"/>

<?php
session_start();
include_once"conexion.php";


$username = $_POST['matricula'];
$password = $_POST['pass'];

$con = Conectar_bd();
$query =mysql_query("SELECT * FROM lista WHERE matricula = '".$username."' AND password = '".$password."'", $con);
#$q = mysql_query($query, $con);
try{
	//if(mysql_result($q, 0)){
	if($row = mysql_fetch_array($query)){
		$_SESSION['nombre']=$row['nombre'];
		$_SESSION['apellido']=$row['apellido'];
		$_SESSION['matricula']=$row['matricula'];
		$_SESSION['carrera']= $row['carrera'];
	    //echo "Usuario validado correctamente.";
	    header("location:servicionline.php");
	}else{
		echo"<script>alert('Usuario o contraseña incorrectas, intentelo de nuevo'); 
		window.location='index.php';
		</script>";  
	}
}catch(Exception $error){}
mysql_close($con);