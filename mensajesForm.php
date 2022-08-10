<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

include('inc/header.php');
include('inc/sidebar.php');
include('Business/mensajesBusiness.php');


if(isset($_POST['submit'])){
  if(!empty($_GET['edit'])){
    businessModificarMensaje($_POST,$_GET['edit']);
  }else{
    businessGuardarMensaje($_POST,$_FILES);
  }
  redirect('mensajesListado.php');
}


$msj= array("Nombre" =>"" ,"Email" =>"","Telefono" =>"","Reclamo" => "", "Comentario" =>"","Estado"=>"","Respuesta"=>"","IdProducto" => "");
if(!empty($_GET['edit'])){
  $msj=businessObtenerMensaje($_GET['edit']);
}

?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ver Mensajes</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
        <div class="col-md-6 col-center">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
              </div>                
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="Nombre" value="<?php echo $msj['Nombre'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="Email" value="<?php echo $msj['Email'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Telefono</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="Telefono" value="<?php echo $msj['Telefono'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Reclamo</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="Reclamo" value="<?php echo $msj['Reclamo'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mensaje</label>
                    <textarea  class="form-control"  name="Comentario" ><?php echo $msj['Comentario'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Respuesta</label>
                    <textarea  class="form-control"  name="Respuesta" ></textarea>
                    <input type="hidden" class="form-control" name="Estado" value="Respondido">
                    <input type="hidden" class="form-control" name="Estado" value="<?php echo $msj['IdProducto'] ?>">
                  </div>
                  <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include('inc/footer.php');
?>
