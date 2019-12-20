$(sdata());

function sdata(consult){
	$.ajax({
		url:'../Model/querys/access_usr.php',
		type:'POST',
		dataType:'html',
		data:{consult: consult},
	})
	.done (function(answer) {
		$("#data").html(answer);
		})
	.fail(function() {
		console.log("error");
	})

	}
 
	$(document).on('keyup','#nc', function(){
	var valor = $(this).val();
	if (valor != "") {
		sdata(valor);
	}else{
		sdata();
	}
});

$(document).ready(function() {
  NewAcs();
});

var NewAcs=function(){
  $("#ag").on("click",function(){
  var opc=$("#agregarr #opc").val(),
      nc=$("#agregarr #nc").val(),
      room=$("#agregarr #room").val();
  $.ajax({
      method:"POST",
      url:"../Model/querys/access.php",
      data:{"opc": opc, "nc": nc, "room": room}
    }).done(function(info) {
          var json_info=JSON.parse(info);
          mostrar_mensaje(json_info);
          limpiar_datos_Ag();
        });
      });
}
var limpiar_datos_Ag = function(){
  $("#agregarr #opc").val("Agregar");
  $("#agregarr #nc").val("");
  $("#agregarr #room").val("");
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