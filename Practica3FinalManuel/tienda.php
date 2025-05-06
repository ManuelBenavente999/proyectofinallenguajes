<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}
include 'conexion.php';

echo "<h1>Bienvenido, " . $_SESSION['usuario'] . "</h1>";
echo "<a href='generarXML.php'>Descargar catálogo XML</a><br><br>";

$result = $conn->query("SELECT * FROM productos");

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<strong>{$row['nombre']}</strong><br>";
    echo "Precio: {$row['precio']} €<br>";
    echo "<form method='post' action='comprar.php'>
            <input type='hidden' name='referencia' value='{$row['referencia']}'>
            <input type='submit' value='Comprar'>
          </form>";
    echo "</div><hr>";
}
?>
