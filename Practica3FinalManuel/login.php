<?php
session_start();
include 'conexion.php';

if (!isset($_POST['usuario']) || !isset($_POST['contrasena'])) {
    echo "Datos incompletos.";
    exit;
}

$usuario = trim($_POST['usuario']);
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($contrasena, $row['contrasena'])) {
        $_SESSION['usuario'] = $usuario;
        echo "OK";
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Usuario no encontrado.";
}
?>
