<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pagina administrador</title>

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/admin.css" rel="stylesheet">

    <script src="js/jquery.js"></script>
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
          <a class="navbar-brand" href="admin.php">Logo escuela</a>
          
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="admin.php">Inicio</a></li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Alumnos<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="admin.php?name=altas&alta=alumno">Altas</a></li>
                <li><a href="admin.php?name=bajas&baja=alumno">Bajas</a></li>
                <li><a href="#">Subopcion3.3</a></li>
                <li><a href="#">Subopcion3.4</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profesores<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="admin.php?name=altas&alta=profesor">Altas</a></li>
                <li><a href="admin.php?name=bajas&baja=profesor">Bajas</a></li>
                <li><a href="#">Subopcion3.3</a></li>
                <li><a href="#">Subopcion3.4</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Grupos<b class="caret"></b></a>
              <ul class="dropdown-menu">
              <li><a href="admin.php?name=altas&alta=grupo">Altas</a></li>
                <li><a href="admin.php?name=bajas&baja=grupo">Bajas</a></li>
                <li><a href="#">Subopcion3.3</a></li>
                <li><a href="#">Subopcion3.4</a></li>
              </ul>
            </li>
            <li><form>
                <input id="busqueda" type="search" placeholder="Buscar..."><br>
                <input id="btn_buscar" type="submit" value="Buscar">
            </form></li>

          </ul> 
        </div><!-- navbar-collapse -->
      </div><!-- container -->
    </nav>
    <!--header-->