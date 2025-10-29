<?php
session_start();
include('db.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>🎃 Concurso de Disfraces - Halloween 🎃</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="js/script.js" defer></script>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <?php if (!isset($_SESSION['id_usuario'])): ?>
                <li><a href="login.php">Iniciar sesión</a></li>
                <li><a href="registro.php">Registrarse</a></li>
            <?php else: ?>
                <li><a href="logout.php">Cerrar sesión</a></li>
                <?php if ($_SESSION['nombre'] === 'admin'): ?>
                    <li><a href="admin.php">Administrar</a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </nav>

    <header></header>

    <main>
        <h1>🎃 Disfraces participantes 🎃</h1>
        <?php
        $query = "SELECT * FROM disfraces WHERE eliminado = 0 ORDER BY votos DESC";
        $result = mysqli_query($con, $query);

        while ($r = mysqli_fetch_assoc($result)) {
            echo "<div class='section'>";
            echo "<h2>" . htmlspecialchars($r['nombre']) . "</h2>";
            echo "<p>" . htmlspecialchars($r['descripcion']) . "</p>";

            if (file_exists("fotos/" . $r['foto'])) {
                echo "<img src='fotos/" . $r['foto'] . "' width='200'><br>";
            }

            echo "<p>Votos: " . $r['votos'] . "</p>";

            if (isset($_SESSION['id_usuario'])) {
                echo "<form action='votar.php' method='POST'>";
                echo "<input type='hidden' name='id_disfraz' value='" . $r['id'] . "'>";
                echo "<button type='submit' class='votar'>Votar 🎃</button>";
                echo "</form>";
            } else {
                echo "<p><a href='login.php'>Inicia sesión para votar</a></p>";
            }
            echo "</div>";
        }
        ?>
    </main>
</body>
</html>
