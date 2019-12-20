<?php 
	require_once"./Seccion/head2.php";
 ?>
 <body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php 
		require_once"./Seccion/menuv1.php";
	 ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php 
		//require_once"./Seccion/menuh1.php";
	 	?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">SISTEMA DE ACCESO UNIVERSITARIO</h1>
          </div>

          <!-- Content Row -->

          <!-- Content Row -->
          <div class="row">

            <div class="col-lg-10 mb-10">
              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3 bg-secondary">
                  <h6 class="m-0 font-weight-bold text-white-50">Salas</h6>
                </div>
                <div class="card-body">
                    <div class="col-sm-offset-2 col-sm-8">
                      <p class="mensaje"></p>
                </div>
                  <button type="button" class="agregar btn btn-primary" data-toggle="modal" data-target="#agregarroom"><i class="fas fa-plus"> Nueva sala</i></button> 
                  <br><br>
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
           
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/80x15.png" /></a><br />Esta obra está bajo una <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Licencia Creative Commons Atribución-NoComercial-CompartirIgual 4.0 Internacional</a>.</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Modal-->
  <div class="modal fade" id="agregarroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar sala</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="user" id="agregarr" action="" method="POST">
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="opc" value="Agregar">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="tName" placeholder="Ingresa nombre...">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary" type="button" data-dismiss="modal" id="ag">Agregar</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal-->
  <div class="modal fade" id="editarroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar sala</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="user" id="editarr" action="" method="POST">
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="opc" value="Editar">
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="intID">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="tName" placeholder="Ingresa nombre...">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary" type="button" data-dismiss="modal" id="Er">Actualizar</button>
        </form>
        </div>
      </div>
    </div>
  </div>
    <!-- Modal-->
  <div class="modal fade" id="eliminarroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar sala</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        ¿Esta seguro de eliminar esta sala?
          <form class="user" id="eliminarr" action="" method="POST">
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="intID">
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="opc" value="Eliminar">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary" type="button" data-dismiss="modal" id="el">Eliminar</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal-->
  <div class="modal fade" id="abrirroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Abrir sala</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        ¿Esta seguro de abrir esta sala?
          <form class="user" id="abrirr" action="" method="POST">
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="intID">
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="opc" value="Abrir">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary" type="button" data-dismiss="modal" id="Ar">Abrir</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal-->
  <div class="modal fade" id="cerrarroom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cerrar sala</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        ¿Esta seguro de cerrar esta sala?
          <form class="user" id="cerrarr" action="" method="POST">
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="intID">
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control form-control-user" id="opc" value="Cerrar">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-primary" type="button" data-dismiss="modal" id="Cr">Cerrar</button>
        </form>
        </div>
      </div>
    </div>
  </div>

<?php 
	require_once"./Seccion/footer1.php";
 ?>
 <script src="../Control/tabroom.js" type="text/javascript"></script>