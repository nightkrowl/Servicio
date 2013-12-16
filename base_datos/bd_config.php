<?php
define("BD_HOST", "localhost");
define("BD_USUARIO", "root");
define("BD_CONTRASENA", "root");
define("BD_NOMBRE", "registro_escolar");
define( "TABLAS", serialize (array ("alumno" => "alumnos","carrera" =>
 "carreras", "materia" => "materias", "profesor" => "profesores", "hora" => "horas", 
 "salon"=>"salones", "carrera-materia" => "carreras_materias", 
 "materia-profesor" => "materias_profesores", "inscripcion" => "inscripciones" ) ) );

//$tablas = unserialize (TABLAS);
//$tabla = tablas[1];

?>