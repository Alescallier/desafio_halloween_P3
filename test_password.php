<?php
$hash = '$2y$10$AvzWngoYNVm5p8B52Vj0E.lmEjY5sWgJGVhRzU0g6M6afB/CJvsB.'; // el hash del admin
$clave = 'admin123';

if (password_verify($clave, $hash)) {
    echo "✅ La contraseña coincide con el hash";
} else {
    echo "❌ No coincide";
}
?>
