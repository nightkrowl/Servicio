$(document).ready(function(){
	$('#login').submit(function(){
		var url = 'http://localhost/sistema_registros/ws/busqueda.php'
		var usuario = $('[name=usuario]').val();
		var contra = $('[name=contrasena]').val();
		var tipo = $('[name=tipo]').val();
		$.post(url, {tabla: tipo, usuario: usuario, contrasena: contra},
			function(data){
				//if(data.sesion){alert('hola')}
				if(data.sesion){
					if(usuario == 'admin'){
						window.location.assign('http://localhost/sistema_registros/admin.html');
					}else if(usuario == 'profesores'){

					}
				}else{
					alert('error');
				}
			}, 'json');
		return false;
	});
});