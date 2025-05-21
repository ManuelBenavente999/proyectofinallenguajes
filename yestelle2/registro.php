<?php
// =========================================================
// BLOQUE DE DEPURACIÓN (MANTÉNELO TEMPORALMENTE o COMENTA LAS LÍNEAS ini_set una vez que todo funcione)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// =========================================================

// Incluye el archivo de conexión a la base de datos.
// Usamos require_once para asegurar que 'conexion.php' se incluya solo una vez.
require_once 'conexion.php';

// 1. Comprobación de que todos los campos del formulario fueron enviados y no están vacíos.
if (
  empty($_POST['usuario']) || empty($_POST['contrasena']) ||
  empty($_POST['nombre']) || empty($_POST['apellidos']) ||
  empty($_POST['correo']) || empty($_POST['fecha']) || empty($_POST['genero'])
) {
  // Si falta algún campo, muestra una alerta y redirige de vuelta al formulario de registro.
  echo "<script>alert('Todos los campos son obligatorios'); window.location.href='registro.html';</script>";
  exit; // Detiene la ejecución del script.
}

// 2. Recolección y preparación de los datos enviados por el formulario (POST).
$usuario = $_POST['usuario'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // ¡IMPORTANTE! Encripta la contraseña para seguridad.
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha']; // Asume que la fecha viene en un formato compatible con MySQL (ej. YYYY-MM-DD).
$genero = $_POST['genero'];

// 3. Iniciar una transacción de base de datos.
$conn->begin_transaction();

try {
  // 4. Inserción de datos en la tabla 'usuarios' (almacena el usuario y la contraseña encriptada).
  $stmt1 = $conn->prepare("INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)");
  $stmt1->bind_param("ss", $usuario, $contrasena);

  if (!$stmt1->execute()) {
    throw new Exception('El nombre de usuario ya existe o hubo un problema al crear el usuario. Por favor, intente con otro nombre.');
  }

  // 5. Inserción de datos en la tabla 'clientes' (almacena la información personal del cliente).
  $stmt2 = $conn->prepare("INSERT INTO clientes (nombre, apellidos, correo, fecha_nacimiento, genero) VALUES (?, ?, ?, ?, ?)");
  $stmt2->bind_param("sssss", $nombre, $apellidos,  $correo, $fecha, $genero);

  if (!$stmt2->execute()) {
    throw new Exception('Error al insertar los datos adicionales del cliente. Por favor, inténtelo de nuevo.');
  }

  // 6. Si ambas inserciones fueron exitosas, confirmamos la transacción.
  $conn->commit();
  // Mensaje de Éxito y REDIRECCIÓN A index.html
  echo "<script>alert('¡Registro exitoso! Ya puedes iniciar sesión.'); window.location.href='index.html';</script>";

} catch (Exception $e) {
  // 7. Si se produce alguna excepción (un error en cualquiera de las inserciones),
  // revertimos la transacción para que ninguna de las operaciones se guarde.
  $conn->rollback();
  // Mensaje de Error y REDIRECCIÓN A registro.html
  echo "<script>alert('" . $e->getMessage() . "'); window.location.href='registro.html';</script>";

} finally {
  // 8. Cerramos las sentencias preparadas y la conexión a la base de datos.
  if (isset($stmt1)) {
    $stmt1->close();
  }
  if (isset($stmt2)) {
    $stmt2->close();
  }
  if (isset($conn)) {
      $conn->close();
  }
}
?>