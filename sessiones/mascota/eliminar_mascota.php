<?php
include '../../mysql/conexion.php';
session_start();

if (isset($_GET['id_mascota']) && isset($_SESSION['id_usuario'])) {
    $id_mascota = $_GET['id_mascota'];
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "DELETE FROM mascotas WHERE id = ? AND id_usuario = ?";
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conexion->error);
    }
    $stmt->bind_param("ii", $id_mascota, $id_usuario);
    if ($stmt->execute()) {
        header("Location: tabla_mascota.php?mensaje=success");
        exit(); 
    } else {
        header("Location: tabla_mascota.php?mensaje=error");
        exit();
    }
} else {
    header("Location: tabla_mascota.php");
    exit();
}

$stmt->close();
$conexion->close();
?>
