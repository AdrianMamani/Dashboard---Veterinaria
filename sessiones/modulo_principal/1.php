<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>lorem lorem | Gestor</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<!-- Icons style (Font Awesome) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- AdminLTE Theme style -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">

<!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- DataTables CSS (CDN version) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.1/css/buttons.bootstrap4.min.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" style="min-height: 100vh;">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="http://localhost/veterinaria/sessiones/inicio.php" class="nav-link" style="color: black;">
          Inicio
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Menu de portada -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 100vh;"> 
    <a href="" class="brand-link">
      <i class="fas fa-paw mr-2"></i>
      <span class="brand-text font-weight-bold"> Animal | PET</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <?php if (isset($_SESSION['usuario'])): ?>
            <div class="welcome-box" style="display: flex; align-items: center;">
              <img src="http://localhost/veterinaria/img/usuario/usuario.jpg" alt="Usuario" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; margin-right: 10px;" />
              <a href="#" class="d-block"><b>BIENVENIDO</b> <br> <?= $_SESSION['usuario'] ?></a>
            </div>
          <?php else: ?>
            <a href="#" class="d-block"><b>BIENVENIDO</b> <br> Usuario Desconocido</a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Menu opciones -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Menú Inicio -->
          <li class="nav-item d-none d-sm-inline-block">
            <a href="http://localhost/veterinaria/sessiones/inicio.php" class="nav-link" style="background-color: #0074ff; color: white;">
              <i class="nav-icon fas fa-home"></i>
              <p style="font-weight: bold;">Inicio</p>
            </a>
          </li>

          <!-- Menú Mascota con subopciones siempre visible -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link" style="background-color: #0074ff; color: white;">
              <i class="nav-icon fas fa-paw"></i>
              <p style="font-weight: bold;">Mascota</p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="http://localhost/veterinaria/sessiones/mascota/tabla_mascota.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de mascota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/veterinaria/sessiones/mascota/agregar_mascota.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar mascota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/veterinaria/sessiones/mascota/alimentar_mascota.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Alimentar mascota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="http://localhost/veterinaria/sessiones/mascota/pasear_mascota.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pasear mascota</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Opción para Cerrar sesión -->
          <li class="nav-item">
            <a href="http://localhost/veterinaria/login/iniciar_sesion.php" class="nav-link" style="background-color: red">
              <i class="nav-icon fas fa-door-open"></i>
              <p style="font-weight: bold; color: white;">
                Cerrar sesión
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">