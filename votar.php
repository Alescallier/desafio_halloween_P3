<?php
session_start();
include('db.php');

if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_disfraz = $_POST['id_disfraz'] ?? 0;

if ($id_disfraz > 0) {
    $check = mysqli_query($con, "SELECT * FROM votos WHERE id_usuario=$id_usuario AND id_disfraz=$id_disfraz");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($con, "INSERT INTO votos (id_usuario, id_disfraz) VALUES ($id_usuario, $id_disfraz)");
        mysqli_query($con, "UPDATE disfraces SET votos = votos + 1 WHERE id = $id_disfraz");
        echo "<script>alert('¡Gracias por tu voto! 🎃'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Ya votaste este disfraz 🧙‍♀️'); window.location='index.php';</script>";
    }
}
?>
