<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\proveedores;
    $proveedores = new proveedores();

 if(isset($_POST['id'])){
  $result = $proveedores->GetProveedorById($_POST['id']);
  $_SESSION['proveedores'] = $result;
  header("location:./../../proveedores/delete.php");
}else{
  if(isset($_POST['submit'])){
    $result = $proveedores->GetProveedorById($_POST['id_proveedor']);
    $proveedores->DeleteProveedor($_POST['id_proveedor']);
    $proveedores->SetRespaldo($result['nombre_empresa'], $result['persona_contacto'], $result['direccion'], $result['num_telefono'], $result['email_proveedor']);
    
    header("location:./../../proveedores/read.php");
 } else {
    header("location:./../../proveedores/read.php");
 }
}
?>