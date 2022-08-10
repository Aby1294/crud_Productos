<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

include('inc/header.php');
include('inc/sidebar.php');
include('Business/productosBusiness.php');
include('Business/categoriasBusiness.php');
include('Business/marcasBusiness.php');

$marcas = businessObtenerMarcas();
$categorias = businessObtenerCategorias();

if(isset($_GET['del'])){
  businessBorrarProducto($_GET['del']);
  redirect('productosListado.php');
}
?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Listado de Productos</li>
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
          <h3 class="card-title">Productos <a href="productosForm.php"><i class="fas fa-plus"></i></a></h3>

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
                  <a class="dropdown-item" href ="productosListado.php?categoria=<?php echo $cate['Id'] ?>&marca=<?php echo (isset($_GET['marca']))?$_GET['marca']:""; ?>"><?php echo $cate['nombre'];?></a>
              <?php } ?>
              </div>
            </div>
          </div>
          <div class="input-group-inline mb-3 form-check form-check-inline">
            <div class="input-group-prepend">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Marcas</button>
              <div class="dropdown-menu">
              <?php foreach( $marcas as $cate) {?>
                  <a class="dropdown-item" href ="productosListado.php?marca=<?php echo $cate['Id']?>&categoria=<?php echo (isset($_GET['categoria']))?$_GET['categoria']:""; ?>"><?php echo $cate['nombre'];?></a>
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
								<a href="productosListado.php" class="btn btn-warning"><i class="fas fa-trash"></i></a>
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
                      <th>Categoria</th>
                      <th>Marca</th>
                      <th>Precio</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach(businessObtenerProductos() as $prod ){
								      $print = true;
					
								      if(!empty($_GET['categoria']) AND $print){
									      if($prod['Idcategoria'] != $_GET['categoria']) $print = FALSE;
								      }
							
								      if(!empty($_GET['marca']) AND $print){
									      if($prod['IdMarca'] != $_GET['marca']) $print = FALSE;
								      }
							
								      if($print){ ?>
                    <tr>
                      <td><?php echo $prod['ID']?></td>
                      <td><?php echo $prod['Nombre']?></td>
                      <td><?php echo $categorias[$prod['Idcategoria']]['nombre']?></td>
                      <td><?php echo $marcas[$prod['IdMarca']]['nombre']?></td>
                      <td><?php echo $prod['Precio']?></td>
                     
                      
                      <td>
                      <a href="productosForm.php?edit=<?php echo $prod['ID'] ?>"><i class="fas fa-pen"></i></a>
                      <a href="productosListado.php?del=<?php echo $prod['ID'] ?>"><i class="fas fa-trash"></i></a>
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
