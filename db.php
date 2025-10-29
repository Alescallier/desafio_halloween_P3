<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "halloween";
$port = 3306; // cambia si tu XAMPP usa otro puerto

$con = mysqli_connect($host, $user, $pass, $db, $port);

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
