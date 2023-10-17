<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\proveedores;
    $proveedor = new proveedores();

 if(isset($_POST['id'])){
    $result = $proveedor->GetProveedorById($_POST['id']);
    $_SESSION['proveedores'] = $result;
    header("location:./../../proveedores/add.php");
 }else{
    if(isset($_POST['submit'])){
        if(!isset($_POST['nombre-empresa']) or !isset($_POST['direccion-proveedor']) or !isset($_POST['persona-contacto']) or !isset($_POST['telefono']) or !isset($_POST['correo-proveedor'])){
            header("location:./../../proveedores/add.php");
        } else {
            //in this section just add a variable which need a validation of the data type
            $id_str = $_POST['id_proveedor'];
            $id = intval($id_str);

            $provdr_tel_str = $_POST['telefono'];
            $provdr_tel = intval($provdr_tel_str);

            $proveedor->UpdateProveedor($id, $_POST['nombre-empresa'], $_POST['direccion-proveedor'], $_POST['persona-contacto'], $provdr_tel, $_POST['correo-proveedor']);
            
            header("location:./../../proveedores/read.php");
        }
    }
 }
?>