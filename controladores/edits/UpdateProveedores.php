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

            $provdr_tel_str = $_POST['telefono'];
            $provdr_tel = intval($provdr_tel_str);

            $proveedor->SetRespaldo($id,1);
            $proveedor->UpdateProveedor($id, $_POST['nombre-empresa'], $_POST['direccion-proveedor'], $_POST['persona-contacto'], $provdr_tel, $_POST['correo-proveedor']);
            
            header("location:./../../proveedores/read.php");
        }
    }
 }
?>