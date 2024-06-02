<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="../style/app.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="users-container">
        <div class="users-sidebar">
            <h2 class="users-menu-title">Menú</h2>
            <ul class="users-menu-list">
                <li><a href="inicio.html" class="users-menu-item">Ventas</a></li>
                <li><a href="registro.php" class="users-menu-item">Registrar Producto</a></li>
                <li><a href="proveedores.php" class="users-menu-item users-active">Gestión de Proveedores</a></li>
                <li><a href="historial.php" class="users-menu-item">Historial de Ventas</a></li>
            </ul>

            <button class="logout-button"><a href="../src/logout.php">Cerrar sesion</a></button>

        </div>
        <div class="users-main-content">
            <h1 class="users-page-title">Proveedores</h1>
            <div class="users-user-form">
                <h2 class="users-form-title">Crear Proveedor</h2>
                <form class="users-registration-form" action="../src/procesar_proveedor.php" method="POST">
                    <label for="nombre" class="users-form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="users-form-input" required><br><br>
                    
                    <label for="contacto" class="users-form-label">:</label>
                    <input type="text" id="contacto" name="contacto" class="users-form-input" required><br><br>

                    <label for="telefono" class="users-form-label">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" class="users-form-input" required><br><br>
                    
                    <label for="email" class="users-form-label">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" class="users-form-input" required><br><br>
                    
                    <label for="direccion" class="users-form-label">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" class="users-form-input" required><br><br>
                    
                    <button type="submit" class="users-form-button">Crear Proveedor</button>
                </form>
            </div>
            <div class="users-user-list">
                <h2 class="users-list-title">Lista de Proveedores</h2>
                <ul class="users-list">
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

                    // Obtener proveedores
                    $sql = "SELECT nombre, contacto, telefono, email, direccion FROM proveedores";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output de los datos de cada fila
                        while($row = $result->fetch_assoc()) {
                            echo "<li><strong>Nombre:</strong> " . $row["nombre"] . " | <strong>Contacto:</strong> " . $row["contacto"] . " | <strong>Teléfono:</strong> " . $row["telefono"] . " | <strong>Correo Electrónico:</strong> " . $row["email"] . " | <strong>Dirección:</strong> " . $row["direccion"] . "</li>";
                        }
                    } else {
                        echo "<li>No hay proveedores registrados</li>";
                    }

                    $conn->close();
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
