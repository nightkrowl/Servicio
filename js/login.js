$(document).ready(function(){
	$('#login').submit(function(){
		var url = 'http://localhost/Servicio/ws/busqueda.php'
		var usuario = $('[name=usuario]').val();
		var contra = $('[name=contrasena]').val();
		var tipo = $('[name=tipo]').val();
		$.post(url, {tabla: tipo, usuario: usuario, contrasena: contra},
			function(data){
				
				if(data.sesion){
					if(usuario == 'admin'){
						window.location.assign('http://localhost/Servicio/admin/admin.html');
					}else if(usuario == 'profesores'){

					}else if (tipo == 'alumnos') {
						window.location.assign('http://localhost/Servicio/admin.html');
					}
				}else{
					alert('error');
				}
			}, 'json');
		return false;
	});
});