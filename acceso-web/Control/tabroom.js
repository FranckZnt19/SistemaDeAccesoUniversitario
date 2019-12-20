
$(document).ready(function() {
  listar();
  NewRoom();
  UpdRoom();
  ElRoom();
  ArRoom();
  CrRoom();
});

var listar=function(){
  var tab=$('#room1').DataTable({
          "destroy":false,
          "ajax":{
            "method":"POST",
            "url":"../Model/querys/tabroom.php"
          },
          "columns":[
          {"data":"strNameRoom"},
          {"data":"boolEstRoom",
          render:function(data,type,row,meta) {
              if (data.substr(0,2)==="0") {
                return "<button type='button' class='Abrir btn btn-success' data-toggle='modal' data-target='#abrirroom'><i class='fas fa-door-open'></i></button> <button type='button' class='updat btn btn-primary' data-toggle='modal' data-target='#editarroom'><i class='fas fa-user-edit'></i></button>  <button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#eliminarroom' ><i class='far fa-trash-alt'></i></button>";
              }else {
                return "<button type='button' class='Cerrar btn btn-danger' data-toggle='modal' data-target='#cerrarroom'><i class='fas fa-door-closed'></i></button> <button type='button' class='updat btn btn-primary' data-toggle='modal' data-target='#editarroom'><i class='fas fa-user-edit'></i></button>  <button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#eliminarroom' ><i class='far fa-trash-alt'></i></button>";
              }
            }
          }],
          "language":spn,
        });
        setInterval(function () {tab.ajax.reload(null, false); }, 3000);
        data_room("#room1 tbody", tab);
        data_eliminar_room("#room1 tbody", tab);
        data_abrir_room("#room1 tbody", tab);
        data_cerrar_room("#room1 tbody", tab);
}
var data_room=function(tbody,tab){
  $(tbody).on("click","button.updat",function(){
    var data=tab.row($(this).parents("tr")).data();
    var intID=$("#editarroom #intID").val(data.intid_Room),
        tName=$("#editarroom #tName").val(data.strNameRoom);
  });
}
var data_eliminar_room=function(tbody,tab){
  $(tbody).on("click","button.eliminar",function(){
    var data=tab.row($(this).parents("tr")).data();
    var intID=$("#eliminarroom #intID").val(data.intid_Room);
  });
}
var data_abrir_room=function(tbody,tab){
  $(tbody).on("click","button.Abrir",function(){
    var data=tab.row($(this).parents("tr")).data();
    var intID=$("#abrirroom #intID").val(data.intid_Room);
  });
}
var data_cerrar_room=function(tbody,tab){
  $(tbody).on("click","button.Cerrar",function(){
    var data=tab.row($(this).parents("tr")).data();
    var intID=$("#cerrarroom #intID").val(data.intid_Room);
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
var NewRoom=function(){
  $("#ag").on("click",function(){
  var opc=$("#agregarroom #opc").val(),
      tName=$("#agregarroom #tName").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/sala.php",
      data:{"opc": opc, "tName": tName}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_Ag();
        });
      });
    }
var UpdRoom=function(){
  $("#Er").on("click",function(){
  var opc=$("#editarroom #opc").val(),
      tName=$("#editarroom #tName").val(),
      intID=$("#editarroom #intID").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/sala.php",
      data:{"intID": intID, "opc": opc, "tName": tName}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_Ed();
        });
      });
    }
var ElRoom=function(){
  $("#el").on("click",function(){
  var intID=$("#eliminarroom #intID").val(),
      opc=$("#eliminarroom #opc").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/sala.php",
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
      url:"../Model/querys/sala.php",
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
      url:"../Model/querys/sala.php",
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

var limpiar_datos_Ag = function(){
  $("#agregarroom #opc").val("Agregar");
  $("#agregarroom #tName").val("").focus();
}
var limpiar_datos_Ed = function(){
  $("#editarroom #opc").val("Editar");
  $("#editarroom #tName").val("").focus();
  $("#editarroom #intID").val("");
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