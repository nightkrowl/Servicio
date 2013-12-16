<?php
$carpeta = "opciones_alumnos";
include_once("$carpeta/header.php");

//pagina default
$pagina = "$carpeta/inicio.php";

if ( !empty( $_GET['name'] ) ) {
	$tmp_pag = basename($_GET['name']);

	//si existe, actualiza la pagina
	if(file_exists("$carpeta/{$tmp_pag}.php")){
		$pagina = $tmp_pag;
		//actualiza pagina
		include_once("$carpeta/$pagina.php");
	}

	elseif(!file_exists($tmp_pag)){
		include_once("notfound.html");
			//include("footer-index.html");
		exit;
	}
}else{
	include_once($pagina);
}

include_once("$carpeta/footer.php");
?>