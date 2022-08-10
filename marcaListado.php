<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

include('inc/header.php');
include('inc/sidebar.php');
include('Business/marcasBusiness.php');

if(isset($_GET['del'])){
  businessBorrarMarca($_GET['del']);
  redirect('marcaListado.php');
}
if(isset($_POST['submit'])){
  if(!empty($_GET['edit'])){
    businessModificarmarca($_POST,$_GET['edit']);
  }else{
    businessGuardarMarca($_POST);
  }
  redirect('marcaListado.php');
}
$marca= array("nombre" =>"");
if(!empty($_GET['edit'])){
  $marca=businessObtenerMarca($_GET['edit']);
}

?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Marcas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Listado de Marcas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Marca</h3>
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
          <form class="form-inline" method="post">
            <div class="form-group mx-sm-3 mb-2">
              <label for="exampleFormControlInput1" class="sr-only">Nombre</label>
              <input type="text" class="form-control" name = "nombre" value = "<?php if(!empty($_GET['edit'])){echo $marca['nombre'];}?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary mb-2"><?php if(!empty($_GET['edit'])){echo 'Modificar';}else{echo 'Agregar';}?></button>
            <?php 
              if(!empty($_GET['edit'])){ ?>
                  <a href="marcaListado.php" class="btn btn-primary mx-sm-3 mb-2"><i class="fas fa-trash"></i></a>
            <?php } ?>
          </form>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach(businessObtenerMarcas() as $marc ){?>
                    <tr>
                      <td><?php echo $marc['Id']?></td>
                      <td><?php echo $marc['nombre']?></td>
                      <td>
                      <a href="marcaListado.php?edit=<?php echo $marc['Id'] ?>"><i class="fas fa-pen"></i></a>
                      <a href="marcaListado.php?del=<?php echo $marc['Id'] ?>"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
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
