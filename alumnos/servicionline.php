<?php

	ini_set("display_error", "off");
	ini_set("display_startup_error", "off");
	error_reporting(0);

	session_start();
     
    $inactivo = 10;
     
    if(isset($_SESSION['tiempo']) ) {
    $vida_session = time() - $_SESSION['tiempo'];
        if($vida_session > $inactivo)
        {
        	session_start();
        	session_destroy();
            echo"<script>alert('Sesion cerrada por inactividad.'); 
			window.location='index.php';
			</script>";  
        }
    }

    $_SESSION['tiempo'] = time();
?>

<!DOCTYPE HTML>

<html lang="es">
	<head>
		<meta charset="UTF-8"/>
		<title>Servicio en linea</title>
		<link href="css/estilo_servicio.css" rel="stylesheet" type="text/css"/>
		<link href="css/header_servicio.css" rel="stylesheet" type="text/css"/>
		<link href="css/izquierda_servicio.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div id="todo">
			<header onload="dibujar_cuadro();">
				<img id="img1" width="100px" height="130px" src="imagenes/siase.png"/>
				<img id ="img2" src="imagenes/logo_politecnico.png" width="130px" height="100px"/>
				<script>
					function dibujar_cuadro(){
						var lienzo = document.getElementById(“lienzo”);
						var trabajo = lienzo.getContext(“2d”); //Siempre requerida
						trabajo.fillStyle=“#ccc”;
						trabajo.fillRect(150,150,300,200);
					}
				</script>
				<canvas id="lienzo" style="border:1px gray solid;" width="75" height="130">
				</canvas>
				<p> Nombre:<B><?php echo $_SESSION['nombre']." ". $_SESSION['apellido']; ?></B></br>
          		Matricula:<B><?php echo $_SESSION['matricula'] ?></B></br>
          		Carrera:<B><?php echo $_SESSION['carrera'] ?></B></br>
      			</p>
      			<img src="imagenes/edificio_politecnico.jpg" width="350px" height="130px"/>
			</header>
			<aside>
				<nav>
					<ul>
						<li><a href="inscripcion.php">Inscripcion</a></li>
						<li><a href="#">Solicitud Beca</a></li>
						<li><a href="#">Resultados Generales</a></li>
						<li><a href="#">Horario</a></li>
						<li><a href="#">Calificaciones</a></li>
						<li><a href="#">Datos del academico</a></li>
						<li><a href="#">Servicio social</a></li>
						<li><a href="conexion/logout.php">Salir</a></li>
					</ul>
				</nav>
			</aside>
			<section>
				<p>hoja en blanco, hay que pensar la manera de cambiar el section por cada eleccion de la lista de opciones</p>
			</section>
		</div>
	</body>
</html>