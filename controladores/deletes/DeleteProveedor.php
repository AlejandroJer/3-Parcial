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
    $id = filter_var($_POST['id_proveedor'], FILTER_SANITIZE_NUMBER_INT);
    $result = $proveedores->GetProveedorById($id);
    $usr_making_change = $_SESSION['logged_usr'];
    $proveedores->SetRespaldo($result['id_proveedor'], $result['nombre_empresa'], $result['persona_contacto'], $result['direccion'], $result['num_telefono'], $result['email_proveedor'], 0, $usr_making_change);
    $proveedores->DeleteProveedor($result['id_proveedor']);
    
    header("location:./../../proveedores/read.php");
 } else {
    header("location:./../../proveedores/read.php");
 }
}
?>