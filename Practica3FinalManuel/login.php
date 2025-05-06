<?php
session_start();
include 'conexion.php';

if (!isset($_POST['usuario']) || !isset($_POST['contrasena'])) {
  echo "Faltan datos.";
  exit;
}

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$stmt = $conn->prepare("SELECT contrasena FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {
  if (password_verify($contrasena, $fila['contrasena'])) {
    $_SESSION['usuario'] = $usuario;
    echo "OK";
  } else {
    echo "Contraseña incorrecta.";
  }
} else {
  echo "Usuario no encontrado.";
}
?>
