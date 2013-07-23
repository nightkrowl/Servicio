<?php
	session_start();
	include('htmls/admin/header.html');
	
	//Pagina por default: inicio.html
	$page = 'admin/inicio';

	//obtener pagina del usuario
	if (!empty($_GET[name])){
	   $tmp_page = basename($_GET[name]);

	   //si existe actualiza pagina
	   	if(file_exists("htmls/{$tmp_page}.html")){
			$page = $tmp_page;	
	   	}
		
		elseif(file_exists("htmls/admin/{$tmp_page}.html")){
			$page = "admin/".$tmp_page;	
	   	}

	   	//si no existe despliega pagina y sale
	   	elseif(!file_exists($tmp_page)){
			include("htmls/notfound.html");
			include("htmls/footer.html");
			exit;
	   	}
	}
	//actualiza pagina
	include("htmls/$page.html");
	//incluye el pie de pagina
	include("htmls/footer.html");
?>
