<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['carrito'])) $_SESSION['carrito'] = [];

// Añadir producto
if (isset($_GET['add'])) {
  $ref = (int) $_GET['add'];
  $producto = $conn->query("SELECT * FROM productos WHERE referencia = $ref")->fetch_assoc();

  if ($producto) {
    if (!isset($_SESSION['carrito'][$ref])) {
      $_SESSION['carrito'][$ref] = ['nombre' => $producto['nombre'], 'precio' => $producto['precio'], 'cantidad' => 1];
    } else {
      $_SESSION['carrito'][$ref]['cantidad']++;
    }
  }
}

// Eliminar producto
if (isset($_GET['del'])) {
  $ref = (int) $_GET['del'];
  unset($_SESSION['carrito'][$ref]);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito de Compras</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
  <h2>Carrito de la Compra</h2>
  <?php if (!empty($_SESSION['carrito'])): ?>
    <table class="table">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Total</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; foreach ($_SESSION['carrito'] as $ref => $item): 
          $subtotal = $item['precio'] * $item['cantidad'];
          $total += $subtotal;
        ?>
        <tr>
          <td><?= htmlspecialchars($item['nombre']) ?></td>
          <td><?= number_format($item['precio'], 2) ?> €</td>
          <td><?= $item['cantidad'] ?></td>
          <td><?= number_format($subtotal, 2) ?> €</td>
          <td><a href="carrito.php?del=<?= $ref ?>" class="btn btn-danger btn-sm">Eliminar</a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <h4>Total: <?= number_format($total, 2) ?> €</h4>
    <form action="procesar_compra.php" method="POST">
      <button type="submit" class="btn btn-success">Finalizar compra</button>
    </form>
  <?php else: ?>
    <p>Tu carrito está vacío.</p>
  <?php endif; ?>
</body>
</html>
