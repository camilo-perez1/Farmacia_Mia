
<?php

session_start();
if($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] ==3){  
    include_once 'layouts/header.php';
?>

  <title>Adm | Atributo</title>
  <!-- Tell the browser to be responsive to screen width -->
<?php
    include_once 'layouts/nav.php';
?>


   <div class="modal fade" id="crearlaboratorio" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="card-success">
                <div class="card-header">
                    <h3 class="card-title">Crear laboratorio</h3> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="alert alert-success tex-center" id="add-laboratorio" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>Se agrego correctamentre</span>
                    </div>
                    <div class="alert alert-danger tex-center" id="noadd-laboratorio" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>El laboratotio ya existe</span>
                    </div>

                    
                  <form id="form-crear-laboratorio">
                           
                    
                    <div class="form-group">
                         <label for="nombre_laboratorio">Nombre</label>
                        <input  type="text" class="form-control" id="nombre_laboratorio" placeholder="ingrese nombre" required>
                    </div>         
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-primary float-right">crear</button>

                      <button type ="button"data-dismiss="modal" class="btn btn-outline-secondary float-right mr-2">Close</button>

                </form>
                  </div>
            </div>
        </div>
    </div>
</div>



   <div class="modal fade" id="creartipo" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="card-success">
                <div class="card-header">
                    <h3 class="card-title">Crear tipo</h3> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <div class="card-body">
                  <form id="form-crear-tipo">       
                    
                    <div class="form-group">
                         <label for="nombre-tipo">Nombre</label>
                        <input  type="text" class="form-control" id="nombre-tipo" placeholder="ingrese nombre" required>
                    </div>         
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-primary float-right">crear</button>

                      <button type ="button"data-dismiss="modal" class="btn btn-outline-secondary float-right mr-2">Close</button>

                </form>
                  </div>
            </div>
        </div>
    </div>
</div>



   <div class="modal fade" id="crearpresentacion" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="card-success">
                <div class="card-header">
                    <h3 class="card-title">Crear presentacion</h3> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <div class="card-body">
                  <form id="form-crear-presentacion">       
                    
                    <div class="form-group">
                         <label for="nombre-presentacion">Nombre</label>
                        <input  type="text" class="form-control" id="nombre-presentacion" placeholder="ingrese nombre" required>
                    </div>         
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-primary float-right">crear</button>

                      <button type ="button"data-dismiss="modal" class="btn btn-outline-secondary float-right mr-2">Close</button>

                </form>
                  </div>
            </div>
        </div>
    </div>
</div>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestion atributos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestion atributos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a href="#laboratorio" class="nav-link active" data-toggle="tab">Laboratorio</a></li>
                            <li class="nav-item"><a href="#tipo" class="nav-link" data-toggle="tab">Tipo</a></li>
                            <li class="nav-item"><a href="#presentacion" class="nav-link" data-toggle="tab">Presentacion</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" >
                            <div class="tab-pane active" id='laboratorio'>
                                <div class="card card-success">
                                    <div class="card-header">
                                        <div class="card-title">Busca laboratorio <button type="button" data-toggle="modal" data-target="#crearlaboratorio" class="btn bg-gradient-primary btn-sm m-2">Crear Laboratorio</button></div>
                                        <div class="input-group">
                                            <input id="buscar_laboratorio" type="text" class="form-control float-left" placeholder="ingrese nombre">
                                            <div class="input-group-append">
                                            <button class="btn btn-default"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </div>
                                    <div class="card-body"></div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                            <div class="tab-pane" id='tipo'>
                                <div class="card card-success">
                                    <div class="card-header">
                                        <div class="card-title">Buscar tipo<button  type="button" data-toggle="modal" data-target="#creartipo"class="btn bg-gradient-primary btn-sm m-2">Crear tipo</button></div>
                                        <div class="input-group">
                                            <input id="buscar_laboratorio" type="text" class="form-control float-left" placeholder="ingrese nombre">
                                            <div class="input-group-append">
                                            <button class="btn btn-default"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </div>
                                    <div class="card-body"></div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                            <div class="tab-pane" id='presentacion'>
                                <div class="card card-success">
                                    <div class="card-header">
                                        <div class="card-title">Buscar presentacion<button  type="button" data-toggle="modal" data-target="#crearpresentacion"class="btn bg-gradient-primary btn-sm m-2">Crear presentacion</button></div>
                                        <div class="input-group">
                                            <input id="buscar_laboratorio" type="text" class="form-control float-left" placeholder="ingrese nombre">
                                            <div class="input-group-append">
                                            <button class="btn btn-default"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </div>
                                    <div class="card-body"></div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
    include_once 'layouts/footer.php';  
?>

<?php
}
else{
    header('location: ../index.php');
}

?>
<script src="../js/Laboratorio.js"></script>

