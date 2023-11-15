<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\productos;
    $producto = new productos();

 if(!isset($_POST['submit']) && !isset($_POST['id'])){
    header("location:./../../inventario/extras/add.php");
   //  echo "No se ha enviado el formulario";
 } else {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    
    $producto->DeleteMaterial($id);
    header("location:./../../inventario/extras/add.php");
   //  echo "Material actualizado";
 }
?>