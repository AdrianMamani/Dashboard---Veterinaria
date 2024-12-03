<?php
ob_start();
include '../modulo_principal/1.php';
include '../../mysql/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario']; 
$id_mascota = $_GET['id_mascota']; 

$sql = "SELECT id, nombre, especie, raza, edad, nivel_alimentacion FROM mascotas WHERE id = ? AND id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $id_mascota, $id_usuario); 
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $mascota = $result->fetch_assoc();
} else {

    header("Location: lista_mascotas.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $raza = $_POST['raza'];
    $edad = $_POST['edad'];
    $nivel_alimentacion = $_POST['nivel_alimentacion'];

    $update_sql = "UPDATE mascotas SET nombre = ?, especie = ?, raza = ?, edad = ?, nivel_alimentacion = ? WHERE id = ? AND id_usuario = ?";
    $update_stmt = $conexion->prepare($update_sql);
    $update_stmt->bind_param("sssiiii", $nombre, $especie, $raza, $edad, $nivel_alimentacion, $id_mascota, $id_usuario);

    if ($update_stmt->execute()) {
        header("Location: tabla_mascota.php");
        exit();
    } else {
        echo "<script>window.location.href = 'editar_mascota.php?id_mascota=$id_mascota';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Mascota</title>
</head>
<body>
    <div class="container-fluid">
        <h1>Editar Mascota</h1>
        <div class="col-md-6">
            <div class="card card-primary shadow-none">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold; color: white;">Formulario de Edición</h3>
                </div>
                <div class="card-body">
                    <form action="editar_mascota.php?id_mascota=<?php echo $mascota['id']; ?>" method="POST">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $mascota['nombre']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="especie">Especie:</label>
                                <input type="text" class="form-control" id="especie" name="especie" value="<?php echo $mascota['especie']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="raza">Raza:</label>
                                <input type="text" class="form-control" id="raza" name="raza" value="<?php echo $mascota['raza']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edad">Edad:</label>
                                <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $mascota['edad']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nivel_alimentacion">Nivel de Alimentación:</label>
                            <input type="number" class="form-control" id="nivel_alimentacion" name="nivel_alimentacion" value="<?php echo $mascota['nivel_alimentacion']; ?>" min="0" max="100" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="../mascota/tabla_mascota.php?id_mascota=<?php echo $mascota['id']; ?>" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
ob_end_flush();
include '../modulo_principal/2.php';
?>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
</body>
</html>
