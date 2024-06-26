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

// Iniciar sesión
session_start();

// Verificar que el user_id esté en la sesión
if (!isset($_SESSION['user_id'])) {
    die("Error: No se ha iniciado sesión o no se ha establecido el ID del usuario.");
}

$user_id = $_SESSION['user_id']; // Obtener el user_id de la sesión

// Verificar que todos los datos necesarios estén presentes en $_POST
if (!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['precio']) && !empty($_POST['cantidad']) && !empty($_POST['proveedor'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $proveedor = $_POST['proveedor'];

    // Validar y sanitizar datos
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $descripcion = mysqli_real_escape_string($conn, $descripcion);
    $precio = mysqli_real_escape_string($conn, $precio);
    $cantidad = mysqli_real_escape_string($conn, $cantidad);
    $proveedor = mysqli_real_escape_string($conn, $proveedor);

    // Insertar datos en la tabla
    $sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad, proveedor_id, user_id) VALUES ('$nombre', '$descripcion', '$precio', '$cantidad', '$proveedor', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo producto registrado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Por favor, completa todos los campos del formulario.";
}

$conn->close();
?>
