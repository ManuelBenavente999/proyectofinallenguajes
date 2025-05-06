<?php
$conn = new mysqli("localhost", "root", "", "tienda");
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
?>
