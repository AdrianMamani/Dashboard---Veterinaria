<?php
ob_start();
include 'C:/xampp/htdocs/veterinaria/sessiones/modulo_principal/1.php'; 


if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $alert_type = isset($_SESSION['alert_type']) ? $_SESSION['alert_type'] : 'info'; 
    unset($_SESSION['message']); 
    unset($_SESSION['alert_type']);  
} else {
    $message = null;
    $alert_type = 'info';
}

include 'C:/xampp/htdocs/veterinaria/mysql/conexion.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $raza = $_POST['raza'];
    $edad = $_POST['edad'];

    $id_usuario = $_SESSION['id_usuario']; 

    $sql = "INSERT INTO mascotas (nombre, especie, raza, edad, id_usuario) 
            VALUES ('$nombre', '$especie', '$raza', '$edad', '$id_usuario')";

    if ($conexion->query($sql) === TRUE) {
        $_SESSION['message'] = "Mascota registrada con éxito";
        $_SESSION['alert_type'] = 'success'; 
        header("Location: agregar_mascota.php"); 
        exit();
    } else {
        $_SESSION['message'] = "Error al registrar la mascota: " . $conexion->error;
        $_SESSION['alert_type'] = 'error'; 
    }
}
ob_end_flush(); 
?>


<!-- Incluir SweetAlert2 CSS y JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.6/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.6/dist/sweetalert2.min.js"></script>

<div class="container-fluid">
  <h1>Agregar Mascota</h1>
  <div class="row">
    <div class="col-md-6">
        <div class="card card-primary shadow-none">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold; color: white;">Datos de la Mascota</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre de la Mascota <b>*</b></label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="especie">Especie <b>*</b></label>
                                <select name="especie" class="form-control" required>
                                    <option value="perro">Perro</option>
                                    <option value="gato">Gato</option>
                                    <option value="conejo">Conejo</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="raza">Raza <b>*</b></label>
                                <input type="text" name="raza" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edad">Edad <b>*</b></label>
                                <input type="number" name="edad" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="../mascota/tabla_mascota.php" class="btn btn-secondary">Cancelar</a>
                            <input type="submit" class="btn btn-success" value="Registrar Mascota">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
<?php if ($message): ?>
    Swal.fire({
        title: '<?php echo $message; ?>',
        icon: '<?php echo $alert_type; ?>',
        confirmButtonText: 'Aceptar'
    });
<?php endif; ?>
</script>

<?php
include '../modulo_principal/2.php';
?>
