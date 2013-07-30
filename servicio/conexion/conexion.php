<?php

ini_set("display_error", "off");
ini_set("display_startup_error", "off");
error_reporting(0);

function Conectar_bd(){
	if(!($conectar = mysql_connect("localhost", "root", "Master10."))){
		echo "Error conectando a la base de datos.";
		exit();
	}if(!mysql_select_db("alumnos", $conectar)){
		echo "Error seleccionando base de datos.";
		exit();
	}
	return $conectar;
}

?>