<?php

require "conexcion.php";

session_start();

if ($_POST) {
  //aca reciviendo password y usuario que se inicia
  $usuario = $_POST['usuario'];
  $password = $_POST['password'];

  //es una consulta para revisar si el usuario existe
  $sql = "SELECT id, password, nombre, tipo_usuario FROM usuarios WHERE usuario='$usuario'";

  //se realiza la ejecucion
  $resultado = $mysqli->query($sql);
  $num = $resultado->num_rows;

  if ($num > 0) {

    $row = $resultado->fetch_assoc();
    $password_bd = $row['password'];

    $pass_c = sha1($password);

    if (/*$password_bd == $pass_c*/$usuario) {//Solo pedira usuario

      $_SESSION['id'] = $row['id'];
      $_SESSION['nombre'] = $row['nombre'];
      $_SESSION['tipo_usuario'] = $row['tipo_usuario'];

      header("Location: productosListado.php");
    } else {

      echo "La contraseña no coincide";
    }
  } else {
    echo "NO existe usuario";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a class="h1"><b>Gorilla</b>Fitness</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Iniciar Secion</p>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group">
            <label class="small mb-1" for="inputEmailAddress">Usuario</label>
            <input class="form-control py-4" id="inputEmailAddress" name="usuario" type="text" placeholder="Ingrese usuario" />
          </div>
          <div class="form-group">
            <label class="small mb-1" for="inputPassword">Password</label>
            <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Ingrese password" />
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.card-body -->
    </div>
  </div>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>
