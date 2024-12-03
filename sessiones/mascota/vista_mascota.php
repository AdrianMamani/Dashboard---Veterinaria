<?php
include '../modulo_principal/1.php';
include '../../mysql/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    // Redirigir al login si no hay sesión
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario']; // Obtener el id_usuario de la sesión
$id_mascota = $_GET['id_mascota']; // Obtener el id_mascota desde la URL

// Realizar la consulta para obtener los detalles de la mascota (sin la columna estado_salud)
$sql = "SELECT id, nombre, especie, raza, edad, nivel_alimentacion, fecha_creacion FROM mascotas WHERE id = ? AND id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $id_mascota, $id_usuario); // Vincula los parámetros id_mascota y id_usuario
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontró la mascota
if ($result->num_rows > 0) {
    $mascota = $result->fetch_assoc();
} else {
    // Redirigir si no se encuentra la mascota o el usuario no tiene acceso
    echo "<script>alert('Mascota no encontrada o no tienes acceso a esta mascota.'); window.location.href = 'lista_mascotas.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Mascota</title>
</head>
<body>

    <div class="container-fluid">
        <h1>Detalles de la Mascota</h1>
        <div class="col-md-12">
        <div class="card card-primary shadow-none">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold; color: white;">Información de la Mascota</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <td><?php echo $mascota['id']; ?></td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <td><?php echo $mascota['nombre']; ?></td>
                    </tr>
                    <tr>
                        <th>Especie</th>
                        <td><?php echo $mascota['especie']; ?></td>
                    </tr>
                    <tr>
                        <th>Raza</th>
                        <td><?php echo $mascota['raza']; ?></td>
                    </tr>
                    <tr>
                        <th>Edad</th>
                        <td><?php echo $mascota['edad']; ?> años</td>
                    </tr>
                    <tr>
                        <th>Nivel de Alimentación</th>
                        <td><?php echo $mascota['nivel_alimentacion']; ?>%</td>
                    </tr>
                    <tr>
                        <th>Fecha de Registro</th>
                        <td><?php echo $mascota['fecha_creacion']; ?></td>
                    </tr>
                </table>
                <hr>
                <a href="../mascota/tabla_mascota.php" class="btn btn-primary">Regresar</a>
            </div>
        </div>
    </div>
</div>

<?php
include '../modulo_principal/2.php';
?>

<!-- Scripts de AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
</body>
</html>
