$(document).ready(function(){
	get_carreras();

	$('#select').change(function () {

  		get_materias( $(this).val() );
	});

	$('#sel_materias').change(function () {
  		get_profes( $(this).val() );
  		get_horas();
  		get_salones();
	});

});

function get_carreras(){
	//var url = 'http://localhost/Servicio/ws/inscripcion.php';
	var url = "http://localhost/Servicio/ws/get_all.php";
	$.post(url, {tabla: 1},
		function( data, textStatus, jqXHR){
			var html = '<option selected="selected">Escoge</option>';

			for (var i = 0; i < data.length; i++) {
				html += "<option>carrera</option>";
				html = html.replace("carrera", data[i].siglas);
			};

			$("#select").append(html);

		}, 'json').fail(function(jqXHR, textStatus, errorThrown){
			alert(errorThrown);
	});
}

function get_materias( carrera ){
	var url = "http://localhost/Servicio/ws/inscripcion.php";

	$.post( url, {accion: 2, carrera: carrera},
		function(data, textStatus, jqXHR){
			
			var html ;

			for (var i = 0; i < data.length; i++) {
				html += "<option>materia</option>";
				html = html.replace("materia", data[i].materia);
			};

			$("#sel_materias").html(html);

	}, 'json').fail( function(jqXHR, textStatus, errorThrown){
		alert(errorThrown);
	});
}


function get_profes(materia){
	var url = "http://localhost/Servicio/ws/inscripcion.php"
	
	$.post(url, { accion: 3, materia: materia }, 
		function( data, textStatus, jqXHR ){
			var html;

			for (var i = 0; i < data.length; i++) {
				html += "<option>profe</option>";
				html = html.replace("profe", data[i].nombre);
			};

			$("#sel_profe").html(html);
		}, 'json').fail( function( jqXHR, textStatus, errorThrown ) {
			alert(errorThrown);
		});
}

function get_horas(){
	var url = "http://localhost/Servicio/ws/get_all.php";

	$.post(url, {tabla: 4}, 
		function( data, textStatus, jqXHR ){
			var html;

			for (var i = 0; i < data.length; i++) {
				html += "<option>hora</option>";
				html = html.replace( "hora", data[i].siglas);
			};

			$('#sel_hora').html(html);
		}, 'json').fail( function(jqXHR, textStatus, errorThrown ){
			alert(errorThrown);
	});
}

function get_salones() {
	var url = "http://localhost/Servicio/ws/get_all.php";

	$.post( url, {tabla: 5},
		function( data, textStatus, jqXHR ){
			var html;

			for ( var i = 0; i < data.length; i++ ) {
				html += "<option>salon</option>";
				html = html.replace( "salon", data[i].salon );
			};

			$('#sel_salones').html(html);

		}, 'json' ).fail( function( jqXHR, textStatus, errorThrown ){
				alert(errorThrown);
		} );
}