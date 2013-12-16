<?php
function inactividad(){
//iniciamos la sesión
  session_start();

  //antes de hacer los cálculos, compruebo que el usuario está logueado
  if ($_SESSION["autentificado"] != "SI") {
    //si no está logueado devuelvo falso
    return False;
  } else {
    //sino, calculamos el tiempo transcurrido
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

      //comparamos el tiempo transcurrido
     if($tiempo_transcurrido >= 180) {
      //si pasaron 10 minutos o más
      session_destroy(); // destruyo la sesión
      //header("Location: index.php");
      return False;
      //sino, actualizo la fecha de la sesión
    }else {
      $_SESSION["ultimoAcceso"] = $ahora;
      return True;
    }
  }
}
?>