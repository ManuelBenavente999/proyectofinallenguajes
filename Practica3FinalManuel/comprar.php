<?php
session_start();
include 'conexion.php';

$usuario = $_SESSION['usuario'];
$ref = $_POST['referencia'];

$stmt = $conn->prepare("INSERT INTO compras (usuario, referencia) VALUES (?, ?)");
$stmt->bind_param("ss", $usuario, $ref);
$stmt->execute();

echo "Producto comprado exitosamente. <a href='tienda.php'>Volver</a>";
?>
