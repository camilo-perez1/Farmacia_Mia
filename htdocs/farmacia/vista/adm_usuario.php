
<?php

session_start();
if ($_SESSION['us_tipo'] == 1) {
    include_once 'layouts/header.php';
?>
  <title>Farmacia | Editar datos personales</title>

<?php
    include_once 'layouts/nav.php';
?>
  <!-- Button trigger modal -->



   <div class="modal fade" id="crearusuario" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="card-success">
                <div class="card-header">
                    <h3 class="card-title">Crear usuario</h3> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <div class="card-body">
                  <form id="form-crear">       
                    
                    <div class="form-group">
                         <label for="nombre">Nombres</label>
                        <input type="text" class="form-control" id="nombre" placeholder="ingrese nombres" required>
                    </div>
                      
                    <div class="form-group">
                         <label for="apellido">apellidos</label>
                        <input type="text" class="form-control" id="apellido" placeholder="ingrese apellido" required>
                    </div>
                      
                    <div class="form-group">
                         <label for="edad">Nacimiento</label>
                        <input type="date" class="form-control" id="edad" placeholder="ingrese nacimiento" required>
                    </div>
                      
                    <div class="form-group">
                         <label for="dni">DNI</label>
                        <input type="text" class="form-control" id="dni" placeholder="ingrese DNI" required>
                    </div>
                      
                    <div class="form-group">
                         <label for="pass">Passwaord</label>
                        <input type="password" class="form-control" id="pass" placeholder="ingrese password" required>
                    </div>
                      
                
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-primary float-right">Guardar</button>

                      <button type ="button"data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Close</button>

                </form>
                  </div>
            </div>
        </div>
    </div>
</div>


  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestion Usuarios <button type="button"data-togglee="modal" data-target="#crearusuario" class="btn bg-gradient-prymary ml-2">Crear usuario</button></h1>
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion Usuario</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section>
     <div class="container-fluid">
        <div class="card-card-success">
            <div class="card-hedder">
                <h3 class="card-title">Buscar usuario</h3>
                <div class="input-group">
                    <input type="text" id="Bucar"class="form-control float-left" placeholder="Ingrese nombere de usuario">
                    <div class="input-group-append">
                        <button class="btn btn-default"><i class="fas fa-search"></i></button></div>
                </div>
            </div>
            <div class="card-body"></div>
           </div>
            <div class="card-footer"></div>
        </div>
     </div>
    </section>
  </div>

  
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/demo.js"></script>

<?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
    exit;

}  

?>

<script src="../js/Usuario.js"></script>
