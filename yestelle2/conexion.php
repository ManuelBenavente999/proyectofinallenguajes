<?php
// conexion.php

$servername = "localhost";
$username = "root"; // Tu usuario de MySQL en XAMPP
$password = "";     // Tu contraseña de MySQL en XAMPP (por defecto, vacía)
$dbname = "yestelle"; // ¡Asegúrate de que este sea el nombre EXACTO de tu base de datos!

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de Conexión a la Base de Datos: " . $conn->connect_error);
}

// NO DEBE HABER NADA MÁS QUE PUEDA CAUSAR UN BUCLE O CONSUMIR MEMORIA AQUÍ.
// Si tienes includes o requires dentro de conexion.php, revísalos cuidadosamente.
// La línea 25 DEBE ser parte de tu bloque de conexión, no otra cosa.

?>