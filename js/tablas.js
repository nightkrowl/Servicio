$(document).ready(function(){

  function actualizarTabla(){
    var url = 'http://localhost/Servicio/ws/get_all.php';
    var tabla = $('table').attr('id');
    
    $.post(url,{tabla: tabla}, 
      function(data, textStatus, jqXHR){
        var html = '<thead> <tr> <th>Nombre</th> <th>Usuario</th> </tr> </thead> <tbody>';
      
        for (var i = 0; i < data.length; i++) {
          html += "<tr> <td>nombre</td><td>usuario </td><td> <button type=button onclick=borrar('ytr')>Borrar</button> </td> <td> <button type=button onclick=editar('xyz')>Editar</button> </td></tr>";
          html = html.replace('ytr', data[i].id);
          html = html.replace('nombre',  data[i].nombre);
          html = html.replace('usuario',  data[i].usuario);
          html = html.replace('xyz',  data[i].id);
        };

        html += '</tbody></table></div>';
        $('#tabla').append(html);
      }, 'json').fail(function(jqXHR, textStatus, errorThrown){
        alert(textStatus);
      });
  }

  $('#editar').submit(function(){
    var url = 'http://localhost/Servicio/ws/update.php'
    var nombre = $('[name=nombre]').val();
    var apellidos = $('[name=apellidos]').val();
    var usuario = $('[name=usuario]').val();
    var contra = $('[name=contrasena]').val();
    var email = $('[name=email]').val();
    var tabla = $('table').attr('id');
    var id_profe = $('[name=id_profe]').val();

    $.post(url, {tabla: tabla, nombre:nombre, apellidos:apellidos,usuario: usuario, contrasena: contra, email:email, id: id_profe},
      function(data){
        if(data){
          $('#contenido').load('htmls/profesores.html');
        }else{
          alert('error');
        }
      }, 'json');
    return false;
  });

  actualizarTabla();

});

var popupStatus = 0;

function borrar(x){
  var url = 'http://localhost/Servicio/ws/update.php';
  var id_profe = x;
  var tabla = $('table').attr('id');
  $.post( url, { tabla: tabla, id: id_profe }, 
  function( data, textStatus, jqXHR ){
    if ( data ) {
      alert(data);
      $('#contenido').load('htmls/profesores.html');
    }
        
  }, 'json').fail( function( jqXHR, textStatus, errorThrown ) {
    alert('error');
  });
}

function editar(id){
  //alert(id);
  cargando();
  setTimeout(function(){
    carga_popup(id);
  }, 500);
  return false;
}

$("div.cerrar").click( function() {
  cierra_popup();
});

$(this).keyup( function(event) {
  if (event.which == 27) {
    cierra_popup();
  };
});

function cargando(){
  $("div.loading").show();
}

function cierra_cargando(){
  $("div.loading").fadeOut('normal');
}

function carga_popup(id){
  if(popupStatus == 0){
    cierra_cargando();
    $("#toPopup").fadeIn(0500);
    $("#fondoPopup").css("opacity", "0.7");
    $("#fondoPopup").fadeIn(0001);
    popupStatus = 1;

    var url = 'http://localhost/Servicio/ws/busqueda.php';
    var id_profe = id;
    var tabla = $('table').attr('id');
    $.post(url,{tabla: tabla, id_profe: id_profe}, 
    function(data, textStatus, jqXHR){
      for (var i = 0; i < data.length; i++) {
        $("#campos").html('<label>Nombre:</label><input id="nombre" type="text" name="nombre" maxlength="30" placeholder="Nombre" autofocus required /> <label>Apellidos:</label><input id="apellidos" type="text" name="apellidos" maxlength="30" placeholder="Apellidos" autofocus required /> <label>Usuario:</label><input id="usuario" type="text" name="usuario" maxlength="30" placeholder="Usuario" required /> <label>Contraseña:</label><input id="contrasena" type="password" name="contrasena" maxlength="30" placeholder="Contraseña" required /> <label>Correo:</label><input id="email" type="text" name="email" maxlength="30" placeholder="Correo" required /> <input  id="id_profe" name="id_profe" type=hidden />');
        $("#id_profe").val(data[i].id);
        $("#nombre").val(data[i].nombre);
        $("#apellidos").val(data[i].apellidos);
        $("#usuario").val(data[i].usuario);
        $("#contrasena").val(data[i].contrasena);
        $("#email").val(data[i].email);
      };
    }, 'json').fail(function(jqXHR, textStatus, errorThrown){
      alert(textStatus);
    });
  }
}

function cierra_popup(){
  if (popupStatus == 1) {
    $("#toPopup").fadeOut("normal");
    $("#fondoPopup").fadeOut("normal");
    popupStatus = 0;
  };
}

$("div#fondoPopup").click(function() {
    cierra_popup();
});