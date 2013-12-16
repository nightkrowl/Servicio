<?php
require_once("hash.php");

$hash = crear_hash("1");

$res = autenticar("1", $hash[ "hash" ], $hash[ "salt" ]);
if ($res) {
    echo "Fail";
}else{
    echo "login";
}

?>