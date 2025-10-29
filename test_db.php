<?php
include('db.php');

if ($con) {
    echo "✅ Conectado correctamente a la base de datos 'halloween'";
} else {
    echo "❌ Error de conexión: " . mysqli_connect_error();
}
?>
