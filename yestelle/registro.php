<?php
include 'conexion.php';

// Comprobacion de datos añadidos con exito o error
if (
  empty($_POST['usuario']) || empty($_POST['contrasena']) ||
  empty($_POST['nombre']) || empty($_POST['apellidos']) ||
  empty($_POST['correo']) || empty($_POST['fecha']) || empty($_POST['genero'])
) {
  echo "<script>alert('Todos los campos son obligatorios'); window.location.href='registro.html';</script>";
  exit;
}

// Envio de datos a la base de datos mediante POST
$usuario = $_POST['usuario'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha'];
$genero = $_POST['genero'];

// Insercion de datos en la tabla USUARIOS de "usuario" y "contrasena"
$stmt1 = $conn->prepare("INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)");
$stmt1->bind_param("ss", $usuario, $contrasena);

// Insercion de datos en la tabla CLIENTES de todos los datos
if ($stmt1->execute()) {
  $stmt2 = $conn->prepare("INSERT INTO clientes (nombre, apellidos, correo, fecha_nacimiento, genero) VALUES (?, ?, ?, ?, ?)");
  $stmt2->bind_param("sssss", $nombre, $apellidos, $correo, $fecha, $genero);
  $stmt2->execute();

  // Mensajes de Exito y Error
  echo "<script>alert('Registro exitoso'); window.location.href='index.html';</script>";
} else {
  echo "<script>alert('El usuario ya existe'); window.location.href='registro.html';</script>";
}
?>