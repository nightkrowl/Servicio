var server = "http://localhost/final/";

$(document).ready(function(){
	$('.form-signin').submit(function(){
		var url = server+'ws/busqueda.php';
		var usuario = $('[name=usuario]').val();
		var contra = $('[name=contrasena]').val();
		var tipo = $('[name=tipo]').val();

		$.post(url, {tabla: tipo, usuario: usuario, contrasena: contra},
			function(data){
				if(data.sesion){
					if(usuario == 'admin'){
						window.location.assign( server + 'admin.php');
					}else if(tipo == ''){

					}else if (tipo == 'alumno') {
						window.location.assign( server + 'alumnos.php' );
					}
				}else{
					alert('error');
				}
			}, 'json');
		return false;
	});
});