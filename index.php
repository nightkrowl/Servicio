<?php
include_once('header-index.php');

//pagina default
$pagina = "inicio.php";

if ( !empty( $_GET['name'] ) ) {
	$tmp_pag = basename($_GET['name']);

	//si existe, actualiza la pagina
	if(file_exists("opciones_index/{$tmp_pag}.php")){
		$pagina = $tmp_pag;
		//actualiza pagina
		include_once("opciones_index/$pagina.php");
	}

	elseif(!file_exists($tmp_pag)){
		include_once("notfound.html");
			//include("footer-index.html");
		exit;
	}
}else{
	include_once($pagina);
}

include_once('footer-index.php');
?>