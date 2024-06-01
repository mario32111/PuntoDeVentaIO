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

// Verificar que todos los datos necesarios estén presentes en $_POST
if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['apellido'])) {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    // Validar y sanitizar datos
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = mysqli_real_escape_string($conn, $password);
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $apellido = mysqli_real_escape_string($conn, $apellido);

    // Hashear la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar datos en la tabla
    $sql = "INSERT INTO usuarios (email, password, nombre, apellido) VALUES ('$email', '$hashed_password', '$nombre', '$apellido')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo usuario registrado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Por favor, completa todos los campos del formulario.";
}

$conn->close();
?>
