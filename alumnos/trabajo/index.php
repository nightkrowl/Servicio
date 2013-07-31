<!DOCTYPE HTML>
<html lang="es">
 <head>
    <meta charset="UTF-8"/>
    <title>Instituto politecnico nacional</title>
    <link href="css/estilo.css" rel="stylesheet" type="text/css"/>
    <link href="css/header.css" rel="stylesheet" type="text/css"/>
    <link href="css/centro.css" rel="stylesheet" type="text/css"/>
    <link href="css/izquierda.css" rel="stylesheet" type="text/css"/>
    <link href="css/derecha.css" rel="stylesheet" type="text/css"/>
    <link href="css/footer.css" rel="stylesheet" type="text/css"/>  
  </head>
  <body>
  	<div id="todo">
      <header>
        <h1>Instituto Politecnico Nacional</h1>
        <form action="index.html" method="post">
          <input size="20px" type="text"/>
          <input type="submit" value="Buscar"/>
        </form>
        <p>La tecnica al servicio de la patria</p>
      	<nav><!-- Para listas -->
      		<ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="instalaciones.php">Instalaciones</a></li>
            <li><a href="edumedsup.php">Educacion Media Superior</a></li>
            <li><a href="edusup.php">Educacion Superior</a></li>
            <li><a href="posgrado.php">Posgrados</a></li>
            <li><a href="servicios_medicos.php">Servicios medicos</a></li>
            <li><a href="calendario_escolar.php">Calendario escolar</a></li>
      		</ul>
      	</nav>
      </header>
      <aside id="izquierda">
        <p>
          <img class="imagenes" src="imagenes/logo_politecnico.png"/>
        </p>
      </aside>
      <section><!--Para texto en centros-->
        <form action="conexion/validar.php" method="post">
          <table>
            <tr>
              <th colspan="2">
                Servicio en linea
              </th>
            </tr>
            <tr>
              <td>
                <label>Usuario: </label>
              </td>
              <td>
                <input type="text" class ="input_field" name="matricula" required="" size="10px" value=""/>
              </td>
            </tr>
            <tr>
              <td>
                <label>Contraseña: </label>
              </td>
              <td>
                <input type="password" class="input_field" name="pass" required="" size="10px" value=""/>
              </td>
            </tr>
            <tr>
              <td><label>Tipo: </label>
              </td>
                <td>
                  <select>
                    <option value ="Alumno">Alumno</option>
                    <option value ="Maestro">Maestro</option>
                  </select>
                </td>
              </tr>
            <tr>
              <td colspan="2">
                <center><input type="submit" value="Entrar"/></center>
              </td>
            </tr>
          </table>
        </form>
      </section>
      <footer>
        <p>
          INSTITUTO POLITÉCNICO NACIONAL</br>
          D.R. Instituto Politécnico Nacional (IPN), Av. Luis Enrique Erro S/N, Unidad Profesional Adolfo López Mateos, Zacatenco, Delegación Gustavo A. Madero, 
          C.P. 07738, México, Distrito Federal, 2009-2010.  
        </p>
      </footer>
    </div>
  </body>
</html>
