<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php
include 'C:/xampp/htdocs/veterinaria/mysql/conexion.php';
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
    $_SESSION['id_usuario'] = $user['id_usuario'];
    $_SESSION['usuario'] = $user['nombre_completo'];

        header("Location: http://localhost/veterinaria/sessiones/inicio.php");
        exit();
    } else {
        echo "¡Contraseña incorrecta!";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISTEMA DE GESTOR DE MASCOTAS</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
  </head>
<body class="hold-transition login-page">
  <div class="login-container">
    <div class="login-box-container">
      <div class="login-box">
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <a href=""class="h1"><b>ANIMAL </b>|PET</a>
          </div>
          <div class="card-body">
            <p class="login-box-msg">BIENVENIDO A ANIMAL|PET</p>
            <form action="" method="post">
              <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <hr>
              <button type="submit" class="btn btn-primary" style="width: 100%">Ingresar</button>
              <br><br>
              <a href="" class="btn btn-secondary" style="width:100%">Cancelar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

 <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js (necesario para Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Bootstrap 4 JS (con Popper.js incluido) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>

</body>
</html>