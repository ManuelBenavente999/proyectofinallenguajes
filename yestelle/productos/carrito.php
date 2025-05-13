<?php
session_start();

if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    echo "<h1>Tu carrito de compras</h1>";
    $total = 0;

    foreach ($_SESSION['carrito'] as $id_producto => $producto) {
        $nombre = $producto['nombre'];
        $precio = $producto['precio'];
        $cantidad = $producto['cantidad'];
        $subtotal = $precio * $cantidad;
        $total += $subtotal;

        echo "<div class='producto'>
                <h2>$nombre</h2>
                <p>Precio: €$precio</p>
                <p>Cantidad: $cantidad</p>
                <p>Subtotal: €$subtotal</p>
              </div>";
    }

    echo "<h2>Total: €$total</h2>";
    echo "<a href='vaciar_carrito.php' class='btn btn-danger'>Vaciar carrito</a>";
} else {
    echo "<p>Tu carrito está vacío.</p>";
}
?>
