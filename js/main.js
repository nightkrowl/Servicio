server = "http://localhost/servicio/";

$(document).ready(function(){
	var url = server + "ws/get_all.php";
	$.post(url, {accion: "datos"},
		function(data){
			if(data){
				if (data[0].nombre != false) {
					$("#alumno").html("Nombre:"+data[0].nombre);
					$("#matricula").html("Matricula:"+data[0].usuario);
					$("#carrera").html("Carrera:"+data[0].carrera);
				}else{
					alert("Tu sesion ha sido terminada por inactividad");
					window.location.assign(server+'/index.html');
				}
			}
	}, 'json');
});