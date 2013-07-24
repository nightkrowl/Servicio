<?php
	session_start();
	include('htmls/admin/header.php');
	
	//Pagina por default: inicio.html
	$page = 'admin/inicio';

	//obtener pagina del usuario
	if (!empty($_GET[name])){
	   $tmp_page = basename($_GET[name]);

	   //si existe actualiza pagina
	   	if(file_exists("htmls/{$tmp_page}.html")){
			$page = $tmp_page;
			//actualiza pagina
			include("htmls/$page.html");
	   	}
		
		elseif(file_exists("htmls/admin/{$tmp_page}.html")){
			$page = "admin/".$tmp_page;
			//actualiza pagina
			include("htmls/$page.html");
	   	}

		elseif(file_exists("htmls/admin/{$tmp_page}.php")){
			$page = "admin/".$tmp_page;
			//actualiza pagina
			include("htmls/$page.php");
	   	}

	   	//si no existe despliega pagina y sale
	   	elseif(!file_exists($tmp_page)){
			include("htmls/notfound.html");
			include("htmls/footer.html");
			exit;
	   	}
	}
	
	//incluye el pie de pagina
	include("htmls/footer.html");
?>
