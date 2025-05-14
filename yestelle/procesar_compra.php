<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
  die("El carrito está vacío.");
}

foreach ($_SESSION['carrito'] as $producto) {
  $nombre = $conn->real_escape_string($producto['nombre']);
  $cantidad = (int) $producto['cantidad'];
  $total = $producto['precio'] * $cantidad;

  $conn->query("INSERT INTO compras (usuario, producto, cantidad, precio_total)
                VALUES ('cliente_prueba', '$nombre', $cantidad, $total)");
}

unset($_SESSION['carrito']); // Vaciar carrito después de la compra
echo "<h2>¡Compra realizada con éxito!</h2><a href='index.php'>Volver a la tienda</a>";
?>
