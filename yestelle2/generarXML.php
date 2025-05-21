<?php
include 'conexion.php';

$query = "SELECT * FROM productos";
$resultado = $conn->query($query);

$xml = new DOMDocument("1.0", "UTF-8");
$xml->formatOutput = true;

$root = $xml->createElement("productos");

while ($row = $resultado->fetch_assoc()) {
  $producto = $xml->createElement("producto");

  foreach ($row as $key => $value) {
    $producto->appendChild($xml->createElement($key, htmlspecialchars($value)));
  }

  $root->appendChild($producto);
}

$xml->appendChild($root);
$xml->save("catalogo_productos.xml");

echo "XML generado con éxito.";
?>