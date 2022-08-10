<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

include('inc/header.php');
include('inc/sidebar.php');
include('Business/mensajesBusiness.php');
include('Business/categoriasBusiness.php');
include('Business/marcasBusiness.php');
include('Business/productosBusiness.php');

$marcas = businessObtenerMarcas();
$categorias = businessObtenerCategorias();

if(isset($_GET['del'])){
  businessBorrarMensaje($_GET['del']);
  redirect('mensajesListado.php');
}
?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Mensajes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Listado de Mensajes</li>
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
          <!-- /.row -->
          <div class="form-check form-check-inline">
            <label class="form-check-label" for="inlineCheckbox1">Filtros: </label>
          </div>
          <div class="input-group-inline mb-3 form-check form-check-inline">
            <div class="input-group-prepend">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorias</button>
              <div class="dropdown-menu">
              <?php foreach($categorias as $cate) {?>
                  <a class="dropdown-item" href ="mensajesListado.php?categoria=<?php echo $cate['Id'] ?>&marca=<?php echo (isset($_GET['marca']))?$_GET['marca']:""; ?>"><?php echo $cate['nombre'];?></a>
              <?php } ?>
              </div>
            </div>
          </div>
          <div class="input-group-inline mb-3 form-check form-check-inline">
            <div class="input-group-prepend">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Marcas</button>
              <div class="dropdown-menu">
              <?php foreach( $marcas as $cate) {?>
                  <a class="dropdown-item" href ="mensajesListado.php?marca=<?php echo $cate['Id']?>&categoria=<?php echo (isset($_GET['categoria']))?$_GET['categoria']:""; ?>"><?php echo $cate['nombre'];?></a>
              <?php } ?>
              </div>
            </div>
          </div>
          <?php
						if(!empty($_GET)){ ?>
              <?php if($_GET["categoria"] != ""){?>
                  <div class="head form-check form-check-inline">
								    <span><?php echo $categorias[$_GET["categoria"]]["nombre"]; ?></span>
							    </div> 
              <?php } ?>
              <?php if($_GET["marca"] != ""){?>
                  <div class="head form-check form-check-inline">
								    <span><?php echo $marcas[$_GET["marca"]]["nombre"]; ?></span>
							    </div> 
              <?php } ?>
							<div class="head form-check form-check-inline">
								<a href="mensajesListado.php" class="btn btn-warning"><i class="fas fa-trash"></i></a>
							</div>
					<?php ;} ?>
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
                        <th>E-Mail</th>
                        <th>Telefono</th>
                        <th>Reclamo</th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach(businessObtenerMensajes() as $mensaje){
                      $print = true;

                      $nProd = businessObtenerProducto($mensaje['IdProducto']);
					
								      if(!empty($_GET['categoria']) AND $print){
									      if($nProd['Idcategoria'] != $_GET['categoria']) $print = FALSE;
								      }
							
								      if(!empty($_GET['marca']) AND $print){
									      if($nProd['IdMarca'] != $_GET['marca']) $print = FALSE;
								      }
							
								      if($print){ ?>
                      <tr>
                        <td><?php echo $mensaje['id']?></td>
                        <td><?php echo $mensaje['Nombre']?></td>
                        <td><?php echo $mensaje['Email']?></td>
                        <td><?php echo $mensaje['Telefono']?></td>
                        <td><?php echo $mensaje['Reclamo']?></td>
                        <td><?php echo $mensaje['Estado']?></td>
                        <td>
                        <a href="mensajesForm.php?edit=<?php echo $mensaje['id'] ?>"><i class="fas fa-eye"></i></a>
                        <a href="mensajesListado.php?del=<?php echo $mensaje['id'] ?>"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php }} ?> 
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
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
