<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\proveedores;
    $proveedor = new proveedores();

 if(isset($_POST['id'])){
    $result = $proveedor->GetProveedorById($_POST['id']);
    $_SESSION['proveedores'] = $result;
    header("location:./../../proveedores/update.php");
 }else{
    if(isset($_POST['submit'])){
        if(!isset($_POST['nombre-empresa']) or !isset($_POST['direccion-proveedor']) or !isset($_POST['persona-contacto']) or !isset($_POST['telefono']) or !isset($_POST['correo-proveedor'])){
            header("location:./../../proveedores/add.php");
        } else {
            //in this section just add a variable which need a validation of the data type
            $id = filter_var($_POST['id_proveedor'], FILTER_SANITIZE_NUMBER_INT);
            $nombre = filter_var($_POST['nombre-empresa'], FILTER_SANITIZE_STRING);
            $direccion = filter_var($_POST['direccion-proveedor'], FILTER_SANITIZE_STRING);
            $persona = filter_var($_POST['persona-contacto'], FILTER_SANITIZE_STRING);
            $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT);
            $correo = filter_var($_POST['correo-proveedor'], FILTER_SANITIZE_EMAIL);

            $usr_making_change = $_SESSION['logged_usr'];
            $proveedor->SetRespaldo($id, $nombre, $persona, $direccion, $telefono, $correo, 1, $usr_making_change);
            $proveedor->UpdateProveedor($id, $nombre, $direccion, $persona, $telefono, $correo);
            
            header("location:./../../proveedores/read.php");
        }
    }
 }
?>