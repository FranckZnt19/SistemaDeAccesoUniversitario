$(document).ready(function() {
  listar();
  NewUsr();
  ElCard();
});

var listar=function(){
  var tab=$('#nuevo1').DataTable({
          "destroy":false,
          "ajax":{
            "method":"POST",
            "url":"../Model/querys/tabrfid.php"
          },
          "columns":[
          {"data":"intUidCard"},
          {"defaultContent":"<button type='button' class='agregar btn btn-primary' data-toggle='modal' data-target='#agregarusr'><i class='fas fa-user-edit'></i></button>  <button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#eliminaruid' ><i class='far fa-trash-alt'></i></button>"}],
          "language":spn,
        });
        setInterval(function () {tab.ajax.reload(null, false); }, 3000);
        data_usuario("#nuevo1 tbody", tab);
        data_eliminar_uid("#nuevo1 tbody", tab);
}
var data_usuario=function(tbody,tab){
  $(tbody).on("click","button.agregar",function(){
    var data=tab.row($(this).parents("tr")).data();
    var UidUsr=$("#agregaruser #eUID").val(data.intUidCard);
  });
}
var data_eliminar_uid=function(tbody,tab){
  $(tbody).on("click","button.eliminar",function(){
    var data=tab.row($(this).parents("tr")).data();
    var UidUsr=$("#eliminarcard #eUID").val(data.intUidCard);
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
var NewUsr=function(){
  $("#ag").on("click",function(){
  var eUID=$("#agregaruser #eUID").val(),
      opc=$("#agregaruser #opc").val(),
      tName=$("#agregaruser #tName").val(),
      tApellido=$("#agregaruser #tApellido").val(),
      eNC=$("#agregaruser #eNC").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/uidcard.php",
      data:{"eUID": eUID, "opc": opc, "tName": tName, "tApellido": tApellido, "eNC": eNC}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_Ag();
        });
      });
    }
var ElCard=function(){
  $("#el").on("click",function(){
  var eUID=$("#eliminarcard #eUID").val(),
      opc=$("#eliminarcard #opc").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/uidcard.php",
      data:{"eUID": eUID, "opc": opc}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_El();
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
  $("#agregaruser #opc").val("Agregar");
  $("#agregaruser #eUID").val("");
  $("#agregaruser #tName").val("").focus();
  $("#agregaruser #tApellido").val("");
  $("#agregaruser #eNC").val("");
}
var limpiar_datos_El = function(){
  $("#eliminarcard #opc").val("Eliminar");
  $("#eliminarcard #eUID").val("");
}