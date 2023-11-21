<?php 
namespace controladores;
require_once("../autoload.php");
use modelos\{proveedores, movimientos};
$proveedor = new proveedores();
$movimiento = new movimientos();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['nombre-empresa']) && !empty($_POST['direccion-proveedor']) && !empty($_POST['persona-contacto']) && !empty($_POST['telefono']) && !empty($_POST['correo-proveedor'])) {
        
        $nombreEmpresa = $_POST['nombre-empresa'];
        $direccionProveedor = $_POST['direccion-proveedor'];
        $personaContacto = $_POST['persona-contacto'];
        $telefono = $_POST['telefono'];
        $correoProveedor = $_POST['correo-proveedor'];

        $usr_making_change = $_SESSION['logged_usr'];
        $id = $proveedor->Insertar($nombreEmpresa, $direccionProveedor, $personaContacto, $telefono, $correoProveedor);
        $movimiento->SetMov('proveedores', $id, 0, 2, $usr_making_change);
        
        
        header("location:../proveedores/read.php");
    } else {
        echo "Error al ingresar los datos del proveedor.";
    }
}
?>
