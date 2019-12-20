$(document).ready(function() {
  listar();
  EdtUsr();
  ElUsr();
  AbrUsr();
  CrUsr();
});

var listar=function(){
  var tab=$('#user1').DataTable({
          "destroy":false,
          "ajax":{
            "method":"POST",
            "url":"../Model/querys/tabusr.php"
          },
          "columns":[
          {"data":"strNameUser"},
          {"data":"strLastNameUser"},
          {"data":"intNumConUser"},
          {"data":"intfkUidUser"},
          {"data":"boolEstUser",
          render:function(data,type,row,meta) {
              if (data.substr(0,5)==="0") {
                return "<button type='button' class='Abrir btn btn-success' data-toggle='modal' data-target='#abrirusr'><i class='fas fa-user-alt'></i></button> <button type='button' class='updat btn btn-primary' data-toggle='modal' data-target='#editarusrs'><i class='fas fa-user-edit'></i></button>  <button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#eliminarusr' ><i class='fas fa-user-times'></i></button>";
              }else {
                return "<button type='button' class='Cerrar btn btn-danger' data-toggle='modal' data-target='#cerrarusr'><i class='fas fa-user-alt-slash'></i></button> <button type='button' class='updat btn btn-primary' data-toggle='modal' data-target='#editarusrs'><i class='fas fa-user-edit'></i></button>  <button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#eliminarusr' ><i class='fas fa-user-times'></i></button>";
              }
            }
          }],
          "language":spn,
        });
        setInterval(function () {tab.ajax.reload(null, false); }, 3000);
        data_usuario("#user1 tbody", tab);
        data_abrir_ac_us("#user1 tbody", tab);
        data_cerrar_ac_us("#user1 tbody", tab);
        data_eliminar_us("#user1 tbody", tab);
}
var data_usuario=function(tbody,tab){
  $(tbody).on("click","button.updat",function(){
    var data=tab.row($(this).parents("tr")).data();
    var intID=$("#editarusrs #intID").val(data.intid_UidUser),
        tName=$("#editarusrs #tName").val(data.strNameUser),
        tApellido=$("#editarusrs #tApellido").val(data.strLastNameUser),
        eNC=$("#editarusrs #eNC").val(data.intNumConUser);
  });
}

var data_eliminar_us=function(tbody,tab){
  $(tbody).on("click","button.eliminar",function(){
    var data=tab.row($(this).parents("tr")).data();
    var intID=$("#eliminarusr #intID").val(data.intid_UidUser);
  });
}

var data_abrir_ac_us=function(tbody,tab){
  $(tbody).on("click","button.Abrir",function(){
    var data=tab.row($(this).parents("tr")).data();
    var intID=$("#abrirusr #intID").val(data.intid_UidUser);
  });
}

var data_cerrar_ac_us=function(tbody,tab){
  $(tbody).on("click","button.Cerrar",function(){
    var data=tab.row($(this).parents("tr")).data();
    var intID=$("#cerrarusr #intID").val(data.intid_UidUser);
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
var EdtUsr=function(){
  $("#ac").on("click",function(){
  var intID=$("#editarusrs #intID").val(),
      opc=$("#editarusrs #opc").val(),
      tName=$("#editarusrs #tName").val(),
      tApellido=$("#editarusrs #tApellido").val(),
      eNC=$("#editarusrs #eNC").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/users.php",
      data:{"intID": intID, "opc": opc, "tName": tName, "tApellido": tApellido, "eNC": eNC}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_Ed();
        });
      });
    }
var ElUsr=function(){
  $("#el").on("click",function(){
  var intID=$("#eliminarusr #intID").val(),
      opc=$("#eliminarusr #opc").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/users.php",
      data:{"intID": intID, "opc": opc}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_El();
        });
      });
    }
var AbrUsr=function(){
  $("#ar").on("click",function(){
  var intID=$("#abrirusr #intID").val(),
      opc=$("#abrirusr #opc").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/users.php",
      data:{"intID": intID, "opc": opc}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_abr();
        });
      });
    }
var CrUsr=function(){
  $("#cr").on("click",function(){
  var intID=$("#cerrarusr #intID").val(),
      opc=$("#cerrarusr #opc").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/users.php",
      data:{"intID": intID, "opc": opc}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_cr();
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

var limpiar_datos_Ed = function(){
  $("#editarusrs #opc").val("Editar");
  $("#editarusrs #tName").val("").focus();
  $("#editarusrs #tApellido").val("");
  $("#editarusrs #intID").val("");
}
var limpiar_datos_El = function(){
  $("#eliminarusr #opc").val("Eliminar");
  $("#eliminarusr #intID").val("");
}
var limpiar_datos_abr = function(){
  $("#abrirusr #opc").val("Abrir");
  $("#abrirusr #intID").val("");
}
var limpiar_datos_cr = function(){
  $("#cerrarusr #opc").val("Cerrar");
  $("#cerrarusr #intID").val("");
}