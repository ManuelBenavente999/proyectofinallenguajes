<?php
include 'conexion.php';

$productos = $conn->query("SELECT * FROM productos");

$xml = new SimpleXMLElement('<catalogo/>');

while ($row = $productos->fetch_assoc()) {
    $producto = $xml->addChild('producto');
    $producto->addChild('referencia', $row['referencia']);
    $producto->addChild('nombre', $row['nombre']);
    $producto->addChild('precio', $row['precio']);
}

Header('Content-type: text/xml');
echo $xml->asXML();
?>
