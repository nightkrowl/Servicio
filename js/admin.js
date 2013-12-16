var server = "http://localhost/final/ws/";

$(document).ready(function(){

	if ($("#carreras").is(":visible")) {
		get_carreras();
	};
	if ( $("#semestre").is(":visible") ) {
		get_semestres();
	};
	if ( $("#hora").is(":visible") ) {
		get_horas();
	};

	$('#alta').submit( function() {
		var url = server + 'funciones.php';

		var nombre = $('[name=nombres]').val();
		var apellidos = $('[name=apellidos]').val();
		var carrera = $('[name=carrera]').val();
		var semestre = $('[name=semestre]').val();
		var correo = $('[name=correo]').val();
		var materia = $('[name=materia]').val();
		var profe = $('[name=profesor]').val();
		var hora = $('[name=hora]').val();
		var ciclo = $('[name=ciclo]').val();
		
		$.post(url, {accion: 'alta', nombre: nombre, apellidos: apellidos, carrera: carrera, semestre: semestre, email: correo, materia: materia, profesor: profe, hora: hora, ciclo: ciclo},
			function(data){
				if (data) {
					alert(data);
				}else{
					alert("Ha ocurrido un problema")
				};
			}, 'json').fail(function(jqXHR, textStatus, errorThrown){
        		alert(errorThrown);
        		alert('alta');
      		});
		return false;
	});

	$('#baja').submit( function() {
		var url = server + 'funciones.php';
		var nombres = $('[name=nombres]').val();
		var apellidos = $('[name=apellidos]').val();
		var carrera = $('[name=carrera]').val();
		var semestre = $('[name=semestre]').val();
		var correo = $('[name=correo]').val();

		$.post(url, {accion: 'datos', nombre: nombres, apellidos: apellidos, carrera: carrera, semestre: semestre, email: correo},
			function(data){
				if (data) {
					//alert(data[0].id);
					var html = '<thead> <tr> <th>Nombre</th> <th>Apellidos</th> <th>Semestre</th> <th>Carrera</th> </tr> </thead> <tbody>';
					for (var i = 0; i < data.length; i++) {
          				html += "<tr> <td>nombre</td><td>apellidos</td><td>carrera</td><td>semestre</td><td> <button type=button onclick=borrar('ytr')>Borrar</button> </td> </tr>";
          				html = html.replace('nombre',  data[i].nombre);
          				html = html.replace('apellidos',  data[i].apellidos);
          				html = html.replace('carrera',  data[i].carrera);
          				html = html.replace('semestre',  data[i].semestre);
          				html = html.replace('ytr',  data[i].id);
        			};

        			html += '</tbody>';
        			$('.tabla').html(html);
				}else{
					alert("No se encontraron datos.");
				};
			}, 'json').fail(function(jqXHR, textStatus, errorThrown){
        		alert(jqXHR);
      		});
		return false;
	});

	$("#carreras").change( function() {
		if ( $('[name=materia]').is(":visible") && $('[name=correo]').is(":visible") ) {
			get_materias();
		};
	} );

	$("#semestre").change( function() {
		if ( $('[name=materia]').is(":visible") ) {
			get_materias();
		};
	} );

	$("[name=materia]").change( function() {
		if ( $('[name=profesor]').is(":visible") ) {
			get_profes();

		};
	} );

});
	
function get_carreras(){
	var url = server + "funciones.php";
	$.post(url, {accion: "datos", tabla: "carrera"},
		function( data, textStatus, jqXHR){
			if ( data ) {
				var html = '<option selected="selected">Escoge</option>';

				for (var i = 0; i < data.length; i++) {
					html += "<option>"+data[i].siglas+"</option>";
				};

				$("#carreras").html(html);
			}else{
				alert("Ha ocurrido un problema");
			};
		}, 'json').fail(function(jqXHR, textStatus, errorThrown){
			alert(errorThrown);
			alert("carreras");
		});
	return false;
}

function get_semestres(){
	var html = '<option selected="selected">Escoge</option>';
	for (var i = 1; i < 11; i++) {
		html += "<option>"+i+"</option>";
	};
	$("#semestre").html(html);
}

function borrar(x){
  var url = server + "funciones.php";
  var tabla = $('table').attr('id');
  $.post( url, { accion: "baja" , tabla: tabla, id: x }, 
  	function( data, textStatus, jqXHR ){
    	if ( data ) {
    		alert('borrado');
    	}else{
    		alert('Ha ocurrido un problema');
    	}
        
  	}, 'json').fail( function( jqXHR, textStatus, errorThrown ) {
    	alert(jqXHR);
    	alert('borrar');
  	});
  	return false;
}

function get_materias(){
	var html = "";
	var url = server + "funciones.php";
	var carrera = $('[name=carrera]').val();
	var semestre = $('[name=semestre]').val();

	$.post(url, {accion: "datos", tabla: "materia", carrera:carrera, semestre:semestre},
		function( data, textStatus, jqXHR){
			if ( data ) {
				if ( $('[name=materia]').is(":visible") && $('[name=correo]').is(":visible") ) {
					for (var i = 0; i < data.length; i++) {
						html += '<option value="'+data[i].materia+'"/>';
					};
					$("#materia").html(html);
				}else{
					if (data!="vacio") {
						for (var i = 0; i < data.length; i++) {
							html += '<option value="'+data[i].materia+'"/>';
						};
						$("#materia").html(html);
					}else{
						$("#materia").html(html);
					}
				};
				
			}else{
				alert("Ha ocurrido un problema");
			};
		}, 'json').fail(function(jqXHR, textStatus, errorThrown){
			alert(errorThrown);
			alert("materias");
		});
	return false;
}

function get_horas(){
	var url = server + "funciones.php";
	$.post(url, {accion: "datos", tabla: "hora"},
		function( data, textStatus, jqXHR){
			if ( data ) {
				var html = '<option selected="selected">Escoge</option>';

				for (var i = 0; i < data.length; i++) {
					html += "<option>"+data[i].siglas+"</option>";
				};

				$("#hora").html(html);
			}else{
				alert("Ha ocurrido un problema");
			};
		}, 'json').fail(function(jqXHR, textStatus, errorThrown){
			alert(errorThrown);
			alert('horas');
		});
	return false;
}

function get_profes(){
	var html;
	var url = server + "funciones.php";
	var materia = $('[name=materia]').val();
	var carrera = $('[name=carrera]').val();
	
	$.post(url, {accion: "datos", tabla: "materia-profesor", carrera: carrera, materia: materia},
		function( data, textStatus, jqXHR){
			if ( data ) {
				for (var i = 0; i < data.length; i++) {
					html += '<option value="'+data[i].profesor+'"/>';
				};
				$("#profesor").html(html);

			}else{
				alert("Ha ocurrido un problema");
			};
		}, 'json').fail(function(jqXHR, textStatus, errorThrown){
			alert(errorThrown);
			alert('error');
		});
	return false;
}