<?php
session_start();

// Verifica si el carrito ya está creado, si no, crea uno vacío
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Verifica si los datos fueron pasados correctamente
if (isset($_GET['id']) && isset($_GET['nombre']) && isset($_GET['precio'])) {
    // Recibe los datos del producto
    $productoId = $_GET['id'];
    $nombre = $_GET['nombre'];
    $precio = $_GET['precio'];

    // Si el producto ya está en el carrito, incrementar la cantidad
    if (isset($_SESSION['carrito'][$productoId])) {
        $_SESSION['carrito'][$productoId]['cantidad']++;
    } else {
        // Si no está en el carrito, agregarlo con cantidad 1
        $_SESSION['carrito'][$productoId] = array(
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => 1
        );
    }

    echo "Producto agregado al carrito";
} else {
    echo "No se han proporcionado los datos correctamente.";
}
?>

