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
if (!empty($_POST['cantidad']) && !empty($_POST['fecha_venta']) && !empty($_POST['producto_id']) && !empty($_POST['total'])) {
    // Obtener los datos del formulario
    $cantidad = $_POST['cantidad'];
    $fecha_venta = $_POST['fecha_venta'];
    $producto_id = $_POST['producto_id'];
    $total = $_POST['total'];

    // Validar y sanitizar datos
    $cantidad = mysqli_real_escape_string($conn, $cantidad);
    $fecha_venta = mysqli_real_escape_string($conn, $fecha_venta);
    $producto_id = mysqli_real_escape_string($conn, $producto_id);
    $total = mysqli_real_escape_string($conn, $total);

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Insertar datos en la tabla ventas
        $sql_ventas = "INSERT INTO ventas (cantidad, fecha_venta, producto_id, total, usuario_id) VALUES ('$cantidad', '$fecha_venta', '$producto_id', '$total', '$user_id')";
        if (!$conn->query($sql_ventas)) {
            throw new Exception("Error en la inserción de ventas: " . $conn->error);
        }

        // Actualizar la cantidad en la tabla productos
        $sql_productos = "UPDATE productos SET cantidad = cantidad - '$cantidad' WHERE id = '$producto_id'";
        if (!$conn->query($sql_productos)) {
            throw new Exception("Error en la actualización de productos: " . $conn->error);
        }

        // Confirmar la transacción
        $conn->commit();
        echo "Venta registrada exitosamente y productos actualizados";
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Por favor, completa todos los campos del formulario.";
}

$conn->close();
?>
