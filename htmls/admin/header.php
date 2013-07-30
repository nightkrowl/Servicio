<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Sistema de Registros</title>
	<meta name="description" content="Sistema de registros">
	<meta name="keywords" content="sistema educativo">
	<link rel="stylesheet" href="css/admin.css">
  <!-- IE6-8 support of HTML5 elements --> <!--[if lt IE 9]>       
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>

<body>
  <header>
    <span>Bienvenido <?php session_start(); echo $_SESSION['usuario']; ?>!</span>
  </header>
  <nav id="nav"><ul id="menu">
	<li><a class="inicio" title="inicio" href="admin.php?name=inicio">Inicio</a></li>
	<li><a title="Horario" href="#">Horario</a></li>
      <li><a href="" title="Calificaciones">Calificaciones</a>
		<ul>
	  		<li><a title="Grupo" href="admin.php?name=grupo">Grupo</a></li>
	  		<li><a href="#">Alumno</a></li>
	  	</ul>
      </li>
      <li><a title="Contacto" href="admin.php?name=contacto">Contacto</a></li>
  </ul></nav>

  <article id="contenido" role="main">
