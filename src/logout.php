<?php
// Iniciar sesión
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión u otra página
header("Location: ../view/index.html"); // Cambia "login.php" por la página a la que deseas redirigir después de cerrar sesión
exit(); // Asegurarse de que el script se detenga aquí
?>
