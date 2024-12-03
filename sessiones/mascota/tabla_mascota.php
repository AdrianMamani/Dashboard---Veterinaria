<?php
include '../modulo_principal/1.php';
include '../../mysql/conexion.php';

$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT id, nombre, especie, raza, edad FROM mascotas WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario); 
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container-fluid">
    <h1>Lista de Mascotas</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary shadow-none">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold; color: white;">Mascotas Registradas</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Especie</th>
                                <th>Raza</th>
                                <th>Edad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['nombre'] . "</td>";
                                    echo "<td>" . $row['especie'] . "</td>";
                                    echo "<td>" . $row['raza'] . "</td>";
                                    echo "<td>" . $row['edad'] . "</td>";
                                    echo "<td style='text-align: center'>
                                    <div class='btn-group' role='group' aria-label='Basic example'>
                                        <a href='../mascota/vista_mascota.php?id_mascota=" . $row['id'] . "' class='btn btn-success'>Ver</a>
                                        <a href='../mascota/editar_mascota.php?id_mascota=" . $row['id'] . "' class='btn btn-warning'>Editar</a>
                                        <a href='../mascota/eliminar_mascota.php?id_mascota=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta mascota?\");'>Eliminar</a>
                                    </div>
                                </td>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No hay mascotas registradas.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../modulo_principal/2.php';
?>
<script>
$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
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