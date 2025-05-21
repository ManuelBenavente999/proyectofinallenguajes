<?php
session_start();
if(!isset($_SESSION['usuario'])) header("Location: login.html");
require 'includes/conexion.php';
require 'includes/funciones.php';

$u = $conn->real_escape_string($_SESSION['usuario']);
$r = intval($_POST['referencia']);
$q = intval($_POST['cantidad']);

$stmt=$conn->prepare("INSERT INTO compras(usuario,referencia,cantidad) VALUES(?,?,?)");
$stmt->bind_param("sii",$u,$r,$q);
if($stmt->execute()) flash('success','Compra registrada.');
else flash('danger','Error al comprar.');
header("Refresh:1; url=tienda.php");
