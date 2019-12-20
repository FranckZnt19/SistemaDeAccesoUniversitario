
$(document).ready(function() {
  listar();
  ElRoom();
  ArRoom();
  CrRoom();
});

var listar=function(){
  var tab=$('#room1').DataTable({
          "destroy":false,
          "ajax":{
            "method":"POST",
            "url":"../Model/querys/tabaccess.php"
          },
          "columns":[
          {"data":"strNameRoom"},
          {"data":"strNameUser"},
          {"data":"strLastNameUser"},
          {"data":"intNumConUser"},
          {"data":"EstAccess",
          render:function(data,type,row,meta) {
              if (data.substr(0,7)==="0") {
                return "<button type='button' class='Abrir btn btn-success' data-toggle='modal' data-target='#abrirroom'><i class='fas fa-door-open'></i></button> <button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#eliminarroom' ><i class='far fa-trash-alt'></i></button>";
              }else {
                return "<button type='button' class='Cerrar btn btn-danger' data-toggle='modal' data-target='#cerrarroom'><i class='fas fa-door-closed'></i></button> <button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#eliminarroom' ><i class='far fa-trash-alt'></i></button>";
              }
            }
          }],
          "language":spn,
        });
        setInterval(function () {tab.ajax.reload(null, false); }, 3000);
        data_eliminar_room("#room1 tbody", tab);
        data_abrir_room("#room1 tbody", tab);
        data_cerrar_room("#room1 tbody", tab);
}

var data_eliminar_room=function(tbody,tab){
  $(tbody).on("click","button.eliminar",function(){
    var data=tab.row($(this).parents("tr")).data();
    var intID=$("#eliminarroom #intID").val(data.intid_Access);
  });
}
var data_abrir_room=function(tbody,tab){
  $(tbody).on("click","button.Abrir",function(){
    var data=tab.row($(this).parents("tr")).data();
    var intID=$("#abrirroom #intID").val(data.intid_Access);
  });
}
var data_cerrar_room=function(tbody,tab){
  $(tbody).on("click","button.Cerrar",function(){
    var data=tab.row($(this).parents("tr")).data();
    var intID=$("#cerrarroom #intID").val(data.intid_Access);
  });
}

var spn={
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate":
                  {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                  },
        "oAria": 
                    {
                      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
        "buttons": 
                    {
                      "copy": "Copiar",
                      "colvis": "Visibilidad"
                    }
}

var ElRoom=function(){
  $("#el").on("click",function(){
  var intID=$("#eliminarroom #intID").val(),
      opc=$("#eliminarroom #opc").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/access_room.php",
      data:{"intID": intID, "opc": opc}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_El();
        });
      });
    }
var ArRoom=function(){
  $("#Ar").on("click",function(){
  var intID=$("#abrirroom #intID").val(),
      opc=$("#abrirroom #opc").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/access_room.php",
      data:{"intID": intID, "opc": opc}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_Ab();
        });
      });
    }
var CrRoom=function(){
  $("#Cr").on("click",function(){
  var intID=$("#cerrarroom #intID").val(),
      opc=$("#cerrarroom #opc").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/access_room.php",
      data:{"intID": intID, "opc": opc}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_Cr();
        });
      });
    }
var mostrar_mensaje = function( informacion ){
  var texto = "", color = "";
  if( informacion.respuesta == "BIEN" ){
    texto = "<strong>Bien!</strong> Se han guardado los cambios correctamente.";
    color = "#379911";
  }else if( informacion.respuesta == "ERROR"){
    texto = "<strong>Error</strong>, no se ejecutó la consulta.";
    color = "#C9302C";
  }else if( informacion.respuesta == "EXISTE" ){
    texto = "<strong>Información!</strong> el usuario ya existe.";
    color = "#5b94c5";
  }else if( informacion.respuesta == "VACIO" ){
    texto = "<strong>Advertencia!</strong> debe llenar todos los campos solicitados.";
    color = "#ddb11d";
  }else if( informacion.respuesta == "OPCION_VACIA" ){
    texto = "<strong>Advertencia!</strong> la opción no existe o esta vacia, recargar la página.";
    color = "#ddb11d";
  }
  $(".mensaje").html( texto ).css({"color": color });
  $(".mensaje").fadeOut(5000, function(){
    $(this).html("");
    $(this).fadeIn(3000);
  });     
}

var limpiar_datos_El = function(){
  $("#eliminarroom #opc").val("Eliminar");
  $("#eliminarroom #intID").val("");
}
var limpiar_datos_Ab = function(){
  $("#abrirroom #opc").val("Abrir");
  $("#abrirroom #intID").val("");
}
var limpiar_datos_Cr = function(){
  $("#cerrarroom #opc").val("Cerrar");
  $("#cerrarroom #intID").val("");
}