<?php
$host = "localhost";
$usuario = "root";     // predeterminado en XAMPP
$contrasena = "";      // por defecto sin contraseña
$basedatos = "yestelle"; // tu base de datos

$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
?>
