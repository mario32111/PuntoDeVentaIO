<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "puntodeventa";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Validar y sanitizar datos
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$password = mysqli_real_escape_string($conn, $password);

// Buscar el usuario en la base de datos
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Verificar la contraseña
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Contraseña correcta, redirigir a inicio.html
        header("Location: ../view/inicio.html");
        exit(); // Asegurarse de que el script se detenga aquí
    } else {
        // Contraseña incorrecta
        echo "Contraseña incorrecta. Inténtalo de nuevo.";
    }
} else {
    // Usuario no encontrado
    echo "No se encontró un usuario con ese correo electrónico.";
}

$conn->close();
?>
