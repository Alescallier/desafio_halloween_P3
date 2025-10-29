<?php
session_start();
include('db.php');

if ($_SESSION['nombre'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Crear disfraces
if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
    $foto_nombre = "";

    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $archivo = $_FILES['foto']['name'];
        $extension = end(explode(".", $archivo));
        $foto_nombre = time() . "." . $extension;
        copy($_FILES['foto']['tmp_name'], "fotos/" . $foto_nombre);
    }

    mysqli_query($con, "INSERT INTO disfraces (nombre, descripcion, votos, foto, foto_blob) VALUES ('$nombre', '$descripcion', 0, '$foto_nombre', '')");
    echo "<script>alert('Disfraz agregado ✅'); window.location='admin.php';</script>";
}

// Eliminar disfraces
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $r = mysqli_fetch_assoc(mysqli_query($con, "SELECT foto FROM disfraces WHERE id=$id"));
    if (file_exists("fotos/" . $r['foto'])) unlink("fotos/" . $r['foto']);
    mysqli_query($con, "UPDATE disfraces SET eliminado=1 WHERE id=$id");
    echo "<script>alert('Disfraz eliminado ❌'); window.location='admin.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel Admin</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<main>
<h1>Panel de Administración 🎃</h1>

<form method="POST" enctype="multipart/form-data">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <label>Descripción:</label>
    <textarea name="descripcion" required></textarea>
    <label>Foto:</label>
    <input type="file" name="foto" accept="image/*">
    <button type="submit">Agregar Disfraz</button>
</form>

<h2>Lista de Disfraces</h2>
<?php
$res = mysqli_query($con, "SELECT * FROM disfraces WHERE eliminado=0");
while ($r = mysqli_fetch_assoc($res)) {
    echo "<div class='section'>";
    echo "<h3>{$r['nombre']}</h3>";
    echo "<p>{$r['descripcion']}</p>";
    echo "<p>Votos: {$r['votos']}</p>";
    if (file_exists('fotos/' . $r['foto'])) echo "<img src='fotos/{$r['foto']}' width='150'><br>";
    echo "<a href='?eliminar={$r['id']}'>Eliminar</a>";
    echo "</div>";
}
?>
</main>
</body>
</html>
