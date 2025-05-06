<?php
include 'conexion.php';

$usuario = $_POST['usuario'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha_nacimiento'];
$genero = $_POST['genero'];

$stmt = $conn->prepare("INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)");
$stmt->bind_param("ss", $usuario, $contrasena);
$stmt->execute();

$stmt2 = $conn->prepare("INSERT INTO clientes (nombre, apellidos, correo, fecha_nacimiento, genero) VALUES (?, ?, ?, ?, ?)");
$stmt2->bind_param("sssss", $nombre, $apellidos, $correo, $fecha, $genero);
$stmt2->execute();

echo "Usuario registrado correctamente. <a href='login.html'>Iniciar sesión</a>";
?>
