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
if (!empty($_POST['nombre']) && !empty($_POST['contacto']) && !empty($_POST['telefono']) && !empty($_POST['email']) && !empty($_POST['direccion'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    // Validar y sanitizar datos
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $contacto = mysqli_real_escape_string($conn, $contacto);
    $telefono = mysqli_real_escape_string($conn, $telefono);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $direccion = mysqli_real_escape_string($conn, $direccion);

    // Insertar datos en la tabla
    $sql = "INSERT INTO proveedores (nombre, contacto, telefono, email, direccion) VALUES ('$nombre', '$contacto', '$telefono', '$email', '$direccion')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo proveedor registrado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Por favor, completa todos los campos del formulario.";
}

$conn->close();
?>
