<?php
include 'modulo_principal/1.php';
include 'C:/xampp/htdocs/veterinaria/mysql/conexion.php'; //ruta absoluta

$id_usuario = $_SESSION['id_usuario']; 

$sql_perro = "SELECT COUNT(*) AS total_perros FROM mascotas WHERE id_usuario = ? AND especie = 'Perro'";
$sql_gato = "SELECT COUNT(*) AS total_gatos FROM mascotas WHERE id_usuario = ? AND especie = 'Gato'";
$sql_pez = "SELECT COUNT(*) AS total_peces FROM mascotas WHERE id_usuario = ? AND especie = 'Pez'";
$sql_otros = "SELECT COUNT(*) AS total_otros FROM mascotas WHERE id_usuario = ? AND especie NOT IN ('Perro', 'Gato', 'Pez')";

$stmt_perro = $conexion->prepare($sql_perro);
$stmt_gato = $conexion->prepare($sql_gato);
$stmt_pez = $conexion->prepare($sql_pez);
$stmt_otros = $conexion->prepare($sql_otros);

$stmt_perro->bind_param("i", $id_usuario);
$stmt_gato->bind_param("i", $id_usuario);
$stmt_pez->bind_param("i", $id_usuario);
$stmt_otros->bind_param("i", $id_usuario);

$stmt_perro->execute();
$result_perro = $stmt_perro->get_result();
$row_perro = $result_perro->fetch_assoc();
$total_perros = $row_perro['total_perros'];

$stmt_gato->execute();
$result_gato = $stmt_gato->get_result();
$row_gato = $result_gato->fetch_assoc();
$total_gatos = $row_gato['total_gatos'];

$stmt_pez->execute();
$result_pez = $stmt_pez->get_result();
$row_pez = $result_pez->fetch_assoc();
$total_peces = $row_pez['total_peces'];

$stmt_otros->execute();
$result_otros = $stmt_otros->get_result();
$row_otros = $result_otros->fetch_assoc();
$total_otros = $row_otros['total_otros'];
?>
<br>
<div class="row" style="margin-left: 10px;"> 
  <div class="col-lg-3 col-6">
    <div class="info-box mb-3" style="background-color: #343a40;">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-paw"></i></span> 
      <div class="info-box-content">
        <span class="info-box-text" style="color: white;">Perros</span> 
        <span class="info-box-number" style="color: white;"><?php echo $total_perros; ?></span> 
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="info-box mb-3" style="background-color: #343a40;"> 
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cat"></i></span> 
      <div class="info-box-content">
        <span class="info-box-text" style="color: white;">Gatos</span> 
        <span class="info-box-number" style="color: white;"><?php echo $total_gatos; ?></span> 
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="info-box mb-3" style="background-color: #343a40;">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-fish"></i></span> 
      <div class="info-box-content">
        <span class="info-box-text" style="color: white;">Peces</span> 
        <span class="info-box-number" style="color: white;"><?php echo $total_peces; ?></span> 
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="info-box mb-3" style="background-color: #343a40;">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-paw"></i></span> 
      <div class="info-box-content">
        <span class="info-box-text" style="color: white;">Otros Animales</span> 
        <span class="info-box-number" style="color: white;"><?php echo $total_otros; ?></span> 
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="../css/tamaño_imagenes_mascoa.css">
<div class="col-12">
  <div class="card card-primary">
    <div class="card-header">
      <h4 class="card-title"><strong>Galeria Animal|PET</strong></h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-2">
          <a href="../img/mascotas/gato1.jpg?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
            <img src="../img/mascotas/gato1.jpg?text=1" class="img-fluid mb-2" alt="white sample">
          </a>
        </div>
        <div class="col-sm-2">
          <a href="../img/mascotas/conejo4.jpg?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
            <img src="../img/mascotas/conejo4.jpg?text=2" class="img-fluid mb-2" alt="black sample">
          </a>
        </div>
        <div class="col-sm-2">
          <a href="../img/mascotas/perro2.jpg?text=3" data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
            <img src="../img/mascotas/perro2.jpg?text=3" class="img-fluid mb-2" alt="red sample">
          </a>
        </div>
        <div class="col-sm-2">
          <a href="../img/mascotas/ave1?text=4" data-toggle="lightbox" data-title="sample 4 - red" data-gallery="gallery">
            <img src="../img/mascotas/ave1.jpg?text=4" class="img-fluid mb-2" alt="red sample">
          </a>
        </div>
        <div class="col-sm-2">
          <a href="../img/mascotas/peces1.jpg?text=5" data-toggle="lightbox" data-title="sample 5 - black" data-gallery="gallery">
            <img src="../img/mascotas/peces1.jpg?text=5" class="img-fluid mb-2" alt="black sample">
          </a>
        </div>
        <div class="col-sm-2">
          <a href="../img/mascotas/perro1.jpg?text=6" data-toggle="lightbox" data-title="sample 6 - white" data-gallery="gallery">
            <img src="../img/mascotas/perro1.jpg?text=6" class="img-fluid mb-2" alt="white sample">
          </a>
        </div>
        <div class="col-sm-2">
          <a href="../img/mascotas/cuy1.jpg?text=7" data-toggle="lightbox" data-title="sample 7 - white" data-gallery="gallery">
            <img src="../img/mascotas/cuy1.jpg?text=7" class="img-fluid mb-2" alt="white sample">
          </a>
        </div>
        <div class="col-sm-2">
          <a href="../img/mascotas/perro3.jpg?text=8" data-toggle="lightbox" data-title="sample 8 - black" data-gallery="gallery">
            <img src="../img/mascotas/perro3.jpg?text=8" class="img-fluid mb-2" alt="black sample">
          </a>
        </div>
        <div class="col-sm-2">
          <a href="../img/mascotas/gato2.jpg?text=9" data-toggle="lightbox" data-title="sample 9 - red" data-gallery="gallery">
            <img src="../img/mascotas/gato2.jpg?text=9" class="img-fluid mb-2" alt="red sample">
          </a>
        </div>
        <div class="col-sm-2">
          <a href="../img/mascotas/ave2.jpg?text=10" data-toggle="lightbox" data-title="sample 10 - white" data-gallery="gallery">
            <img src="../img/mascotas/ave2.jpg?text=10" class="img-fluid mb-2" alt="white sample">
          </a>
        </div>
        <div class="col-sm-2">
          <a href="../img/mascotas/conejo2.jpg?text=11" data-toggle="lightbox" data-title="sample 11 - red" data-gallery="gallery">
            <img src="../img/mascotas/conejo2.jpg?text=11" class="img-fluid mb-2" alt="red sample">
          </a>
        </div>
        <div class="col-sm-2">
          <a href="../img/mascotas/gato3.jpg?text=11" data-toggle="lightbox" data-title="sample 11 - red" data-gallery="gallery">
            <img src="../img/mascotas/gato3.jpg?text=11" class="img-fluid mb-2" alt="red sample">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include 'modulo_principal/2.php';
?>
