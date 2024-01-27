<?php
    namespace controladores;
    require_once("../autoload.php");
    use modelos\productos;
    $producto = new productos();
    if(!isset($_POST['material-nombre']) && !isset($_POST['submit'])){
        header("location:../inventario/extras/add.php");
    } else {
        $material = filter_var($_POST['material-nombre'], FILTER_SANITIZE_STRING);
        
        $producto->InsertarMaterial($material);
        header("location:../inventario/extras/add.php");
    }
?>