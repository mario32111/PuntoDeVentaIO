<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php");
    exit(); // Asegurarse de que el script se detenga aquí
}

// Obtener el ID de usuario de la sesión
$user_id = $_SESSION['user_id'];

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

// Obtener datos de ventas del usuario actual de la tabla "ventas"
$sql = "SELECT producto_id, cantidad, fecha_venta, total, usuario_id FROM ventas WHERE usuario_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas</title>
    <link rel="stylesheet" href="../style/app.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>M</h2>
            <ul>
                <li><a href="inicio.html"><span></span></a></li>
                <li><a href="registro.php"><span></span></a></li>
                <li><a href="proveedores.php"><span></span></a></li>
                <li><a href="historial.php"><span></span></a></li>
            </ul>
            <button class="logout-button"><a href="../src/logout.php">Cerrar sesion</a></button>
        </div>
        <div class="main-content">
            <h1>Historial de Ventas</h1>
            <table>
                <thead>
                    <tr>
                        <th>Producto ID</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Usuario ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Output de los datos en la tabla HTML
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["producto_id"] . "</td>";
                            echo "<td>" . $row["cantidad"] . "</td>";
                            echo "<td>" . $row["fecha_venta"] . "</td>";
                            echo "<td>" . $row["total"] . "</td>";
                            echo "<td>" . $row["usuario_id"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay ventas registradas para este usuario.</td></tr>";
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../src/navbar.js"></script>
</body>
</html>
