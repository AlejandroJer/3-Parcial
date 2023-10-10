<?php
    //Conexión 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jemas";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    //Consulta
    $sql = "SELECT * FROM proveedores";
    $result = $conn->query($sql);

    //Datos y tabla
    if ($result->num_rows > 0) {
        echo "<h2>Lista de Proveedores</h2>";
        echo "<table>";
        echo "<tr><th>ID del proveedor</th><th>Nombre de la Empresa</th><th>Dirección</th><th>Persona de Contacto</th><th>Teléfono</th><th>Correo Electrónico</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_proveedor"] . "</td>";
            echo "<td>" . $row["nombre_empresa"] . "</td>";
            echo "<td>" . $row["direccion"] . "</td>";
            echo "<td>" . $row["persona_contacto"] . "</td>";
            echo "<td>" . $row["num_telefono"] . "</td>";
            echo "<td>" . $row["email_proveedor"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo '<a href="../dashboard.html" class="btn btn-primary">Volver al Dashboard</a>';
    } else {
        echo "No se encontraron proveedores.";
    }

    $conn->close();
?>
