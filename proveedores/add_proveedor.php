<?php
    // Conexión BD
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jemas";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    } 

    // Recibir los datos y almacenarlos
    $idProveedor = $_POST["id-proveedor"];
    $nombreEmpresa = $_POST["nombre-empresa"];
    $direccionProveedor = $_POST["direccion-proveedor"];
    $personaContacto = $_POST["persona-contacto"];
    $telefono = $_POST["telefono"];
    $correoProveedor = $_POST["correo-proveedor"];

    // Insertar datos en la BD
    $sql = "INSERT INTO proveedores (id_proveedor, nombre_empresa, direccion, persona_contacto, num_telefono, email_proveedor)
    VALUES ('$idProveedor', '$nombreEmpresa', '$direccionProveedor', '$personaContacto', '$telefono', '$correoProveedor')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Datos guardados correctamente";
        echo '<a href="../dashboard.html" class="btn btn-primary">Volver al Dashboard</a>';
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }
    
    $conn->close();
?>
