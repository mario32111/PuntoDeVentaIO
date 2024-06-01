<?php
// Configuración de la base de datos
$servername = "fdb1034.awardspace.net"; // Cambia esto con el servidor proporcionado por AwardSpace
$username = "4472420_puntodeventa"; // Cambia esto con el usuario proporcionado por AwardSpace
$password = "productos1"; // Cambia esto con la contraseña proporcionada por AwardSpace
$dbname = "4472420_puntodeventa"; // Cambia esto con el nombre de la base de datos proporcionado por AwardSpace

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar que todos los datos necesarios estén presentes en $_POST
if (!empty($_POST['cantidad']) && !empty($_POST['fecha_venta']) && !empty($_POST['producto-id']) && !empty($_POST['total']) && !empty($_POST['usuario-id'])) {
    // Obtener los datos del formulario
    $cantidad = $_POST['cantidad'];
    $fecha_venta = $_POST['fecha_venta'];
    $producto_id = $_POST['producto-id'];
    $total = $_POST['total'];
    $usuario_id = $_POST['usuario-id'];

    // Validar y sanitizar datos
    $cantidad = mysqli_real_escape_string($conn, $cantidad);
    $fecha_venta = mysqli_real_escape_string($conn, $fecha_venta);
    $producto_id = mysqli_real_escape_string($conn, $producto_id);
    $total = mysqli_real_escape_string($conn, $total);
    $usuario_id = mysqli_real_escape_string($conn, $usuario_id);

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Insertar datos en la tabla ventas
        $sql_ventas = "INSERT INTO ventas (cantidad, fecha_venta, producto_id, total, usuario_id) VALUES ('$cantidad', '$fecha_venta', '$producto_id', '$total', '$usuario_id')";
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
