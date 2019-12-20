<?php 
	require_once"./Seccion/head2.php";
  $intIDusr=$_GET['intID'];
  $informacion=[];
  if ($intID!= "") {
    $informacion["respuesta"] = "LISTO";
    echo json_encode($informacion);
  }else {
    $informacion["respuesta"] = "VACIO";
    echo json_encode($informacion);
  }
 ?>
 <body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">

            <div class="col-lg-12 mb-12">
              <!-- Tab -->
              <table class="table table-bordered" id="room1" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sala</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Sala</th>
                    <th>Acción</th>
                  </tr>
                </tfoot>
              </table>
            </div>
           
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Modal-->
  <div class="modal fade" id="Asignarroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Asignar acceso</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Esta seguro de asignar este acceso?
          <form class="user" id="asignarr" action="" method="POST">
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="opc" value="Asignar">
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="intID">
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="intIDusr" value="<?php echo $_GET[intID]; ?>">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary" type="button" data-dismiss="modal" id="asig">Asignar</button>
        </form>
        </div>
      </div>
    </div>
  </div>

<?php 
	require_once"./Seccion/footer1.php";
 ?>
 <script src="../Control/slctabroom.js" type="text/javascript"></script>