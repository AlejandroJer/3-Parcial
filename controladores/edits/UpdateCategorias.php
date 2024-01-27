<?php
 namespace controladores;
    require_once("./../../autoload.php");
    use modelos\productos;
    $producto = new productos();

 if(!isset($_POST['submit']) && !isset($_POST['categoria-nombre-edit'])){
    header("location:./../../inventario/extras/add.php");
   //  echo "No se ha enviado el formulario";
 } else {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $categoria = filter_var($_POST['categoria-nombre-edit'], FILTER_SANITIZE_STRING);
    
    $producto->UpdateCategoria($id, $categoria);
    header("location:./../../inventario/extras/add.php");
   //  echo "Material actualizado";
 }
?>