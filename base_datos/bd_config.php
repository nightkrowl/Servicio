<?php
define("BD_HOST", "localhost");
define("BD_USUARIO", "root");
define("BD_CONTRASENA", "root");
define("BD_NOMBRE", "registro_escolar");
define( "TABLAS", serialize (array ("alumnos",
 "carreras", "materias", "profesores", "horas", "salones",
 "carreras_materias", "materias_profesores", "inscripciones" ) ) );

//$tablas = unserialize (TABLAS);
//$tabla = tablas[1];

?>