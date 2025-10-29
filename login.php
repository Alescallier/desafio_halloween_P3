<?php
session_start();
include('db.php');

// Si ya está logueado, redirige
if (isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $clave = $_POST['clave'];

    // Buscar el usuario
    $res = mysqli_query($con, "SELECT * FROM usuarios WHERE nombre = '$nombre' LIMIT 1");

    if ($res && mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);

        // Verificar la contraseña
        if (password_verify($clave, $user['clave'])) {
            $_SESSION['id_usuario'] = $user['id'];
            $_SESSION['nombre'] = $user['nombre'];
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('❌ Contraseña incorrecta');</script>";
        }
    } else {
        echo "<script>alert('⚠️ Usuario no encontrado');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login - Halloween 🎃</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<main>
    <h1>Iniciar sesión 🎃</h1>
    <form method="POST">
        <label>Usuario:</label>
        <input type="text" name="nombre" required>
        <label>Contraseña:</label>
        <input type="password" name="clave" required>
        <button type="submit">Entrar</button>
    </form>
    <p><a href="registro.php">¿No tenés cuenta? Registrate</a></p>
</main>
</body>
</html>
