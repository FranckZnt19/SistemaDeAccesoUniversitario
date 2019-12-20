
$(document).ready(function() {
  listar();
});

var listar=function(){
  var tab=$('#room1').DataTable({
          "destroy":false,
          "ajax":{
            "method":"POST",
            "url":"../Model/querys/tabsalida.php"
          },
          "columns":[
          {"data":"strNameRoom"},
          {"data":"strNameUser"},
          {"data":"strLastNameUser"},
          {"data":"intNumConUser"},
          {"data":"dtm_DaTi"}
          ],
          "language":spn,
        });
        setInterval(function () {tab.ajax.reload(null, false); }, 3000);
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
