<?php 
namespace controladores;
require_once("../autoload.php");
use modelos\proveedores;
$proveedor = new proveedores();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['nombre-empresa']) && !empty($_POST['direccion-proveedor']) && !empty($_POST['persona-contacto']) && !empty($_POST['telefono']) && !empty($_POST['correo-proveedor'])) {
        
        $nombreEmpresa = $_POST['nombre-empresa'];
        $direccionProveedor = $_POST['direccion-proveedor'];
        $personaContacto = $_POST['persona-contacto'];
        $telefono = $_POST['telefono'];
        $correoProveedor = $_POST['correo-proveedor'];

        $proveedor->Insertar($nombreEmpresa, $direccionProveedor, $personaContacto, $telefono, $correoProveedor);
        
        header("location:../proveedores/read.php");
    } else {
        echo "Error al ingresar los datos del proveedor.";
    }
}
?>
