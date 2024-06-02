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
if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar y sanitizar datos
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $apellido = mysqli_real_escape_string($conn, $apellido);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = mysqli_real_escape_string($conn, $password); 
    // Cifrar la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Verificar si el usuario ya existe en la base de datos
    $sql_check = "SELECT * FROM usuarios WHERE email = '$email'";
    $result_check = $conn->query($sql_check);
    if ($result_check->num_rows > 0) {
        echo "El usuario ya existe en la base de datos.";
    } else {
        // Insertar datos en la tabla
        $sql_insert = "INSERT INTO usuarios (email, password, nombre, apellido, fecha_creacion) VALUES ('$email', '$hashed_password', '$nombre', '$apellido', NOW())";

        if ($conn->query($sql_insert) === TRUE) {
            echo "Nuevo usuario registrado exitosamente";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
} else {
    echo "Por favor, completa todos los campos del formulario.";
}

$conn->close();
?>
