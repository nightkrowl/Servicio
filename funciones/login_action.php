<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	login();
}

function login(){
	$data = array('usuario' => $_POST['usuario'], 'contrasena'=>$_POST['contrasena']);

	//url a web service
	$url = "http://localhost/ws/ws_login.php";
	//curl_handle
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$return = curl_exec($ch);
	curl_close($ch);
	$result = json_decode($return, true);
	
	if ($result['sesion'] == True){
		header('Location: /admin.php');
	}	
}
?>
