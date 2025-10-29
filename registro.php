<?php
include('db.php');

if (isset($_POST['nombre']) && isset($_POST['clave'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
    mysqli_query($con, "INSERT INTO usuarios (nombre, clave) VALUES ('$nombre', '$clave')");
    echo "<script>alert('Usuario registrado correctamente 🎃'); window.location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<main>
<h1>Registrarse</h1>
<form method="POST">
    <label>Nombre de usuario:</label>
    <input type="text" name="nombre" required>
    <label>Contraseña:</label>
    <input type="password" name="clave" required>
    <button type="submit">Registrarme</button>
</form>
</main>
</body>
</html>
