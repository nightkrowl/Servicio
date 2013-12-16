<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pagina principal</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <!-- Estilos css -->
    <link href="css/estilo.css" rel="stylesheet">

  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Logo escuela</a>
          <p class="text">slogan escuela o referencia a la escuela</p>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php?name=noticias">Nexus</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Noticias<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Subopcion3.1</a></li>
                <li><a href="#">Subopcion3.2</a></li>
                <li><a href="#">Subopcion3.3</a></li>
                <li><a href="#">Subopcion3.4</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Información<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Subopcion4.1</a></li>
                <li><a href="#">Subopcion4.2</a></li>
                <li><a href="#">Subopcion4.3</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Log in<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <form class="form-signin">
                  <li><input type="text" class="form-control" placeholder="Nombre" name="usuario" autocorrect="off" autocapitalize="off" required autofocus></li>
                  <li><input type="password" class="form-control" placeholder="Contraseña" name="contrasena" required></li>
                  <select class="selectpicker" name="tipo">
                    <option value="alumno">Alumno</option>
                    <option value="3">Maestro</option>
                  </select>
                  <input class="btn btn-lg btn-primary btn-block" type="submit" value="Entrar"/>
                </form>
              </ul>
            </li>
          </ul>
        </div><!-- navbar-collapse -->
      </div><!-- container -->
    </nav>
    <!--header-->