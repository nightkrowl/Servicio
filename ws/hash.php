<?php
require_once("password_compat/lib/password.php");
define("ALGORITMO_HASH", PASSWORD_BCRYPT);
define("INDEX_ALGORITMO_HASH", 1);
define("COSTO", 10);//Recomendado es 10
define("SALT_BYTES", 22 );

function crear_hash($password, $bool = NULL){
    $salt;
    if ($bool == NULL) {
        $salt = base64_encode( mcrypt_create_iv( SALT_BYTES, MCRYPT_DEV_URANDOM ) );
    }else{
        $salt = $bool;
    }
    
    $opciones = [
    'cost' => COSTO,
    'salt' => $salt,
    ];

    $hashed = base64_encode( password_hash( $password , ALGORITMO_HASH, $opciones ) );

    return array("salt"=>$salt, "hash"=>$hashed);
}

function autenticar($password, $hash , $salt){
    $hashed = crear_hash($password, $salt);
    $login = $hashed['hash'];

    $diff = 0;
    if (strlen($login) == strlen($hash)) {
        for($i = 0; $i < strlen($login); $i++){

        $diff += ord($login[$i]) ^ ord($hash[$i]);
        }
    }
    return $diff;
}

?>