<?php
session_start();
include 'conexion.php';  // conecta a mi base de datos

// Validacion de datos obligatorios vacios
if (empty($_POST['usuario']) || empty($_POST['contrasena'])) {
  echo "<script>alert('Campos vacíos'); window.location.href='login.html';</script>";
  exit;
}
// POST para datos de "usuario" y "contrasena"
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Consultamos el usuario
$stmt = $conn->prepare("SELECT contrasena FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {
  // Verificar contraseña encriptada
  if (password_verify($contrasena, $fila['contrasena'])) {
    $_SESSION['usuario'] = $usuario;
    header("Location: index.html");
    exit;
  } else { // Mensajes de Error por contraseña incorrecta o usuario no encontrado
    echo "<script>alert('Contraseña incorrecta'); window.location.href='login.html';</script>";
  }
} else {
  echo "<script>alert('Usuario no encontrado'); window.location.href='login.html';</script>";
}
?>
