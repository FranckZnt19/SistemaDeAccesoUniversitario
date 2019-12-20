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
                  <h6 class="m-0 font-weight-bold text-white-50">Asignar acceso</h6>
                </div>
                <div class="card-body">
                    <div class="col-sm-offset-2 col-sm-8">
                      <p class="mensaje"></p>
                    </div>
                     <form class="user" id="agregarr" action="" method="POST" style="text-align: center;">
                        <input type="hidden" id="opc" value="Agregar">
                        <div class="form-group">
                          <input type="text" class="form-control" id="nc" placeholder="Ingresa numero de control...">
                        </div>
                        <div id="data">
                          
                        </div>
                        <div class="form-group">
                          <select id="room" class="form-control">
                            <option value="0"> Seleccionar sala </option>
                            <?php require_once '../Model/querys/select.php';
                              foreach ($result as $row) {
                                ?>
                                <option value="<?php echo $row['intid_Room']?>"> <?php echo $row['strNameRoom']; ?> </option>
                                <?php
                               } 
                               ?>
                          </select>
                        </div>
                        <div style="text-align: center;">
                          <a href="accesos.php"><button class="btn btn-secondary" type="button">Cancelar</button></a>
                          <button class="btn btn-primary" type="button" id="ag">Crear</button>
                        </div>
                      </form> 
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

<?php 
	require_once"./Seccion/footer1.php";
 ?>
 <script src="../Control/access.js" type="text/javascript"></script>