<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

include('inc/header.php');
include('inc/sidebar.php');
include('Business/productosBusiness.php');
include('Business/categoriasBusiness.php');
include('Business/marcasBusiness.php');

if(isset($_POST['submit'])){
  if(!empty($_GET['edit'])){
    businessModificarProducto($_POST,$_GET['edit'],$_FILES);
}else{
  businessGuardarProducto($_POST,$_FILES);
  
}
  redirect('productosListado.php');
}

$producto= array("Nombre" =>"" ,"Precio" =>"","Idcategoria" =>"","IdMarca" => "", "Descripcion" =>"", "imagen" =>'');
if(!empty($_GET['edit'])){
  $producto=businessObtenerProducto($_GET['edit']);
  
  
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
          <h3 class="card-title">Agregar o Editar Productos</h3>

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
        <div class="col-md-6">
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
                    <input type="text" class="form-control" id="exampleInputEmail1" name="Nombre" value="<?php echo $producto['Nombre'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Categoria</label>
                    <select name="Idcategoria">
                    <?php foreach(businessObtenerCategorias() as $cat) {?>
                    <option value="<?php echo $cat['Id'] ?>" <?php echo ($cat['Id'] == $producto['Idcategoria'])?'selected':'' ?>> <?php echo $cat['nombre'] ?> </option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Marca</label>
                    <select name="IdMarca">
                    <?php foreach(businessObtenerMarcas() as $cat){?>
                        <option value="<?php echo $cat['Id']?>" <?php echo ($cat['Id'] == $producto['IdMarca'])?'selected':'' ?>> <?php echo $cat['nombre']?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Precio</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="Precio" value="<?php echo $producto['Precio'] ?>">
                  </div>
               
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripcion</label>
                    <textarea  class="form-control"  name="Descripcion" ><?php echo $producto['Descripcion'] ?></textarea>
                  </div>
             
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
						<input type="file" name="imagen" id ="imagen" class="custom-file-input" id="exampleInputFile" onclick="miFunc()">
                        <input type="hidden" name="old_imagen" value="<?php echo $producto['imagen'] ?>" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
