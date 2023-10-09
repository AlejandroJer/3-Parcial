<?php
    namespace controladores;
    require_once("../autoload.php");
    use modelos\productos;
    $producto = new productos();
    if(!isset($_POST['producto-nombre']) or !isset($_POST['producto-proveedor']) or !isset($_POST['producto-precio-venta']) or !isset($_POST['producto-precio-compra']) or !isset($_POST['categoria']) or !isset($_POST['tipo-material']) or !isset($_POST['peso']) or !isset($_POST['cantidad-disponible']) or !isset($_POST['ubicacion-almacen']) or !isset($_POST['producto-descripcion'])){
        header("location:../inventario/add.php");
    } else {
        if($_FILES['image']['error'] == 0){
            $name_images= $producto->GetDirImg();
            $dir_img = $producto->InsertarImg($name_images);
            $producto->Insertar($_POST['producto-nombre'], $_POST['producto-descripcion'], $dir_img, $_POST['producto-precio-compra'], $_POST['producto-precio-venta'], $_POST['categoria'], $_POST['peso'], $_POST['tipo-material'], $_POST['cantidad-disponible'], $_POST['ubicacion-almacen'], $_POST['producto-proveedor']);
            header("location:../inventario/read.html");
        }else{
            $publicacion->Insertar($_POST['producto-nombre'], $_POST['producto-descripcion'], $dir_img, $_POST['producto-precio-compra'], $_POST['producto-precio-venta'], $_POST['categoria'], $_POST['peso'], $_POST['tipo-material'], $_POST['cantidad-disponible'], $_POST['ubicacion-almacen'], $_POST['producto-proveedor']);
            header("location:../inventario/read.html");
        }
    }
?>