<?php 
	require_once"View/Seccion/head1.php";
 ?>
 <body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-9 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="Ncont" aria-describedby="Usuario" placeholder="Numero de control...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="clave" placeholder="Clave">
                    </div>
                    <a href="index.html" class="btn btn-primary btn-user btn-block">
                      Ingresar
                    </a>
                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Olvide mi contraseña</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
 <?php 
	require_once"View/Seccion/footer2.php";
 ?>