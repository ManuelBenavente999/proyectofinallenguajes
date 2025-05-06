<?php
include 'conexion.php';

if (!isset($_POST['usuario'], $_POST['contrasena'], $_POST['nombre'], $_POST['correo'])) {
  echo "Faltan datos.";
  exit;
}

$usuario = $_POST['usuario'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];

$stmt = $conn->prepare("INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)");
$stmt->bind_param("ss", $usuario, $contrasena);

if ($stmt->execute()) {
  $stmt2 = $conn->prepare("INSERT INTO clientes (nombre, correo) VALUES (?, ?)");
  $stmt2->bind_param("ss", $nombre, $correo);
  $stmt2->execute();
  echo "OK";
} else {
  echo "Error al registrar usuario. ¿Ya existe?";
}
?>
