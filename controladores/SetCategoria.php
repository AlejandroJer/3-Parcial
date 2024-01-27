<?php
    namespace controladores;
    require_once("../autoload.php");
    use modelos\productos;
    $producto = new productos();
    if(!isset($_POST['categoria-nombre']) && !isset($_POST['submit'])){
        header("location:../inventario/extras/add.php");
    } else {
        $categoria = filter_var($_POST['categoria-nombre'], FILTER_SANITIZE_STRING);
        
        $producto->InsertarCategoria($categoria);
        header("location:../inventario/extras/add.php");
    }
?>