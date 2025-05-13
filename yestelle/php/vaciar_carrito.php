<?php
session_start();

// Vaciar el carrito
unset($_SESSION['carrito']);

header('Location: carrito.php');  // Redirigir al carrito después de vaciarlo
exit();
?>
