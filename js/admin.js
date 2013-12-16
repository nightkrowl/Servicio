$(document).ready(function() {
    //pagina de inicio
    $('#contenido').load('htmls/inicio.html');

    //navegacion
    $('ul#menu li a').click(function(){
	   var pag = $(this).attr('href');
       //alert(pag);
	   $('#contenido').load('htmls/admin/'+ pag + '.html');
	   return false;
    });

    //Busqueda de alumno o profesor. LLamada a webservice
    $('#busqueda').submit(function(){
        var e = document.getElementById('tipo_busqueda');
        var select = e.options[e.selectedIndex].value;
    	var buscar = $('[name=busqueda]').val();
        var url = 'http://localhost/sistema_registros/ws/busqueda.php';
        $.post(url, {tabla: select, buscar: buscar}, 
            function(data){
                var html = '<table border="1"><tr><th>Nombre</th><th>Apellidos</th></tr>';
                
                for (var i = 0; i < data.length; i++) {
                    html += '<tr><td>' + data[i].nombre + '</td><td>' + data[i].apellidos + '</td></tr>';
                    //$("div").html(data[i].nombre + " " + data[i].apellidos);
                };
                html += '</table>';
                $('#contenido').append(html);
            }, 'json');
        return false;
    });

    /*$("#alta").submit( function() {
        var url = server + "/Servicio/ws/update.php";
        var nombre = $('[name=nombre]').val();
        var apellidos = $('[name=apellidos]').val();
        var usuario = $('[name=usuario]').val();
        var contra = $('[name=contrasena]').val();
        var carrera = $('[name=carrera]').val();
        var email = $('[name=email]').val();
        var semestre = $('[name=semestre]').val();
        alert(url);
        $.post(url, {accion: alta, nombre:nombre, apellidos:apellidos, usuario:usuario,contrasena:contra, email:email,semestre:semestre, carrera:carrera},
            function( data ) {
                alert('data');
            }, 'json');
        return false;
    });*/

});

var server = "http://localhost";