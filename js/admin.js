$(document).ready(function() {
    //pagina de inicio
    $('#contenido').load('htmls/inicio.html');

    //navegacion
    $('ul#menu li a').click(function(){
	   var pag = $(this).attr('href');
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

});