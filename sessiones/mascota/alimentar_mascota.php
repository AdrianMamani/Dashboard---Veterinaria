<?php

require_once('C:/xampp/htdocs/veterinaria/mysql/conexion.php');
include_once '../modulo_principal/1.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login/iniciar_sesion.php");
    exit();
}


$id_usuario = $_SESSION['id_usuario'];

function obtenerMascotas() {
    global $conexion;
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];

        $query = "SELECT id, nombre, especie, raza, edad, nivel_alimentacion FROM mascotas WHERE id_usuario = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario); 
        $stmt->execute();
        $resultado = $stmt->get_result();

        $mascotas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $mascotas[] = $fila;
        }
        return $mascotas;
    } else {
        return [];
    }
}

function actualizarAlimentacion($id_mascota, $incremento) {
    global $conexion;
    $query = "UPDATE mascotas SET nivel_alimentacion = GREATEST(LEAST(nivel_alimentacion + ?, 100), 0) WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $incremento, $id_mascota);
    $stmt->execute();
}


if (isset($_POST['pasear'])) {
    $id_mascota = $_POST['id_mascota']; 
    actualizarAlimentacion($id_mascota, 20); 
}

$mascotas = obtenerMascotas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Mascotas</title>
    <style>
        .content-container {
        margin-left: 20px; 
        }
        .progress-bar {
            height: 20px;
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
        }
        .progress-bar-inner {
            height: 100%;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            left: 0;
            top: 0;
        }

        .hueso-walking {
            animation: walk 10s linear infinite;
            position: absolute;
            left: -30px; 
            top: 0;
        }

        @keyframes walk {
            0% { left: -30px; }
            100% { left: 100%; }
        }

        .btn-pasear {
            background-color: #cf0808; 
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-pasear:hover {
            background-color: #a40707; 
        }

        .badge-success { background-color: green; }
        .badge-warning { background-color: #ffcd00; color: black; }
        .badge-danger { background-color: red; }
    </style>
</head>
<body>
<div class="content-container">
<h1>Lista de Mascotas</h1>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Especie</th>
            <th>Edad</th>
            <th>Alimentacion</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mascotas as $mascota): 
            $nivel_paseo = $mascota['nivel_alimentacion'];
            $estado = "";
            $clase_estado = "";
            $color_barra = "";

            if ($nivel_paseo > 80) {
                $estado = "Ya estoy lleno";
                $clase_estado = "badge-success";
                $color_barra = "background-color: green;";
            } elseif ($nivel_paseo >= 35) {
                $estado = "Tengo hambre";
                $clase_estado = "badge-warning";
                $color_barra = "background-color: #ffcd00; color: black;";
            } else {
                $estado = "Me muero";
                $clase_estado = "badge-danger";
                $color_barra = "background-color: red;";
            }
        ?>
        <tr>
            <td><?php echo $mascota['id']; ?></td>
            <td><?php echo $mascota['nombre']; ?></td>
            <td><?php echo $mascota['especie']; ?></td>
            <td><?php echo $mascota['edad']; ?> años</td>
            <td>
                <div class="progress-bar">
                    <div class="progress-bar-inner" style="width: <?php echo $nivel_paseo; ?>%; <?php echo $color_barra; ?>">
                        <!-- Animación del perrito caminando -->
                        <i class="fas fa-bone hueso-walking"></i>
                    </div>
                </div>
            </td>
            <td><span class="badge <?php echo $clase_estado; ?>"><?php echo $estado; ?></span></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id_mascota" value="<?php echo $mascota['id']; ?>">
                    <button type="submit" name="pasear" class="btn-pasear">Alimentar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</body>
</html>

<?php
include '../modulo_principal/2.php';
?>
<script>
$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "pageLength": 7,
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ mascotas",
            "infoEmpty": "Mostrando 0 a 0 de 0 mascotas",
            "infoFiltered": "(Filtrado de _MAX_ total mascotas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ mascotas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "buttons": [
            {
                extend: 'copy',
                text: 'Copiar'
            },
            {
                extend: 'csv',
                text: 'CSV'
            },
            {
                extend: 'excel',
                text: 'Excel'
            },
            {
                extend: 'pdf',
                text: 'PDF'
            },
            {
                extend: 'print',
                text: 'Imprimir'
            },
            {
                extend: 'colvis',
                text: 'Visor de columnas'
            }
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ mascotas",
            "infoEmpty": "Mostrando 0 a 0 de 0 mascotas",
            "infoFiltered": "(Filtrado de _MAX_ total mascotas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ mascotas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});
</script>