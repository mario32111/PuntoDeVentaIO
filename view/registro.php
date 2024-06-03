<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>
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
        <div class="users-main-content">
            <h1>Productos</h1>
            <form class="registration-form" action="../src/procesar_producto.php" method="POST">
                <label for="nombre" class="form-label">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" class="form-input" required><br><br>
                
                <label for="descripcion" class="form-label">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="form-textarea" required></textarea><br><br>
                
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" class="form-input" required><br><br>
                
                <label for="cantidad" class="form-label">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" class="form-input" required><br><br>

                <label for="proveedor" class="form-label">Proveedor:</label>
                <select id="proveedor" name="proveedor" class="form-select" required>
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
                    $sql = "SELECT id, nombre FROM proveedores";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output de los datos de cada fila
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay proveedores registrados</option>";
                    }

                    $conn->close();
                    ?>
                </select><br><br>

                <button type="submit" class="form-button">Registrar Producto</button>
            </form>
        </div>
    </div>
    <script src="../src/navbar.js"></script>
</body>
</html>
