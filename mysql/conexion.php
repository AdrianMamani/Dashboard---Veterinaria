<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "veterinaria"; 


$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    echo "Conexión fallida: " . $conexion->connect_error;
    exit(); 
} else {
}
